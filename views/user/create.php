<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model User
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Add user');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icons::getIcon(Icons::RECORDS),
		"active" => false
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icons::getIcon(Icons::USERS),
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"active" => false,
		"icon" => Icons::getIcon(Icons::CRUD_ADD)
	]
];

?>
<div class="user-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
