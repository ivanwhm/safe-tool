<?php

/**
 * This class is responsible for manager assets of SBAdmin2 template.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 *
 * @see https://startbootstrap.com/template-overviews/sb-admin-2/
 * @see https://jquery.com
 * @see https://getbootstrap.com
 * @see https://github.com/mimicreative/yii2-metismenu
 * @see https://github.com/onokumus/metismenu
 * @see http://mm.onokumus.com
 * @see https://github.com/yidas/yii2-fontawesome
 * @see https://fontawesome.com
 */

namespace app\assets\SBAdmin2;

//Imports
use yii\web\AssetBundle;

class SBAdmin2Asset extends AssetBundle
{
	/**
	 * Define the source path to the asset files.
	 *
	 * @var string
	 */
	public $sourcePath = "@app/assets/SBAdmin2/files";

	/**
	 * Define the css files to the asset.
	 *
	 * @var array
	 */
	public $css = [
		"css/sb-admin-2.css",
	];

	/**
	 * Define the js files to the asset.
	 *
	 * @var array
	 */
	public $js = [
		"js/sb-admin-2.js"
	];

	/**
	 * Define the dependencies to the asset.
	 *
	 * @var array
	 */
	public $depends = [
		'yii\web\YiiAsset',
		"yii\web\JqueryAsset",
		"yii\bootstrap\BootstrapAsset",
		"yii\bootstrap\BootstrapPluginAsset",
		"mimicreative\assets\MetisMenuAsset",
	];
}