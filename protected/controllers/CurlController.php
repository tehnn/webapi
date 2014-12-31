<?php

class CurlController extends Controller {

    public function filters() {
        return array();
    }

    public function actionList() {

        $json = Yii::app()->curl->run('http://localhost/webapi/index.php/api2/patients/');

        $rawData = json_decode($json, true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'id',
            'totalItemCount' => count($rawData),
            'sort' => array(
                'attributes' => array_keys($rawData[0])
            ),
            'pagination'=>array(
                'pagesize'=>15
            )
        ));
        $this->render('rpt', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionPost1($name='ว่าง', $lname='ว่าง') {

        $url = 'http://localhost/webapi/index.php/api2/patients/';
        $fields = array(
            'name' => urlencode($name),
            'lname' => urlencode($lname),
        );


        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);


        $result = curl_exec($ch);
        curl_close($ch);
        if($result==1){
            $this->redirect(array('list'));
        }

        
    }

}
