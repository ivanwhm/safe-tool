<?php
/**
 * Displays the update page to Story CRUD.
 *
 * @var $this View
 * @var $model Story
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Story;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Update story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_EDIT),
		"url" => $model->getLink(true)
	]
];

echo Html::beginTag('div', ['class' => 'story-update']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
