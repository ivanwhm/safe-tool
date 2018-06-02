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
use app\models\enums\Icons;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Update user');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icons::getIcon(Icons::USERS),
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];
?>
<div class="user-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
