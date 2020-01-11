<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 14.05.2016
 * Time: 10:40
 */

namespace app\models;
use yii\db\ActiveRecord;

class Wishlist extends ActiveRecord{

    public function addToWishlist($product, $qty = 1){
        if(isset($_SESSION['wishlist'][$product->id])){
            $_SESSION['wishlist'][$product->id]['qty'] += $qty;
        }else{
            $_SESSION['wishlist'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
        $_SESSION['wishlist.qty'] = isset($_SESSION['wishlist.qty']) ? $_SESSION['wishlist.qty'] + $qty : $qty;
        $_SESSION['wishlist.sum'] = isset($_SESSION['wishlist.sum']) ? $_SESSION['wishlist.sum'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalc($id){
        if(!isset($_SESSION['wishlist'][$id])) return false;
        $qtyMinus = $_SESSION['wishlist'][$id]['qty'];
        $sumMinus = $_SESSION['wishlist'][$id]['qty'] * $_SESSION['wishlist'][$id]['price'];
        $_SESSION['wishlist.qty'] -= $qtyMinus;
        $_SESSION['wishlist.sum'] -= $sumMinus;
        unset($_SESSION['wishlist'][$id]);
    }

}
