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
use app\models\StoryStatus;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'Add story status');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('story-status', 'Story statuses'),
		"icon" => Icon::show('tags'),
		"url" => Url::to(["story-status/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => false
	]
];

?>
<div class="story-status-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
