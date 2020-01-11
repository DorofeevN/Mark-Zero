<?php if(!empty($session['wishlist'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['wishlist'] as $id => $item):?>
                <tr>
                    <td>
                      <?php if((strrpos($item['img'] , 'picsum')) || (strrpos($item['img'] , 'lorempixel')) || (strrpos($item['img'] , 'placekitten'))):?>
                          <?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]);?>
                      <?php else: ?>
                        <?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]);?>
                      <?php endif?>

                    </td>
                    <td><?= $item['name']?></td>
                    <td><?= $item['qty']?></td>
                    <td><?= $item['price']?></td>
                    <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?= $session['wishlist.qty']?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['wishlist.sum']?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>В Избранном пока нет ничего...</h3>
<?php endif;?>
