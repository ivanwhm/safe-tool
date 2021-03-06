<?php
/**
 * This is the model class for table "feature".
 *
 * @property int $id Feature ID.
 * @property string $feature Feature description/title.
 * @property string $benefit_hypothesis The benefit hypothesis of the feature.
 * @property string $acceptance_criteria The acceptance criteria of the feature.
 * @property int $product_id Product ID related to the feature.
 * @property int $epic_id Epic ID related to the feature.
 * @property string $date_created Date and time that the feature was created.
 * @property string $date_updated Date and time that the feature was updated.
 * @property int $user_created User ID that created this feature.
 * @property int $user_updated User ID that updated this feature.
 *
 * @property User $userCreated Data of user that created this feature.
 * @property User $userUpdated Data of user that updated this feature.
 * @property Product $product Data of the Product of the feature.
 * @property Epic $epic Data of the Epic of the feature.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Feature extends SafeToolActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'feature';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['feature', 'product_id', 'epic_id'], 'required'],
			[['product_id', 'epic_id', 'user_created', 'user_updated'], 'integer'],
			[['date_created', 'date_updated'], 'safe'],
			[['feature'], 'string', 'max' => 255],
			[['benefit_hypothesis'], 'string', 'max' => 1000],
			[['acceptance_criteria'], 'string', 'max' => 2000],
			[['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
			[['epic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Epic::class, 'targetAttribute' => ['epic_id' => 'id']],
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
			'id' => Yii::t('feature', 'ID'),
			'feature' => Yii::t('feature', 'Feature'),
			'benefit_hypothesis' => Yii::t('feature', 'Benefit Hypothesis'),
			'acceptance_criteria' => Yii::t('feature', 'Acceptance Criteria'),
			'product_id' => Yii::t('feature', 'Product'),
			'epic_id' => Yii::t('feature', 'Epic'),
			'date_created' => Yii::t('feature', 'Date of creation'),
			'date_updated' => Yii::t('feature', 'Date of the last update'),
			'user_created' => Yii::t('feature', 'The user of creation'),
			'user_updated' => Yii::t('feature', 'The user of the last update'),
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
			'feature' => Yii::t('feature', 'Input the feature description.'),
			'product_id' => Yii::t('feature', 'Select the product of the feature.'),
			'epic_id' => Yii::t('feature', 'Select the epic of the feature.'),
			'benefit_hypothesis' => Yii::t('feature', 'Describe the benefit hypothesis for this feature.'),
			'acceptance_criteria' => Yii::t('feature', 'Describe the acceptance criteria for this feature.')
		];
	}

	/**
	 * Returns the product of the feature.
	 *
	 * @return Product
	 */
	public function getProduct()
	{
		return Product::findOne(['id' => $this->getAttribute('product_id')]);
	}

	/**
	 * Returns the epic of the feature.
	 *
	 * @return Epic
	 */
	public function getEpic()
	{
		return Epic::findOne(['id' => $this->getAttribute('epic_id')]);
	}

	/**
	 * Returns the link to feature visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['feature/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['feature/view', 'id' => $this->getAttribute('id')]);
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
		$query->orderBy('feature');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => ['attributes' => ['feature', 'id']]
		]);
		$this->load($params);

		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['=', 'product_id', $this->getAttribute('product_id')])
			->andFilterWhere(['=', 'epic_id', $this->getAttribute('epic_id')])
			->andFilterWhere(['like', 'feature', $this->getAttribute('feature')]);

		return $dataProvider;
	}

	/**
	 * Returns the feature link of the record.
	 *
	 * @return string
	 */
	public function printLink()
	{
		return Html::a($this->getAttribute('feature'), $this->getLink());
	}

	/**
	 * Returns all the features.
	 *
	 * @param int $productId Product ID.
	 * @param int $epicId Epic ID.
	 * @param string $type Type of return.
	 * @return array
	 */
	public static function getFeatures($productId, $epicId, $type = 'map')
	{
		$features = self::find()->where([
			'product_id' => $productId,
			'epic_id' => $epicId
		])->orderBy('feature')->all();

		if ($type === 'array') {
			$result = [];
			foreach ($features as $feature) {
				$result[] = [
					'id' => $feature->getAttribute('id'),
					'name' => $feature->getAttribute('feature')
				];
			}
			return $result;
		}
		return ArrayHelper::map($features, 'id', 'feature');
	}
}
