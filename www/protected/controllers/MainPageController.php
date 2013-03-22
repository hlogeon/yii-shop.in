<?php

class MainPageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}


	public function actionLogin()
	{
    	$model=new Users('login');

   	 // uncomment the following code to enable ajax-based validation
    	/*
    	if(isset($_POST['ajax']) && $_POST['ajax']==='users-login-form')
    	{
        echo CActiveForm::validate($model);
        Yii::app()->end();
   		}
    	*/

   	 if(isset($_POST['Users']))
    		{
        		$model->attributes=$_POST['Users'];
        		if($model->validate())
        		{
            		$model->login($model->attributes);
            		return;
        		}
    		}
    $this->render('login',array('model'=>$model));
	}

	public function actionRegister(){
		$model = new Users('register');
		if(isset($_POST['Users'])){
			$model->attributes = $_POST['Users'];
			if($model->validate()){
				$model->registerUser($model->attributes);
				return;
			}
			$this->render('login', array('model'=>$model));
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}