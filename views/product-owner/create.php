<?php
/**
 * Displays the create page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\ProductOwner;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'Add product owner');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('product-owner', 'Product owners'),
		"icon" => Icon::show('user-md'),
		"url" => Url::to(["product-owner/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => false
	]
];

?>
<div class="product-owner-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
