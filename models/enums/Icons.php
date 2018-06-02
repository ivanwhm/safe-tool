<?php
/**
 * The model responsible for icons control.
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

namespace app\models\enums;

//Imports
use yii\helpers\Html;

class Icons
{

	const RECORDS = 'record';
	const PRODUCT = 'product';
	const EPIC = 'epic';
	const FEATURE = 'feature';
	const PRODUCT_OWNER = 'po';
	const STORY = 'story';
	const STORY_ACCEPTANCE_CRITERIA = 'story_accept';
	const STORY_STATUS = 'story_status';
	const USERS = 'users';
	const USER_ROLE = 'user_role';
	const USER_PASSWORD = 'password';
	const DASHBOARD = 'dashboard';

	const CRUD_ADD = 'add';
	const CRUD_DELETE = 'del';
	const CRUD_EDIT = 'edit';
	const CRUD_VIEW = 'view';
	const CRUD_RELOAD = 'reload';
	const FORM_HELP = 'help';
	const FORM_OK = 'ok';
	const FORM_SAVE = 'save';
	const FORM_CANCEL = 'cancel';
	const FORM_MANDATORY = 'mandatory';
	const FORM_USER = 'user';
	const FORM_TRANSFER = 'transfer';
	const FORM_LOGIN = 'login';
	const FORM_LOGOUT = 'logout';
	const FORM_CARET = 'carrot';

	/**
	 * Shows the icon using font-awesome tags.
	 * 
	 * @param $icon string Icon name.
	 * @return string
	 */
	private static function show($icon) {
		return Html::tag('i', '', ['class' => 'fa fa-' . $icon . ' fa-fw']);
	}

	/** 
	 * Returns the icon according to its place in the screens.
	 * 
	 * @param $place string Icon place. Please use the constants.
	 * @return string
	 */
	public static function getIcon($place)
	{
		$icon = '';
		switch ($place) {
			case self::CRUD_ADD:
				$icon = self::show('plus');
				break;
			case self::CRUD_DELETE:
				$icon = self::show('trash');
				break;
			case self::CRUD_EDIT:
				$icon = self::show('pencil');
				break;
			case self::CRUD_VIEW:
				$icon = self::show('eye');
				break;
			case self::CRUD_RELOAD:
				$icon = self::show('refresh');
				break;
			case self::FORM_HELP:
				$icon = self::show('info-circle');
				break;
			case self::FORM_OK:
				$icon = self::show('check');
				break;
			case self::FORM_SAVE:
				$icon = self::show('download');
				break;
			case self::FORM_CANCEL:
				$icon = self::show('ban');
				break;
			case self::FORM_MANDATORY:
				$icon = self::show('asterisk');
				break;
			case self::FORM_USER:
				$icon = self::show('user');
				break;
			case self::FORM_TRANSFER:
				$icon = self::show('exchange');
				break;
			case self::FORM_LOGIN:
				$icon = self::show('sign-in');
				break;
			case self::FORM_LOGOUT:
				$icon = self::show('sign-out');
				break;
			case self::FORM_CARET:
				$icon = self::show('caret-down');
				break;
			case self::RECORDS:
				$icon = self::show('edit');
				break;
			case self::EPIC:
				$icon = self::show('globe');
				break;
			case self::FEATURE:
				$icon = self::show('map-signs');
				break;
			case self::PRODUCT:
				$icon = self::show('product-hunt');
				break;
			case self::PRODUCT_OWNER:
				$icon = self::show('user-md');
				break;
			case self::STORY:
				$icon = self::show('book');
				break;
			case self::STORY_ACCEPTANCE_CRITERIA:
				$icon = self::show('check-circle');
				break;
			case self::STORY_STATUS:
				$icon = self::show('tags');
				break;
			case self::USERS:
				$icon = self::show('users');
				break;
			case self::USER_ROLE:
				$icon = self::show('female');
				break;
			case self::USER_PASSWORD:
				$icon = self::show('key');
				break;
			case self::DASHBOARD:
				$icon = self::show('dashboard');
				break;
		}
		return $icon;
	}
}