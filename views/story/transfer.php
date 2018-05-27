<?php
/**
 * Displays the product owner transfer page to Story CRUD.
 *
 * @var $this View
 * @var $model Story
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Story;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Product owner transfer of the story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icon::show('book'),
		"active" => false,
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('exchange'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="story-transfer">

	<?= $this->render('_transfer', ['model' => $model]) ?>

</div>
