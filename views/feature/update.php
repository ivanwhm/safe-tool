<?php
/**
 * Displays the update page to Feature CRUD.
 *
 * @var $this View
 * @var $model Feature
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Feature;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('feature', 'Update feature');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('feature', 'Features'),
		"icon" => Icon::show('map-signs'),
		"active" => false,
		"url" => Url::to(["feature/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="feature-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
