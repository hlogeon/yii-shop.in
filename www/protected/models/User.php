<?php

class User extends CActiveRecord{


	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName(){
    	return 'users';
    }

	public function createUser($data){
		if(empty($data))
			return false;
		if(self::existingUser($data['login']))
			return false;
		$user = new User();
		$user->login = $data['login'];
		$user->password = md5($data['password']);
		$user->email = $data['email'];
		if(isset($data['name']) || !empty($data['name']))
			$user->name = $data['name'];
		$user->save();
	}


	public function existingUser($login){
		if(User::model()->exists('login=:login', array(':login'=>$login)))
			return true;
		return false;
	}

	public function freeEmail($email){
		if(User::model()->exists('email=:email', array(':email'=>$email)))
			return false;
		return true;
	}


	public function checkPass($login, $password){
		if(!self::existingUser($login))
			return false;
		$password = md5($password);
		$query = User::model()->find('login=:login AND password=:password', array(':login'=>$login, ':password'=>$password));
		if($query == null)
			return false;
		return true;
	}

	public function login($data){
		if(empty($data))
			return false;
		if(!self::existingUser($data['login']))
			return false;
		$password = md5($password);
		if(!self::checkPass($data['login'], $data['password']))
			return false;
		return true;

	}
}