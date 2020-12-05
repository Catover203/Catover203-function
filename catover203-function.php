<?php

use CatBoomMailer\CatBoomMailer\CatBoomMailer;
use CatBoomMailer\CatBoomMailer\Exception;
require 'CatBoomMailer/src/Exception.php';
require 'CatBoomMailer/src/CatBoomMailer.php';
require 'CatBoomMailer/src/SMTP.php';
class CBMailer{
	function __construct($host, $port, $secure, $auth, $username, $password){
	$smtp = 
		[
		'host' => $host,
		'port' => $port,
		'secure' => $secure,
		'auth' => $auth,
		'username' => $username,
		'password' => $password
		];
     $this->smtp = $smtp;
}
	function send($to, $subject, $body, $header = ['isHTML' => false, 'From' => 'CatBoomMailer', 'to' => 'CatBoomMailerToUser']){
		$smtp = $this->smtp;
		$mail = new CatBoomMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 0;  
		$mail->SMTPAuth   = $smtp['auth'];
		$mail->SMTPSecure = $smtp['secure'];
		$mail->Port       = $smtp['port'];
		$mail->Host       = $smtp['host'];
		$mail->Username   = $smtp['username'];
		$mail->Password   = $smtp['password'];
		$mail->AddAddress($to, $header['to']);
		$mail->SetFrom($smtp['username'], $header['From']);
		$mail->Subject = $subject;
		$content = $body;
		if($header['isHTML'] == true){
			$mail->IsHTML($header['isHTML']);
			$mail->MsgHTML($content);
		}
		return $mail->send();
	}
}
class CatBoomFile{
	public $file;
	function __construct($file){
		$this->file = $file;
	}
	public function create($file){
		$new = fopen($file, 'a+');
		fclose($new);
	}
	public function write($file, $data, $mode){
		$fopen = fopen($file, $mode);
		$write = fwrite($fopen, $data);
		$close = fclose($fopen);
		if($fopen){
			return true;
		}else{
			return false; 
		}
	}
	public function delete($file) {
		$delete = unlink($file);
		if($delete){
			return true;
		}else{
			return false; 
		}
	}
	public function get_content($file){
		return file_get_contents($file) ;
	}
}
function catdb_version(){
	$catdb_version = "2.1.0";
	return $catdb_version;
}
function catover203_function_version(){
	$version = "1.6.2";
	return $version;
}
function text2link($s) {
          return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1">$1</a>', $s);
}
function catdb_connect($host, $username, $password, $database){
	if(isset($database)){
		$connect = new mysqli($host, $username, $password, $database);
	}else{
		$connect = new mysqli($host, $username, $password);
	}
	return $connect;
}
function catdb_query($connect, $sql){
	$query = $connect->query($sql);
	return $query;
}
function catover203_function_info(){
	$ver = catover203_function_version();
	$catdb_ver = catdb_version();
	$infoversion = $ver;
	$cb8e = catbase8_encode('example');
	$cb8d = catbase8_decode($cb8e);
	$infoquery = 'mysql and mysqli';
	$infosql_connect = "using catdb_connect('HOST', 'USERNAME', 'PASSWORD', 'DATABASE') 'DATABASE' can empty for only connect to sql";
	$infodoquery = 'the query can do like mysqli_query but i use catdb_query';
	$infofinal = 
'<!DOCTYPE html>
<html>
	<head>
		<title>Catover203 Function - info</title>
		<style>
			.infodex{
				border: 1px solid black;
			}
			.plum{
				background-color:plum;
			}
		</style>
	</head>
	<body>
		<h1 style="text-align:center">Catover203 Function - V'.$infoversion.'</h1>
		<h3 style="text-align:center;color:lightblue">Powered By Catover203</h3>
		<table align="center">
			<tr>
				<td  class="infodex">
					<div style="background-color:lightblue">
						<p style="text-align:align">Version: <a style="color:blue">'.$infoversion.'</a> | CatDB version: <a style="color:orange">'.$catdb_ver.'</a></p>
					</div>
				</td>
			</tr>
			<br>
			<tr>
				<td class="infodex plum">
					<p>Connect type: '.$infosql_connect.'</p>
					<p>query: '.$infodoquery.'</p>
				</td>
			</tr>
			<br>
			<br>
			<br>
			<br>
			<tr>
				<td class="infodex plum">
					<p>Function:</p>
					<p>catdb_fetch($type, $query) : like mysql fetch and $type is: assoc, array, row</p>
					<p>catdb_connect ($host, $username, $password, $database[if needed]) : connect to your sql database</p>
					<p>catdb_query($connect, $sql_command) : query to your sql database, it like mysqli_query</p>
					<p>catdb_version() : Show catdb version</p>
					<p>catover203_function_version() : get this function version</>
					<p>string_check($text, $contain) : check the string contain values</p>
					<p>dfie($file_path) : delete file if file is exists</p>
					<p>delete_file($path) : delete file</p>
					<p>cookie(name, value, time, path, securite, httponly) : set user cookie, but it not like setcookie() because it can delete cookie using cookie(name, "", "remove")</p>
					<p>catbase[8->64]_encode($value) : base64_encode from 8 to 64 time for hight securite, example: [input: (catbase8_encode("example"))] [output: ('.$cb8e.')]</p>
					<p>catbase[8->64]_decode($value) : base64_decode frm 8 to 64 time, example:[input: (catbase8_decode("'.$cb8e.'"))] [output: ('.$cb8d.')]</p>
					<p>post_url($url, $post_data) : Post data to other url and $url is the url and $post_data is like this; <input type="text" size="45" value="$post_data '."= ['data1' => '1', 'data2' => '2']".'" disabled>
					<p>ch57_ecode($data) And ch57_decode is the CatBoom smaill encypt data and i can'."'".'t show example for you for securite reasion</p>
					<p>catdb_enhash($data) and catdb_dehash($data) is a CatBoom Powerful encrypt data tranfer went change password i not show hot it hash and dehash for secure</p>
					<p>Added Class CatBoomMail and CatBoomFile</p>
					<p>txlink(text) : find a text like a link and replace with <input type="text" size="3" value="<a>"> tag</p>
				</td>
			</tr>
		</table>
	</body>';
echo $infofinal;
}
function catdb_fetch($type, $query){
	if($type == 'assoc'){
		$query_fetch = ($query->fetch_assoc());
		return $query_fetch;
	}elseif($type == 'row'){
		$query_fetch = ($query->fetch_row());
		return $query_fetch;
	}elseif($type == 'array'){
		$query_fetch = ($query->fetch_array());
		return $query_fetch;
	}elseif(empty($type)){
		echo "<h5>CatDB Sintax Error: </h5><a>Error, catdb_fetch($type, $query) can't empty $type.</a>";
	}
}
function catdb_num_rows($string){
	return $string->num_rows;
}
function convertDate($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;
	$string = array('y' => 'year','m' => 'month','w' => 'week','d' => 'day','h' => 'hour','i' => 'minute','s' => 'second');
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k.' '.$v.($diff->$k > 1 ? 's' : '');
		}else{
			unset($string[$k]);
		}
	}
if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) : 'just now';
}
function string_check($string, $contain){
	$result = strstr($string, $contain);
	if ($result){
		return true;
	}else{
		return false;
	}
}
function equal_check($value1, $value2){
	if($value1 == $value2){
		return true;
	}else{
		return false;
	}
}
function dfie($file_name){
	if(file_exists($file_name)){
		unlink($file_name);
		return true;
	}else{
		return false;
	}
}
function delete_file($path){
	if(unlink($path)){
		return true;
	}else{
		return false;
	}
}
function print_head_info(){
	$ver = catover203_function_version();
	$catdb_ver = catdb_version();
	echo '
	<table align="center">
	<tr>
		<td>
			<p style="font-size:120%; text-align:center; background-color:gray; color:white">Included Catover203-Function v'.$ver.' with catdb(database) v'.$catdb_ver.'</p>
		</td>
	</tr>
</table>';
}
function cookie($name, $value, $time, $dir, $site, $ssl, $http){
	if(isset($ssl) AND $ssl =true){
		$ssl = true;
	}else{
		$ssl = false;
	}
	if(isset($http) && $http=true){
		$http=true;
	}else{
		$http=false;
	}
	if($time === "remove"){
		$time = (200000000000000000000*100000000000000000000000000000);
		$value = '';
	}
	setcookie($name, $value, $time, $dir, $site, $ssl, $http);
}
function catbase8_encode($value){
$a = base64_encode($value);
	$b =base64_encode($a);
	$c =base64_encode($b);
	$d =base64_encode($c);
	$e =base64_encode($d);
	$g =base64_encode($e);
	$h =base64_encode($g);
	$result = base64_encode($h);
	return $result;
}
function catbase8_decode($value){
	$a = base64_decode($value);
	$b =base64_decode($a);
	$c =base64_decode($b);
	$d =base64_decode($c);
	$e =base64_decode($d);
	$g =base64_decode($e);
	$h =base64_decode($g);
	$result = base64_decode($h);
	return $result;
}
function catbase16_encode($string){
	return catbase8_encode(catbase8_encode($string));
}
function catbase32_encode($string){
	return catbase16_encode(catbase16_encode($string));
}
function catbase64_encode($string){
	return catbase32_encode(catbase32_encode($string));
}
function catbase16_decode($string){
	return catbase8_decode(catbase8_decode($string));
}
function catbase32_decode($string){
	return catbase16_decode(catbase16_decode($string));
}
function catbase64_decode($string){
	return catbase32_decode(catbase32_decode($string));
}
function redirect($path){
	$to  = 'Location: '.$path;
	header ($to);
}
function post_url($url, $post){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, COULOPT_POSTFIELDS, $post);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
function ch57_encode($in){
	$total = str_replace('a',':q@1:',$in);
	$repal = str_replace('c',':f 4:',$total);
	$inpal = str_replace('t',':g55:',$repal);
	$portal = str_replace('o', ':9l9:', $inpal);
	$initel = str_replace('v', ': g5:', $portal);
	$opal = str_replace('e', ':3d3:', $initel);
	$homal = str_replace('r', ':4f4:', $opal);
	return $homal;
}
function ch57_decode($in){
	$total = str_replace(':q@1:','a',$in);
	$repal = str_replace(':f 4:','c',$total);
	$inpal = str_replace(':g55:','t',$repal);
	$portal = str_replace(':9l9:','o', $inpal);
	$initel = str_replace(': g5:','v', $portal);
	$opal = str_replace(':3d3:','e', $initel);
	$homal = str_replace(':4f4:','r', $opal);
	return $homal;
}
function catdb_hash($value){
	$val = array(
	'q',
	'w',
	'e',
	'r',
	't',
	'y',
	'u',
	'i',
	'o',
	'p',
	'a',
	's',
	'd',
	'f',
	'g',
	'h',
	'j',
	'k',
	'l',
	'z',
	'x',
	'c',
	'v',
	'b',
	'n',
	'm',
	'1',
	'2',
	'3',
	'4',
	'5',
	'6',
	'7',
	'8',
	'9',
	'0'
	);
	$rep = array(
	'/1qa/',
	'/2ws/',
	'/3ed/',
	'/4rf/',
	'/5tg/',
	'/6yh/',
	'/7uj/',
	'/8ik/',
	'/9ol/',
	'/0p;/',
	'/qaz/',
	'/wsx/',
	'/edc/',
	'/rfv/',
	'/tgb/',
	'/yhn/',
	'/ujm/',
	'/ik,/',
	'/ol./',
	'/az /',
	'/sx /',
	'/dc /',
	'/fv /',
	'/gb /',
	'/hn /',
	'/jm /',
	'/`12/',
	'/123/',
	'/234/',
	'/345/',
	'/456/',
	'/567/',
	'/678/',
	'/789/',
	'/890/',
	'/90-/'
	);
	$all = str_replace($val, $rep, $value);
	return $all;
}
?>
