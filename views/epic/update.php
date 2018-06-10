<?php
/**
 * Displays the update page to Epic CRUD.
 *
 * @var $this View
 * @var $model Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Epic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'Update epic');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('epic', 'Epics'),
		"icon" => Icons::getIcon(Icons::EPIC),
		"url" => Url::to(["epic/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];

echo Html::beginTag('div', ['class' => 'epic-update']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
