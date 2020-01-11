<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              <h1 class="text-center">Случайные товары по скидке:</h1>
              <?php if(!empty($onsales)): ?>
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <?php $i = 0; foreach($onsales as $onsale): ?>
                        <li data-target="#slider-carousel" data-slide-to="<?php $onsale?>" <?php if($i == 0):?>class="active"<?php $i++; endif;?>></li>
                        <?php endforeach;?>
                    </ol>
              <?php endif;?>

              <?php if(!empty($onsales)): ?>
                  <div class="carousel-inner">
                <?php $i = 0; foreach($onsales as $onsale): ?>
                    <div class="item <?php if($i === 0): ?>active<?php endif;?>">
                            <div class="col-sm-6">
                                <h1><?php echo($onsale->name)?></h1>
                                <h2><s><?php echo($onsale->price)?></s> <?php echo(round($onsale->price*0.9, 2))?></h2>
                                <h2>Описание товара</h2>
                                <p><?php echo($onsale->description)?></p>
                                <h3><a href="#" data-id="<?= $onsale->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a></h3>

                            </div>
                            <div class="col-sm-6">
                              <?php if((strrpos($onsale['img'] , 'picsum')) || (strrpos($onsale['img'] , 'lorempixel')) || (strrpos($onsale['img'] , 'placekitten'))):?>
                              <?= Html::img($onsale->img, ['alt' => $onsale->name, 'class' => "girl img-responsive"])?>
                              <?php else: ?>
                              <?= Html::img("@web/images/products/{$onsale->img}", ['alt' => $onsale->name, 'class' => "girl img-responsive"])?>
                              <?php endif?>

                            </div>
                        </div>
                 <?php $i++;?>
              <?php endforeach;?>

            </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
<?php endif;?>
            </div>
        </div>
    </div>
</section><!--/slider-->

<section>

<div class="container">

<div class="row">

<div class="col-sm-3">

    <div class="left-sidebar">
        <h2>Категории</h2>
        <ul class="catalog category-products">
            <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
        </ul>

        <div class="price-range"><!--price-range-->
            <h2>Цены</h2>
            <div class="well">
                <input type="text" class="span2" value="" data-slider-min="<?php $min = round(min($rangeprice), 2);echo(floor($min))?>" data-slider-max="<?php $max = max($rangeprice); echo(ceil($max));?>"
                data-slider-step="1"
                data-slider-value="[<?php echo($min) ?>,<?php echo($max) ?>]" id="sl2" ><br />
                <b>$ <?php echo($min);?></b> <b class="pull-right">$ <?php echo($max);?></b>
                <a class="btn btn-success" href="#" >Применить фильтр</a>
            </div>
        </div><!--/price-range-->
    </div>


</div>

<div class="col-sm-9 padding-right">
<?php if( !empty($hits) ): ?>
  <div class="features_items"><!--features_items-->
  <h2 class="title text-center">Хиты продаж:</h2>
      <?php if(!empty($hits)): ?>
          <?php $i = 0; foreach($hits as $hit): ?>
  <div class="col-sm-4">
      <div class="product-image-wrapper">
          <div class="single-products">
              <div class="productinfo text-center">
                <?php if((strrpos($hit['img'] , 'picsum')) || (strrpos($hit['img'] , 'lorempixel')) || (strrpos($hit['img'] , 'placekitten'))):?>
                  <?=Html::img($hit->img, ['alt' => $hit->name]);?>
                <?php else: ?>
                <?= Html::img("@web/images/products/{$hit->img}", ['alt' => $hit->name]); ?>
                <?php endif?>
                  <h2>$<?= $hit->price?></h2>
                  <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>"><?= $hit->name?></a></p>
                  <a href="#" data-id="<?= $hit->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в Корзину</a>
              </div>
              <?php if($hit->hit): ?>
                  <?= Html::img("@web/images/home/hitr.png", ['alt' => 'Новинка', 'class' => 'new'])?>
              <?php endif?>
          </div>
          <div class="choose">
              <ul class="nav nav-pills nav-justified">
                  <li><a href="" data-id="<?= $hit->id?>" class = "add-to-wishlist"><i class="fa fa-plus-square"></i>Добавить в Избранное</a></li>
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
  <!--<ul class="pagination">
      <li class="active"><a href="">1</a></li>
      <li><a href="">2</a></li>
      <li><a href="">3</a></li>
      <li><a href="">&raquo;</a></li>
  </ul>-->
  </div><!--features_items-->

<?php endif; ?>



</div>
</div>

</div>
</section>
