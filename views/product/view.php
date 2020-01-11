<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<section>
<div class="container">
<div class="row">


<div class="col-sm-12 padding-right">
<div class="product-details"><!--product-details-->


    <div class="col-sm-5 ">
        <div class="view-product">
          <?php if((strrpos($product['img'] , 'picsum')) || (strrpos($product['img'] , 'lorempixel')) || (strrpos($product['img'] , 'placekitten'))):?>
            <?= Html::img($product->img, ['alt' => $product->name])?>
          <?php else: ?>
          <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->name])?>
          <?php endif?>

        </div>


    </div>
    <div class="col-sm-7">
        <div class="product-information padding-right"><!--/product-information-->
            <?php if($product->new): ?>
                <?= Html::img("@web/images/home/newr.png", ['alt' => 'Новинка', 'class' => 'newarrival'])?>
            <?php endif?>
            <?php if($product->sale): ?>
                <?= Html::img("@web/images/home/saler.png", ['alt' => 'Распродажа', 'class' => 'newarrival'])?>
            <?php endif?>
            <h1><?= $product->name?></h1>
            <p>Web ID: 123123</p>
								<span>
									<span>US $<?= $product->price?></span>
									<label>Quantity:</label>
									<input type="text" value="1" id="qty" />
									<a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?= $product->id?>" class="btn btn-fefault add-to-cart cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Добавить в Корзину
                                    </a>
								</span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b> <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->id]) ?>"><?= $product->category->name?></a></p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Хиты продаж</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
<?php $count = count($hits); $i = 0; foreach($hits as $hit): ?>
<?php if($i % 3 == 0): ?>
    <div class="item <?php if($i == 0) echo 'active' ?>">
<?php endif; ?>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      <?php if((strrpos($hit['img'] , 'picsum')) || (strrpos($hit['img'] , 'lorempixel')) || (strrpos($hit['img'] , 'placekitten'))):?>
                        <?= Html::img($hit->img, ['alt' => $hit->name])?>
                      <?php else: ?>
                      <?= Html::img("@web/images/products/{$hit->img}", ['alt' => $hit->name])?>
                      <?php endif?>

                        <h2>$<?= $hit->price?></h2>
                        <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id])?>"><?= $hit->name?></a></p>
                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в Корзину</button>
                    </div>
                </div>
            </div>
        </div>
<?php $i++; if($i % 3 == 0 || $i == $count): ?>
    </div>
<?php endif; ?>
<?php endforeach; ?>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->

</div>
</div>
</div>
</section>
