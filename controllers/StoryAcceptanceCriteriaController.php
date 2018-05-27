<?php
/**
 * This class is responsible to manager the Story Acceptance Criteria CRUD related pages.
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

class StoryAcceptanceCriteriaController extends SafeToolController
{

	/**
	 * Displays a single Story Acceptance Criteria model.
	 *
	 * @param integer $id Story Acceptance Criteria ID.
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
	 * Creates a new Story Acceptance Criteria model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param $story int Story ID.
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionCreate($story)
	{
		$storyModel = Story::findOne(['id' => $story]);

		if (ProductOwner::getCurrentProductOwnerId() != $storyModel->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story-acceptance-criteria',
				'Only the product owner of this story can create more acceptance criterias.'));
		}

		$model = new StoryAcceptanceCriteria();
		$model->setAttribute('story_id', $story);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->getAttribute('id')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Story Acceptance Criteria model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id Story Acceptance Criteria ID.
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if (ProductOwner::getCurrentProductOwnerId() != $model->getStory()->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story-acceptance-criteria',
				'Only the product owner of the story related to the acceptance criteria can change it.'));
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
	 * Deletes an existing Story Acceptance Criteria model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id Story Acceptance Criteria ID.
	 * @return string
	 *
	 * @throws NotFoundHttpException If the Story Acceptance Criteria cannot be deleted
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$storyId = $model->getAttribute('story_id');

		if (ProductOwner::getCurrentProductOwnerId() != $model->getStory()->getAttribute('product_owner_id')) {
			throw new NotFoundHttpException(Yii::t('story-acceptance-criteria',
				'Only the product owner of the story related to the acceptance criteria can delete it.'));
		}

		try {
			$model->delete();
		} catch (Exception $ex) {
			throw new NotFoundHttpException(Yii::t('story-acceptance-criteria',
				'You can not delete the selected acceptance criteria.'));
		}

		return $this->redirect(['story/view', 'id' => $storyId]);
	}

	/**
	 * Finds the Story Acceptance Criteria model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id Story Acceptance Criteria ID.
	 * @return StoryAcceptanceCriteria
	 *
	 * @throws NotFoundHttpException if the Story Acceptance Criteria cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = StoryAcceptanceCriteria::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException(Yii::t('story-acceptance-criteria',
				'The requested acceptance criteria does not exist.'));
		}
	}

}
