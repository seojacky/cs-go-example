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
  array('example@mail.com','IGNt7uOcEQdP'),
  array('example@mail.com','hmer9POVTnFn'),
  array('example@mail.com','a2TN4cjqxx98'),
  array('example@mail.com','0w2hEbBv7LMN'),
  array('example@mail.com','354fiFeynXxc'),
  array('example@mail.com','HwgxguVc9rJv'),
  array('example@mail.com','kczILO5A868h'),
  array('example@mail.com','xMtEyrytt5bGzw'),
  array('example@mail.com','TRoL49oGoqjdEX'),
  array('example@mail.com','jJIM8aV4L40JiX'),
  array('example@mail.com','zzymVtfRJLMO1f'),
  array('example@mail.com','a49rGTBmeDaAlo'),
  array('example@mail.com','7fkJIf1DijZwKb'),
  array('example@mail.com','vnUe1iCHK1tYRn'),
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

