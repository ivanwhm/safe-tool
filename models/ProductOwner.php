<?php

/**
 * This is the model class for table "product-owner".
 *
 * @property int $id Product owner ID.
 * @property int $user_id User ID associated with this product owner.
 * @property string $name Product owner name.
 * @property string $status Product owner status.
 * @property string $date_created Date and time that product owner was created.
 * @property string $date_updated Date and time that product owner was updated.
 * @property int $user_created User ID that created this product owner.
 * @property int $user_updated User ID that updated this product owner.
 *
 * @property User $user Data of the user associated with this product owner.
 * @property User $userCreated Data of user that created this product owner.
 * @property User $userUpdated Data of user that updated this product owner.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class ProductOwner extends SafeToolActiveRecord
{

	const STATUS_ACTIVE = 'A';
	const STATUS_INACTIVE = 'I';
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%product_owner}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'name', 'status'], 'required'],
			[['id', 'user_id', 'user_created', 'user_updated'], 'integer'],
			[['date_created', 'date_updated'], 'safe'],
			[['name'], 'string', 'max' => 100],
			[['status'], 'string', 'max' => 1],
			[['user_id'], 'unique'],
			[['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_created' => 'id']],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
			[['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_updated' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('product-owner', 'ID'),
			'user_id' => Yii::t('product-owner', 'The user associated with the product owner'),
			'name' => Yii::t('product-owner', 'Name'),
			'status' => Yii::t('product-owner', 'Status'),
			'date_created' => Yii::t('product-owner', 'Date of creation'),
			'date_updated' => Yii::t('product-owner', 'Date of the last update'),
			'user_created' => Yii::t('product-owner', 'The user of creation'),
			'user_updated' => Yii::t('product-owner', 'The user of the last update'),
		];
	}

	/**
	 * Returns the user associated with this product owner.
	 * 
	 * @return User
	 */
	public function getUser()
	{
		return User::findOne(['id' => $this->getAttribute('user_id')]);
	}


	/**
	 * Returns all the product owner status information.
	 *
	 * @return array
	 */
	public static function getStatusData()
	{
		return [
			self::STATUS_ACTIVE => Yii::t('index', 'Active'),
			self::STATUS_INACTIVE => Yii::t('index', 'Inactive')
		];
	}

	/**
	 * Returns the status description of the product owner.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return ($this->getAttribute('status') != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->getAttribute('status') == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->getAttribute('status')], ['class' => 'label ' . (($this->getAttribute('status') == self::STATUS_ACTIVE) ? 'label-success' : 'label-danger')]) : '';
	}

	/**
	 * Returns the link to product owner visualization info.
	 *
	 * @return string
	 */
	public function getLink()
	{
		return Url::to(['product-owner/view', 'id' => $this->getAttribute('id')]);
	}	
}
