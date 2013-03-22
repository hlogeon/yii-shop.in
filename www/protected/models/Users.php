<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $name
 * @property string $password
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password', 'required'),
			array('login, email, name', 'length', 'max'=>25),
			array('password', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, email, name, password', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'email' => 'Почта',
			'name' => 'Имя',
			'password' => 'Пароль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	**@author Degtyaruk A.
	**@param $data should be the $_GET array which was send by the registration form
	** This method defines user registration feature
	*/

	public function registerUser($data = array()){
		if(empty($data)){
			return false;
		}
		if(isExistingUser){
			echo "User Already exists";
			return false;
		}
		$user = new Users();
		$user->login = $data['login'];
		$user->email = $data['email'];
		if(isset($data['name'])){
			$user->name = $data['name'];
		}
		$user->password = md5($data['password']);
		$user->save();
		return true;
	}


	public function login($data = array()){
		if(empty($data)){
			return false;
		}
		if(!isExistingUser){
			return false;
		}

		$user = new Users();
		$user->login = $data['login'];
		$user->password = md5($data['password']);
		if ($user->password == self::checkPass($user->login)) {
			// success code...
			echo "succes!!!";
			return true;
		}
		else{
			//unsuccessful
			echo "unsuccessful";
			return false;
		}

	}

	private function checkPass($login){
		$criteria = new CDbCriteria();
		$criteria->select = 'password';
		$criteria->condition = 'login:=login';
		$criteria->params = ":login=>$login";
		$password = self::find($criteria);
		return $password;
	}

	/**
	**@author Degtyaruk A.
	**Checks if user is already exists
	*/

	private function isExistingUser($data){
		$potential = self::exists(array('login=:login or email=email'),
										 array(':login' => $data['login'], ':email' => $data['email'] ));
		return $potential;
	}


}