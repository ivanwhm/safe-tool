<?php
/**
 * Displays the update page to Epic CRUD.
 *
 * @var $this View
 * @var $model Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Epic;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'Update epic');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('epic', 'Epics'),
		"icon" => Icon::show('globe'),
		"active" => false,
		"url" => Url::to(["epic/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="epic-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
