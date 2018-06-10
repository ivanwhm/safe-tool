<?php
//Imports
use yii\helpers\Url;

$this->title = Yii::t('index', 'Dashboard');
?>

<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-black">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-product-hunt fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $productCount ?></div>
						<div><?= Yii::t('product', 'Products') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['product/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-globe fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $epicCount ?></div>
						<div><?= Yii::t('epic', 'Epics') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['epic/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-map-signs fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $featureCount ?></div>
						<div><?= Yii::t('feature', 'Features') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['feature/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-book fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $storyCount ?></div>
						<div><?= Yii::t('story', 'Stories') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['story/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $userCount ?></div>
						<div><?= Yii::t('user', 'Users') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['user/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-purple">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user-md fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $productOwnerCount ?></div>
						<div><?= Yii::t('product-owner', 'Product owners') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['product-owner/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-brown">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-female fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $userRoleCount ?></div>
						<div><?= Yii::t('user-role', 'User roles') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['user-role/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-pink">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tags fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $storyStatusCount ?></div>
						<div><?= Yii::t('story-status', 'Story statuses') ?></div>
					</div>
				</div>
			</div>
			<a href="<?= Url::to(['story-status/index']) ?>">
				<div class="panel-footer">
					<span class="pull-left"><?= Yii::t('index', 'Access the register') ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>