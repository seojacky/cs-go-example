<div id="cs-go_stats" style="width:100%;">

<?php
	$_GET['user'] = '76561198116436066';
				if (isset($_GET['user']) && !empty($_GET['user'])) {
					// Если форма заполнена - то выводить код рекламы
					?>

    <?php } ?>


	<div style="color:black;">	
<?php

require_once "../vendor/autoload.php";

use Carbon\Carbon;

// Массив лучших игроков
$playerArray = json_decode(file_get_contents("leaderboards/data.json"), true);
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

$countries = array
(
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

$errorMail = "pustojack@list.ru";

// Получаем схему данных игры. Это понадобится для отображения иконок достижений.
try {
	$schemaJson = file_get_contents("http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v0002/?key=$apikey&appid=730&l=russian&format=json");	
} catch (Exception $e) {
	mail($errorMail, 'CS-GO ERROR', 'CS-GO ERROR');
}

$schema = json_decode($schemaJson, true);

// Создаём массив изображений

$images = [];

foreach($schema['game']['availableGameStats']['achievements'] as $achievement) {
	$images[$achievement['name']] = [$achievement['icon'], $achievement['description']];
}

//Получаем данные игрока CS:GO
$id          = $url->steamID64;
$myurl       = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=' . $apikey . '&steamid=' . $id;
try {
	$urljson     = file_get_contents($myurl);
} catch (Exception $e) {
	mail($errorMail, 'CS-GO ERROR', 'CS-GO ERROR');
}


// Получаем профиль Steam
$profileUrl       = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apikey&steamids=$id";
try {
	$profile     = json_decode(file_get_contents($profileUrl), true);
} catch (Exception $e) {
	mail($errorMail, 'CS-GO ERROR', 'CS-GO ERROR');		
}


if($urljson) {
	// echo '<br> Next Data (stats)<br>';
	$statas        = (array) json_decode($urljson)->playerstats->stats;
	$statas = json_decode(json_encode($statas),true);

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
	print_r($stata["name"]);
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

	arsort($accuracyResult);
	// var_dump($weaponsResult);
	?>


	<div class="container">
		<div class="row">
			<div class="col-3">
				<img class="profile" src="<?php echo $profile["response"]["players"][0]["avatarfull"]; ?>">
			</div>
			<div class="col-9">
				<span class="profile_title"><?php echo $profile["response"]["players"][0]["personaname"]; ?></span>
				<br><span class="profile_rank"><?php echo $rankFactor; ?></span><sup title="Текущее количество очков: <?php echo $rankFactorNum ?>&#013;Новичок - 0&#013;Начинающий - 3&#013;Опытный - 6&#013;Продвинутый - 8&#013;Мастер - 10" style="vertical-align: top;font-size: 1em;color: black;">?</sup>
				<?php if ($profile["response"]["players"][0]["lastlogoff"]): ?>
					<br><span class="profile_last_offline">Был в сети <?php echo Carbon::createFromTimestamp($profile["response"]["players"][0]["lastlogoff"])->format('d-m-Y H:i'); ?></span>
				<?php endif; ?>
				<br><span class="profile_time_player">Часов сыграно: <?php echo $statas[2]["value"]; ?></span>
				<?php if($profile["response"]["players"][0]["loccountrycode"]): ?>
					<br><img class="country_image" src="https://www.countryflags.io/<?php echo $profile["response"]["players"][0]["loccountrycode"]; ?>/flat/16.png"><span class="profile_country"><?php echo $countries[$profile["response"]["players"][0]["loccountrycode"]]; ?></span>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<div class="container">
      <div class="row">
	  	<div class="col-8">
			<div class="card">
				<!-- <div class="progress" style="width:<?php //echo round($kills_ratio/$topPlayer["statsDetail"], 3)*100 ?>%"></div> -->
				<div class="progress" style="width:<?php echo round($kills_ratio/10, 3)*100 ?>%"></div>
				<div class="content">
					<bold class="card_title">K/D</bold>
					<p class="percentage"><?php echo round($kills_ratio, 3) ?></p>
				</div>
			</div>
			<div class="card">
				<div class="progress" style="width:<?php echo round($round_ratio, 2)*100; ?>%"></div>
				<div class="content">
					<bold class="card_title">% победных раундов</bold>
					<p class="percentage"><?php echo round($round_ratio, 2)*100; ?>%</p>
				</div>
			</div>
			<div class="card">
				<div class="progress" style="width:<?php echo round($accuracy, 2)*100; ?>%"></div>
				<div class="content">
					<bold class="card_title">Точность</bold>
					<p class="percentage"><?php echo round($accuracy, 2)*100; ?>%</p>
				</div>
			</div>
			<div class="card">
				<div class="progress" style="width:<?php echo round($lethality, 2)*100; ?>%"></div>
				<div class="content">
					<bold class="card_title">Летальность</bold>
					<p class="percentage"><?php echo round($lethality, 2)*100; ?>%</p>
				</div>
			</div>
        </div>
        <div class="col-4">
			<script src="chart.js"></script>
			<canvas id="ctx" width="500" height="500" class="chartjs"></canvas>
			<script>Chart.defaults.global.defaultFontColor = "#fff";</script>

			<script>new Chart(document.getElementById("ctx"),{
				"type":"bar",
				"data":{
					"labels":["<?php echo $weaponsName[array_keys($accuracyResult)[0]]; ?>", "<?php echo $weaponsName[array_keys($accuracyResult)[1]]; ?>", "<?php echo $weaponsName[array_keys($accuracyResult)[2]]; ?>", "<?php echo $weaponsName[array_keys($accuracyResult)[3]]; ?>", "<?php echo $weaponsName[array_keys($accuracyResult)[4]]; ?>"],
					"datasets":[{
						"label":"Статистика",
						"data":[<?php $i = 0; foreach($accuracyResult as $result) { if($i == 5) { break; } echo "$result, "; $i++; } ?>],
						"fill":false,
						"backgroundColor":["rgba(255, 99, 132, 0.9)","rgba(255, 159, 64, 0.9)","rgba(255, 205, 86, 0.9)","rgba(75, 192, 192, 0.9)","rgba(54, 162, 235, 0.9)","rgba(153, 102, 255, 0.9)","rgba(201, 203, 207, 0.9)"],
						"borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
						"borderWidth":1
					}]},
					"options":{
						"scales":{
							"yAxes":[{
								"ticks":{
									"beginAtZero":true,
									callback: function(value, index, values) {
											return value + '%';
									}
								}
							}],
							"xAxes":[{
								// "display": false,
							}]
						},
						"legend": {
							"display": false,
						},
						"title": {
							"display": true,
							"text": "Топ оружия по точности"
						}
					}
				})</script>
        </div>
      </div>
    </div>

	<?php

	// Подключаем библиотеку для графиков
	// <script src="chart.js"></script>;

	// // Создаём холст для графика
	// <canvas id="ctx" class="chartjs" width="770" height="385" style="display: block; width: 770px; height: 385px;"></canvas>;

	// // Создаём график
	// <script>new Chart(document.getElementById("ctx"),{
	// 	"type":"bar",
	// 	"data":{
	// 		"labels":["Убийства/смерти", "Выигранные раунды/всего раундов", "Точность", "Летальность"],
	// 		"datasets":[{
	// 			"label":"Статистика",
	// 			"data":['. round($kills_ratio, 3) .', '. round($round_ratio, 3) .', '. round($accuracy, 3) .', '. round($lethality, 3) .'],
	// 			"fill":false,
	// 			"backgroundColor":["rgba(255, 99, 132, 0.9)","rgba(255, 159, 64, 0.9)","rgba(255, 205, 86, 0.9)","rgba(75, 192, 192, 0.9)","rgba(54, 162, 235, 0.9)","rgba(153, 102, 255, 0.9)","rgba(201, 203, 207, 0.9)"],
	// 			"borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
	// 			"borderWidth":1
	// 		}]},
	// 		"options":{
	// 			"scales":{
	// 				"yAxes":[{
	// 					"ticks":{
	// 						"beginAtZero":true
	// 					}
	// 				}]
	// 			}
	// 		}
	// 	});</script>;


	// echo '<script>new Chart(document.getElementById("ctx").getContext("2d"),{"type":"radar",
	// 	"data":{"labels":["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],
	// 	"datasets":[{"label":"My First Dataset","data":[65,59,90,81,56,55,40],
	// 	"fill":true,
	// 	"backgroundColor":"rgba(255, 99, 132, 0.2)","borderColor":"rgb(255, 99, 132)","pointBackgroundColor":"rgb(255, 99, 132)","pointBorderColor":"#fff","pointHoverBackgroundColor":"#fff","pointHoverBorderColor":"rgb(255, 99, 132)"},{"label":"My Second Dataset","data":[28,48,40,19,96,27,100],"fill":true,"backgroundColor":"rgba(54, 162, 235, 0.2)","borderColor":"rgb(54, 162, 235)","pointBackgroundColor":"rgb(54, 162, 235)","pointBorderColor":"#fff","pointHoverBackgroundColor":"#fff","pointHoverBorderColor":"rgb(54, 162, 235)"}]},"options":{"elements":{"line":{"tension":0,"borderWidth":3}}}});</script>';
	
	// Статистика за прошлый матч	
	$table ='<div class="table-responsive"><table id="leaderboard" class="table-fill fleads">
	<thead>
	<tr>
			<th class="text-left">Статистика за предыдущий матч</th>                
			<th class="text-left">Значение</th>                
		</tr>			
		</thead>
		<tbody id="user-rows">';
		foreach ($statas as $key => $stata) {
			// Проверяем, соотвествует ли характеристика критерию "Предыдущий матч"
			if(in_array($stata['name'], $lastmatch)) {
				$table .='<tr>
				<td class="text-left">'. $stats[$stata['name']] .'</td>
				<td class="text-left">'. $stata['value'] .'</td>
				</tr>';
	}
	}

	$table .='</tbody></table></div><br>';
	echo $table;

	// Выводим таблицу со статистикой оружия
	echo '<h3>Статистика по оружию</h3>';
	$table ='<div class="table-responsive"><table id="leaderboard" class="table-fill fleads">
	<thead>
	<tr>
		<th class="text-left">Оружие</th>                
		<th class="text-left">Убийства</th>                
		<th class="text-left">Выстрелы</th>                
		<th class="text-left">Попадания</th>                
		<th class="text-left">Точность</th>                
		<th class="text-left">Летальность</th>                
	</tr>			
	</thead>
	<tbody id="user-rows">';
	foreach ($accuracyTable as $weapon) {
		$table .='<tr>
			<td class="text-left"><img src="icons/weapon_'. $weapon .'.svg">'. $weaponsName[$weapon] .'</td>
			<td class="text-left">'. $weaponsResult[$weapon]['kills'] .'</td>
			<td class="text-left">'. $weaponsResult[$weapon]['shots'] .'</td>
			<td class="text-left">'. $weaponsResult[$weapon]['hits'] .'</td>
			<td class="text-left">'. $weaponsResult[$weapon]['accuracy'] .'%</td>
			<td class="text-left">'. $weaponsResult[$weapon]['lethality'] .'%</td>
			</tr>';
	}

	$table .='</tbody></table></div><br>';
	echo $table;

	// Выводим статистику по картам
	echo '<h3>Статистика по картам</h3>';
	$table ='<div class="table-responsive"><table id="leaderboard" class="table-fill fleads">
	<thead>
	<tr>
		<th class="text-left">Карта</th>                
		<th class="text-left">Выгранных раундов</th>                
		<th class="text-left">Всего раундов</th>                
		<th class="text-left">Процент побед</th>                
	</tr>			
	</thead>
	<tbody id="user-rows">';
	foreach ($mapsArray as $map) {
		$table .='<tr>
			<td class="text-left">'. $map .'</td>
			<td class="text-left">'. $mapsResult[$map]['wins'] .'</td>
			<td class="text-left">'. $mapsResult[$map]['rounds'] .'</td>
			<td class="text-left">'. $mapsResult[$map]['percentage'] .'%</td>
			</tr>';
	}

	$table .='</tbody></table></div><br>';
	echo $table;

	// Выводим главную таблицу, с основными статистиками
	echo '<h3>Общая статистика за всё время</h3>';
	$table ='<div class="table-responsive"><table id="leaderboard" class="table-fill fleads">
			<thead>
			<tr>
					<th class="text-left">Характеристика</th>                
					<th class="text-left">Значение</th>                
				</tr>			
				</thead>
				<tbody id="user-rows">';
				foreach ($statas as $key => $stata) {
					// Проверяем, соотвествует ли характеристика критерию "Обычная"
					if(in_array($stata['name'], $main)) {
						$table .='<tr>
						<td class="text-left">'. $stats[$stata['name']] .'</td>
						<td class="text-left">'. $stata['value'] .'</td>
						</tr>';
		}
	}
	
	$table .='</tbody></table></div><br>';
	echo $table;
	
	// $table ='<div class="table-responsive"><table id="leaderboard" class="table-fill fleads">
	// <thead>
	// <tr>
	// <th class="text-left">Характеристика оружия</th>                
	// <th class="text-left">Значение</th>                
	// </tr>			
	// 		</thead>
	// 		<tbody id="user-rows">';
	// 		foreach ($statas as $stata) {
	// 			// Проверяем, соотвествует ли характеристика критерию "Оружие"
	// 			if(in_array($stata['name'], $weapons)) {
	// 				$table .='<tr>
	// 				<td class="text-left">'. $stats[$stata['name']] .'</td>
	// 				<td class="text-left">'. $stata['value'] .'</td>
	// 				</tr>';
	// 			}
	// 		}
			
	// 		$table .='</tbody></table></div><br>';
	// 		echo $table;
			
echo '<h2>Достижения игрока</h2>';
echo '<div id="achievements">';

			foreach ($achievements as $achievement) {
				echo "<img title=\"". $images[$achievement['name']][1]."\" src=\"".$images[$achievement['name']][0]."\">";
				// echo $i. '&nbsp;' .$achievement['name'] . ':&nbsp;' . $achievement['achieved'], "<br>";
				// $i++;
			}
echo '</div>';
} else if(empty($_GET['user'])) {
	require_once "leaderboard.php";
} else {
	echo '<div class="text">';
	echo '<p>Профиль не найден или имеет статус закрытого. Проверьте правильность ввода.</p>';
	echo '<p>Чтобы узнать статус аккаунта, его SteamID, SteamCommunityID, Имя профиля, URL профиля воспользуйтесь нашим сервисом проверки <a href="https://game-stat.com/steam/">статистика Steam аккаунта</a>.</p>';
	echo '<p style="margin:0 auto; text-align:center"><iframe width="560" height="315" src="https://www.youtube.com/embed/1T18wZgvwPw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p></div>';
	echo '</div>';
}
//$data        = (array) json_decode($urljson)->playerstats->stats[1];
//$request_cs = $data['avatar'];
//print_r($data);


?>
	</div>	
</div>	


