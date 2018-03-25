<?php
/**
 * Displays the update page to User CRUD.
 *
 * @var $this View
 * @var $model User
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\User;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Update user');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icon::show('users'),
		"active" => false,
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => Url::to(["user/update", 'id' => $model->getAttribute('id')])
	]
];
?>
<div class="user-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
