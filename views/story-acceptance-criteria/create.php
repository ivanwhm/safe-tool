<?php
/**
 * Displays the create page to StoryAcceptanceCriteria CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model StoryAcceptanceCriteria
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\StoryAcceptanceCriteria;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-acceptance-criteria', 'Add acceptance criteria');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'View story'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => $model->getStory()->getLink()
	],
	[
		"label" => Yii::t('story-acceptance-criteria', 'Acceptance criterias'),
		"icon" => Icons::getIcon(Icons::STORY_ACCEPTANCE_CRITERIA),
		"url" => Url::to(['story/view', 'id' => $model->getAttribute('story_id')])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

echo Html::beginTag('div', ['class' => 'story-acceptance-criteria-create']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
