<?php


/**
 * Description of SiteController
 *
 * @author UTEHN
 */
class SiteController extends Controller {
    
    public function actionIndex() {
        $this->render('index');
    }
    
    public function actionTest(){
        echo "test";
    }

    public function actionError(){
        if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
                            $this->render('error',$error);
		}
    }
}
