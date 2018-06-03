<?php
/**
 * This is the model class for table "user".
 *
 * @property int $id User User ID.
 * @property string $username Username.
 * @property string $password User password.
 * @property string $salt User salt password.
 * @property boolean $status User status.
 * @property string $email User e-mail.
 * @property string $language User language.
 * @property string $last_login_date Date and time of the last user login.
 * @property string $last_password_change Date and time of the last password change.
 * @property string $date_created Date and time that user was created.
 * @property string $date_updated Date and time that user was updated.
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
use app\models\enums\Language;
use app\models\enums\Status;
use kartik\password\StrengthValidator;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Cookie;
use yii\web\IdentityInterface;

class User extends SafeToolActiveRecord implements IdentityInterface
{

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
			['status', 'default', 'value' => Status::ACTIVE],
			['language', 'default', 'value' => Yii::$app->getSession()->get('language')],
			[['username', 'name', 'email', 'language', 'status'], 'required'],
			[['id', 'user_created', 'user_updated'], 'integer'],
			[['last_login_date', 'last_password_change', 'date_created', 'date_updated'], 'safe'],
			[['username'], 'string', 'max' => 20],
			[['password'], 'string', 'max' => 64],
			[['salt'], 'string', 'max' => 128],
			[['status'], 'boolean'],
			[['name'], 'string', 'max' => 150],
			[['email'], 'string', 'max' => 150],
			[['language'], 'string', 'max' => 5],
			[['id', 'username', 'email'], 'unique'],
			[['email'], 'email'],
			[['password', 'new_password'], 'required', 'on' => 'create'],
			[['password', 'new_password'], StrengthValidator::class, 'hasUser' => false, 'hasEmail' => false, 'min' => 6, 'max' => 30, 'lower' => 1, 'upper' => 1, 'digit' => 1, 'special' => 1],
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
			'new_password' => Yii::t('user', 'Repeat password'),
			'salt' => Yii::t('user', 'SALT'),
			'status' => Yii::t('user', 'Status'),
			'name' => Yii::t('user', 'Name'),
			'email' => Yii::t('user', 'E-mail'),
			'language' => Yii::t('user', 'Language'),
			'last_login_date' => Yii::t('user', 'Date of the last login'),
			'last_password_change' => Yii::t('user', 'Date of the last password change'),
			'date_created' => Yii::t('user', 'Date of creation'),
			'date_updated' => Yii::t('user', 'Date of the last update'),
			'user_created' => Yii::t('user', 'The user of creation'),
			'user_updated' => Yii::t('user', 'The user of the last update'),
		];
	}

	/**
	 * Returns the help messages for forms.
	 *
	 * @return array
	 */
	public function getHelpMessages()
	{
		return [
			'name' => Yii::t('user', 'Input the name of the user.'),
			'username' => Yii::t('user', 'Input the username.'),
			'email' => Yii::t('user', 'Input the e-mail address.'),
			'password' => Yii::t('user', 'Input the password.'),
			'new_password' => Yii::t('user', 'Input the password (again).'),
			'language' => Yii::t('user', 'Input the language.'),
			'status' => Yii::t('user', 'Please tell if the user is active or inactive.')
		];
	}
	
	/**
	 * Return the user model that created this user.
	 *
	 * @return User
	 */
	public function getUserCreated()
	{
		return self::findOne(['id' => $this->getAttribute('user_created')]);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getCreatedUsers()
	{
		return $this->hasMany(User::class, ['user_created' => 'id']);
	}

	/**
	 * Returns the user model that updated this user.
	 *
	 * @return User
	 */
	public function getUserUpdated()
	{
		return self::findOne(['id' => $this->getAttribute('user_updated')]);
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
		//Set the last login date
		$this->setAttribute('password', '');
		$this->setAttribute('last_login_date', new Expression('current_timestamp'));
		$this->save(false);

		//Set the language session
		Yii::$app->getSession()->set('language', $this->getAttribute('language'));

		//Set the language cookie
		Yii::$app->getResponse()->getCookies()->add(new Cookie([
			'name' => 'language',
			'value' => $this->getAttribute('language')
		]));
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
		return User::findOne(['status' => Status::ACTIVE, 'id' => $id]);
	}

	/**
	 * Finds an identity by the given username.
	 *
	 * @param $username string the username to be looked for
	 * @return User
	 */
	public static function findByUsername($username)
	{
		return User::findOne(['status' => Status::ACTIVE, 'username' => $username]);
	}

	/**
	 * Returns an ID that can uniquely identify a user identity.
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->getAttribute('id');
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
		return $this->getAttribute('password');
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
		return $this->passwordCrypt($authKey, $this->getAttribute('salt')) === $this->getAuthKey();
	}

	/**
	 * @inheritdoc
	 */
	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			return ($this->getAttribute('id') !== 1);
		}
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if ($insert) {
			$this->setAttribute('salt', Yii::$app->getSecurity()->generateRandomString(128));
		}

		if ($this->getAttribute('password') !== '') {
			$this->setAttribute('salt', Yii::$app->getSecurity()->generateRandomString(128));
			$this->setAttribute('password', $this->passwordCrypt($this->getAttribute('password'), $this->getAttribute('salt')));
		} else {
			$user = User::findIdentity($this->getAttribute('id'));
			if ($user) {
				$this->setAttribute('password', $user->getAttribute('password'));
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

	/**
	 * Returns the language description of the user.
	 *
	 * @return string
	 */
	public function getLanguage()
	{
		return Language::getLanguageDescription($this->getAttribute('language'), true, ['class' => 'fa-fw']);
	}

	/**
	 * Returns the status description of the user.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return Status::getStatusDescriptionWithLabel($this->getAttribute('status'));
	}

	/**
	 * Returns the link to user visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['user/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['user/view', 'id' => $this->getAttribute('id')]);
	}

	/**
	 * Returns the last password change information to print on views.
	 *
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function printLastPasswordChangeInformation()
	{
		return Yii::t('password', 'Last password change on {date}.', [
			'date' => Yii::$app->getFormatter()->asDatetime($this->getAttribute('last_password_change'))
		]);
	}

	/**
	 * Returns all the users.
	 *
	 * @return array
	 */
	public static function getUsers()
	{
		$users = self::find()->andFilterWhere(['status' => Status::ACTIVE])->orderBy('name')->all();
		return ArrayHelper::map($users, 'id', 'name');
	}

	/**
	 * Returns the form search.
	 *
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = User::find();
		$query->orderBy('name');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => ['attributes' => ['id', 'name', 'username']]
		]);
		$this->load($params);

		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['like', 'name', $this->getAttribute('name')])
			->andFilterWhere(['like', 'username', $this->getAttribute('username')])
			->andFilterWhere(['=', 'status', $this->getAttribute('status')])
			->andFilterWhere(['=', 'language', $this->getAttribute('language')]);

		return $dataProvider;
	}

}
	