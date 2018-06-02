<?php
/**
 * Displays the create page to User Role CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model UserRole
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\UserRole;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user-role', 'Add user role');
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
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

?>
<div class="user-role-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
