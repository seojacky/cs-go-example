<?php 

mb_internal_encoding("UTF-8");

$_GET['user'] = '76561198116436066';
$client_ip   = $_SERVER['REMOTE_ADDR'];
$userok      = $_GET['user']; //Получаем данные из текстового поля по GET-запросу
$datetime    = time(); //Определяем время
$superdate   = date('H:i:s/d.m.y', $datetime); //Преобразуем время в формат 12:00:00/10.09.89

$apikey = 'YOUR_API_KEY'; //API STEAM


//Обращение к БД

if (isset($_GET['user']) && !empty($_GET['user'])) {



  if (isset($_GET['user'])) {
    $okay = $_GET['user'];
  }
  $steamid1 = '/^STEAM_0:([0|1]):([\d]+)$/'; //STEAM_0:1:38052486
  $steamid2 = '/^([\d]+)$/'; //76561198036370701
  $steamid3 = '/^[^-_\d]{1}[-a-zA-Z_\d]+$/'; //Heavenanvil
  $steamid4 = '~^(http[s]?://)?(www\.)?steamcommunity.com/profiles/([^-_]{1}[\d(/)?]+)$~'; //steamcommunity.com/profiles/76561198036370701
  $steamid5 = '~^(http[s]?://)?(www\.)?steamcommunity.com/id/([^-_]{1}[-a-zA-Z_\d(/)?]+)$~'; //steamcommunity.com/id/heavenanvil

  //Обращение к api.steampowered.com

  if (preg_match($steamid1, $okay, $matches)) //Если данные из Input вида "STEAM_0:1:38052486"
    {
    $valid1     = $matches[1];
    $valid2     = $matches[2];
    $realokay   = ($valid2 * 2) + 76561197960265728 + $valid1; //Формула расчета steamID64 из STEAM_0:X:XXXXXXXX
    $urljson    = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$realokay");
    $data       = (array) json_decode($urljson)->response->players[0];
    $profileurl = $data['profileurl']; //Находим profileurl (customurl)
  }
  if (preg_match($steamid2, $okay)) {
    $urljson    = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$okay");
    $data       = (array) json_decode($urljson)->response->players[0];
    $profileurl = $data['profileurl']; //Находим profileurl (customurl)
  }
  if (preg_match($steamid4, $profileurl, $matchespro)) //Если profileurl вида "steamcommunity.com/profiles/76561198036370701", находим "76561198036370701" из ссылки
    {
    if (substr($matchespro[3], -1) == '/') //Если на конце знак "/"
      {
      $myurl = substr($matchespro[3], 0, -1); //Убираем его
    } else {
      $myurl = $matchespro[3];
    }
    $slf  = "http://steamcommunity.com/profiles/$myurl/?xml=1";
    $url  = simplexml_load_file($slf);
    $link = "http://steamcommunity.com/profiles/$myurl";
  }
  if (preg_match($steamid5, $profileurl, $matchesid)) //Если profileurl вида "steamcommunity.com/id/heavenanvil", находим "heavenanvil" из ссылки
    {
    if (substr($matchesid[3], -1) == '/') //Если на конце знак "/"
      {
      $myurl = substr($matchesid[3], 0, -1); //Убираем его
    } else {
      $myurl = $matchesid[3];
    }
    $slf  = "http://steamcommunity.com/id/$myurl/?xml=1";
    $url  = simplexml_load_file($slf);
    $link = "http://steamcommunity.com/id/$myurl";
  }
  if (preg_match($steamid3, $okay)) //Если Input вида "Heavenanvil"
    {
    $slf  = "http://steamcommunity.com/id/$okay/?xml=1";
    $url  = simplexml_load_file($slf);
    $link = "http://steamcommunity.com/id/$okay";
  }
  if (preg_match($steamid4, $okay)) {
    if (preg_match($steamid4, $okay, $matchespro)) //Если Input вида "steamcommunity.com/profiles/76561198036370701", находим "76561198036370701" из ссылки
      {
      if (substr($matchespro[3], -1) == '/') //Если на конце знак "/"
        {
        $myurl = substr($matchespro[3], 0, -1); //Убираем его
      } else {
        $myurl = $matchespro[3];
      }
      $urljson    = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$myurl");
      $data       = (array) json_decode($urljson)->response->players[0];
      $profileurl = $data['profileurl']; //Проверяем, есть ли customurl
      if (preg_match($steamid4, $profileurl, $matchesprox)) //Если profileurl вида "steamcommunity.com/profiles/76561198036370701", находим "76561198036370701" из ссылки
        {
        if (substr($matchesprox[3], -1) == '/') //Если на конце знак "/"
          {
          $myurlx = substr($matchesprox[3], 0, -1); //Убираем его
        } else {
          $myurlx = $matchesprox[3];
        }
        $slf  = "http://steamcommunity.com/profiles/$myurlx/?xml=1";
        $url  = simplexml_load_file($slf);
        $link = "http://steamcommunity.com/profiles/$myurlx";
      }
      if (preg_match($steamid5, $profileurl, $matchesprox)) //Если profileurl вида "steamcommunity.com/profiles/76561198036370701", находим "76561198036370701" из ссылки
        {
        if (substr($matchesprox[3], -1) == '/') //Если на конце знак "/"
          {
          $myurlx = substr($matchesprox[3], 0, -1); //Убираем его
        } else {
          $myurlx = $matchesprox[3];
        }
        $slf  = "http://steamcommunity.com/id/$myurlx/?xml=1";
        $url  = simplexml_load_file($slf);
        $link = "http://steamcommunity.com/id/$myurlx";
      }
    }
  }
  if (preg_match($steamid5, $okay, $matchesid)) //Если profileurl вида "steamcommunity.com/id/heavenanvil", находим "heavenanvil" из ссылки
    {
    if (substr($matchesid[3], -1) == '/') //Если на конце знак "/"
      {
      $myurl = substr($matchesid[3], 0, -1); //Убираем его
    } else {
      $myurl = $matchesid[3];
    }
    $slf  = "http://steamcommunity.com/id/$myurl/?xml=1";
    $url  = simplexml_load_file($slf);
    $link = "http://steamcommunity.com/id/$myurl";
  }
  $sid64 = $url->steamID64;
  if (($sid64 - 76561197960265728 - 1) - (($sid64 - 76561197960265728 - 1) / 2) - floor(($sid64 - 76561197960265728 - 1) / 2) == 0) {
    $ass = 1;
  } else {
    $ass = 0;
  }
  $sid         = $sid64 - 76561197960265728;
  $myfriend    = @simplexml_load_file($link . "/friends/?xml=1");
  $linktolvl   = $url->steamID64;
  $steam_level = @file_get_contents("http://api.steampowered.com/IPlayerService/GetSteamLevel/v1?key=$apikey&steamid=$linktolvl");
  $datalevel   = json_decode($steam_level)->response->player_level;
  $need        = $_GET['need'];
  //Получаем аватарку
  $id          = $url->steamID64;
  $myurl       = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $apikey . '&steamids=' . $id;
  $urljson     = file_get_contents($myurl);
  $data        = (array) json_decode($urljson)->response->players[0];
  $request_img = $data['avatar'];
  // Получаем код страны для флага
  $data        = (array) json_decode($urljson)->response->players[0];
  $request_loc = $flag = mb_strtolower($data['loccountrycode']);
  //Пишем в БД
  //$result0     = mysqli_query($db, "INSERT INTO `steaminfodb` (request_id,request_cont,datetime,request_img,request_lvl,request_loc) VALUES('$request_id','$userok','$superdate','$request_img','$datalevel','$request_loc')");

}



require_once "../vendor/autoload.php";

use Carbon\Carbon;

// Массив лучших игроков
$playerArray = json_decode(file_get_contents("../leaderboards/data.json"), true);
$topPlayer = $playerArray[1];

$rankFactor = 0;

$ranks = [
	0 => "Новичок",
	3 => "Начинающий",
	6 => "Опытный",
	8 => "Продвинутый",
	10 => "Мастер"
];

// Массив возможных значений, возвращаемых апи.

$stats = [
	'total_kills' => 'Всего убийств',
	'total_deaths' => 'Всего смертей',
	'total_time_played' => 'Часов сыграно',
	'total_planted_bombs' => "Бомб установлено",
	'total_defused_bombs' => "Бомб разминировано",
	'total_wins' => "Всего побед",
	'total_damage_done' => "Полученный урон",
	'total_money_earned' => "Количество заработанных денег",
	'total_rescued_hostages' => "Заложников спасено",
	'total_kills_glock' => "Убийств из Glock",
	'total_kills_deagle' => "Убийств из Desert Eagle",
	'total_kills_ump45' => "Убийств из UMP-45",
	'total_kills_p90' => "Убийств из P90",
	'total_kills_ak47' => "Убийств из AK47",
	'total_kills_aug' => "Убийств из AUG",
	'total_kills_famas' => "Убийств из FAMAS",
	'total_kills_headshot' => "Количество убийств в голову",
	'total_kills_enemy_weapon' => "Количество убийств из оружия противника",
	'total_wins_pistolround' => "Количество побед на пистолетном раунде",
	'total_wins_map_cs_italy' => "Победы на карте cs_italy",
	'total_wins_map_de_dust2' => "Победы на карте de_dust2",
	'total_wins_map_de_aztec' => "Победы на карте de_aztec",
	'total_wins_map_de_dust' => "Победы на карте de_dust",
	'total_wins_map_de_inferno' => "Победы на карте de_inferno",
	'total_wins_map_de_nuke' => "Победы на карте de_nuke",
	'total_wins_map_de_train' => "Победы на карте de_train",
	'total_weapons_donated' => "Количество оружия, отданного союзникам",
	'total_broken_windows' => "Количество разбитых окон",
	'total_kills_against_zoomed_sniper' => "Количество убийств снайперов с активным прицелом",
	'total_dominations' => "Количество доминирований",
	'total_shots_hit' => "Количество попаданий",
	'total_shots_fired' => "Количество выстрелов",
	'total_rounds_played' => "Раундов сыграно",
	'total_shots_deagle' => "Выстрелов из Desert Eagle",
	'total_shots_glock' => "Выстрелов из Glock",
	'total_shots_fiveseven' => "Выстрелов из Five-Seven",
	'total_shots_ak47' => "Выстрелов из AK47",
	'total_shots_aug' => "Выстрелов из AUG",
	'total_shots_famas' => "Выстрелов из FAMAS",
	'total_shots_p90' => "Выстрелов из P90",
	'total_shots_ump45' => "Выстрелов из UMP-45",
	'total_hits_deagle' => "Попаданий из Desert Eagle",
	'total_hits_glock' => "Попаданий из Glock",
	'total_hits_ak47' => "Попаданий из AK47",
	'total_hits_aug' => "Попаданий из AUG",
	'total_hits_famas' => "Попаданий из FAMAS",
	'total_hits_p90' => "Попаданий из P90",
	'total_hits_ump45' => "Попаданий из UMP-45",
	'total_rounds_map_cs_italy' => "Сыграно раундов на карте cs_italy",
	'total_rounds_map_de_aztec' => "Сыграно раундов на карте de_aztec",
	'total_rounds_map_de_dust2' => "Сыграно раундов на карте de_dust2",
	'total_rounds_map_de_dust' => "Сыграно раундов на карте de_dust",
	'total_rounds_map_de_inferno' => "Сыграно раундов на карте de_inferno",
	'total_rounds_map_de_nuke' => "Сыграно раундов на карте de_nuke",
	'total_rounds_map_de_train' => "Сыграно раундов на карте de_train",
	'last_match_t_wins' => "Количество выигранных раундов за террористов в прошлом матче",
	'last_match_ct_wins' => "Количество выигранных раундов за контр-террористов в прошлом матче",
	'last_match_wins' => "Количество выигранных раундов в прошлом матче",
	'last_match_max_players' => "Количество игроков в прошлом матче",
	'last_match_kills' => "Количество убийств в прошлом матче",
	'last_match_deaths' => "Количество смертей в прошлом матче",
	'last_match_mvps' => "Количество полученных MVP в прошлом матче",
	// Нет информации об ID оружия
	// 'last_match_favweapon_id' => "",
	'last_match_favweapon_shots' => "Выстрелов из любимого оружия",
	'last_match_favweapon_hits' => "Попаданий из любимого оружия",
	'last_match_favweapon_kills' => "Убийств из любимого оружия",
	'last_match_damage' => "Урона нанесено за прошлый матч",
	'last_match_money_spent' => "Денег потрачено за прошлым матч",
	'total_mvps' => "Количество полученных MVP",
	'total_matches_won' => "Количество побед в матчах",
	'total_matches_played' => "Матчей сыграно",
	'total_contribution_score' => "Количество очков вклада",
	'last_match_contribution_score' => "Количество очков вклада в предыдущем матче",
	'last_match_rounds' => "Сыграно раундов в предыдущем матче",
	'total_kills_hkp2000' => "Всего убийств из P2000",
	'total_shots_hkp2000' => "Всего выстрелов из P2000",
	'total_hits_hkp2000' => "Всего попаданий из P2000",
	'total_kills_sg556' => "Всего убийств из SG556",
	'total_shots_sg556' => "Всего выстрелов из SG556",
	'total_hits_sg556' => "Всего попаданий из SG556",
	'total_shots_mp7' => "Всего выстрелов из MP7",
	'total_hits_mp7' => "Всего попаданий из MP7",
	'total_kills_mp9' => "Всего убийств из MP9",
	'total_shots_mp9' => "Всего выстрелов из MP9",
	'total_hits_mp9' => "Всего попаданий из MP9",
	'total_shots_bizon' => "Всего выстрелов из PP-Bizon",
	'total_hits_bizon' => "Всего попаданий из PP-Bizon",
	'total_kills_bizon' => "Всего убийств из PP-Bizon",
	'total_kills_m4a1' => "Всего убийств из M4A1-S",
	'total_kills_molotov' => "Всего убийств коктейлем Молотова",
	'total_kills_taser' => "Всего убийств из Zeus x27",
	'total_shots_m4a1' => "Всего выстрелов из M4A1-S",
	'total_shots_taser' => "Всего выстрелов из Zeus x27",
	'total_hits_m4a1' => "Всего попаданий из M4A1-S",
	'total_matches_won_train' => "Всего матчей выиграно на de_train",
	'total_kills_knife' => "Всего убийств ножом",
	'total_kills_hegrenade' => 'Всего убийств гранатой',
	'total_kills_elite' => 'Всего убийств из Elite',
	'total_kills_fiveseven' => 'Всего убийств из Five-Seven',
	'total_kills_xm1014' => 'Всего убийств из Xm1014',
	'total_kills_mac10' => 'Всего убийств из Mac10',
	'total_kills_awp' => 'Всего убийств из AWP',
	'total_kills_g3sg1' => 'Всего убийств из G3SG1',
	'total_kills_m249' => 'Всего убийств из M249',
	'total_kills_enemy_blinded' => 'Всего убийств ослепленных противников',
	'total_kills_knife_fight' => 'Всего убийств в ножевых раунадах',
	'total_domination_overkills' => 'Всего убийств в режиме Overkill',
	'total_revenges' => 'Всего отомщений',
	'total_shots_elite' => 'Всего выстрелов из Elite',
	'total_shots_g3sg1' => 'Всего выстрелов из G3SG1',
	'total_shots_mac10' => 'Всего выстрелов из Mac10',
	'total_shots_xm1014' => 'Всего выстрелов из Xm1014',
	'total_shots_m249' => 'Всего выстрелов из M249',
	'total_hits_elite' => 'Всего попаданий из Elite',
	'total_hits_fiveseven' => 'Всего попаданий из Five-Seven',
	'total_hits_awp' => 'Всего попаданий из AWP',
	'total_hits_g3sg1' => 'Всего попаданий из G3SG1',
	'total_hits_mac10' => 'Всего попаданий из Mac10',
	'total_hits_xm1014' => 'Всего попаданий из Xm1014',
	'total_hits_m249' => 'Всего попаданий из M249',
	'total_hits_p250' => 'Всего попаданий из P250',
	'total_kills_p250' => 'Всего убийств из P250',
	'total_shots_p250' => 'Всего выстрелов из P250',
	'total_hits_scar20' => 'Всего попаданий из Scar20',
	'total_kills_scar20' => 'Всего убийств из Scar20',
	'total_shots_scar20' => 'Всего выстрелов из Scar20',
	'total_shots_ssg08' => 'Всего выстрелов из SSG08',
	'total_hits_ssg08' => 'Всего попаданий из SSG08',
	'total_kills_ssg08' => 'Всего убийств из SSG08',
	'total_kills_mp7' => 'Всего убийств из MP7',
	'total_hits_nova' => 'Всего попаданий из Nova',
	'total_kills_nova' => 'Всего убийств из Nova',
	'total_shots_nova' => 'Всего выстрелов из Nova',
	'total_hits_negev' => 'Всего попаданий из Negev',
	'total_kills_negev' => 'Всего убийств из Negev',
	'total_shots_negev' => 'Всего выстрелов из Negev',
	'total_shots_sawedoff' => 'Всего выстрелов из Sawedoff',
	'total_hits_sawedoff' => 'Всего попаданий из Sawedoff',
	'total_kills_sawedoff' => 'Всего убийств из Sawedoff',
	'total_kills_tec9' => 'Всего убийств из TEC9',
	'total_shots_tec9' => 'Всего выстрелов из TEC9',
	'total_hits_tec9' => 'Всего попаданий из TEC9',
	'total_shots_mag7' => 'Всего выстрелов из MAG7',
	'total_kills_mag7' => 'Всего убийств из MAG7',
	'total_hits_mag7' => 'Всего попаданий из MAG7',
	'total_kills_galilar' => 'Всего убийств из Galilar',
	'total_kills_decoy' => 'Всего убийств из Decoy',
	'total_shots_galilar' => 'Всего выстрелов из Galilar',
	'total_hits_galilar' => 'Всего попаданий из Galilar',
	// Неизвестное значение. 
	// 'GI.lesson.tr_explain_plant_bomb' => 16
];

$lastmatch = [
	'last_match_t_wins',
	'last_match_ct_wins',
	'last_match_wins',
	'last_match_max_players',
	'last_match_kills',
	'last_match_deaths',
	'last_match_mvps',
	'last_match_favweapon_shots',
	'last_match_favweapon_hits',
	'last_match_favweapon_kills',
	'last_match_damage',
	'last_match_money_spent',
	'last_match_contribution_score',
	'last_match_rounds',
];

$main = [
	'total_kills',
	'total_deaths',
	'total_time_played',
	'total_planted_bombs',
	'total_defused_bombs',
	'total_wins',
	'total_damage_done',
	'total_money_earned',
	'total_rescued_hostages',
	'total_kills_headshot',
	'total_kills_enemy_weapon',
	'total_wins_pistolround',
	'total_weapons_donated',
	'total_broken_windows',
	'total_kills_against_zoomed_sniper',
	'total_dominations',
	'total_shots_hit',
	'total_shots_fired',
	'total_rounds_played',
	'total_mvps',
	'total_matches_won',
	'total_matches_played',
	'total_contribution_score',
];

$weapons = [
	'total_kills_glock',
	'total_kills_deagle',
	'total_kills_ump45',
	'total_kills_p90',
	'total_kills_ak47',
	'total_kills_aug',
	'total_kills_famas',
	'total_shots_deagle',
	'total_shots_glock',
	'total_shots_fiveseven',
	'total_shots_ak47',
	'total_shots_aug',
	'total_shots_famas',
	'total_shots_p90',
	'total_shots_ump45',
	'total_hits_deagle',
	'total_hits_glock',
	'total_hits_ak47',
	'total_hits_aug',
	'total_hits_famas',
	'total_hits_p90',
	'total_hits_ump45',
	'total_kills_hkp2000',
	'total_shots_hkp2000',
	'total_hits_hkp2000',
	'total_kills_sg556',
	'total_shots_sg556',
	'total_hits_sg556',
	'total_shots_mp7',
	'total_hits_mp7',
	'total_kills_mp9',
	'total_shots_mp9',
	'total_hits_mp9',
	'total_shots_bizon',
	'total_hits_bizon',
	'total_kills_bizon',
	'total_kills_m4a1',
	'total_kills_molotov',
	'total_kills_taser',
	'total_shots_m4a1',
	'total_shots_taser',
	'total_hits_m4a1',
];

// $accuracyTable = [
// 	'total_shots_deagle',
// 	'total_shots_glock',
// 	'total_shots_fiveseven',
// 	'total_shots_ak47',
// 	'total_shots_aug',
// 	'total_shots_famas',
// 	'total_shots_p90',
// 	'total_shots_ump45',
// 	'total_shots_hkp2000',
// 	'total_shots_sg556',
// 	'total_shots_mp7',
// 	'total_shots_bizon',
// 	'total_shots_mp9',
// 	'total_shots_m4a1',
// 	'total_shots_taser',
// 	'total_hits_deagle',
// 	'total_hits_glock',
// 	'total_hits_ak47',
// 	'total_hits_aug',
// 	'total_hits_famas',
// 	'total_hits_p90',
// 	'total_hits_ump45',
// 	'total_hits_hkp2000',
// 	'total_hits_sg556',
// 	'total_hits_mp7',
// 	'total_hits_mp9',
// 	'total_hits_bizon',
// 	'total_hits_m4a1',
// ];

$accuracyResult = [];

$weaponsResult = [];

$weaponsName = [
	'deagle' => 'Desert Eagle',
	'glock' => 'Glock-17',
	'fiveseven' => 'Five-Seven',
	'ak47' => 'AK47',
	'aug' => 'AUG',
	'famas' => 'FAMAS',
	'p90' => 'P90',
	'ump45' => 'UMP-45',
	'hkp2000' => 'P2000',
	'sg556' => 'SG556',
	'mp7' => 'MP7',
	'bizon' => 'PP-Bizon',
	'mp9' => 'MP9',
	'm4a1' => 'M4A1',
	'taser' => 'Zeus x27'
];

$accuracyTable = [
	'deagle',
	'glock',
	'fiveseven',
	'ak47',
	'aug',
	'famas',
	'p90',
	'ump45',
	'hkp2000',
	'sg556',
	'mp7',
	'bizon',
	'mp9',
	'm4a1',
	// 'taser',
];


$maps = [
	'total_wins_map_cs_italy',
	'total_wins_map_de_dust2',
	'total_wins_map_de_aztec',
	'total_wins_map_de_dust',
	'total_wins_map_de_inferno',
	'total_wins_map_de_nuke',
	'total_wins_map_de_train',
	'total_rounds_map_cs_italy',
	'total_rounds_map_de_aztec',
	'total_rounds_map_de_dust2',
	'total_rounds_map_de_dust',
	'total_rounds_map_de_inferno',
	'total_rounds_map_de_nuke',
	'total_rounds_map_de_train',
	'total_matches_won_train',
];

$mapsArray = [
	'cs_italy',
	'de_dust2',
	'de_aztec',
	'de_dust',
	'de_inferno',
	'de_nuke',
	'de_train'
];

$mapsResult = [];

$countries = array (
	'AF' => 'Афганистан',
	'AX' => 'Аландские острова',
	'AL' => 'Албания',
	'DZ' => 'Алжир',
	'AS' => 'Американское Самоа',
	'AD' => 'Андорра',
	'AO' => 'Ангола',
	'AI' => 'Ангилья',
	'AQ' => 'Антарктида',
	'AG' => 'Антигуа и Барбуда',
	'AR' => 'Аргентина',
	'AM' => 'Армения',
	'AW' => 'Аруба',
	'AU' => 'Австралия',
	'AT' => 'Австрия',
	'AZ' => 'Азербайджан',
	'BS' => 'Багамские острова',
	'BH' => 'Бахрейн',
	'BD' => 'Бангладеш',
	'BB' => 'Барбадос',
	'BY' => 'Беларусь',
	'BE' => 'Бельгия',
	'BZ' => 'Белиз',
	'BJ' => 'Бенин',
	'BM' => 'Бермудские острова',
	'BT' => 'Бутан',
	'BO' => 'Боливия',
	'BQ' => 'Бонэйр, Синт-Эстатиус и Саба',
	'BA' => 'Босния и Герцеговина',
	'BW' => 'Ботсвана',
	'BV' => 'Остров Буве',
	'BR' => 'Бразилия',
	'IO' => 'Британская территория в Индийском океане',
	'VG' => 'Британские Виргинские острова',
	'BN' => 'Бруней',
	'BG' => 'Болгария',
	'BF' => 'Буркина-Фасо',
	'BI' => 'Бурунди',
	'KH' => 'Камбоджа',
	'CM' => 'Камерун',
	'CA' => 'Канада',
	'CV' => 'Кабо-Верде',
	'KY' => 'Каймановы острова',
	'CF' => 'Центральноафриканская Республика',
	'TD' => 'Чад',
	'CL' => 'Чили',
	'CN' => 'Китай',
	'CX' => 'Остров Рождества',
	'CC' => 'Кокосовые острова',
	'CO' => 'Колумбия',
	'KM' => 'Коморы',
	'CK' => 'Острова Кука',
	'CR' => 'Коста-Рика',
	'HR' => 'Хорватия',
	'CU' => 'Куба',
	'CW' => 'Кюрасао',
	'CY' => 'Кипр',
	'CZ' => 'Чехия',
	'CD' => 'Демократическая Республика Конго',
	'DK' => 'Дания',
	'DJ' => 'Джибути',
	'DM' => 'Доминика',
	'DO' => 'Доминиканская Республика',
	'TL' => 'Восточный Тимор',
	'EC' => 'Эквадор',
	'EG' => 'Египет',
	'SV' => 'Сальвадор',
	'GQ' => 'Экваториальная Гвинея',
	'ER' => 'Эритрея',
	'EE' => 'Эстония',
	'ET' => 'Эфиопия',
	'FK' => 'Фолклендские острова',
	'FO' => 'Фарерские острова',
	'FJ' => 'Фиджи',
	'FI' => 'Финляндия',
	'FR' => 'Франция',
	'GF' => 'Французская Гвиана',
	'PF' => 'Французская Полинезия',
	'TF' => 'Французские южные территории',
	'GA' => 'Габон',
	'GM' => 'Гамбия',
	'GE' => 'Грузия',
	'DE' => 'Германия',
	'GH' => 'Гана',
	'GI' => 'Гибралтар',
	'GR' => 'Греция',
	'GL' => 'Гренландия',
	'GD' => 'Гренада',
	'GP' => 'Гваделупа',
	'GU' => 'Гуам',
	'GT' => 'Гватемала',
	'GG' => 'Гернси',
	'GN' => 'Гвинея',
	'GW' => 'Гвинея-Бисау',
	'GY' => 'Гайана',
	'HT' => 'Гаити',
	'HM' => 'Остров Херд и острова Макдональд',
	'HN' => 'Гондурас',
	'HK' => 'Гонконг',
	'HU' => 'Венгрия',
	'IS' => 'Исландия',
	'IN' => 'Индия',
	'ID' => 'Индонезия',
	'IR' => 'Иран',
	'IQ' => 'Ирак',
	'IE' => 'Ирландия',
	'IM' => 'Остров Мэн',
	'IL' => 'Израиль',
	'IT' => 'Италия',
	'CI' => 'Кот-д`Ивуар',
	'JM' => 'Ямайка',
	'JP' => 'Япония',
	'JE' => 'Джерси',
	'JO' => 'Иордания',
	'KZ' => 'Казахстан',
	'KE' => 'Кения',
	'KI' => 'Кирибати',
	'XK' => 'Косово',
	'KW' => 'Кувейт',
	'KG' => 'Кыргызстан',
	'LA' => 'Лаос',
	'LV' => 'Латвия',
	'LB' => 'Ливан',
	'LS' => 'Лесото',
	'LR' => 'Либерия',
	'LY' => 'Ливия',
	'LI' => 'Лихтенштейн',
	'LT' => 'Литва',
	'LU' => 'Люксембург',
	'MO' => 'Макао',
	'MK' => 'Македония',
	'MG' => 'Мадагаскар',
	'MW' => 'Малави',
	'MY' => 'Малайзия',
	'MV' => 'Мальдивы',
	'ML' => 'Мали',
	'MT' => 'Мальта',
	'MH' => 'Маршалловы Острова',
	'MQ' => 'Мартиника',
	'MR' => 'Мавритания',
	'MU' => 'Маврикий',
	'YT' => 'Майотта',
	'MX' => 'Мексика',
	'FM' => 'Микронезия',
	'MD' => 'Молдова',
	'MC' => 'Монако',
	'MN' => 'Монголия',
	'ME' => 'Черногория',
	'MS' => 'Монтсеррат',
	'MA' => 'Марокко',
	'MZ' => 'Мозамбик',
	'MM' => 'Мьянма',
	'NA' => 'Намибия',
	'NR' => 'Науру',
	'NP' => 'Непал',
	'NL' => 'Нидерланды',
	'NC' => 'Новая Каледония',
	'NZ' => 'Новая Зеландия',
	'NI' => 'Никарагуа',
	'NE' => 'Нигер',
	'NG' => 'Нигерия',
	'NU' => 'Ниуэ',
	'NF' => 'Остров Норфолк',
	'KP' => 'Северная Корея',
	'MP' => 'Северные Марианские острова',
	'NO' => 'Норвегия',
	'OM' => 'Оман',
	'PK' => 'Пакистан',
	'PW' => 'Палау',
	'PS' => 'Палестинская территория',
	'PA' => 'Панама',
	'PG' => 'Папуа-Новая Гвинея',
	'PY' => 'Парагвай',
	'PE' => 'Перу',
	'PH' => 'Филиппины',
	'PN' => 'Питкэрн',
	'PL' => 'Польша',
	'PT' => 'Португалия',
	'PR' => 'Пуэрто-Рико',
	'QA' => 'Катар',
	'CG' => 'Республика Конго',
	'RE' => 'Реюньон',
	'RO' => 'Румыния',
	'RU' => 'Россия',
	'RW' => 'Руанда',
	'BL' => 'Сен-Бартелеми',
	'SH' => 'Остров Святой Елены',
	'KN' => 'Сент-Китс и Невис',
	'LC' => 'Сент-Люсия',
	'MF' => 'Сен-Мартен',
	'PM' => 'Сен-Пьер и Микелон',
	'VC' => 'Сент-Винсент и Гренадины',
	'WS' => 'Самоа',
	'SM' => 'Сан-Марино',
	'ST' => 'Сан-Томе и Принсипи',
	'SA' => 'Саудовская Аравия',
	'SN' => 'Сенегал',
	'RS' => 'Сербия',
	'SC' => 'Сейшельские острова',
	'SL' => 'Сьерра-Леоне',
	'SG' => 'Сингапур',
	'SX' => 'Синт-Мартен',
	'SK' => 'Словакия',
	'SI' => 'Словения',
	'SB' => 'Соломоновы Острова',
	'SO' => 'Сомали',
	'ZA' => 'Южная Африка',
	'GS' => 'Южная Георгия и Южные Сандвичевы острова',
	'KR' => 'Южная Корея',
	'SS' => 'Южный Судан',
	'ES' => 'Испания',
	'LK' => 'Шри-Ланка',
	'SD' => 'Судан',
	'SR' => 'Суринам',
	'SJ' => 'Шпицберген и Ян-Майен',
	'SZ' => 'Свазиленд',
	'SE' => 'Швеция',
	'CH' => 'Швейцария',
	'SY' => 'Сирия',
	'TW' => 'Тайвань',
	'TJ' => 'Таджикистан',
	'TZ' => 'Танзания',
	'TH' => 'Таиланд',
	'TG' => 'Того',
	'TK' => 'Токелау',
	'TO' => 'Тонга',
	'TT' => 'Тринидад и Тобаго',
	'TN' => 'Тунис',
	'TR' => 'Турция',
	'TM' => 'Туркменистан',
	'TC' => 'Острова Теркс и Кайкос',
	'TV' => 'Тувалу',
	'VI' => 'США. Виргинские острова',
	'UG' => 'Уганда',
	'UA' => 'Украина',
	'AE' => 'Объединенные Арабские Эмираты',
	'GB' => 'Великобритания',
	'US' => 'США',
	'UM' => 'Внешние малые острова США',
	'UY' => 'Уругвай',
	'UZ' => 'Узбекистан',
	'VU' => 'Вануату',
	'VA' => 'Ватикан',
	'VE' => 'Венесуэла',
	'VN' => 'Вьетнам',
	'WF' => 'Уоллис и Футуна',
	'EH' => 'Западная Сахара',
	'YE' => 'Йемен',
	'ZM' => 'Замбия',
	'ZW' => 'Зимбабве'
);

//$errorMail = "pustojack@list.ru";
$errorMail = "olegfact@gmail.com";

// Получаем схему данных игры. Это понадобится для отображения иконок достижений.
$schemaJson = file_get_contents("http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v0002/?key=$apikey&appid=730&l=russian&format=json");	

if ($schemaJson === false) {
	mail($errorMail, "CS-GO ERROR1", "CS-GO ERROR");
	die();
}

$schema = json_decode($schemaJson, true);

// Создаём массив изображений

$images = [];

foreach($schema['game']['availableGameStats']['achievements'] as $achievement) {
	$images[$achievement['name']] = [$achievement['icon'], $achievement['description']];
}

// Получаем профиль Steam
$profileUrl       = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$id";
//$profile     = json_decode(file_get_contents($profileUrl), true);
$profile = file_get_contents($profileUrl);
if ($profile === false) {
	mail($errorMail, "CS-GO ERROR3", "CS-GO ERROR");
	die();
} 

$profile = json_decode($profile, true);



if($urljson) {
	// echo '<br> Next Data (stats)<br>';
	$statas        = (array) json_decode($urljson)->playerstats->stats;
	$statas = json_decode(json_encode($statas),true);
	//print_r($statas);
	// var_dump($statas);
	
	// print_r($statas );
	
	// $i=0;
	// foreach ($statas as $stata) {
	// 	echo $i. '&nbsp;' .$stata['name'] . ':&nbsp;' . $stata['value'], "<br>";
	// 	$i++;
	// }

	
	// echo '<br> Next Data (achievements)<br>';
	$achievements        = (array) json_decode($urljson)->playerstats->achievements;
	$achievements = json_decode(json_encode($achievements),true);
	
	// $i=0;

	// Превращаем секунды в часы
	$statas[2]['value'] /= 3660;
	$statas[2]['value'] = round($statas[2]['value']);

	$totalShotsHit = 0;
	$totalShotsFired = 0;
	$totalKills = 0;
	$totalDeaths = 0;
	$totalWins = 0;
	$totalRoundsPlayed = 0;
	foreach($statas as $stata) {
		if($stata["name"] == "total_shots_hit") {
			$totalShotsHit = $stata["value"];
		}
		if($stata["name"] == "total_shots_fired") {
			$totalShotsFired = $stata["value"];
		}
		if($stata["name"] == "total_kills") {
			$totalKills = $stata["value"];
		}
		if($stata["name"] == "total_deaths") {
			$totalDeaths = $stata["value"];
		}
		if($stata["name"] == "total_wins") {
			$totalWins = $stata["value"];
		}
		if($stata["name"] == "total_rounds_played") {
			$totalRoundsPlayed = $stata["value"];
		}
	}
	
	// Вычисляем убийства/смерти
	$kills_ratio = $statas[0]['value'];
	if($statas[1]['value'] != 0) {
		$kills_ratio = $totalKills / $totalDeaths;
	}

	if($kills_ratio >= 1) {
		$rankFactor = $rankFactor + 2;
	}

	if($kills_ratio >= 1.3) {
		$rankFactor++;
	}

	// Вычисляем выигранные раунды/всего раундов
	$round_ratio = $statas[5]['value'];
	if($statas[48]['value'] != 0) {
		$round_ratio = $totalWins / $totalRoundsPlayed;
	}

	if($round_ratio >= 0.50) {
		$rankFactor++;
	}

	if($round_ratio >= 0.70) {
		$rankFactor++;
	}

	// Вычисляем попаданий/всего выстрелов (точность)
	$accuracy = $statas[46]['value'];
	if($totalShotsFired != 0) {
		$accuracy = $totalShotsHit / $totalShotsFired;
	}

	if($accuracy > 0.15) {
		$rankFactor++;
	}

	if($accuracy > 0.30) {
		$rankFactor++;
	}

	// Вычисляем летальность
	$lethality = $statas[0]['value'];
	if($totalShotsHit != 0) {
		$lethality = $statas[0]['value'] / $totalShotsHit;
	}

	if($lethality >= 0.25) {
		$rankFactor++;
	}

	if($lethality >= 0.40) {
		$rankFactor++;
	}

	if($statas[2] >= 500) {
		$rankFactor++;
	}

	if($statas[2] <= 200) {
		$rankFactor = 0;
	}

	$rankFactorNum = $rankFactor;

	foreach($ranks as $key => $rank) {
		if($rankFactor > $key) {
			continue;
		}

		$rankFactor = $rank;
		break;
	}

	foreach ($accuracyTable as $stat) {
		$hits = 1;
		$shots = 1;
		$kills = 0;
		foreach($statas as $stata) {
			if($stata["name"] == "total_shots_$stat") {
				$shots = $stata["value"];
			}
			if($stata["name"] == "total_hits_$stat") {
				$hits = $stata["value"];
			}
			if($stata["name"] == "total_kills_$stat") {
				$kills = $stata["value"];
			}
		}
		$accuracyResult[$stat] = round($hits/$shots, 2)*100;
		$weaponsResult[$stat] = ["shots" => $shots, "hits" => $hits, "kills" => $kills, "accuracy" => $accuracyResult[$stat], "lethality" => round($kills/$hits, 2)*100];
	}

	/*
	foreach($mapsArray as $map) {
		$wins = 0;
		$rounds = 1;
		foreach($statas as $stata) {
			if($stata["name"] == "total_rounds_map_$map") {
				$rounds = $stata["value"];
			}
			if($stata["name"] == "total_wins_map_$map") {
				$wins = $stata["value"];
			}
		}
		$mapsResult[$map] = ["wins" => $wins, "rounds" => $rounds, "percentage" => round($wins/$rounds, 2)*100];
	}
	*/

	foreach ($statas as $stata) {
		if (preg_match('/total_[a-z]{0,}_map_[a-z,_]{0,}/', $stata['name'])) {
			$nameExploded = explode('map_', $stata['name']);
			$mapName = $nameExploded[1];

			if (!isset($mapsResult[$mapName]))
				$mapsResult[$mapName] = [];

			$typeExploded = explode('_', $stata['name']);
			if ($typeExploded[1] == 'wins') {
				$mapsResult[$mapName]['wins'] = $stata['value'];
			}
			if ($typeExploded[1] == 'rounds') {
				$mapsResult[$mapName]['rounds'] = $stata['value'];
			}
		}
	}

	foreach ($mapsResult as &$mapResult) {
		$mapResult['rounds'] = $mapResult['rounds'] == 0 ? $mapResult['wins'] : $mapResult['rounds'];
		//print_r();
		$mapResult['percentage'] = round($mapResult['wins']/$mapResult['rounds'], 2)*100;
	}

	arsort($accuracyResult);
	// var_dump($weaponsResult);
}

echo "<table>";
foreach ($statas as $i => $stata) {
	$rus = "";
	if (isset($stats[$stata['name']]))
		$rus = $stats[$stata['name']];

	echo "<tr><td>" . $i . "</td><td>" . $stata['name'] . "</td><td>" . $rus . "</td></tr>";
}

echo "</table>";