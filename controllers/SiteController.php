<?php

/**
 * This class is responsible for management of the main application pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\forms\LoginForm;

class SiteController extends SafeToolController
{

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
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		$this->layout = 'login';
		return $this->render('login', [
			'hasLogo' => false,
			'logo' => '',
			'model' => new LoginForm()
		]);
	}

}
