<?php
/**
 * Displays the update page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $model StoryStatus
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\StoryStatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'Update story status');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('story-status', 'Story statuses'),
		"icon" => Icons::getIcon(Icons::STORY_STATUS),
		"url" => Url::to(["story-status/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];

echo Html::beginTag('div', ['class' => 'story-status-update']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
