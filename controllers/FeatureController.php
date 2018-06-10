<?php
/**
 * This class is responsible to manager the Feature CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\Feature;
use Exception;
use Yii;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class FeatureController extends SafeToolController
{

	/**
	 * Lists all Feature models.
	 *
	 * @param bool $error Indicates if has an error.
	 * @param string $errorMessage The error message.
	 *
	 * @return string
	 */
	public function actionIndex($error = false, $errorMessage = '')
	{
		$searchModel = new Feature();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'error' => $error,
			'errorMessage' => $errorMessage
		]);

	}

	/**
	 * Displays a single Feature model.
	 *
	 * @param integer $id Feature ID.
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
	 * Creates a new Feature model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 */
	public function actionCreate()
	{
		$model = new Feature();

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Feature model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Feature ID.
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
	 * Deletes an existing Feature model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Feature ID.
	 * @return string
	 *
	 * @throws NotFoundHttpException If the feature cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('feature', 'You can not delete the selected feature.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Feature model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Feature ID.
	 * @return Feature
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Feature::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('feature', 'The requested feature does not exist.'));
		}
	}

	/**
	 * Returns all the features based in the selected product and epic.
	 *
	 * @return string
	 */
	public function actionFeatures()
	{
		$output = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$productId = $parents[0];
				$epicId = $parents[1];
				$output = Feature::getFeatures($productId, $epicId, 'array');
				echo Json::encode(['output' => $output, 'selected' => '']);
				return;
			}
		}
		echo Json::encode(['output' => $output, 'selected' => '']);
		return;
	}
}
