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
use app\models\Story;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Add story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icon::show('book'),
		"active" => false,
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => true
	]
];

?>
<div class="story-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
