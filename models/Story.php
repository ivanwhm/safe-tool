<?php

/**
 * This is the model class for table "story".
 *
 * @property int $id Story ID.
 * @property int $product_owner_id Product owner ID.
 * @property int $product_id Story product ID.
 * @property int $epic_id Story epic ID.
 * @property int $feature_id Story feature ID.
 * @property int $user_role_id As a (user role).
 * @property string $i_want_to I want (activity) to.
 * @property string $so_that So that (business value).
 * @property int $priority Story priority.
 * @property int $story_status_id Story status ID.
 * @property string $date_created Date and time that the story was created.
 * @property string $date_updated Date and time that the story was updated.
 * @property int $user_created User ID that created this product.
 * @property int $user_updated User ID that updated this product.
 *
 * @property ProductOwner $productOwner Data of the product owner of the story.
 * @property Epic $epic Data of the epic of the story.
 * @property Feature $feature Data of the feature of the story.
 * @property Product $product Data of the product of the story.
 * @property UserRole $userRole Data of the user role of the story.
 * @property StoryStatus $storyStatus Data of the status of the story.
 * @property User $userCreated Data of user that created this story.
 * @property User $userUpdated Data of user that updated this story.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use app\components\SafeToolActiveRecord;
use app\models\enums\YesNo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class Story extends SafeToolActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'story';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['product_id', 'epic_id', 'feature_id', 'user_role_id', 'i_want_to', 'so_that', 'priority', 'story_status_id'],
				'required'],
			[['product_owner_id'], 'required', 'on' => 'transfer'],
			[['id', 'product_owner_id', 'product_id', 'epic_id', 'feature_id', 'user_role_id', 'story_status_id',
				'user_created', 'user_updated'], 'integer'],
			[['priority'], 'integer', 'min' => 0, 'max' => 999],
			[['date_created', 'date_updated'], 'safe'],
			[['i_want_to', 'so_that'], 'string', 'max' => 500],
			[['id'], 'unique'],
			[['story_status_id'], 'validateReadyStory'],
			[['product_owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOwner::class,
				'targetAttribute' => ['product_owner_id' => 'id']],
			[['epic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Epic::class,
				'targetAttribute' => ['epic_id' => 'id']],
			[['feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::class,
				'targetAttribute' => ['feature_id' => 'id']],
			[['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class,
				'targetAttribute' => ['product_id' => 'id']],
			[['user_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::class,
				'targetAttribute' => ['user_role_id' => 'id']],
			[['story_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoryStatus::class,
				'targetAttribute' => ['story_status_id' => 'id']],
			[['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
				'targetAttribute' => ['user_created' => 'id']],
			[['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
				'targetAttribute' => ['user_updated' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('story', 'ID'),
			'product_owner_id' => Yii::t('story', 'Product owner'),
			'product_id' => Yii::t('story', 'Product'),
			'epic_id' => Yii::t('story', 'Epic'),
			'feature_id' => Yii::t('story', 'Feature'),
			'user_role_id' => Yii::t('story', 'As a'),
			'i_want_to' => Yii::t('story', 'I want'),
			'so_that' => Yii::t('story', 'So that'),
			'priority' => Yii::t('story', 'Priority'),
			'story_status_id' => Yii::t('story', 'Status'),
			'date_created' => Yii::t('story', 'Date of creation'),
			'date_updated' => Yii::t('story', 'Date of the last update'),
			'user_created' => Yii::t('story', 'The user of creation'),
			'user_updated' => Yii::t('story', 'The user of the last update'),
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
			'product_owner_id' => Yii::t('story', 'Select the product owner of the story.'),
			'product_id' => Yii::t('story', 'Select the product of the story.'),
			'epic_id' => Yii::t('story', 'Select the epic of the story.'),
			'feature_id' => Yii::t('story', 'Select the feature of the story.'),
			'user_role_id' => Yii::t('story', 'Select the user role of the story.'),
			'i_want_to' => Yii::t('story', 'Describe the activity that the user want solve.'),
			'so_that' => Yii::t('story', 'Describe the business value of the activity.'),
			'priority' => Yii::t('story', 'Input the priority of this story. 0 indicates a low priority.'),
			'story_status_id' => Yii::t('story', 'Select the status of the story.')
		];
	}

	/**
	 * Returns the product owner of the story.
	 *
	 * @return ProductOwner
	 */
	public function getProductOwner()
	{
		return ProductOwner::findOne(['id' => $this->getAttribute('product_owner_id')]);
	}

	/**
	 * Returns the product of the story.
	 *
	 * @return Product
	 */
	public function getProduct()
	{
		return Product::findOne(['id' => $this->getAttribute('product_id')]);
	}

	/**
	 * Returns the epic of the story.
	 *
	 * @return Epic
	 */
	public function getEpic()
	{
		return Epic::findOne(['id' => $this->getAttribute('epic_id')]);
	}

	/**
	 * Returns the feature of the story.
	 *
	 * @return Feature
	 */
	public function getFeature()
	{
		return Feature::findOne(['id' => $this->getAttribute('feature_id')]);
	}

	/**
	 * Returns the user role of the story.
	 *
	 * @return UserRole
	 */
	public function getUserRole()
	{
		return UserRole::findOne(['id' => $this->getAttribute('user_role_id')]);
	}

	/**
	 * Returns status of the story.
	 *
	 * @return StoryStatus
	 */
	public function getStoryStatus()
	{
		return StoryStatus::findOne(['id' => $this->getAttribute('story_status_id')]);
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

		$query = self::find()->orderBy('id');
		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['=', 'product_owner_id', $this->getAttribute('product_owner_id')])
			->andFilterWhere(['=', 'product_id', $this->getAttribute('product_id')])
			->andFilterWhere(['=', 'priority', $this->getAttribute('priority')])
			->andFilterWhere(['=', 'story_status_id', $this->getAttribute('story_status_id')]);

		return new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => [
				'attributes' => [
					'id',
					'product_owner_id',
					'product_id',
					'epic_id',
					'feature_id',
					'priority',
					'story_status_id'
				]
			]
		]);
	}

	/**
	 * Returns the link to story visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['story/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['story/view', 'id' => $this->getAttribute('id')]);
	}

	/**
	 * Validates de user's password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validateReadyStory($attribute, $params)
	{
		if (!$this->hasErrors()) {
			if ($this->getStoryStatus()->isReady() == YesNo::YES) {
				if (StoryAcceptanceCriteria::find()->where(['story_id' => $this->getAttribute('id')])->count() == 0) {
					$this->addError($attribute, Yii::t('story',
						'This story does not have any acceptance criteria and cannot have the status defined as ready.'));
				}
			}
		}
	}
}
