<?php
/**
 * The class is responsible for Yes and No values.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\enums;

//Imports
use Yii;
use yii\helpers\Html;

class YesNo
{
	/**
	 * Yes status.
	 *
	 * @var bool
	 */
	const YES = true;

	/**
	 * No status.
	 *
	 * @var bool
	 */
	const NO = false;

	/**
	 * Returns all the status.
	 *
	 * @return array
	 */
	public static function getData()
	{
		return [
			self::YES => Yii::t('index', 'Yes'),
			self::NO => Yii::t('index', 'No')
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
				Html::tag('span', Yii::t('index', 'Yes'), ['class' => 'label label-success']) :
				Html::tag('span', Yii::t('index', 'No'), ['class' => 'label label-danger']);
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