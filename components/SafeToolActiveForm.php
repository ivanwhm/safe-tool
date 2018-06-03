<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\enums\Icons;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\Html;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

class SafeToolActiveForm extends ActiveForm
{
	/**
	 * @var string the default field class name when calling [[field()]] to create a new field.
	 * @see fieldConfig
	 */
	public $fieldClass = 'app\components\SafeToolActiveField';

	/**
	 * Generates a form field.
	 * A form field is associated with a model and an attribute. It contains a label, an input and an error message
	 * and use them to interact with end users to collect their inputs for the attribute.
	 *
	 * @param SafeToolActiveRecord|Model $model the data model.
	 * @param string $attribute the attribute name or expression. See [[Html::getAttributeName()]] for the format
	 * about attribute expression.
	 * @param array $options the additional configurations for the field object. These are properties of [[ActiveField]]
	 * or a subclass, depending on the value of [[fieldClass]].
	 *
	 * @return SafeToolActiveField|ActiveField
	 */
	public function field($model, $attribute, $options = [])
	{
		return parent::field($model, $attribute, $options);
	}

	/**
	 * Prints the mandatory message of the form.
	 *
	 * @return string
	 */
	public function printMandatoryFieldsMessage()
	{
		$label = Icons::getIcon(Icons::FORM_MANDATORY) . Yii::t('index', 'Fields marked with (*) are required.');
		return Html::tag('span', $label, ['class' => 'help-block']);
	}

	/**
	 * Prints the created and updated date of the form.
	 *
	 * @param SafeToolActiveRecord|Model $model Data model.
	 * @param bool $created Print created date?
	 *
	 * @return string
	 * @throws InvalidConfigException
	 */
	public function printModelDates($model, $created = true)
	{
		if (!$model->getIsNewRecord()) {
			$tag = '';

			if ($created) {
				$createdDate = Icons::getIcon(Icons::FORM_USER) . $model->printCreatedInformation();
				$tag = Html::tag('span', $createdDate, ['class' => 'help-block']);
			}

			$updatedDate = Icons::getIcon(Icons::FORM_USER) . $model->printLastUpdatedInformation();
			$tag .= Html::tag('span', $updatedDate, ['class' => 'help-block']);

			return $tag;
		}
		return '';
	}

	/**
	 * Prints the error summary of the form.
	 *
	 * @param SafeToolActiveRecord|Model $model Data model.
	 *
	 * @return string
	 */
	public function printErrorSummary($model)
	{
		if ($model->hasErrors()) {
			return Html::tag('div', $this->errorSummary($model), ['class' => 'alert alert-danger']);
		}
		return '';
	}

	/**
	 * Prints the save and cancel button of the form.
	 *
	 * @param SafeToolActiveRecord|Model $model Data model.
	 * @param string $saveButtonLabel Save button label.
	 * @param string $saveButtonIcon Save button icon.
	 * @param array $cancelUrlNewRecord Cancel URL for new records.
	 * @param array|string $cancelUrlOldRecord Cancel URL for old records.
	 *
	 * @return string
	 */
	public function printFormButtons($model, $saveButtonLabel = 'Save', $saveButtonIcon = Icons::FORM_SAVE,
																	 $cancelUrlNewRecord = ['index'], $cancelUrlOldRecord = '')
	{
		$save = Icons::getIcon($saveButtonIcon) . Yii::t('index', $saveButtonLabel);
		$saveClass = $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary';
		$cancel = Icons::getIcon(Icons::FORM_CANCEL) . Yii::t('index', 'Cancel');
		$cancelUrlOldRecord = is_array($cancelUrlOldRecord) ? $cancelUrlOldRecord : ['view', 'id' => $model->getAttribute('id')];
		$cancelUrlNewRecord = $model->getIsNewRecord() ? $cancelUrlNewRecord : $cancelUrlOldRecord;

		$tag = Html::beginTag('div', ['class' => 'form-group']);
		$tag .= Html::submitButton($save, ['class' => $saveClass]);
		$tag .= ' ';
		$tag .= Html::a($cancel, $cancelUrlNewRecord, ['class' => 'btn btn-danger']);

		return $tag;
	}

}