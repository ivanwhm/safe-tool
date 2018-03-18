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

?>

<?= Html::tag('p', $exception->getMessage(), ['class' => 'lead']); ?>

<?php if (YII_ENV_DEV) : ?>
    <?= Html::tag('br') ?>
    <?= Html::tag('p', '<strong>' . Yii::t('general', 'Error code:'). ' </strong>: ' . $exception->getCode(), ['class' => 'lead']); ?>
    <?= Html::tag('p', '<strong>' . Yii::t('general', 'Error line:'). ' </strong>: ' . $exception->getLine(), ['class' => 'lead']); ?>
    <?= Html::tag('p', '<strong>' . Yii::t('general', 'Error trace:'). ' </strong>: ' . $exception->getTraceAsString(), ['class' => 'lead']); ?>
<?php endif; ?>