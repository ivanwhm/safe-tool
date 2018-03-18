<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SafeToolController extends Controller
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		//Get the browser's language to use on Login page
		$browserLanguage = Yii::$app->getRequest()->getPreferredLanguage([
			User::LANGUAGE_PT_BR,
			User::LANGUAGE_EN_US,
		]);
		
		//Adjust the system language
		Yii::$app->language = (!Yii::$app->getUser()->getIsGuest())
			? Yii::$app->getSession()->get('language')
			: $browserLanguage;

	}


	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'delete' => ['POST'],
				],
			],
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
}