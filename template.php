
<table class="servicedesk-ord__table">
    <thead>
        <tr>
            <th>Пользователь</th>
            <? foreach ($arColors as $color) : ?>
                <th><?=$color?></th>
            <? endforeach; ?>
            <th>Всего клиентов</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($arUsers as $arUser) : ?>
            <tr><?=$arUser['LAST_NAME']?> <?=$arUser['FIRST_NAME']?></tr>
            <? foreach ($arColors as $key => $color) : ?>
                <tr><?=$arUser['CLIENTS_COUNTS'][$key] ?? 0?></tr>
            <? endforeach; ?>
            <tr><?=$arUser['CLIENTS_COUNTS']['ALL'] ?? 0?></tr>
        <? endforeach; ?>
    </tbody>
</table>