<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\Language;
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
		//Adjust the system language
		if (Yii::$app->getUser()->getIsGuest()) {
			//Get the language from cookie
			if (Yii::$app->getRequest()->getCookies()->has('language')) {
				Yii::$app->language = Yii::$app->getRequest()->getCookies()->get('language')->value;
			} else {
				//Get the language from the browser
				Yii::$app->language = Yii::$app->getRequest()->getPreferredLanguage([
					Language::LANGUAGE_PT_BR,
					Language::LANGUAGE_EN_US,
				]);
			}
		} else {
			//Get the language from session
			Yii::$app->language = Yii::$app->getSession()->get('language');
		}

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