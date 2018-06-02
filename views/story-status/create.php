<?php
/**
 * Displays the create page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model StoryStatus
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\StoryStatus;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'Add story status');
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
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

?>
<div class="story-status-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
