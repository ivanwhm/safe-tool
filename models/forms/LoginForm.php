<?php

/**
 * LoginForm is the model behind the login form.
 *
 * @property User $user This property is read-only.
 *
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\forms;

//Imports
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
	
	public $username;
	public $password;
	public $rememberMe = false;

	private $_user = false;


	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			[['username', 'password'], 'required'],
			['rememberMe', 'boolean'],
			['password', 'validatePassword'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'username' => Yii::t('login', 'Username'),
			'password' => Yii::t('login', 'Password'),
			'rememberMe' => Yii::t('login', 'Remember me for 30 days'),
		];
	}	

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Yii::t('login', 'Incorrect username or password.'));
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return bool whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->getUser()->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		}
		return false;
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByUsername($this->username);
		}

		return $this->_user;
	}
	
}
