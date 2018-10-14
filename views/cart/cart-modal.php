<?php if (!empty($session['cart'])): ?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Фото</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
            <th><span class="glyphicon glyphicon-remove" aria-hidden="true">

                </span></th>
        </tr>
        </thead>
        <tbody>


        <?php foreach ($session['cart'] as $item):?>
        <tr>

            <td><?= $item['img'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['qty'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></td>

        </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4">Итого: </td>
            <td><?= $session['cart.qty'] ?></td>
        </tr>
        <tr>
            <td colspan="4">На сумму: </td>
            <td><?= $session['cart.sum'] ?></td>
        </tr>
        </tbody>

    </table>
</div>

<?php else: ?>
<p>Корзина пуста</p>
<?php endif; ?>