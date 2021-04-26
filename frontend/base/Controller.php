<?php
namespace frontend\base;


use common\models\CartItem;

/**
 * Class Controller
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package frontend\base
 */
class Controller extends \yii\web\Controller
{
  public function beforeAction($action)
  {
    $this->view->params['cartItemCount'] = CartItem::getTotalQuantityForUser(currUserId());

    return parent::beforeAction($action);
  }
}
