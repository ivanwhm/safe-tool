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
use app\models\enums\Icons;
use app\models\Product;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Update product');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('product', 'Products'),
		"icon" => Icons::getIcon(Icons::PRODUCT),
		"url" => Url::to(["product/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];
?>
<div class="product-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
