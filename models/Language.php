<?php
/**
 * The model responsible for the language control.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models;

//Imports
use kartik\icons\Icon;
use Yii;

class Language
{

	const LANGUAGE_PT_BR = 'pt-BR';
	const LANGUAGE_EN_US = 'en-US';


	/**
	 * Returns all the languages country options.
	 *
	 * @return array
	 */
	public static function getLanguageCountryData()
	{
		return [
			self::LANGUAGE_EN_US => 'us',
			self::LANGUAGE_PT_BR => 'br'
		];
	}
	
	/**
	 * Returns all the languages country icons.
	 *
	 * @return array
	 */
	public static function getLanguageCountryIcon()
	{
		return [
			self::LANGUAGE_EN_US => Icon::show(self::getLanguageCountryData()[self::LANGUAGE_EN_US], [], Icon::FI),
			self::LANGUAGE_PT_BR => Icon::show(self::getLanguageCountryData()[self::LANGUAGE_PT_BR], [], Icon::FI)
		];
	}
	
	/**
	 * Returns all the languages options.
	 *
	 * @param bool $showIcon Show de icon flag.
	 * @return array
	 */
	public static function getLanguageData($showIcon = false)
	{
		return [
			self::LANGUAGE_EN_US => (($showIcon) ? self::getLanguageCountryIcon()[self::LANGUAGE_EN_US] : '') . Yii::t('language', 'English (United States)'),
			self::LANGUAGE_PT_BR => (($showIcon) ? self::getLanguageCountryIcon()[self::LANGUAGE_PT_BR] : '') . Yii::t('language', 'Portuguese (Brazil)')
		];
	}

}