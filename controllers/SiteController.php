<?php

/**
 * This class is responsible for management of the main application pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\enums\Status;
use app\models\Epic;
use app\models\Feature;
use app\models\forms\ChangePasswordForm;
use app\models\forms\LoginForm;
use app\models\Product;
use app\models\ProductOwner;
use app\models\Story;
use app\models\StoryStatus;
use app\models\User;
use app\models\UserRole;
use Yii;
use yii\filters\AccessControl;
use yii\web\Cookie;

class SiteController extends SafeToolController
{

	/*
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['logout', 'index', 'password', 'language', 'profile'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['login', 'error'],
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => ['logout', 'index', 'password', 'language', 'profile'],
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
		return $this->render('index', [
			'productCount' => Product::find()->where(['status' => Status::ACTIVE])->count(),
			'epicCount' => Epic::find()->count(),
			'featureCount' => Feature::find()->count(),
			'storyCount' => Story::find()->count(),
			'userCount' => User::find()->where(['status' => Status::ACTIVE])->count(),
			'productOwnerCount' => ProductOwner::find()->where(['status' => Status::ACTIVE])->count(),
			'userRoleCount' => UserRole::find()->where(['status' => Status::ACTIVE])->count(),
			'storyStatusCount' => StoryStatus::find()->where(['status' => Status::ACTIVE])->count()
		]);
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
			
			$result = Yii::$app->getUrlManager()->parseRequest(Yii::$app->getRequest());
			if ($result !== false) {
				$route = explode('/', $result[0])[0];
				
				switch ($route) {
					case 'story' :
						return $this->redirect(['story/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'epic' :
						return $this->redirect(['epic/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'feature' :
						return $this->redirect(['feature/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'product' :
						return $this->redirect(['product/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'product-owner' :
						return $this->redirect(['product-owner/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'story-acceptance-criteria' :
						return $this->redirect(['story/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'story-status' :
						return $this->redirect(['story-status/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'user' :
						return $this->redirect(['user/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
					case 'user-role' :
						return $this->redirect(['user-role/index', 'error' => true, 'errorMessage' => $exception->getMessage()]);
				}
			}

			return $this->render('error', ['exception' => $exception]);
		}

		return '';
	}

	/**
	 * Login action.
	 *
	 * @return string
	 * @throws \Throwable
	 */
	public function actionLogin()
	{
		$this->layout = 'sbadmin2_login';

		if (!Yii::$app->getUser()->getIsGuest()) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->login()) {
			Yii::$app->getUser()->getIdentity()->registerLogin();
			return $this->goHome();
		}

		return $this->render('login', [
			'model' => $model
		]);
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

		return $this->goBack();
	}

	/**
	 * Change password action.
	 *
	 * @return string
	 */
	public function actionPassword()
	{
		$updated = false;

		$model = new ChangePasswordForm();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->changePassword()) {
			$updated = true;
		}

		return $this->render('password', [
			'model' => $model,
			'updated' => $updated,
			'user' => User::findOne(Yii::$app->getUser()->getId())
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
	 * User profile action.
	 *
	 * @return string
	 */
	public function actionProfile()
	{
		$updated = false;

		$model = User::findOne(Yii::$app->getUser()->getId());
		$model->setAttribute('password', '');
		$model->new_password = '';

		if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->save()) {
			$updated = true;
		}

		return $this->render('profile', [
			'model' => $model,
			'updated' => $updated
		]);
	}
}
