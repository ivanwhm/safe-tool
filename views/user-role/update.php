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
use app\models\enums\Icons;
use app\models\UserRole;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user-role', 'Update user role');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('user-role', 'User roles'),
		"icon" => Icons::getIcon(Icons::USER_ROLE),
		"url" => Url::to(["user-role/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];
?>
<div class="user-role-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
