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
use app\models\ProductOwner;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'Update product owner');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('product-owner', 'Product owners'),
		"icon" => Icon::show('user-md'),
		"active" => false,
		"url" => Url::to(["product-owner/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="product-owner-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
