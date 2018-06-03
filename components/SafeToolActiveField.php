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
	 * @param string $id Help ID.
	 * @return string
	 */
	private function help($id)
	{
		if ($this->model->hasMethod('getHelpMessages') &&
			isset($this->model->getHelpMessages()[$this->attribute])) {
			$icon = Icons::getIcon(Icons::FORM_HELP);
			$message = $this->model->getHelpMessages()[$this->attribute];
			return Html::tag('span', $icon . $message, [
				'id' => $id,
				'class' => 'help-block'
			]);
		}
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function textInput($options = [])
	{
		$input = parent::textInput($options);
		$input .= $this->help(isset($options['aria-describedby']) ? $options['aria-describedby'] : '');
		return $input;
	}

	/**
	 * @inheritdoc
	 */
	public function widget($class, $config = [])
	{
		$widget = parent::widget($class, $config);
		$widget .= $this->help(isset($config['options']['aria-describedby']) ?
			$config['options']['aria-describedby'] : '');
		return $widget;
	}

	/**
	 * @inheritdoc
	 */
	public function textarea($options = [])
	{
		$text = parent::textarea($options);
		$text .= $this->help(isset($options['aria-describedby']) ? $options['aria-describedby'] : '');
		return $text;
	}

}