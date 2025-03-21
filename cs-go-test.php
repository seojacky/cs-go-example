<div id="block_stats" style="width:100%;">

<?php
/*
* заданы нужны переменные:
*/
$apikey = '2EF6E52E83E288756136106E81C4B41E'; //API STEAM

$id = '76561198116436066';
?>


	


	<div>	
<?php



require_once "vendor/autoload.php";

use Carbon\Carbon;


//$errorMail = "pustojack@list.ru";
$errorMail = "pustojack@list.ru";

// Получаем схему данных игры. Это понадобится для отображения иконок достижений.
/*$schemaJson = file_get_contents("http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v0002/?key=$apikey&appid=730&l=russian&format=json");	
$schema = json_decode($schemaJson, true);
echo $schema;*/


//Получаем данные игрока CS:GO
//$id          = $url->steamID64;
/*$id 	     = $steamID64;
$myurl       = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=' . $apikey . '&steamid=' . $id;
$urljson     = file_get_contents($myurl);
echo $schema;*/

// Получаем профиль Steam
$profileUrl       = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$id";
$profilejson = file_get_contents($profileUrl);
$profile = json_decode($profilejson, true);

//echo $profilejson;

//print_r($profile);
echo 'Это тест ключа API'.'<br>';
echo 'steamid:' . $profile['response']['players'][0]['steamid'].'<br>';
echo 'personaname:' . $profile['response']['players'][0]['personaname'].'<br>';


?>
	</div>	
</div>	


