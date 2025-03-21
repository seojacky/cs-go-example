<?php
  /* Шапка */
  
  /* Установка внутренней кодировки в UTF-8 */
  mb_internal_encoding("UTF-8");
 
 ?>
 <?php
/* Вторая функция по минификации, первая в хедере
/* Пришлось отключить - минифицировало всё подряд, в том числе счётчики Метрики */
 //echo ob_get_clean();
 ?>
 
 <div id="footerInner">
   <div id="footerContainer">
   
     <div style="float:left; display:flex; align-items:center; height:70px; padding:5px; width:90%;">
	 <?php
if ($_SERVER['REQUEST_URI']=="/") // если главная страница- выполняем действие
{ 
echo '<div style="display:inline-block; margin: 2px"> © '. date("Y") . ' Game-Stat.Com</div>'; 
echo '<div style="display:inline-block; margin: 2px"> <a href="/privacy" >Политика конфиденциальности</a> </div> <div style="display:inline-block; margin: 2px"> <a href="/contacts" >Контакты </a> </div>';

 }
else
{
echo '<div style="display:inline-block; margin: 2px"> © '. date("Y") . ' Game-Stat.Com </div> <div style="display:inline-block; margin: 2px"><a href="/" >Игровая статистика онлайн</a></div>'; 
echo '';
 }
 ?>
	 
     </div>  
	 
	<script src="https://game-stat.com/assets/js/lazyload/jquery.lazyload.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$("img.lazy").lazyload({
			    effect : "fadeIn"
			});
		});

	</script>
	 
	 
	 
   
      <div style="float:right;">	  
	  <!--LiveInternet counter--><script>
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t38.3;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
    </script><!--/LiveInternet-->
	
	<!-- Yandex.Metrika counter --><script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym"); ym(49589926, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/49589926" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->	
	  </div>
	
	<div id="delaypush"></div>
		<script> 
		setTimeout(function(){  
		$.get("https://game-stat.com/sw-init.php", function(data) {
			$('#delaypush').replaceWith($(data));
		})
		},4000);
	</script>
	
	
  </div><!--конец footerContainer-->
</div><!--конец footerInner-->