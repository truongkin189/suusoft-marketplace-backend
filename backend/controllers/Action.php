<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\controllers;

use Yii;


/**
 * Action is the base class for action classes that implement RESTful API.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Action extends \yii\base\Action
{
    public $checkAccess;
}
