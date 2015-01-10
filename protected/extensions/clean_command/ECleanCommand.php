<?php

/**
 * Command for remove temporary data of your application
 */
class ECleanCommand extends CConsoleCommand
{
    public $webRoot;

    /**
     * Clear application cache
     */
    public function actionCache()
    {
        $cache = Yii::app()->getComponent('cache');
        if ($cache !== null) {
            $cache->flush();
            echo "Cache cleared. \n";
        } else {
            echo "Please, configure cache component! \n";
        }
    }

    /**
     * Remove old assets
     */
    public function actionAssets()
    {
        if (empty($this->webRoot)) {
            echo "Please, define path to web root of your application! \n";
            Yii::app()->end();
        }
        $this->cleanDir($this->webRoot . DIRECTORY_SEPARATOR . 'assets');
        echo "Assets removed. \n";
    }

    /**
     * Clear runtime dir
     */
    public function actionRuntime()
    {
        $this->cleanDir(Yii::app()->getRuntimePath());
        echo "Runtime dir cleared. \n";
    }

    /**
     * Clean up dir
     *
     * @param $dir
     */
    private function cleanDir($dir)
    {
        $di = new DirectoryIterator($dir);
        foreach ($di as $d) {
            if (!$d->isDot()) {
                echo "Removed " . $d->getPathName() . "\n";
                $this->removeDirRecursive($d->getPathName());
            }
        }
    }

    /**
     * Remove dir and files inside it recursive
     *
     * @param $dir
     */
    private function removeDirRecursive($dir)
    {
        $files = glob($dir . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->removeDirRecursive($file);
            } else {
                unlink($file);
            }
        }
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }

    /**
     * Show the info about 'clean' command
     *
     * @return string
     */
    public function getHelp()
    {
        $output = "This command will allow you to remove some Yii temporary data \n\n";

        return $output.parent::getHelp();
    }
}
