<?php
/**
 * This class is responsible to manager the User Role CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\enums\Status;
use app\models\UserRole;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class UserRoleController extends SafeToolController
{

	/**
	 * Lists all User Role models.
	 *
	 * @param bool $error Indicates if has an error.
	 * @param string $errorMessage The error message.
	 *
	 * @return string
	 */
	public function actionIndex($error = false, $errorMessage = '')
	{
		$searchModel = new UserRole();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'error' => $error,
			'errorMessage' => $errorMessage
		]);

	}

	/**
	 * Displays a single User Role model.
	 *
	 * @param integer $id User Role ID
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
	 * Creates a new User Role model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new UserRole();
		$model->setAttribute('status', Status::ACTIVE);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing User Role model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id User Role ID
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User Role model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id User Role ID
	 * @return string
	 *
	 * @throws NotFoundHttpException If the user role cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('user-role', 'You can not delete the selected user role.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User Role model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id User Role ID
	 * @return UserRole
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = UserRole::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('user-role', 'The requested user role does not exist.'));
		}
	}
}
