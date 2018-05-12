<?php
/**
 * This is the model class for table "epic".
 *
 * @property int $id Epic ID.
 * @property string $title Epic title.
 * @property int $product_id Product ID of the epic.
 * @property string $type Epic type.
 * @property string $epic Epic full description.
 * @property string $date_created Date and time that the epic was created.
 * @property string $date_updated Date and time that the epic was updated.
 * @property int $user_created User ID that created this epic.
 * @property int $user_updated User ID that updated this epic.
 *
 * @property User $userCreated Data of user that created this epic.
 * @property User $userUpdated Data of user that updated this epic.
 * @property Product $product Data of the epic product.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use app\models\enums\EpicType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Epic extends SafeToolActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'epic';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'product_id', 'type', 'epic'], 'required'],
			[['date_created', 'date_updated'], 'safe'],
			[['product_id', 'user_created', 'user_updated'], 'integer'],
			[['title'], 'string', 'max' => 50],
			[['type'], 'string', 'max' => 1],
			[['epic'], 'string', 'max' => 2000],
			[['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
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
			'id' => Yii::t('epic', 'ID'),
			'title' => Yii::t('epic', 'Title'),
			'product_id' => Yii::t('epic', 'Product'),
			'type' => Yii::t('epic', 'Type'),
			'epic' => Yii::t('epic', 'Epic'),
			'date_created' => Yii::t('epic', 'Date of creation'),
			'date_updated' => Yii::t('epic', 'Date of the last update'),
			'user_created' => Yii::t('epic', 'The user of creation'),
			'user_updated' => Yii::t('epic', 'The user of the last update'),
		];
	}

	/**
	 * Returns the type description of the epic.
	 *
	 * @return string
	 */
	public function getType()
	{
		return EpicType::getTypeDescription($this->getAttribute('type'));
	}

	/**
	 * Returns the link to epic visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['epic/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['epic/view', 'id' => $this->getAttribute('id')]);
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
		$query->orderBy('title');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => ['attributes' => ['title', 'id']]
		]);
		$this->load($params);

		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['=', 'product_id', $this->getAttribute('product_id')])
			->andFilterWhere(['=', 'type', $this->getAttribute('type')])
			->andFilterWhere(['like', 'epic', $this->getAttribute('epic')]);

		return $dataProvider;
	}

	/**
	 * Returns all the epics.
	 *
	 * @param int $productId Product ID.
	 * @param string $type Type of return.
	 * @return array
	 */
	public static function getEpics($productId, $type = 'map')
	{
		$epics = self::find()->where(['product_id' => $productId])->orderBy('title')->all();
		if ($type === 'array') {
			$result = [];
			foreach ($epics as $epic) {
				$result[] = [
					'id' => $epic->getAttribute('id'),
					'name' => $epic->getAttribute('title')
				];
			}
			return $result;
		}
		return ArrayHelper::map($epics, 'id', 'title');
	}

	/**
	 * Returns the epic link of the record.
	 *
	 * @return string
	 */
	public function printLink() {
		return Html::a($this->getAttribute('title'), $this->getLink());
	}

	/**
	 * Return the product of the epic.
	 * 
	 * @return Product
	 */
	public function getProduct()
	{
		return Product::findOne(['id' => $this->getAttribute('product_id')]);
	}	
}
