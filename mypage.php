<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>自分のページ</title>
    <meta name="description" content="how_to_organic_agriの会員の自分のページです。">

  	<script >

    /*
   * myWeather.js: livedoorお天気WebサービスからJSONデータを取得する
   */

  // 取得する地域
  var result = null;
  var data = null;
  var cityId = "350020";

  var httpObj = new XMLHttpRequest();
  // 事前にアップしたPHPプログラムを介して、livedoorお天気WebサービスからJSONデータ取得する
  httpObj.open("GET", "https://torisky.com/libs/getLWWS.php?city=" + cityId, true);

  httpObj.onload = function(){
  	data = JSON.parse(this.responseText);	// JSON形式データを変換
  	console.log(data);
  	console.log("XHR送信成功!!");
  	showWeather(data);
  }

  httpObj.send(null);

  function showWeather(data){
  	var tag = "";
  	tag += "<h2>" + data.location.city + "の天気</h2>";
  	tag += "<table>";
  	tag += "<tr><th>日付</th><th>天気</th><th>最高気温</th><th>最低気温</th></tr>";

  	for(var i in data.forecasts){	// 天気情報取得（i = 0:今日、i = 1: 明日、i = 2:あさって）
  		tag += "<tr>";
  		// 「今日」「明日」「明後日」+　日付
  		tag += "<td>" + data.forecasts[i].dateLabel + data.forecasts[i].date + "</td>";
  		// 天気アイコン画像＋天気の文字（例：晴れ）
  		tag += "<td><img src='" + data.forecasts[i].image.url + "' width='50' height='31'>" + data.forecasts[i].telop + "</td>";
  		// 最高気温（データがnullの場合がある）
  		var max = data.forecasts[i].temperature.max;
  		if(max != null){
  			tag += "<td class='center'>";
  			if(max.celsius >= 30){
  				tag += "<span class='red'>" + max.celsius + "℃</span>";
  			}
  			else{
  				tag += max.celsius + "℃";
  			}
  			tag += "</td>";
  		}
  		else{
  			tag += "<td class='center'>-</td>";
  		}
  		// 最低気温（データがnullの場合がある）
  		var min = data.forecasts[i].temperature.min;
  		if(min != null){
  			tag += "<td class='center'>";
  			if(min.celsius <= 5){
  				tag += "<span class='blue'>" + min.celsius + "℃</span>";
  			}
  			else{
  				tag += min.celsius +"℃";
  			}
  			tag += "</td>";
  		}
  		else{
  			tag += "<td class='center'>-</td>";
  		}

  		tag += "</tr>";
  	}
  	tag += "</table>";
  	// 日付を整形
  	var d = new Date(data.publicTime);
  	var month = d.getMonth() + 1;
  	var date = d.getDate();
  	var hour = d.getHours();
  	var minute = d.getMinutes();
  	tag += "<p class='description'>" + month + "/" + date + " " + hour + "時 発表</p>";
  	// 天気概況
  	tag += "<p class='description'>" + data.description.text + "</p>";

  	result.innerHTML = tag;
  }

  window.onload = function(){
  	result = document.getElementById("result");
  }

    </script>


  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li class="current"><a href="basepage.html">BasePage</a></li>
          <li><a href="">MyPage</a></li>
          <li><a href="">Message</a></li>
          <li><a href="">お知らせ</a></li>
        </ul>
      </nav>


    </header>

    <section>
      <h1>あなたの畑の天気</h1>

    	<div id="result">Getting weather...</div>

    </section>
    <section>
      <h1>自分の畑</h1>
    </section>
    <section>
      <h1>友達</h1>
    </section>


  </body>

  <footer>
    <p>(c) hiroyasu hirano</p>
  </footer>

</html>


<!-- うまくいかなかったapi -->
 <?php

// $api_url = 'https://api.darksky.net/forecast/b3c53043d2850629ecde6d2f1aaa32db/34.137896,131.496279?units=si&lang=ja&exclude=alerts,flags';

// $forecast = json_decode(file_get_contents($api_url));

// echo '<pre>';
// print_r($forecast);
// echo '</pre>';

 // ?>
