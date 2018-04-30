<?php
/**
 * Displays the update page to Product CRUD.
 *
 * @var $this View
 * @var $model Product
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Product;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Update product');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('product', 'Products'),
		"icon" => Icon::show('product-hunt'),
		"active" => false,
		"url" => Url::to(["product/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="product-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
