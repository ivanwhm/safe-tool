<?php
/**
 * The model responsible for the language control.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\enums;

//Imports
use kartik\icons\Icon;
use Yii;

class Language
{

	/**
	 * Portuguese (Brazil) language.
	 *
	 * @var string
	 */
	const PT_BR = 'pt-BR';

	/**
	 * English (United States) language.
	 *
	 * @var string
	 */
	const EN_US = 'en-US';

	/**
	 * Returns all the countries data related to the languages.
	 *
	 * @return array
	 */
	private static function getCountryData()
	{
		return [
			self::EN_US => 'us',
			self::PT_BR => 'br'
		];
	}

	/**
	 * Returns all the countries icon data related to the languages.
	 *
	 * @param array $iconOptions Options to the icon.
	 * @return array
	 */
	private static function getCountryIconData($iconOptions = [])
	{
		return [
			self::EN_US => Icon::show(self::getCountryFromLanguage(self::EN_US), $iconOptions, Icon::FI),
			self::PT_BR => Icon::show(self::getCountryFromLanguage(self::PT_BR), $iconOptions, Icon::FI)
		];
	}

	/**
	 * Returns all the languages options.
	 *
	 * @param bool $showCountryIcon Shows de icon flag.
	 * @param array $iconOptions Options to the icon.
	 * @return array
	 */
	public static function getData($showCountryIcon = false, $iconOptions = [])
	{
		return [
			self::EN_US => (($showCountryIcon) ? self::getCountryIconFromLanguage(self::EN_US, $iconOptions) : '') . Yii::t('language', 'English (United States)'),
			self::PT_BR => (($showCountryIcon) ? self::getCountryIconFromLanguage(self::PT_BR, $iconOptions) : '') . Yii::t('language', 'Portuguese (Brazil)')
		];
	}

	/**
	 * Returns all the languages options.
	 *
	 * @param $language string Language.
	 * @param bool $showCountryIcon Shows de icon flag.
	 * @param array $iconOptions Options to the icon.
	 * @return string
	 */
	public static function getLanguageDescription($language, $showCountryIcon = false, $iconOptions = [])
	{
		$languages = self::getData($showCountryIcon, $iconOptions);
		if (isset($languages[$language])) {
			return $languages[$language];
		}
		return '';
	}

	/**
	 * Returns all the languages country options.
	 *
	 * @param $language string Language.
	 * @return string
	 */
	public static function getCountryFromLanguage($language)
	{
		$countries = self::getCountryData();
		if (isset($countries[$language])) {
			return $countries[$language];
		}
		return '';
	}

	/**
	 * Returns all the languages country icons.
	 *
	 * @param $language string Language.
	 * @param array $iconOptions Options to the icon.
	 * @return string
	 */
	public static function getCountryIconFromLanguage($language, $iconOptions)
	{
		$countriesIcon = self::getCountryIconData($iconOptions);
		if (isset($countriesIcon[$language])) {
			return $countriesIcon[$language];
		}
		return '';
	}

}
