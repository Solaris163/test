<?php

$arColors = [
    '0' => 'значение отсутствует',
    '1' => 'зеленый цвет',
    '2' => 'желтый цвет',
    '3' => 'красный цвет',
];
$arColorsIds = array_keys($arColors);

// получить всех пользователей
$arUsers = [];
$data = GetList(['ID', 'FIRST_NAME', 'LAST_NAME']);
while($arUser = $data->Fetch()) {
    $arUsers[$arUser['ID']] = $arUser;
}
$arUsersIds = array_keys($arUsers);

// получить всех клиентов
$obRes = GetList(['ID', 'COLOR', 'USER_ID']);
while ($arRes = $obRes->Fetch()){
    if (isset($arRes['USER_ID']) && in_array($arRes['USER_ID'], $arUsersIds)) {
        $userId = $arRes['USER_ID'];
        // увеличить количество клиентов у пользователя на 1
        $arUsers[$userId]['CLIENTS_COUNTS']['ALL'] = isset($arUsers[$userId]['CLIENTS_COUNTS']['ALL']) ? $arUsers[$userId]['CLIENTS_COUNTS']['ALL'] + 1 : 1;

        if (isset($arRes['COLOR'])) {
            $colorId = $arRes['COLOR'];

            // увеличить количество клиентов данного цвета на 1
            if (isset($arUsers[$userId]['CLIENTS_COUNTS'][$colorId])) {
                $arUsers[$userId]['CLIENTS_COUNTS'][$colorId]++;
            } else {
                $arUsers[$userId]['CLIENTS_COUNTS'][$colorId] = 1;
            }
        }
    }
}

require_once (__DIR__.'/template.php');