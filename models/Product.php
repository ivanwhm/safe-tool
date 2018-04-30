<?php
/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $status
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

use app\components\SafeToolActiveRecord;
use app\models\enums\Status;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class Product extends SafeToolActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'status'], 'required'],
			[['date_created', 'date_updated'], 'safe'],
			[['user_created', 'user_updated'], 'integer'],
			[['name'], 'string', 'max' => 50],
			[['status'], 'string', 'max' => 1],
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
			'id' => Yii::t('product', 'ID'),
			'name' => Yii::t('product', 'Name'),
			'status' => Yii::t('product', 'Status'),
			'date_created' => Yii::t('product', 'Date of creation'),
			'date_updated' => Yii::t('product', 'Date of the last update'),
			'user_created' => Yii::t('product', 'The user of creation'),
			'user_updated' => Yii::t('product', 'The user of the last update'),
		];
	}

	/**
	 * Returns the link to product visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['product/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['product/view', 'id' => $this->getAttribute('id')]);
	}

	/**
	 * Returns the status description of the product.
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
		$query = self::find();
		$query->orderBy('name');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => ['attributes' => ['id', 'name']]
		]);
		$this->load($params);

		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['like', 'name', $this->getAttribute('name')])
			->andFilterWhere(['=', 'status', $this->getAttribute('status')]);

		return $dataProvider;
	}
}
