<?php
/**
 * Some methods to DetailViews pages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\enums\Icons;
use Yii;
use yii\helpers\Html;

class SafeToolDetailView
{

	/**
	 * Returns all the CRUD buttons.
	 *
	 * @param SafeToolActiveRecord $model Data model.
	 * @param string $deleteMessage Delete message.
	 * @param array $addUrl URL do create a new record.
	 * @param boolean $showTransferButton Shows the transfer button?
	 *
	 * @return string
	 */
	public static function getCrudButtons($model, $deleteMessage, $addUrl = ['create'], $showTransferButton = false)
	{
		$tag = Html::beginTag('p');

		//Add Button
		$tag .= Html::a(Icons::getIcon(Icons::CRUD_ADD) . Yii::t('index', 'Add'), $addUrl, [
			'class' => 'btn btn-success'
		]);

		//Edit Button
		$tag .= ' ' . Html::a(Icons::getIcon(Icons::CRUD_EDIT) . Yii::t('index', 'Update'), [
				'update', 'id' => $model->getAttribute('id')], ['class' => 'btn btn-primary']);

		//Transfer Button
		if ($showTransferButton) {
			$tag .= ' ' . Html::a(Icons::getIcon(Icons::FORM_TRANSFER) . Yii::t('index', 'Transfer'), [
					'transfer', 'id' => $model->getAttribute('id')], ['class' => 'btn btn-primary']);
		}

		//Delete Button
		$tag .= ' ' . Html::a(Icons::getIcon(Icons::CRUD_DELETE) . Yii::t('index', 'Delete'), [
				'delete', 'id' => $model->getAttribute('id')], ['class' => 'btn btn-danger',
				'data' => [
					'confirm' => $deleteMessage,
					'method' => 'post'
				]
			]);

		$tag .= Html::endTag('p');
		return $tag;
	}

	/**
	 * Returns the heading of the panel.
	 *
	 * @param string $title Title of the panel.
	 * @return string
	 */
	public static function getDetailViewHeading($title)
	{
		return Html::tag('h3', Icons::getIcon(Icons::CRUD_VIEW) . ' ' . $title, [
			'class' => 'panel-title'
		]);
	}
}