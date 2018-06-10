<?php
/**
 * Some methods to messages.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use yii\helpers\Html;

class SafeToolMessages
{

	/**
	 * Print an alert.
	 * 
	 * @param $type string Type of the message.
	 * @param $message string Message.
	 * 
	 * @return string
	 */
	public static function printMessage($type, $message)
	{
		$tag = Html::beginTag('div', ['class' => 'alert alert-' . $type . ' alert-dismissable']);
		$tag .= Html::button('&times;', [
			'class' => 'close',
			'data-dismiss' => 'alert',
			'aria-hidden' => 'true',
		]);
		$tag .= $message;
		$tag .= Html::endTag('div');
		return $tag;
	}
}