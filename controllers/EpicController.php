<?php
/**
 * This class is responsible to manager the Epic CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\Epic;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class EpicController extends SafeToolController
{

	/**
	 * Lists all Epic models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new Epic();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);

	}

	/**
	 * Displays a single Epic model.
	 *
	 * @param integer $id Epic ID
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
	 * Creates a new Epic model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new Epic();

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Epic model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Epic ID
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
	 * Deletes an existing Epic model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Epic ID
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
			throw new NotFoundHttpException(Yii::t('epic', 'You can not delete the selected epic.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Epic ID
	 * @return Epic
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Epic::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('epic', 'The requested epic does not exist.'));
		}
	}
}
