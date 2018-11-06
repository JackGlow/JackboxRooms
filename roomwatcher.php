<?php

function rmg($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}

if(isset($_GET['sw'])){

$baseurl = "https://blobcast.jackboxgames.com/room/";
$find = false;
for ($i=0; $i < 1; $i++) {
	$ml = rmg(4);
	if(get_http_response_code('http://blobcast.jackboxgames.com/room/' . $ml) != "200"){
		continue;
		print(1);
	}
	$ttg = json_decode(file_get_contents($baseurl.$ml), true);
	print($ttg['roomid']." | ".$ttg['apptag']." | ".$ttg['numPlayers']."<br>");
}




exit();
}

?><head>
	<title>Jackbox Roomwatcher</title>
	<script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
</head>
Wait for rooms... we are parsing currently.<br>
<span style="color: red;">Maybe you will cannot join though jackbox.tv! Use VPN on this page please and other browser ;)</span>
<div id="parsedIDs">
	
</div>


<script type="text/javascript">
window.onload = function(){
	scanOneMore();
}

function scanOneMore(){
	$.post(
		{
			url: '?sw=1',
			success: function(d){
				document.getElementById("parsedIDs").innerHTML += d;
			}
		});
}

setInterval(scanOneMore, 50);
</script>