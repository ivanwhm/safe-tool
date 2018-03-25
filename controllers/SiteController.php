<?php

/**
 * This class is responsible for management of the main application pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use Yii;
use yii\filters\AccessControl;
use app\components\SafeToolController;
use app\models\forms\LoginForm;
use app\models\User;
use yii\web\Cookie;

class SiteController extends SafeToolController
{

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['logout', 'index', 'password'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['login', 'error'],
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => ['logout', 'index', 'password'],
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}


	/**
	 * Display the error page.
	 *
	 * @return string
	 */
	public function actionError()
	{
		$exception = Yii::$app->getErrorHandler()->exception;

		if ($exception !== null) {
			return $this->render('error', [
					'exception' => $exception,
				]
			);
		}
		
		return '';
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		$this->layout = 'sbadmin2_login';

		if (!Yii::$app->getUser()->getIsGuest()) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->login()) {
			return $this->goHome();
		}

		return $this->render('login', [
			'hasLogo' => false,
			'logo' => '',
			'model' => $model
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->getUser()->logout();
		return $this->goHome();
	}


	/**
	 * Language change action.
	 *
	 * @param string $lang Language
	 * @return string
	 */
	public function actionLanguage($lang)
	{
		//Change de user language
		$user = User::findOne(Yii::$app->getUser()->getId());
		$user->setAttribute('language', $lang);
		$user->setAttribute('password', '');
		$user->new_password = '';
		$user->save(false);

		//Refresh session data
		Yii::$app->getSession()->set('language', $lang);

		//Set a cookie
		Yii::$app->getResponse()->getCookies()->add(new Cookie([
			'name' => 'language',
			'value' => $lang
		]));

		return $this->goHome();
	}
}
