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
use app\models\enums\Language;
use app\models\User;
use kartik\dialog\Dialog;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

SBAdmin2Asset::register($this);

try {
	echo Dialog::widget([
			'options' => [
				'btnOKLabel' => Icon::show('check') . ' ' . Yii::t('index', 'Yes'),
				'btnCancelLabel' => Icon::show('ban') . ' ' . Yii::t('index', 'No'),
			]
		]
	);
} catch (Exception $e) {
}

$user = User::findOne(Yii::$app->getUser()->getId());
$logoutMessage = Yii::t('index', '{username}, are you sure you want to log out?', [
	'username' => $user->getAttribute('name')
]);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<?= Html::csrfMetaTags() ?>
	<?php Icon::map($this, Icon::FA); ?>
	<?php Icon::map($this, Icon::FI); ?>
	<title><?= Yii::$app->name . ' - ' . $this->title ?></title>
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
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?= Language::getCountryIconFromLanguage($user->getAttribute('language'), ['class' => 'fa-fw']) . ' ' . Icon::show('caret-down') ?>
				</a>
				<ul class="dropdown-menu">
					<?php
					foreach (Language::getData() as $key => $value) {
						echo Html::beginTag('li');
						$text = Language::getCountryIconFromLanguage($key, ['class' => 'fa-fw']) . $value;
						echo Html::a($text, Url::to(['site/language', 'lang' => $key]));
						echo Html::endTag('li');
					}
					?>
				</ul>
			</li>
			<!-- /.dropdown -->
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?= Icon::show('user', ['class' => 'fa-fw']) . Icon::show('caret-down') ?>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<a href="<?= Url::to(["site/password"]) ?>">
							<?= Icon::show('key', ['class' => 'fa-fw']) . Yii::t('password', 'Change password') ?>
						</a>
					</li>
					<li>
						<a href="#">
							<?= Icon::show('gear', ['class' => 'fa-fw']) . ' ' . Yii::t('index', 'Settings') ?>
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a id="btn-logout">
							<?= Icon::show('sign-out', ['class' => 'fa-fw']) . ' ' . Yii::t('index', 'Log out') ?>
						</a>
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
						<a href="<?= Url::to(['site/index']) ?>">
							<?= Icon::show('dashboard', ['class' => 'fa-fw']) . ' ' . Yii::t('index', 'Dashboard') ?>
						</a>
					</li>
					<li>
						<a href="#">
							<?= Icon::show('edit', ['class' => 'fa-fw']) . ' ' . Yii::t('index', 'Records') ?>
						</a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?= Url::to(['user/index']) ?>">
									<?= Icon::show('users', ['class' => 'fa-fw']) . ' ' . Yii::t('user', 'Users') ?>
								</a>
							</li>
							<li>
								<a href="<?= Url::to(['product-owner/index']) ?>">
									<?= Icon::show('user-md', ['class' => 'fa-fw']) . ' ' . Yii::t('product-owner', 'Product owners') ?>
								</a>
							</li>
							<li>
								<a href="<?= Url::to(['user-role/index']) ?>">
									<?= Icon::show('female', ['class' => 'fa-fw']) . ' ' . Yii::t('user-role', 'User roles') ?>
								</a>
							</li>
							<li>
								<a href="<?= Url::to(['story-status/index']) ?>">
									<?= Icon::show('tags', ['class' => 'fa-fw']) . ' ' . Yii::t('story-status', 'Story statuses') ?>
								</a>
							</li>
						</ul>
						<!-- /.nav-second-level-->
					</li>
					<li>
						<a href="<?= Url::to(['product/index']) ?>">
							<?= Icon::show('product-hunt', ['class' => 'fa-fw']) . ' ' . Yii::t('product', 'Products') ?>
						</a>
					</li>
					<li>
						<a href="<?= Url::to(['epic/index']) ?>">
							<?= Icon::show('globe', ['class' => 'fa-fw']) . ' ' . Yii::t('epic', 'Epics') ?>
						</a>
					</li>
					<li>
						<a href="<?= Url::to(['feature/index']) ?>">
							<?= Icon::show('map-signs', ['class' => 'fa-fw']) . ' ' . Yii::t('feature', 'Features') ?>
						</a>
					</li>
					<li>
						<a href="<?= Url::to(['story/index']) ?>">
							<?= Icon::show('book', ['class' => 'fa-fw']) . ' ' . Yii::t('story', 'Stories') ?>
						</a>
					</li>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>

	<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?= $this->title ?></h1>
					<br>
					<!-- .breadcrumb -->
					<ol class="breadcrumb2">
						<li>
							<?= Icon::show('dashboard') ?>
							<a href="<?= Url::to(["site/index"]) ?>">
								<?= Yii::t('index', 'Dashboard') ?>
							</a>
						</li>

						<?php
						$breadcrumbs = isset($this->params["breadcrumbs"]) ? $this->params["breadcrumbs"] : [];
						foreach ($breadcrumbs as $breadcrumb) :
							$active = (isset($breadcrumb["active"]) && $breadcrumb["active"]) ? "active" : "";
							$label = isset($breadcrumb["label"]) ? $breadcrumb["label"] : "";
							$icon = isset($breadcrumb["icon"]) ? $breadcrumb["icon"] : "";
							$url = isset($breadcrumb["url"]) ? $breadcrumb["url"] : "";
							?>
							<li class="<?= $active ?>">
								<?= $icon ?>
								<?php if ($url != "") : ?>
								<a href="<?= $url ?>">
									<?php endif; ?>
									<?= $label ?>
									<?php if ($url != "") : ?>
								</a>
							<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ol>
					<!-- /.breadcrumb -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<!-- content -->
			<?= $content ?>
			<!-- /content -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
$this->registerJs("
	$('#btn-logout').on('click', function() {
		let message = '" . $logoutMessage . "'; 
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
