<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\components;

//Imports
use app\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

abstract class SafeToolActiveRecord extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		$user = Yii::$app->getUser()->getId();

		if ($insert) {
			if ($this->hasAttribute('date_created')) {
				$this->setAttribute('date_created', new Expression('current_timestamp'));
			}
			if ($this->hasAttribute('user_created')) {
				$this->setAttribute('user_created', $user);
			}
		}

		if ($this->hasAttribute('date_updated')) {
			$this->setAttribute('date_updated', new Expression('current_timestamp'));
		}
		if ($this->hasAttribute('user_updated')) {
			$this->setAttribute('user_updated', $user);
		}

		return parent::beforeSave($insert);
	}


	/**
	 * Returns the user that created the record.
	 *
	 * @return User
	 */
	public function getUserCreated()
	{
		if ($this->hasAttribute('user_created')) {
			return User::findOne(['id' => $this->getAttribute('user_created')]);
		}
		return null;
	}

	/**
	 * Returns the user that updated the record.
	 *
	 * @return User
	 */
	public function getUserUpdated()
	{
		if ($this->hasAttribute('user_updated')) {
			return User::findOne(['id' => $this->getAttribute('user_updated')]);
		}
		return null;
	}

	/**
	 * Returns the user link that created the record.
	 *
	 * @return string
	 */
	public function printUserCreatedLink()
	{
		if ($this->getUserCreated() instanceof User) {
			return Html::a($this->getUserCreated()->getAttribute('name'), $this->getUserCreated()->getLink());
		}
		return null;
	}

	/**
	 * Returns the user link that updated the record.
	 *
	 * @return string
	 */
	public function printUserUpdatedLink()
	{
		if ($this->getUserUpdated() instanceof User) {
			return Html::a($this->getUserUpdated()->getAttribute('name'), $this->getUserUpdated()->getLink());
		}
		return null;
	}

	/**
	 * Returns the created information to print on views.
	 *
	 * @return string
	 * @throws InvalidConfigException
	 */
	public function printCreatedInformation()
	{
		if (($this->hasAttribute('date_created')) and ($this->getUserCreated() instanceof User)) {
			$this->refresh();
			$date = $this->getAttribute('date_created');

			return Yii::t('index', 'Created on {date} by {username}.', [
				'date' => Yii::$app->getFormatter()->asDatetime($date),
				'username' => $this->printUserCreatedLink()
			]);
		}
		return '';
	}

	/**
	 * Returns the last updated information to print on views.
	 *
	 * @return string
	 * @throws InvalidConfigException
	 */
	public function printLastUpdatedInformation()
	{
		if (($this->hasAttribute('date_updated')) and ($this->getUserUpdated() instanceof User)) {
			$this->refresh();
			$date = $this->getAttribute('date_updated');

			return Yii::t('index', 'Last update on {date} by {username}.', [
				'date' => Yii::$app->getFormatter()->asDatetime($date),
				'username' => $this->printUserUpdatedLink()
			]);
		}
		return '';
	}

	/**
	 * Returns the help messages for forms.
	 *
	 * @return array
	 */
	public abstract function getHelpMessages();

}