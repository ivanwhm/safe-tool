<?php
/**
 * This class is responsible to manager the StoryStatus CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\StoryStatus;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class StoryStatusController extends SafeToolController
{

	/**
	 * Lists all Story Status models.
	 *
	 * @param bool $error Indicates if has an error.
	 * @param string $errorMessage The error message.
	 *
	 * @return string
	 */
	public function actionIndex($error = false, $errorMessage = '')
	{
		$searchModel = new StoryStatus();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'error' => $error,
			'errorMessage' => $errorMessage
		]);

	}

	/**
	 * Displays a single Story Status model.
	 *
	 * @param integer $id Story Status ID
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
	 * Creates a new Story Status model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new StoryStatus();
		$model->setAttribute('ready', false);
		$model->setAttribute('status', true);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Story Status model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Story Status ID
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
	 * Deletes an existing Story Status model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Story Status ID
	 * @return string
	 *
	 * @throws NotFoundHttpException If the Story Status cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('story-status', 'You can not delete the selected story status.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the StoryStatus model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Story Status ID
	 * @return StoryStatus
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = StoryStatus::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('story-status', 'The requested story status does not exist.'));
		}
	}

}
