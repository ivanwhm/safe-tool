<?php
/**
 * This file is responsible for the login layout of the application.
 * This layout is based on SBAdmin2 template.
 *
 * @var $this View
 * @var $content string
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\assets\SBAdmin2\SBAdmin2Asset;
use yii\helpers\Html;
use yii\web\View;

SBAdmin2Asset::register($this);

//html
$this->beginPage();
echo Html::beginTag('!DOCTYPE html');
echo Html::beginTag('html', ['lang' => Yii::$app->language]);

//head
echo Html::beginTag('head');
echo Html::tag('meta', '', ['charset' => Yii::$app->charset]);
echo Html::csrfMetaTags();
echo Html::tag('title', Yii::$app->name);
$this->head();
echo Html::endTag('head');

//body
echo Html::beginTag('body');
$this->beginBody();

//content
echo Html::beginTag('div', ['class' => 'container']);
echo Html::beginTag('div', ['class' => 'row']);
echo $content;
echo Html::endTag('div');
echo Html::endTag('div');

//end body
$this->endBody();
echo Html::endTag('body');

//end html
echo Html::endTag('html');
$this->endPage();
