<?php

/**
 * This class is responsible to manager the User CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\User;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class UserController extends SafeToolController
{

	/**
	 * Lists all User models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new User();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);
	}

	/**
	 * Displays a single User model.
	 *
	 * @param integer $id User ID
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		return $this->render('view', [
			'model' => $model,
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new User();
		$model->setScenario('create');
		$model->setAttribute('password', '');
		$model->new_password = '';
		$model->setAttribute('status', User::STATUS_ACTIVE);
		$model->setAttribute('language', Yii::$app->getSession()->get('language'));

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id User ID
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->setAttribute('password', '');
		$model->new_password = '';

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			if (Yii::$app->getUser()->getId() == $model->getAttribute('id')) {
				Yii::$app->getSession()->set('language', $model->getAttribute('language'));
			}
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id User ID
	 * @return string
	 *
	 * @throws NotFoundHttpException If the user cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('user', 'You can not delete the selected user.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id User ID
	 * @return User
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('user', 'The requested user does not exist.'));
		}
	}

}
