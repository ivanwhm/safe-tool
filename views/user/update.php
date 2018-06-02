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
		"active" => false,
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icon::show('users'),
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"url" => $model->getLink(true)
	]
];
?>
<div class="user-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
