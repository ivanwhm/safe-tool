<?php
/**
 * This is the model class for table "story_status".
 *
 * @property int $id Story Status ID.
 * @property string $name Story status name.
 * @property int $ready Story status ready to development.
 * @property int $status Story status status.
 * @property string $date_created Date and time that the story status was created.
 * @property string $date_updated Date and time that the story status was updated.
 * @property int $user_created User ID that created this story status.
 * @property int $user_updated User ID that updated this story status.
 *
 * @property User $userCreated Data of user that created this story status.
 * @property User $userUpdated Data of user that updated this story status.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

use app\components\SafeToolActiveRecord;
use app\models\enums\Status;
use app\models\enums\YesNo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class StoryStatus extends SafeToolActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'story_status';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['ready', 'default', 'value' => YesNo::NO],
			['status', 'default', 'value' => Status::ACTIVE],
			[['name', 'ready', 'status'], 'required'],
			[['status', 'ready', 'user_created', 'user_updated'], 'integer'],
			[['date_created', 'date_updated'], 'safe'],
			[['name'], 'string', 'max' => 50],
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
			'id' => Yii::t('story-status', 'ID'),
			'name' => Yii::t('story-status', 'Name'),
			'ready' => Yii::t('story-status', 'Ready'),
			'status' => Yii::t('story-status', 'Status'),
			'date_created' => Yii::t('story-status', 'Date of creation'),
			'date_updated' => Yii::t('story-status', 'Date of the last update'),
			'user_created' => Yii::t('story-status', 'The user of creation'),
			'user_updated' => Yii::t('story-status', 'The user of the last update'),
		];
	}

	/**
	 * Returns the status description of the story status.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return Status::getStatusDescriptionWithLabel($this->getAttribute('status'));
	}

	/**
	 * Returns the status description of the story ready.
	 *
	 * @return string
	 */
	public function getReady()
	{
		return YesNo::getStatusDescriptionWithLabel($this->getAttribute('ready'));
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
			->andFilterWhere(['=', 'ready', $this->getAttribute('ready')])
			->andFilterWhere(['=', 'status', $this->getAttribute('status')])
			->andFilterWhere(['like', 'name', $this->getAttribute('name')]);

		return new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => [
				'attributes' => [
					'id',
					'name'
				]
			]
		]);
	}

	/**
	 * Returns the link to story status visualization info.
	 *
	 * @param bool $edit Edit or view link
	 * @return string
	 */
	public function getLink($edit = false)
	{
		if ($edit) {
			return Url::to(['story-status/update', 'id' => $this->getAttribute('id')]);
		}
		return Url::to(['story-status/view', 'id' => $this->getAttribute('id')]);
	}
}
