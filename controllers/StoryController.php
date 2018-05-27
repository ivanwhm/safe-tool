<?php
/**
 * This class is responsible to manager the Story CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\controllers;

//Imports
use app\components\SafeToolController;
use app\models\ProductOwner;
use app\models\Story;
use app\models\StoryAcceptanceCriteria;
use Exception;
use Yii;
use yii\web\NotFoundHttpException;

class StoryController extends SafeToolController
{

	/**
	 * Lists all Story models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new Story();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);

	}

	/**
	 * Displays a single Story model.
	 *
	 * @param integer $id Story ID.
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$searchModel = new StoryAcceptanceCriteria();
		$dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams(), $model->getAttribute('id'));

		return $this->render('view', [
			'model' => $model,
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);
	}

	/**
	 * Creates a new Story model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionCreate()
	{
		$model = new Story();
		$model->setAttribute('product_owner_id', ProductOwner::getCurrentProductOwnerId());

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Story model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Story ID.
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if (ProductOwner::getCurrentProductOwnerId() != $model->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story',
				'Only the product owner responsible for this story can change it.'));
		}

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Transfer the product owner of the story.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Story ID.
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionTransfer($id)
	{
		$model = $this->findModel($id);
		$model->setScenario('transfer');

		if (ProductOwner::getCurrentProductOwnerId() != $model->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story',
				'Only the product owner responsible for this story can transfer it.'));
		}

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('transfer', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Story model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Story ID.
	 * @return string
	 *
	 * @throws NotFoundHttpException If the story cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);

		if (ProductOwner::getCurrentProductOwnerId() != $model->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story',
				'Only the product owner responsible for this story can delete it.'));
		}

		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('story', 'You can not delete the selected story.'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Story model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Story ID.
	 * @return Story
	 *
	 * @throws NotFoundHttpException if the story cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Story::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('story', 'The requested story does not exist.'));
		}
	}

}
