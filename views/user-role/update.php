<?php
/**
 * Displays the update page to User Role CRUD.
 *
 * @var $this View
 * @var $model UserRole
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\UserRole;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user-role', 'Update user role');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('user-role', 'User roles'),
		"icon" => Icon::show('female'),
		"active" => false,
		"url" => Url::to(["user-role/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="user-role-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
