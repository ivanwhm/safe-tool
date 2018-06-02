<?php
/**
 * Displays the create page to Story CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Story
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Story;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Add story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

?>
<div class="story-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
