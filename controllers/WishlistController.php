<?php

namespace app\controllers;
use app\models\Wishlist;
use app\models\Product;
use app\models\Cart;
//use app\controllers\CartController;
use app\models\Order;
use app\models\OrderItems;
use Yii;

class WishlistController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd(){
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $session =Yii::$app->session;
        $session->open();
        $wishlist = new Wishlist();
        $wishlist->addToWishlist($product, $qty);
        if( !Yii::$app->request->isAjax ){
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('wishlist-modal', compact('session'));
    }

    public function actionClear(){
        $session =Yii::$app->session;
        $session->open();
        $session->remove('wishlist');
        $session->remove('wishlist.qty');
        $session->remove('wishlist.sum');
        $this->layout = false;
        return $this->render('wishlist-modal', compact('session'));
    }

    public function actionDelItem(){
        $id = Yii::$app->request->get('id');
        $session =Yii::$app->session;
        $session->open();
        $wishlist = new Wishlist();
        $wishlist->recalc($id);
        $this->layout = false;
        return $this->render('wishlist-modal', compact('session'));
    }

    public function actionShow(){
        $session =Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('wishlist-modal', compact('session'));
    }

    public function actionView(){
        $session = Yii::$app->session;
        $session->open();

          if(isset($session['wishlist'])){

            $mergewishcart = $session['cart'];
            $cartsum = floatval($session['cart.sum']) + floatval($session['wishlist.sum']);
            $cartqty = intval($session['cart.qty']) + intval($session['wishlist.qty']);
            foreach ($session['wishlist'] as $key => $value) {
              if(isset($mergewishcart[$key])){
                $mergewishcart[$key]['qty'] = $mergewishcart[$key]['qty'] + $value['qty'];
              }
              else{
                $mergewishcart[$key] = $value;
              }
            }
              $session->remove('cart', 'cart.qty', 'cart.sum');
              $session['cart'] = $mergewishcart;
              $session['cart.sum'] = $cartsum;
              $session['cart.qty'] = $cartqty;

              //return $this->refresh();
              foreach ($session['wishlist'] as $key => $value) {
                $relocated[] = $value;
              }
              $qty = $session['wishlist.qty'];
              $sum = $session['wishlist.sum'];

              $session->remove('wishlist.qty');
              $session->remove('wishlist.sum');
              $session->remove('wishlist');

              unset($mergewishcart);
              unset($cartsum);
              unset($cartqty);
              Yii::$app->session->setFlash('success', 'Товары из Избранного успешно помещены в Корзину');
              return $this->render('view', compact('relocated', 'qty', 'sum'));
          }


        return $this->render('view');
    }




}
