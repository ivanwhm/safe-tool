<?php
/**
 * Displays the update page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $model ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\ProductOwner;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'Update product owner');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('product-owner', 'Product owners'),
		"icon" => Icons::getIcon(Icons::PRODUCT_OWNER),
		"url" => Url::to(["product-owner/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];
?>
<div class="product-owner-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
