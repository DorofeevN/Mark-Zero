<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif;?>

    <?php if( Yii::$app->session->hasFlash('error') ): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif;?>

    <?php if(isset($relocated)): ?>


      <table class="table table-hover table-striped">
          <thead>
          <tr>
              <th>Фото</th>
              <th>Наименование</th>
              <th>Кол-во</th>
              <th>Цена</th>
              <th>Сумма</th>
              <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($relocated as $id => $item):?>
              <tr>
                  <td>                          <?php if((strrpos($item['img'] , 'picsum')) || (strrpos($item['img'] , 'lorempixel')) || (strrpos($item['img'] , 'placekitten'))):?>
                                                <?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]);?>
                                            <?php else: ?>
                                              <?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]);?>
                                            <?php endif?></td>
                  <td><a href="<?= Url::to(['product/view', 'id' => $id])?>"><?= $item['name']?></a></td>
                  <td><?= $item['qty']?></td>
                  <td><?= $item['price']?></td>
                  <td><?= $item['qty'] * $item['price']?></td>
                  <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
              </tr>
          <?php endforeach;?>
          <tr>
              <td colspan="5">Итого: </td>
              <td><?= $qty?></td>
          </tr>
          <tr>
              <td colspan="5">На сумму: </td>
              <td><?= $sum?></td>
          </tr>
          </tbody>
      </table>


      <div class="btn-group">
    <a href="<?= \yii\helpers\Url::to(['/cart/view'])?>" class="btn btn-success">Перейти к оформлению заказа</a>
    <a href="<?= \yii\helpers\Url::home()?>" class="btn btn-info">Продолжить покупки</a>
      </div>
    <?php else:?>
      <h1> В избранном пока нет ничего</h1>
      <div class="btn-group">
    <a href="<?= \yii\helpers\Url::home()?>" class="btn btn-info">Продолжить покупки</a>
      </div>
    <?php endif;?>


</div>
