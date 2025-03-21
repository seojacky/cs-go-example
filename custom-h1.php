<?php

if (isset($user) && !empty($user)) {
	// Если форма заполнена - то выводить код				
	echo '<h1 itemprop="headline">Статистика CS:GO</h1> <h2 itemprop="headline">Профиль игрока '.$user.'</h2>';
}
else {
	echo '<h1 itemprop="headline">Статистика CS:GO</h1><p>Отслеживайте статистику и рейтинг любого игрока CS:GO</p>';
}