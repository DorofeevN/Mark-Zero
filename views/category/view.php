<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/1.jpg" alt="" />
    </div>
</section>

<section>
<div class="container">
<div class="row">
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Категории</h2>
        <ul class="catalog category-products">
            <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
        </ul>



    </div>
</div>


<?php if(isset($products)): ?>
<div class="col-sm-9 padding-right">
<div class="features_items"><!--features_items-->
<h2 class="title text-center"><?= $category->name?></h2>
    <?php if(!empty($products)): ?>
        <?php $i = 0; foreach($products as $product): ?>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
              <?php if((strrpos($product['img'] , 'lorempixel')) || (strrpos($product['img'] , 'picsum'))):?>
                <?=Html::img("$product->img", ['alt' => $product->name]);?>
              <?php else: ?>
              <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->name]); ?>
              <?php endif?>
                <h2>$<?= $product->price?></h2>
                <h3><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name?></a></h3>
                <a href="#" data-id="<?= $product->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в Корзину</a>
            </div>
            <?php if($product->new): ?>
                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new'])?>
            <?php endif?>
            <?php if($product->sale): ?>
                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new'])?>
            <?php endif?>
        </div>
        <div class="choose">
          <ul class="nav nav-pills nav-justified">
              <li><a href="" data-id="<?= $product->id?>" class = "add-to-wishlist"><i class="fa fa-plus-square"></i>Добавить в Избранное</a></li>
          </ul>
        </div>
    </div>
</div>
            <?php $i++?>
            <?php if($i % 3 == 0): ?>
                <div class="clearfix"></div>
            <?php endif;?>
            <?php endforeach;?>
        <div class="clearfix"></div>
        <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
        <?php else :?>
        <h2>Здесь товаров пока нет...</h2>
    <?php endif;?>

    <?php endif;?>

    <?php if(isset($categories)): ?>
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center"><?= $category->name?></h2>
            <?php if(!empty($categories)): ?>
                <?php $i = 0; foreach($categories as $category): ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">

                                <div class="productinfo text-center">
                                    <?php if(isset($randimage[$category["name"]])){
                                        $rand = $randimage[$category["name"]];
                                        if($rand == $category["name"]){
                                            $rand = 'no-image.png';
                                        }
                                    }
                                    else{
                                        $rand = 'no-image.png';
                                    }?>
                                    <?php if((strrpos($rand , 'lorempixel')) || (strrpos($rand , 'picsum')) || (strrpos($rand , 'placekitten'))):?>
                                      <?=Html::img($rand);?>
                                    <?php else: ?>
                                    <?= Html::img("@web/images/products/{$rand}"); ?>
                                    <?php endif?>
                                    <h2><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category->id]) ?>"><?= $category->name?></a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++?>
                    <?php if($i % 3 == 0): ?>
                        <div class="clearfix"></div>
                    <?php endif;?>
                <?php endforeach;?>
                <div class="clearfix"></div>
                <?php
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            <?php else :?>
                <h2>Ничего нет...</h2>
            <?php endif;?>
    <?php endif;?>

<!--<ul class="pagination">
    <li class="active"><a href="">1</a></li>
    <li><a href="">2</a></li>
    <li><a href="">3</a></li>
    <li><a href="">&raquo;</a></li>
</ul>-->
</div>
</div>
</div>
</div>
</section>
