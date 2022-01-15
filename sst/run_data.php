<?php
require_once('../../define.php');

function save_html_file($url,$filename){

		$ch = curl_init($url);
		$dir = 'data/';
		$file_name = $filename;
		$save_file_loc = $dir . $file_name;
		
		$fp = fopen($save_file_loc, 'wb');
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
}


	$sql="select * from s_symbol where html_file='1' order by id asc";
	$result=$mysqli->query($sql);
	while($row=$result->fetch_array()) {
			
			$filename=strtolower($row['symbol_name']);
			$filename=$filename.'.html';
			
			$url='http://localhost/sm/mystock/20dayshighlow/web_symbol_data.php?id='.$row['id'];
			save_html_file($url,$filename);
	}
	
?>
