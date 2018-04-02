<?php
/**
 * The model responsible for the language control.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\enums;

//Imports
use Yii;
use yii\helpers\Html;

class Status
{
	/**
	 * Active status.
	 *
	 * @var bool
	 */
	const ACTIVE = true;

	/**
	 * Inactive status.
	 *
	 * @var bool
	 */
	const INACTIVE = false;

	/**
	 * Returns all the status.
	 *
	 * @return array
	 */
	public static function getData()
	{
		return [
			self::ACTIVE => Yii::t('index', 'Active'),
			self::INACTIVE => Yii::t('index', 'Inactive')
		];
	}

	/**
	 * Returns the status in a label style.
	 *
	 * @param $status bool Status.
	 * @return string
	 */
	public static function getStatusDescriptionWithLabel($status)
	{
		$statuses = self::getData();
		if (isset($statuses[$status])) {
			return $status ?
				Html::tag('span', Yii::t('index', 'Active'), ['class' => 'label label-success']) :
				Html::tag('span', Yii::t('index', 'Inactive'), ['class' => 'label label-danger']);
		}
		return '';
	}

	/**
	 * Returns the status description.
	 *
	 * @param $status bool Status.
	 * @return string
	 */
	public static function getStatusDescription($status)
	{
		$statuses = self::getData();
		if (isset($statuses[$status])) {
			return $statuses[$status];
		}
		return '';
	}	

}