<?php
/**
 * This is the model class for table "story-acceptance-criteria".
 *
 * @property int $id Acceptance ID.
 * @property int $story_id Story ID.
 * @property string $acceptance_criteria Description of the acceptance criteria.
 * @property string $date_created Date and time that the acceptance criteria was created.
 * @property string $date_updated Date and time that the acceptance criteria was updated.
 * @property int $user_created User ID that created this acceptance criteria.
 * @property int $user_updated User ID that updated this acceptance criteria.
 *
 * @property Story $story Data of the story of the acceptance criteria.
 * @property User $userCreated Data of user that created this acceptance criteria.
 * @property User $userUpdated Data of user that updated this acceptance criteria.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

use app\components\SafeToolActiveRecord;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;


class StoryAcceptanceCriteria extends SafeToolActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'story_acceptance_criteria';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['story_id', 'acceptance_criteria'], 'required'],
			[['story_id', 'user_created', 'user_updated'], 'integer'],
			[['date_created', 'date_updated'], 'safe'],
			[['acceptance_criteria'], 'string', 'max' => 500],
			[['story_id'], 'exist', 'skipOnError' => true, 'targetClass' => Story::class, 'targetAttribute' => ['story_id' => 'id']],
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
			'id' => Yii::t('story-acceptance-criteria', 'ID'),
			'story_id' => Yii::t('story-acceptance-criteria', 'Story'),
			'acceptance_criteria' => Yii::t('story-acceptance-criteria', 'Acceptance criteria'),
			'date_created' => Yii::t('story-acceptance-criteria', 'Date of creation'),
			'date_updated' => Yii::t('story-acceptance-criteria', 'Date of the last update'),
			'user_created' => Yii::t('story-acceptance-criteria', 'The user of creation'),
			'user_updated' => Yii::t('story-acceptance-criteria', 'The user of the last update'),
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
			'acceptance_criteria' => Yii::t('story-acceptance-criteria', 'Describe the acceptance criteria of the story.'),
		];
	}

	/**
	 * Returns the story of the acceptance criteria.
	 *
	 * @return Story
	 */
	public function getStory()
	{
		return Story::findOne(['id' => $this->getAttribute('story_id')]);
	}

	/**
	 * Returns the form search.
	 *
	 * @param $params array Params.
	 * @param $storyId Story Story ID.
	 * @return ActiveDataProvider
	 */
	public function search($params, $storyId)
	{
		$this->load($params);

		$query = self::find()->where(['story_id' => $storyId])->orderBy('id');
		$query->andFilterWhere(['=', 'id', $this->getAttribute('id')])
			->andFilterWhere(['like', 'acceptance_criteria', $this->getAttribute('acceptance_criteria')]);

		return new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => [
				'attributes' => [
					'id',
					'acceptance_criteria'
				]
			]
		]);
	}

	/**
	 * Returns the link to acceptance criteria visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['story-acceptance-criteria/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['story-acceptance-criteria/view', 'id' => $this->getAttribute('id')]);
	}
}
