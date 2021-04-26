<?php

namespace  frontend\controllers;
use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CartItem;
use common\models\Product;
use yii\web\NotFoundHttpException;
use yii\filters\ContentNegotiator;
use yii\web\Response;
/**
 *
 */
class CartController extends \frontend\base\Controller
{
  public function behaviors()
  {
    return [
      [
        'class' => ContentNegotiator::class,
        'only' => ['add'],
        'formats' => [
        'application/json' => Response::FORMAT_JSON,
        ]
      ],
      [
        'class' => yii\filters\VerbFilter::class,
        'actions' => [
          'delete' => ['POST', 'DELETE'],
        ]
      ]
    ];
  }
    public function actionIndex()
    {
        if (isGuest()) {
          // Get the items from session
          $cardItems =  \Yii::$app->session->get(CartItem::SESSION_KEY,[]);
        }else{
          //Get the items from database
          $cardItems = CartItem::findBySql(
            "SELECT
            c.product_id as id,
            p.image,
            p.name,
            p.price,
            c.quantity,
            p.price * c.quantity as total_price
            FROM cart_items c
            LEFT JOIN products p on p.id = c.product_id
            WHERE c.created_by = :userId
            ",[
              'userId' => Yii::$app->user->id
            ])
            ->asArray()
            ->all();
        }

        return $this->render('index', [
          'items' => $cardItems,
        ]);
    }

    public function actionAdd()
    {
      $id = \Yii::$app->request->post('id');
      $product = Product::find()->id($id)->published()->one();
      if (!$product) {
        throw new NotFoundHttpException("Product does not exist");
      }

      if (\Yii::$app->user->isGuest) {
        // Save in session
        $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
        $found = false;
        foreach ($cartItems as &$cartItem) {
          if ($cartItem['id'] == $id) {
            $cartItem['quantity']++;
            $found = true;
            break;
          }
        }
        if (!$found) {
        $cartItem = [
          'id' => $id,
          'name' => $product->name,
          'image' => $product->image,
          'price' => $product->price,
          'quantity' => 1,
          'total_price' => $product->price
        ];
        $cartItems[] = $cartItem;
        }
        \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
      }else{
        // Save in database
        $userId = \Yii::$app->user->id;
        $cartItem = CartItem::find()->userId($userId)->productId($id)->one();
        if ($cartItem) {
          $cartItem->quantity++;
        }else{
        $cartItem = new CartItem();
        $cartItem->product_id = $id;
        $cartItem->created_by =  $userId;
        $cartItem->quantity = 1;
      }
        if ($cartItem->save()) {
          return [
            'success' => true,
          ];
        }else{
          return [
            'success' => false,
            'errors' =>$cartItem->errors,
          ];
        }
      }
    }

    public function actionDelete($id)
    {
      if (isGuest()) {
        $cardItems =  \Yii::$app->session->get(CartItem::SESSION_KEY,[]);
        foreach ($cardItems as $i => $cardItem) {
          if ($cardItem['id'] == $id) {
            array_splice($cardItems, $i, 1);
            break;
          }
        }
        \Yii::$app->session->set(CartItem::SESSION_KEY,$cardItems);
      }else{
        CartItem::deleteAll(['product_id' => $id, 'created_by' => currUserId()]);
      }

      return $this->redirect(['index']);
    }
}
