<?php
/**
 * Displays the product owner transfer page to Story CRUD.
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

$this->title = Yii::t('story', 'Product owner transfer of the story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::FORM_TRANSFER),
		"url" => $model->getLink(true)
	]
];

echo Html::beginTag('div', ['class' => 'story-transfer']);
echo $this->render('_transfer', ['model' => $model]);
echo Html::endTag('div');
