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
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\web\View;

SBAdmin2Asset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<?= Html::csrfMetaTags() ?>
		<?php Icon::map($this, Icon::FA); ?>
		<title><?= Yii::$app->name ?></title>
		<?php $this->head() ?>
	</head>
	
	<body>
		<?php $this->beginBody() ?>
	
		<!-- Content -->
		<div class="container">
			<div class="row">
				<?= $content ?>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	
		<?php $this->endBody() ?>
	</body>

</html>
<?php $this->endPage() ?>
