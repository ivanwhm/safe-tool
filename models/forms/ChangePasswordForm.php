<?php
/**
 * ChangePasswordForm is the model behind the site page to change the user's password.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\forms;

//Imports
use app\models\User;
use kartik\password\StrengthValidator;
use Yii;
use yii\base\Model;
use yii\db\Expression;

class ChangePasswordForm extends Model
{
	/**
	 * Old password.
	 *
	 * @var string $oldPassword
	 */
	public $oldPassword;

	/**
	 * New password.
	 *
	 * @var string $newPassword
	 */
	public $newPassword;

	/**
	 * Repeat New password.
	 *
	 * @var string $repeatNewPassword
	 */
	public $repeatNewPassword;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['oldPassword', 'newPassword', 'repeatNewPassword'], 'required'],
			[['newPassword', 'repeatNewPassword'], StrengthValidator::class, 'hasUser' => false, 'hasEmail' => false, 'min' => 6, 'max' => 30, 'lower' => 1, 'upper' => 1, 'digit' => 1, 'special' => 1],
			[['newPassword'], 'compare', 'compareAttribute' => 'oldPassword', 'operator' => '!=', 'message' => Yii::t('password', 'The new password is the same of the old one.')],
			[['repeatNewPassword'], 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('password', 'The inputted passwords are different.')],
			['oldPassword', 'validatePassword'],
			[['newPassword', 'repeatNewPassword'], 'string', 'min' => 6],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'oldPassword' => Yii::t('password', 'Old password'),
			'newPassword' => Yii::t('password', 'New password'),
			'repeatNewPassword' => Yii::t('password', 'New password (again)'),
		];
	}

	/**
	 * Validates de user's password.
	 *
	 * @param string $attribute the attribute currently being validated
	 */
	public function validatePassword($attribute)
	{
		if (!$this->hasErrors()) {
			$user = User::findOne(Yii::$app->getUser()->getId());

			if (!$user || !$user->validateAuthKey($this->oldPassword)) {
				$this->addError($attribute, Yii::t('password', 'The old password is incorrect.'));
			}
		}
	}

	/**
	 * Changes de user's password.
	 *
	 * @return boolean
	 */
	public function changePassword()
	{
		$user = User::findOne(Yii::$app->getUser()->getId());
		$user->setAttribute('password', $this->newPassword);
		$user->new_password = $this->repeatNewPassword;
		$user->setAttribute('last_password_change', new Expression('current_timestamp'));
		$user->setAttribute('user_updated', Yii::$app->getUser()->getId());
		
		return $user->save(false);
	}

}