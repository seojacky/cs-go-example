<?php
session_start(); 
$_GET['user'] = '76561198116436066';
	header("Content-Type: text/html; charset=utf-8");
    header("Cache-Control: public");
    header("Expires: " . date("r", time() + 60000)); //Включение кэширования на 1 час (3600), 10 минут (600) или другое время

error_reporting(E_ERROR | E_PARSE);

// фиксация времени начала генерации страницы
$begin = microtime();
// матрица начального времени с секундами и миллисекундами
$arrbegin = explode(" ",$begin);
// Полное начальное время
$allbegin = $arrbegin[1] + $arrbegin[0];
    //error_reporting(-1);
	$last_modified_time = getlastmod(); //время последнего изменения страницы в uni
	// Задаём заголовки Last-Modified и If-Modified-Since
	$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $last_modified_time);
	$IfModifiedSince = false;
	
	 //комментируем пока всё кеширование
/*if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($IfModifiedSince && $IfModifiedSince >= $last_modified_time) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
    exit;

}
	header('Last-Modified: '. $LastModified);	
*/
	

	

	/* Установка внутренней кодировки в UTF-8 */

    mb_internal_encoding("UTF-8");

    /* Задаём переменные */
	$host = 'https://'.$_SERVER['HTTP_HOST']; //адрес сайта вида https://game-stat.com
    $shorturl = str_replace('index.php','',strtok($_SERVER['REQUEST_URI'], '?')); //относительный адрес страницы вида /steam/ без гет-параметров
	$url = $host . $shorturl; //полный адрес страницы https://game-stat.com/steam/
	$prefix = strtok(str_replace('/','',$shorturl), '?'); //удаляет слеши, фактически получает имя папки
    $filename = basename($url, ".php"); // $filename содержит имя файла без расширения php
	$document_root = $_SERVER['DOCUMENT_ROOT']; //получаем путь вида /var/www/u0533667/public_html/game-stat.com
	$sitename = 'Game-Stat.Com'; // Имя сайта
	
	
	
	
	/* Получаем никнейм и платформу из GET запроса */
		if(isset($_GET['user']) && !empty($_GET['user'])){
		$user = $_GET['user'];
		}	
		if(isset($_GET['pl']) && !empty($_GET['pl'])){
		$pl = $_GET['pl'];
		}	

	/* Получаем метатеги из файла в папке*/    
	include_once 'meta.php';
	
?>
<?php
	/*  сжатие и очистка
	передаем функции compress_page управление исходным потоком  */
    ob_start('compress_page');
	/* ниже весь хтмл для сжатия  и вторая функция в конце файла */
	?>
<!DOCTYPE html>
<html itemscope itemtype="https://schema.org/WebPage" lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php // Редактируем 2 строчки здесь и ниже там где Н1 ?>
	<title><?php  if (isset($user) && !empty($user)){ echo $metatitle_2; } else { echo $metatitle;} ?></title>
	<meta name="description" content="<?php  if (isset($user) && !empty($user)){ echo $metadesc_2; } else { echo $metadesc;} ?>">
	
	<meta name="keywords" content="<?php echo $metakeywords ?>">
	<?php 
	// Если $_GET['user'] или $user не пустой, то метатег noindex, nofollow	
	if (isset($user) && !empty($user)) { echo '<meta name="robots" content="noindex, nofollow" />';}
	?>
	<?php

		/* Подключаем Метатеги и стили style.css в <head> */
	//include_once $document_root.'/assets/inc/metahead.php';
	
	/* Подключаем собственные стили страницы */
	/*echo '<link rel="stylesheet" href="style.min.css">'; 
	echo '<link rel="stylesheet" href="stats.min.css">'; 
	echo '<link rel="stylesheet" href="grid.css">'; 
	echo '<link rel="stylesheet" href="cards.min.css">'; 
	echo '<script src="sorttable.min.js"></script>';*/

		/* Подключаем Микроразметку */
	//include_once $document_root.'/assets/inc/opengraph.php'; 

	?>
	
	
</head>
	<body class="<?php echo $prefix; ?>-page">
	
	
	<meta itemprop="datePublished" content="<?php echo date('Y-m-d'); ?>" /><span style="display:none;"><?php echo date('d.m.Y'); ?></span>
	<meta itemprop="dateModified" content="<?php echo date('Y-m-d'); ?>" />
	<span style="display:none;" itemprop="author">Задойный А.В.</span>	
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
    <div itemprop="logo image" itemscope itemtype="https://schema.org/ImageObject">
        <img style="display:none;" itemprop="url contentUrl" src="/assets/img/logo.png" alt="logo" />
        <meta itemprop="width" content="6" />
        <meta itemprop="height" content="6" />
   </div>
   <meta itemprop="name" content="Game-Stat.com" />
   <meta itemprop="address" content="Moscow" />
   <meta itemprop="telephone" content="+7 495 320-77-80" />
	</div>

<?php

  	/* Подключаем шапку */
  	//include_once $document_root.'/assets/inc/header.php'; 

		?>

<!-- начало wrapper -->

<div id="wrapper">
   <div id="middle">
       <div id="content">
          <div id="colLeft">

		  

			<?php
				/* Подключаем Хлебные крошки */
				//include_once 'breadcrumbs.php';
			?>
				

			<?php
				/* Значение рейтинга получено выше из файла meta.php */
				
				/* Подключаем рейтинг звёзды */
				//include_once $document_root.'/assets/rait/raiting.php';
				//echo '<script async src="/assets/rait/rait.min.js"></script>';
				//echo '<link rel="stylesheet" href="/assets/rait/rait.min.css">';
			?>

			
			

				  <div class="textblock" itemprop="description">
				  <?php
						/* Подключаем миниатюру */
							//if ($thumbnail_on == 'yes') include_once $document_root.'/assets/inc/thumbnail.php'; 
					?>
					
					              


                  <?php 
						//Сама форма поиска
				    include_once 'form.php';

				   ?>
				<header>
				<?php
				/* Подключаем кнопки шаринга */
				//include_once $document_root.'/assets/inc/social/social.php';
				?>
				
				<?php // Редактируем 2 строчки здесь и выше там где title & description ?>
				<?php
				if (isset($user) && !empty($user)) {
					// Если форма заполнена - то выводить код				
					
					
				echo '<h1 itemprop="headline">Статистика CS:GO</h1> <h2 itemprop="headline">Профиль игрока '.$user.'</h2>';
				}
				else {
				echo '<h1 itemprop="headline">Статистика CS:GO</h1><p>Отслеживайте статистику и рейтинг любого игрока CS:GO</p>';
				}
				?>
				</header>
				
				
				
				<?php
				if (!isset($_GET['user']) && empty($_GET['user'])) {
					// Если форма НЕ заполнена - то выводить код Рекламы
					?>
				
				<?php } ?>
				
				
				
				<?php 

				//require_once "leaderboard.php";
			    //include_once 'action.php';

				//action.php файл, который вызывается после заполнения формы
				if (isset($user) && !empty($user)) {
				    include_once 'action_test.php';
				} else {
					//require_once "leaderboard.php";
				}

				   ?>
				   
				   
				

				 <?php if (!isset($user) && empty($user)) { 

				 // Если форма НЕ заполнена - то выводить код 

				//текст на странице
				     //include_once $document_root.$shorturl.'text.php';
					//include_once 'text.php';
				} ?>				

		<?php

		/* Подключаем комментарии */  

		//include_once $document_root.'/assets/inc/comments.php'; 

		?>  
		
				

               </div>

          </div><!-- конец colLeft -->

          <!-- начало colRight -->

          

          <!-- конец colRight -->

       </div><!-- конец content -->

	   

	   

	   

		</div><!-- конец middle -->

   </div><!-- конец wrapper -->

   <?php

  /* Подключаем Подвал */

  //include_once $document_root.'/assets/inc/footer.php'; 

		?>
</body>
<?php
/* Сжатие HTML. Первая функция в начале
/*  конец управления буфером и вывод контента */
    ob_end_flush();	

function compress_page($html) 
{
    //Пустые строки
	$html = preg_replace("#\s*?\r?\n\s*?(?=\r\n|\n)#s", "", $html);
	
	// Табуляция и переносы строк
    //$html = str_replace(array("\t", "\r", "\n"), ' ', $html);

    // Двойные пробелы
    //$html = mb_ereg_replace('[\s]+', ' ', $html);    

    return $html;
}
?>
</html>

<?php
$end = microtime();

print_r($begin - $end);
 ?>