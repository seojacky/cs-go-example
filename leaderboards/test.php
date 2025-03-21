<?php
//error_reporting(0);
require_once '../vendor/autoload.php';

use Fortnite\Auth;
use Fortnite\Account;
use Fortnite\Mode;
use Fortnite\Language;
use Fortnite\Platform;
use League\Csv\Writer;

$platforms = [
    'pc' => Platform::PC,
    'ps4' => Platform::PS4,
    'xb1' => Platform::XBOX1
];

$modes = [
    'solo' => Mode::SOLO,
    'duo' => Mode::DUO,
    'squad' => Mode::SQUAD
];

$header = ['Platform', 'Mode', 'Rank', 'Account ID', 'Score', 'Display name', 'KD', 'WR', 'Kills', 'Wins', 'Matches'];
$records = [];

$accounts = array(
  array('pustojack@list.ru','IGNt7uOcEQdP'),
  array('ro.savelev@mail.ru','hmer9POVTnFn'),
  array('5sashunyapopov5@mail.ru','a2TN4cjqxx98'),
  array('skoroveczkij@mail.ru','0w2hEbBv7LMN'),
  array('molotkov-sash@mail.ru','354fiFeynXxc'),
  array('bychov.sanya@mail.ru','HwgxguVc9rJv'),
  array('tola.ivanov.98@mail.ru','kczILO5A868h'),
  array('frerilprop@mail.ru','xMtEyrytt5bGzw'),
  array('vopersgold@mail.ru','TRoL49oGoqjdEX'),
  array('lizemsters@mail.ru','jJIM8aV4L40JiX'),
  array('ridggreler@mail.ru','zzymVtfRJLMO1f'),
  array('ivanfedko1996@mail.ru','a49rGTBmeDaAlo'),
  array('parriodown@mail.ru','7fkJIf1DijZwKb'),
  array('300_001@bk.ru','vnUe1iCHK1tYRn'),
);

$account = array_rand($accounts);

$auth = Auth::login($accounts[$account][0], $accounts[$account][1]);

foreach($platforms as $platformKey => $platform) {
    foreach ($modes as $modeKey => $mode) {
        $leaderboard = $auth->leaderboard->get($platform, $mode);
        foreach($leaderboard as $player) {
            $stats = $auth->profile->stats->lookup($player->displayname);
	    echo json_encode($stats);
	    die();
        }
    }
}

$writer = Writer::createFromString('');
$writer->insertOne($header);
$writer->insertAll($records);
file_put_contents("data.csv", $writer->getContent());

