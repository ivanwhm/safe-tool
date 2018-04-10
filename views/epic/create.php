<?php
/**
 * Displays the create page to Epic CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Epic;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'Add epic');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('epic', 'Epics'),
		"icon" => Icon::show('globe'),
		"active" => false,
		"url" => Url::to(["epic/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => true
	]
];

?>
<div class="epic-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
