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
use kartik\dialog\Dialog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

SBAdmin2Asset::register($this);

try {
	echo Dialog::widget([
			'options' => [
				'title' => Yii::t('index', 'Confirmation'),
				'btnOKLabel' => '<span class="' . Dialog::ICON_OK . '"></span> ' . Yii::t('index', 'Yes'),
				'btnCancelLabel' => '<span class="' . Dialog::ICON_CANCEL . '"></span> ' . Yii::t('index', 'No'),
			]
		]
	);
} catch (Exception $e) {
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>"

<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<?= Html::csrfMetaTags() ?>
	<title><?= Yii::$app->name ?></title>
	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div id="wrapper">

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><?= Yii::$app->name ?></a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="#"><i class="fa fa-user fa-fw"></i> <?= Yii::t('index', 'User Profile') ?></a></li>
					<li><a href="#"><i class="fa fa-gear fa-fw"></i> <?= Yii::t('index', 'Settings') ?></a></li>
					<li class="divider"></li>
					<li><a href="#" id="btn-logout"><i class="fa fa-sign-out fa-fw"></i> <?= Yii::t('index', 'Log out') ?></a>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->

		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li>
						<a href="<?= Url::to(['site/index']) ?>"><i
								class="fa fa-dashboard fa-fw"></i> <?= Yii::t('index', 'Dashboard') ?></a>
					</li>
					<!--					<li>-->
					<!--						<a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>-->
					<!--						<ul class="nav nav-second-level">-->
					<!--							<li>-->
					<!--								<a href="#">Second Level Item</a>-->
					<!--							</li>-->
					<!--							<li>-->
					<!--								<a href="#">Second Level Item</a>-->
					<!--							</li>-->
					<!--							<li>-->
					<!--								<a href="#">Third Level <span class="fa arrow"></span></a>-->
					<!--								<ul class="nav nav-third-level">-->
					<!--									<li>-->
					<!--										<a href="#">Third Level Item</a>-->
					<!--									</li>-->
					<!--									<li>-->
					<!--										<a href="#">Third Level Item</a>-->
					<!--									</li>-->
					<!--									<li>-->
					<!--										<a href="#">Third Level Item</a>-->
					<!--									</li>-->
					<!--									<li>-->
					<!--										<a href="#">Third Level Item</a>-->
					<!--									</li>-->
					<!--								</ul>-->
					<!--								<!-- /.nav-third-level -->
					<!--							</li>-->
					<!--						</ul>-->
					<!--						<!-- /.nav-second-level -->
					<!--					</li>-->
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>

	<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<?= $content ?>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
$this->registerJs("
	$('#btn-logout').on('click', function() {
		let message = '" . Yii::t('index', 'Are you sure you want to log out?') . "'; 
		krajeeDialog.confirm(message, function(out) { 
			if (out) { 
				window.location = '" . Url::to(['site/logout']) . "'; 
			} 
		}); 
	});
") ?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
