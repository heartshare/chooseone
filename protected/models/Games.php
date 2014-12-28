<?php

/**
 * This is the model class for table "{{games}}".
 *
 * The followings are the available columns in table '{{games}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class Games extends CActiveRecord
{
    public $image;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{games}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('image', 'file', 'types' => 'jpg,png,gif', 'allowEmpty' => true, 'on' => 'create,updates'),
            array('name, description', 'required'),
            array('name', 'length', 'max' => 255),
            array('id, name, description, image', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'screens' => array(self::HAS_MANY, 'Screens', 'game_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Назва',
            'description' => 'Опис',
            'image' => 'Постер',
            'genre' => 'Жанр'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Games the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return mixed
     */
    public function afterSave()
    {
        $this->setIsNewRecord(false);
        if (isset($_FILES['screens'])) {
            $images = CUploadedFile::getInstancesByName('screens');
            if (isset($images) && count($images) > 0) {
                foreach ($images as $pic) {
                    $screens = new Screens;
                    $pic->saveAs(Yii::getPathOfAlias('webroot.images.games.screens') . DIRECTORY_SEPARATOR . $pic);
                    $screens->image = $pic->name;
                    $screens->game_id = $this->id;
                    $screens->save();
                }
            }
        }

        return parent::afterSave();
    }

    /**
     * @param $comment
     * @return mixed
     */
    public function addComment($comment)
    {
        $comment->game_id = $this->id;

        return $comment->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->condition = 'game_id=' . $id;
        $comments = Comments::model()->findAll($criteria);

        return $comments;
    }
}
