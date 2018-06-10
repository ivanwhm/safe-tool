<?php
/**
 * This file is responsible to show error default page.
 *
 * @var $this View
 * @var $exception Exception
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use yii\helpers\Html;
use yii\web\View;

echo Html::tag('p', $exception->getMessage(), ['class' => 'lead']);
