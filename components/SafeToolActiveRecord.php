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
use yii\db\ActiveRecord;
use yii\db\Expression;

class SafeToolActiveRecord extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if ($insert) {
			if ($this->hasAttribute('date_created')) {
				$this->setAttribute('date_created', new Expression('current_timestamp'));
			}
			if ($this->hasAttribute('user_created')) {
				$this->setAttribute('user_created', Yii::$app->getUser()->getId());
			}
		}

		if ($this->hasAttribute('date_updated')) {
			$this->setAttribute('date_updated', new Expression('current_timestamp'));
		}
		if ($this->hasAttribute('user_updated')) {
			$this->setAttribute('user_updated', Yii::$app->getUser()->getId());
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

}