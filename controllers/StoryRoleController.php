<?php
/**
 * This class is responsible to manager the Story Role CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\enums\Status;
use app\models\StoryRole;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class StoryRoleController extends SafeToolController
{

	/**
	 * Lists all Story Role models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new StoryRole();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);

	}

	/**
	 * Displays a single Story Role model.
	 *
	 * @param integer $id Story Role ID
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
	 * Creates a new Story Role model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new StoryRole();
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
	 * Updates an existing Story Role model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Story Role ID
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
	 * Deletes an existing Story Role model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Story Role ID
	 * @return string
	 *
	 * @throws NotFoundHttpException If the story role cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('story-role', 'You can not delete the selected story role.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Story Role model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Story Role ID
	 * @return StoryRole
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = StoryRole::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('story-role', 'The requested story role does not exist.'));
		}
	}
}
