<?php

class CURLController extends Controller {

    public function filters() {
        return array();
    }

    public function actionList() {

        $output = Yii::app()->curl->run('http://localhost/webapi/index.php/api/posts/');
        
        

        print_r($output);
    }

}

?>