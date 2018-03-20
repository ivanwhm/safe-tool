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
use app\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User $user This property is read-only.
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
			'rememberMe' => Yii::t('login', 'Remember me for {0,number,integer} days', self::getLoginDuration('days')),
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

			if (!$user || !$user->validateAuthKey($this->password)) {
				$this->addError('username', Yii::t('login', 'Incorrect username or password.'));
				$this->addError('password', Yii::t('login', 'Incorrect username or password.'));
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
			$this->getUser()->registerLogin();
			$duration = $this->rememberMe ? self::getLoginDuration('seconds') : 0;
			return Yii::$app->getUser()->login($this->getUser(), $duration);
		}
		return false;
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByUsername($this->username);
		}

		return $this->_user;
	}

	/**
	 * Returns the user login session duration.
	 * The login session duration is based on the parameter loginDuration and must be defined as seconds.
	 *
	 * @param $unit string to convert from seconds.
	 * @return int
	 */
	private static function getLoginDuration($unit)
	{
		$loginDuration = (int)Yii::$app->params['loginDuration'];

		switch ($unit) {
			case 'seconds':
				return $loginDuration;
				break;
			case 'minutes':
				return $loginDuration / 60;
				break;
			case 'hours':
				return $loginDuration / 3600;
				break;
			case 'days':
				return $loginDuration / 86400;
				break;
			default:
				return $loginDuration;
		}
	}

}