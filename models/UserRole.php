<?php
/**
 * This is the model class for table "user_role".
 *
 * @property int $id User Role ID.
 * @property string $role User Role name.
 * @property string $description User Role description.
 * @property int $status User Role status.
 * @property string $date_created Date and time that product was created.
 * @property string $date_updated Date and time that product was updated.
 * @property int $user_created User ID that created this product.
 * @property int $user_updated User ID that updated this product.
 *
 * @property User $userCreated Data of user that created this product owner.
 * @property User $userUpdated Data of user that updated this product owner.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use app\models\enums\Status;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class UserRole extends SafeToolActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'user_role';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['role', 'status'], 'required'],
			[['status', 'user_created', 'user_updated'], 'integer'],
			[['date_created', 'date_updated'], 'safe'],
			[['role'], 'string', 'max' => 50],
			[['description'], 'string', 'max' => 500],
			[['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_created' => 'id']],
			[['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_updated' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('user-role', 'ID'),
			'role' => Yii::t('user-role', 'Name'),
			'description' => Yii::t('user-role', 'Description'),
			'status' => Yii::t('user-role', 'Status'),
			'date_created' => Yii::t('user-role', 'Date of creation'),
			'date_updated' => Yii::t('user-role', 'Date of the last update'),
			'user_created' => Yii::t('user-role', 'The user of creation'),
			'user_updated' => Yii::t('user-role', 'The user of the last update'),
		];
	}

	/**
	 * Returns the status description of the user role.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return Status::getStatusDescriptionWithLabel($this->getAttribute('status'));
	}

	/**
	 * Returns the form search.
	 *
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$this->load($params);

		$query = self::find()->orderBy('role');
		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['like', 'role', $this->getAttribute('role')])
			->andFilterWhere(['=', 'status', $this->getAttribute('status')]);

		return new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => ['attributes' => ['role', 'id']]
		]);
	}

	/**
	 * Returns the user role link of the record.
	 *
	 * @return string
	 */
	public function printLink()
	{
		return Html::a($this->getAttribute('role'), $this->getLink());
	}

	/**
	 * Returns the link to user role visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['user-role/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['user-role/view', 'id' => $this->getAttribute('id')]);
	}

	/**
	 * Returns all the user roles.
	 *
	 * @return array
	 */
	public static function getUserRoles()
	{
		$products = self::find()->andFilterWhere(['=', 'status', Status::ACTIVE])->orderBy('role')->all();
		return ArrayHelper::map($products, 'id', 'role');
	}

}
