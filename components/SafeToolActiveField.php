<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\enums\Icons;
use yii\helpers\Html;
use yii\widgets\ActiveField;

class SafeToolActiveField extends ActiveField
{

	/**
	 * Returns the HELP tag for form fields.
	 *
	 * @param string $help Help message.
	 * @param string $id Help ID.
	 * @return string
	 */
	private function help($help, $id)
	{
		$icon = Icons::getIcon(Icons::FORM_HELP);
		return Html::tag('span', $icon . $help, [
			'id' => $id,
			'class' => 'help-block'
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function textInput($options = [], $help = '')
	{
		$input = parent::textInput($options);
		$input .= $this->help($help, isset($options['aria-describedby']) ? $options['aria-describedby'] : '');
		return $input;
	}

	/**
	 * @inheritdoc
	 */
	public function widget($class, $config = [], $help = '')
	{
		$widget = parent::widget($class, $config);
		$widget .= $this->help($help, isset($config['options']['aria-describedby']) ?
			$config['options']['aria-describedby'] : '');
		return $widget;
	}

	/**
	 * @inheritdoc
	 */
	public function textarea($options = [], $help = '')
	{
		$text = parent::textarea($options);
		$text .= $this->help($help, isset($options['aria-describedby']) ? $options['aria-describedby'] : '');
		return $text;
	}

}