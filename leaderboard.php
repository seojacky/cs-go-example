<?php

require_once "vendor/autoload.php";

$playerArray = json_decode(file_get_contents("leaderboards/data.json"), true);


$table ='<div class="table-responsive"><table id="leaderboard" class="sortable table-fill fleads">
			<thead>
            <tr>
                <th id="sort_rank" style="display: none">Sort Rank</th>
                <th class="text-left sorttable_nosort">Игрок</th>                
                <th class="text-left sorttable_nosort">Команда</th>                
                <th class="text-left sortable">K/D</th>                
                <th class="text-left sortable">Rating</th>                
			</tr>			
			</thead>
			<tbody id="user-rows">';
			foreach ($playerArray as $key => $player) {
                // Лимит в 30 игроков
                if($key > 5) {
                    break;
                }
                $img = "src";
                $trClass = "";
                // if($key > 5) { 
                //     $trClass = "hidden-by-default"; 
                //     $img = "data-aload";
                // }
                $table .='<tr class="'. $trClass .'">
                    <td style="display: none">'.$key.'</td>
                    <td class="text-left">'. $player["playerCol"] .'</td>
                    <td class="text-left"><img decoding="async" '.$img.'="'. $player["teamLogo"] .'"/><span>&nbsp'. $player["teamCol"] .'</span></td>
                    <td class="text-left">'. $player["statsDetail"] .'</td>
                    <td class="text-left">'. $player['ratingCol'] .'</td>
                </tr>';
            }
			
			$table .='</tbody></table></div><a href="leaderboards/"><div id="showMoreButton">Открыть таблицу лидеров</div></a>';
			echo $table;
?>
<script>
    function placeClass(remove) {
        if(remove) {
            const places = ["place_1", "place_2", "place_3"];
            places.forEach(function (el) {
                elList = document.getElementsByClassName(el);
                for (var i = elList.length-1; i > -1; i--) {
                    elList[i].classList.remove(el);
                }
            });
            return;
        }
        const table = document.getElementById('leaderboard');
        for(let i = 1; i < 4; i++) {
            table.rows[i].classList.add('place_' + i);
        }
    }

    function showMore() {
        aload();
        var style = document.createElement('style');
        style.innerHTML = `
            .hidden-by-default {
                display: table-row;
            }
        `;
        document.head.appendChild(style);
        document.getElementById("showMoreButton").style.display = "none";
    }
    placeClass();
</script>
<script>
  function aload(t){"use strict";var e="data-aload";return t=t||window.document.querySelectorAll("["+e+"]"),void 0===t.length&&(t=[t]),[].forEach.call(t,function(t){t["LINK"!==t.tagName?"src":"href"]=t.getAttribute(e),t.removeAttribute(e)}),t}
</script>