<?php
/**
 * This is the model class for table "epic".
 *
 * @property int $id Epic ID.
 * @property string $title Epic title.
 * @property string $type Epic type.
 * @property string $epic Epic full description.
 * @property string $date_created Date and time that the epic was created.
 * @property string $date_updated Date and time that the epic was updated.
 * @property int $user_created User ID that created this epic.
 * @property int $user_updated User ID that updated this epic.
 *
 * @property User $userCreated Data of user that created this epic.
 * @property User $userUpdated Data of user that updated this epic.
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
			[['title', 'type', 'epic'], 'required'],
			[['date_created', 'date_updated'], 'safe'],
			[['user_created', 'user_updated'], 'integer'],
			[['title'], 'string', 'max' => 50],
			[['type'], 'string', 'max' => 1],
			[['epic'], 'string', 'max' => 2000],
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
			->andFilterWhere(['=', 'type', $this->getAttribute('type')])
			->andFilterWhere(['like', 'epic', $this->getAttribute('epic')]);

		return $dataProvider;
	}

	/**
	 * Returns all the epics.
	 *
	 * @return array
	 */
	public static function getEpics()
	{
		$epics = self::find()->orderBy('title')->all();
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
}
