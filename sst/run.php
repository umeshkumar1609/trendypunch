<?php
require_once('../../define.php');

function save_index_file($url,$filename){

		$ch = curl_init($url);
		$dir = '../';
		$file_name = $filename;
		$save_file_loc = $dir . $file_name;
		
		$fp = fopen($save_file_loc, 'wb');
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
}
function save_html_file($url,$filename){

		$ch = curl_init($url);
		$dir = 'index/';
		$file_name = $filename;
		$save_file_loc = $dir . $file_name;
		
		$fp = fopen($save_file_loc, 'wb');
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
}

function insert_html_file($mysqli,$index_id){
		$sql="select * from s_market_index_symbol_id where s_market_index_id='".$index_id."'";
		$result=$mysqli->query($sql);
		$num=$result->num_rows;
		if($num>0){
				while($row=$result->fetch_array()) {
						$sql_u="update s_symbol set html_file='1' where id='".$row['s_symbol_id']."'";
						$result_u=$mysqli->query($sql_u);
				}
		}
}

	$sql="select * from s_market_index order by id asc limit 5";
	$result=$mysqli->query($sql);
	while($row=$result->fetch_array()) {
	
			insert_html_file($mysqli,$row['id']);
			
			$filename=$row['s_market_index_name'];
			$filename=str_replace("&","",$filename);
			$filename=strtolower(str_replace(" ","-",$filename));
			$filename=$filename.'.html';
			
			$url='http://localhost/sm/mystock/20dayshighlow/web_index_data.php?mid='.$row['id'];
			save_html_file($url,$filename);
	}
	
	$url_index='http://localhost/sm/mystock/20dayshighlow/web_menu.php';
	save_index_file($url_index,'index.html');
?>
