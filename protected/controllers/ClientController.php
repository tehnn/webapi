<?php

class ClientController extends Controller {

    public function filters() {
        return array();
    }

    public function actionList() {
        $url = "http://localhost/webapi/index.php/api2/patients/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $rawData = json_decode($result, true);
        //print_r($rawData);
        //return;
        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'id',
            'totalItemCount' => count($rawData),
            'sort' => array(
                'attributes' => count($rawData) > 0 ? array_keys($rawData[0]) : ''
            ),
            'pagination' => array(
                'pagesize' => 15
            )
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id = "") {
        $url = "http://localhost/webapi/index.php/api2/patients/$id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $rawData = json_decode($result, true);

        $this->render('view', array(
            'rawData' => $rawData
        ));
    }

    public function actionPost() {

        extract($_POST);
        $url = "http://localhost/webapi/index.php/api2/patients/";

        $fields = array(
            'name' => urlencode($name),
            'lname' => urlencode($lname),
            'dx' => urlencode($dx),
        );

        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        $response = curl_exec($ch);

        curl_close($ch);
        if ($response) {
            $this->redirect(array('list'));
        }
    }

    public function actionPut() {

        extract($_POST);
        $url = "http://localhost/webapi/index.php/api2/patients/$id";

        $put_data = array(
            'name' => $name,
            'lname' => $lname,
            'dx' => $dx
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($put_data));

        $response = curl_exec($ch);

        curl_close($ch);

        if ($response) {
            $this->redirect(array('list'));
        }
    }

    public function actionDelete($id = NULL) {


        $url = "http://localhost/webapi/index.php/api2/patients/$id";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //echo $response;
        //echo "<br>";
        //echo $httpCode;
        
        if ($response) {
            //$this->redirect(array('list'));
            //grid view update by ajax
        }

        
    }

}
