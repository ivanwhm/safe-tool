<?php
/**
 * The model responsible for the epic types.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\enums;

//Imports
use Yii;

class EpicType
{
	/**
	 * Business epic type.
	 *
	 * @var string
	 */
	const BUSINESS = 'B';

	/**
	 * Enabler epic type.
	 *
	 * @var string
	 */
	const ENABLER = 'E';

	/**
	 * Returns all the status.
	 *
	 * @return array
	 */
	public static function getData()
	{
		return [
			self::BUSINESS => Yii::t('epic', 'Business'),
			self::ENABLER => Yii::t('epic', 'Enabler')
		];
	}
	
	/**
	 * Returns the epic type description.
	 *
	 * @param $type string Epic type.
	 * @return string
	 */
	public static function getTypeDescription($type)
	{
		$types = self::getData();
		if (isset($types[$type])) {
			return $types[$type];
		}
		return '';
	}	

}