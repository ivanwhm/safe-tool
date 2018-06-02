<?php
/**
 * Displays the create page to Feature CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Feature
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Feature;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('feature', 'Add feature');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('feature', 'Features'),
		"icon" => Icon::show('map-signs'),
		"url" => Url::to(["feature/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => false
	]
];

?>
<div class="feature-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
