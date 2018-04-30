<?php
/**
 * Displays the create page to Product CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Product
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Product;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Add product');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('product', 'Products'),
		"icon" => Icon::show('product-hunt'),
		"active" => false,
		"url" => Url::to(["product/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => true
	]
];

?>
<div class="product-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
