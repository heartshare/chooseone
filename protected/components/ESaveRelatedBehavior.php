<?php

/**
 * ESaveRelatedBehavior
 * Клас що дозволяє керувати поведінкою моделей під час зберігання декількох звязаних
 * @author Stephan Lüderitz
 * @link http://www.yiiframework.com/extension/esaverelatedbehavior/
 * @link http://www.luderitz.de
 * @version 1.6
 */
class ESaveRelatedBehavior extends CActiveRecordBehavior
{
    /**
     * Saves the model and the specified relations
     * @param mixed $relations the relations to be saved. This can be either a string
     * for a single relation or an array of strings for multiple relations.
     * If the relation name is used as index with 'append' as value (relationName => 'append')
     * then existing records will not be deleted before inserting
     * @return boolean weather saving was successful
     */
    public function saveWithRelated($relations)
    {
        return $this->saveR($relations, true);
    }

    /**
     * Saves the specified relations only
     * @param mixed $relations the relations to be saved. This can be either a string
     * for a single relation or an array of strings for multiple relations.
     * If the relation name is used as index with 'append' as value (relationName => 'append')
     * then existing records will not be deleted before inserting
     * @return boolean weather saving was successful
     * @throws CException
     */
    public function saveRelated($relations)
    {
        if ($this->owner->isNewRecord) {
            throw new CException("Function saveRelated() cannot be used for new objects, use saveWithRelated instead.");
        }
        return $this->saveR($relations, false);
    }

    /**
     * Saves the model and/or specified relations
     * @param mixed $relations the relations to be saved
     * @param boolean $saveModel weather to save the model or not
     * @return boolean weather saving was successful
     * @throws CException
     */
    protected function saveR($relations, $saveModel)
    {
        $result = true;
        $t = false;
        if (!Yii::app()->db->currentTransaction) { // only start transaction if none is running already
            $t = Yii::app()->db->beginTransaction();
        }
        if ($saveModel && !$this->owner->save()) { // save owner model if saveWithRelated was called
            $result = false;
        }
        foreach ((array)$relations as $key => $relationName) { // loop through all relations that should be saved
            $config = array();
            if (!is_numeric($key)) {
                $config = $relationName;
                $relationName = $key;
            }
            $relation = $this->owner->getActiveRelation($relationName); // get relation information
            $data = $this->owner->$relationName; // get the data that was set for this relation, if no data was set, $data will contain the current related records
            $data = is_object($data) ? array($data) : (array)$data; // make sure data is an array
            $commandBuilder = $this->owner->getCommandBuilder();
            // Handle many_many relations, this check has to be done first, since CManyManyRelation extends CHasManyRelation
            if ($relation instanceof CManyManyRelation) {
                if (!$this->owner->isNewRecord) { // The owner also has to have saved successfully, so that the foreign key can be determined (if not, do nothing)
                    if (preg_match( // extract infos about mn linking table
                        '/^\s*\{{0,2}\s*(.+?)\s*\}{0,2}\s*\(\s*(.+)\s*,\s*(.+)\s*\)\s*$/s',
                        $relation->foreignKey, $matches
                    )
                    ) {
                        $info = array(
                            'mnTable' => $matches[1],
                            'mnFk1' => $matches[2],
                            'mnFk2' => $matches[3]
                        );
                    } else {
                        throw new CException("Unable to get table and foreign key information from MANY_MANY relation definition (" . $relation->foreignKey . ")");
                    }
                    $model = new $relation->className;
                    $possibleModels = $model->findAll(new CDbCriteria(array( // find all models, that can be related (used to make sure only existing records are linked)
                        'index' => $model->getMetaData()->tableSchema->primaryKey
                    )));
                    if (!@$config['append']) {
                        $criteria = new CDbCriteria;
                        $criteria->compare($info['mnFk1'], $this->owner->primaryKey);
                        $commandBuilder->createDeleteCommand($info['mnTable'], $criteria)->execute(); // delete current links to related model
                    }
                    $hasMnTableClass = @class_exists($info['mnTable']);
                    foreach ($data as $id) {
                        if (is_object($id)) { // get id if object was given
                            $id = $id->primaryKey;
                        }
                        if (array_key_exists($id, $possibleModels)) { // only add if related model exists
                            if ($hasMnTableClass) { // use class for inserting records into mn linking table if it exists
                                $obj = new $info['mnTable'];
                                $obj->attributes = array(
                                    $info['mnFk1'] => $this->owner->primaryKey,
                                    $info['mnFk2'] => $id
                                );
                                if (!$obj->save()) {
                                    $result = false;
                                }
                            } else { // otherwise make and execute insert command
                                $commandBuilder->createInsertCommand(
                                    $info['mnTable'],
                                    array(
                                        $info['mnFk1'] => $this->owner->primaryKey,
                                        $info['mnFk2'] => $id
                                    )
                                )->execute();
                            }
                            unset($possibleModels[$id]); // this makes sure that id will not be inserted twice if submitted data attempts to do so.
                        }
                    }
                    if ($result) {
                        unset($this->owner->$relationName); // saving was successful, clear the relation, so accessing it will return the related records
                    }
                }
            } elseif ($relation instanceof CHasManyRelation) { // Handle has_many relations
                if (!@$config['append']) {
                    $class = new $relation->className;
                    $class->deleteAllByAttributes(array( // delete current related models
                        $relation->foreignKey => $this->owner->primaryKey
                    ));
                }
                $dataProcessed = array();
                $counter = 0;
                $itemCount = count($data);
                foreach ($data as $key => $value) {
                    $obj = new $relation->className;
                    $obj->scenario = @$config['scenario'] ? $config['scenario'] : $obj->scenario;
                    $obj->scenario = (@$config['lastScenario'] && ++$counter == $itemCount) ? $config['lastScenario'] : $obj->scenario;
                    $obj->attributes = is_object($value) ? $value->attributes : $value;
                    $obj->{$relation->foreignKey} = $this->owner->primaryKey;
                    if ((!$this->owner->isNewRecord && !$obj->save()) || ($this->owner->isNewRecord && !$obj->validate())) { // save related record if parent was saved, otherwise only validate it to prevent insertion without foreign key
                        $result = false;
                    }
                    $dataProcessed[$key] = $obj;
                }
                $this->owner->$relationName = $dataProcessed; // set array of related records so it can be retrieved through the relation
            }
        }
        if ($t && $result) {
            $t->commit(); // commit on success if transaction was started in this behavior
        }
        if ($t && !$result) {
            $t->rollback(); // rollback on errors if transaction was started in this behavior
        }

        return $result;
    }
}
