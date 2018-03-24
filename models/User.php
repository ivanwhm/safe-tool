<?php

/**
 * This is the model class for table "user".
 *
 * @property int $id User User ID.
 * @property string $username Username.
 * @property string $password User password.
 * @property string $salt User salt password.
 * @property string $status User status.
 * @property string $email User e-mail.
 * @property string $language User language.
 * @property datetime $last_login_date Date ant time of the last user login.
 * @property datetime $date_created Date and time that user was created.
 * @property datetime $date_updated Date and time that user was updated.
 * @property int $user_created User ID that created this user.
 * @property int $user_updated User ID that updated this user.
 *
 * @property User $userCreated Data of user that created this user.
 * @property User $userUpdated Data of user that updated this user.
 * @property User[] $createdUsers Users that this user created.
 * @property User[] $updatedUsers Users that this user updated.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\web\IdentityInterface;

class User extends SafeToolActiveRecord implements IdentityInterface
{

	const LANGUAGE_PT_BR = 'pt-BR';
	const LANGUAGE_EN_US = 'en-US';

	const STATUS_ACTIVE = 'A';
	const STATUS_INACTIVE = 'I';

	/**
	 * Attribute used to compare passwords.
	 *
	 * @var string
	 */
	public $new_password;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['username', 'password', 'salt', 'email', 'language'], 'required'],
			[['id', 'user_created', 'user_updated'], 'integer'],
			[['last_login_date', 'date_created', 'date_updated'], 'safe'],
			[['username'], 'string', 'max' => 20],
			[['password'], 'string', 'max' => 64],
			[['salt'], 'string', 'max' => 128],
			[['status'], 'string', 'max' => 1],
			[['email'], 'string', 'max' => 150],
			[['language'], 'string', 'max' => 5],
			[['id', 'username', 'email'], 'unique'],
			[['password', 'new_password'], 'required', 'on' => 'create'],
			[['new_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('password', 'The entered passwords are different.')],
			[['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_created' => 'id']],
			[['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_updated' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('user', 'ID'),
			'username' => Yii::t('user', 'Username'),
			'password' => Yii::t('user', 'Password'),
			'salt' => Yii::t('user', 'SALT'),
			'status' => Yii::t('user', 'Status'),
			'email' => Yii::t('user', 'E-mail'),
			'language' => Yii::t('user', 'Language'),
			'last_login_date' => Yii::t('user', 'Date of the last login'),
			'date_created' => Yii::t('user', 'Date of creation'),
			'date_updated' => Yii::t('user', 'Date of the last update'),
			'user_created' => Yii::t('user', 'The user of creation'),
			'user_updated' => Yii::t('user', 'The user of the last update'),
		];
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUserCreated()
	{
		return $this->hasOne(User::class, ['id' => 'user_created']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getCreatedUsers()
	{
		return $this->hasMany(User::class, ['user_created' => 'id']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUserUpdated()
	{
		return $this->hasOne(User::class, ['id' => 'user_updated']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUpdatedUsers()
	{
		return $this->hasMany(User::class, ['user_updated' => 'id']);
	}

	/**
	 * Register the last login of the user.
	 */
	public function registerLogin()
	{
		$this->password = '';
		$this->last_login_date = new Expression('current_timestamp');
		$this->save(false);
	}

	/**
	 * Do the password cryptography.
	 *
	 * @param $password string Password
	 * @param $key string Password Key
	 * @return string
	 */
	private function passwordCrypt($password, $key)
	{
		return hash('SHA256', $password . $key);
	}

	/**
	 * Finds an identity by the given ID.
	 *
	 * @param integer $id the ID to be looked for
	 * @return User
	 */
	public static function findIdentity($id)
	{
		return User::findOne(['status' => User::STATUS_ACTIVE, 'id' => $id]);
	}

	/**
	 * Finds an identity by the given username.
	 *
	 * @param $username string the username to be looked for
	 * @return User
	 */
	public static function findByUsername($username)
	{
		return User::findOne(['status' => User::STATUS_ACTIVE, 'username' => $username]);
	}

	/**
	 * Returns an ID that can uniquely identify a user identity.
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns a key that can be used to check the validity of a given identity ID.
	 *
	 * The key should be unique for each individual user, and should be persistent
	 * so that it can be used to check the validity of the user identity.
	 *
	 * The space of such keys should be big enough to defeat potential identity attacks.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 * @return string a key that is used to check the validity of a given identity ID.
	 * @see validateAuthKey()
	 */
	public function getAuthKey()
	{
		return $this->password;
	}

	/**
	 * Validates the given auth key.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 * @param string $authKey the given auth key
	 * @return boolean whether the given auth key is valid.
	 * @see getAuthKey()
	 */
	public function validateAuthKey($authKey)
	{
		return $this->passwordCrypt($authKey, $this->salt) === $this->getAuthKey();
	}

	/**
	 * @inheritdoc
	 */
	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			return ($this->id !== 1);
		}
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if ($insert) {
			$this->salt = Yii::$app->getSecurity()->generateRandomString(128);
		}

		if ($this->password != '') {
			$this->salt = Yii::$app->getSecurity()->generateRandomString(128);
			$this->password = $this->passwordCrypt($this->password, $this->salt);
		} else {
			$user = User::findIdentity($this->id);
			if ($user) {
				$this->password = $user->password;
			}
		}

		return parent::beforeSave($insert);
	}

	/**
	 * Finds an identity by the given token.
	 * @param mixed $token the token to be looked for
	 * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
	 * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
	 * @return IdentityInterface the identity object that matches the given token.
	 * Null should be returned if such an identity cannot be found
	 * or the identity is not in an active state (disabled, deleted, etc.)
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		// TODO: Implement findIdentityByAccessToken() method.
		return null;	
	}
}
