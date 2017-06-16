<?php
/**
 * @author Pipekung Specialz <chanja@kku.ac.th>
 * @since 2.0
 */

namespace app\components;

use Yii;

class MenuHelper {

	public static function Active($name, $id = [], $unactive = []) {
		if (in_array(Yii::$app->controller->id, $unactive) || in_array(Yii::$app->controller->module->id, $unactive)) {
			return false;
		}

		if (in_array(Yii::$app->controller->action->id, $unactive)) {
			return false;
		}

		if (Yii::$app->controller->module->id == $name && empty($id)) {
			return true;
		} elseif (Yii::$app->controller->module->id == $name && in_array(Yii::$app->controller->id, $id)) {
			return true;
		} elseif (Yii::$app->controller->id == $name && empty($id)) {
			return true;
		} elseif (Yii::$app->controller->id == $name && in_array(Yii::$app->controller->action->id, $id)) {
			return true;
		}

		return false;
	}

	public static function ActiveAnnonuce($type=1) {
		if (Yii::$app->getRequest()->getQueryParam('type') == $type) {
			return true;
		}

		return false;
	}

}
