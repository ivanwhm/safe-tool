<?php
/**
 * Displays the create page to Epic CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Epic;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'Add epic');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('epic', 'Epics'),
		"icon" => Icons::getIcon(Icons::EPIC),
		"url" => Url::to(["epic/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

?>
<div class="epic-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
