<?php


class RegisterForm extends CFormModel{
	

	public $login;
	public $name;
	public $email;
	public $password;
	public $confirmation;


	public function rules(){
		return array(
			array('email, confirmation',  'required', 'on'=>'register'),
			array('login, password', 'required', 'on'=>'register, login'),
			array('email', 'email'),
			array('password', 'length', 'min'=> 4, 'max'=>16),
			array('password', 'compare', 'compareAttribute'=> 'confirmation', 'on'=>'register'),
			);
	}

	public function attributeLabels(){
		return array(
			'login'=> 'Login',
			'name'=> 'Имя',
			'email'=> 'E-mail',
			'password'=> 'Пароль',
			'confirmation'=> 'Подтвердите пароль',
			);
	}


	public function register($data= array()){
		if(empty($data))
			return false;
		$user = new User();
		$user->createUser($this->attributes);
		return true;
	}

	public function login($data = array()){
		if(empty($data))
			return false;
		$user = new User();
		if($user->login($data))
			return true;
		return false;
	}




}