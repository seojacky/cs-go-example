<?php

require_once "../vendor/autoload.php";

use PHPHtmlParser\Dom;

// Массив игроков
$playerArray = [];

// Создаём новый инстанс класса для парсинга HTML
$dom = new Dom;
// Загружаем HLTV
$dom->loadFromUrl("https://www.hltv.org/stats/players");
// Ищем таблицу с игроками
$table = $dom->find(".player-ratings-table");
// Загружаем её для последующих манипуляций
$dom->loadStr($table->outerHtml);
// Выполняем поиск всех элементов с тэгом tr
$elements = $dom->find("tr");
foreach($elements as $key => $element) {
    // Ищем td в каждом tr
    $dom->loadStr($element);
    $data = $dom->find("td");
    // Создаём массив текущего игрока
    $currentPlayer = [];
    foreach($data as $one) {
        // Если td - имя игрока, то извлекаем имя из ссылки
        if($one->class == "playerCol ") {
            $dom->loadStr($one->innerHtml);
            $link = $dom->find("a");
            $currentPlayer["playerCol"] = $link->innerHtml;
            continue;
        }
        // Если td - название команды, то извлекаем название и ссылку на логотип из img тэга
        if($one->class == "teamCol") {
            $dom->loadStr($one->innerHtml);
            $link = $dom->find("img");
            $currentPlayer["teamCol"] = $link->alt;
            $currentPlayer["teamLogo"] = $link->src;
            continue;
        }
        // Если td не подходит под условие выше - просто записываем его в массив данных об игроке
        $currentPlayer[$one->class] = $one->innerHtml;
    }
    // Добавляем текущего игрока в массив всех игроков
    $playerArray[] = $currentPlayer;
}

// Сдвигаем массив на один ключ, для того чтобы убрать пустую строку
unset($playerArray[0]);

file_put_contents("data.json", json_encode($playerArray));