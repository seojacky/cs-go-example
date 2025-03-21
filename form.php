<?php
session_start(); 
//include("../db.php"); //Соединяемся с Базой данных.
?>
<?php
$client_ip   = $_SERVER['REMOTE_ADDR'];
$userok      = $_GET['user']; //Получаем данные из текстового поля по GET-запросу
$datetime    = time(); //Определяем время
$superdate   = date('H:i:s/d.m.y', $datetime); //Преобразуем время в формат 12:00:00/10.09.89

$apikey = '2EF6E52E83E288756136106E81C4B41E'; //API STEAM


require_once "../functions/steam-id-extractor.php";

$steamID64 = getSteamID64($_GET['user']);
$steamID32 = getSteamID32($steamID64);

?>


<div class="steam_stats__form-container">

<form method="get" class ="steam_stats__form">
	<input type="hidden" name="action" value="view">

    <input required type="text" name="user" title="Например:&#10; Heavenanvil &#10; 76561198036370701 &#10; STEAM_0:1:38052486 &#10; steamcommunity.com/id/heavenanvil &#10; steamcommunity.com/profiles/76561198036370701" placeholder="Введите SteamID / SteamCommunityID / Имя профиля / URL профиля" class="steam_stats__form__username" value="<?= $_GET['user'] ?>">

    <input class="steam_stats__form__submit" type="submit" value="ПОИСК" />	

</form>

<?php
/*

echo $_GET['user'];



if (isset($_GET['user']))  { echo 'Srabotalo 1 <br>'; } ?>

<?php if (!empty($_GET['user']))  { echo 'Srabotalo 2 <br>'; } ?>

<?php if ($_GET['user'] !== '')  { echo 'Srabotalo 3 <br>'; } 

*/
?>

</div>