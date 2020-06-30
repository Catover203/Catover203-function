<?php
function catdb_connect($host, $username, $password, $database){
if(isset($database)){
$connect = mysqli_connect($host, $username, $password, $database);
}
if(!isset($database)){
$connect = mysqli_connect($host, $username, $password);
}
return $connect;
}
function catdb_query($connect, $sql){
$query = mysqli_query($connect, $sql);
return $query;
}
function catover203_function_info(){
$ver = "1.1.0";
$catdb_ver = "1.0.5";
$infoversion = $ver;
$cb8e = catbase8_encode('example');
$cb8d = catbase8_decode($cb8e);
$infoquery = 'mysql and mysqli';
$infosql_connect = "using catdb_connect('HOST', 'USERNAME', 'PASSWORD', 'DATABASE') 'DATABASE' can empty for only connect to sql";
$infodoquery = 'the query can do like mysqli_query but i use catdb_query';
$query_command = '
<p>catdb_fetch_assoc($query) : like mysqli_fetch_assoc</p>
<p>catdb_connect ($host, $username, $password, $database[if needed]) : connect to your sql database</p>
<p>catdb_query($connect, $sql_command) : query to your sql database, it like mysqli_query</p>
<p>catdb_version() : Show catdb version</p>
<p>catover203_function_version() : get this function version</>
<p>string_check($text, $contain) : check the string contain values</p>
<p>dfie($file_path) : delete file if file is exists</p>
<p>delete_file($path) : delete file</p>
<p>cookie(name, value, time, path, securire, httponly) : set user cookie, but it not like setcookie() because it can delete cookie using cookie(name, "", "remove")</p>
<p>catbase8_encode($value) : base64_encode 8 time for hight securite, example: [input: (catbase8_encode("example"))] [output: ('.$cb8e.')]</p>
<p>catbase8_decode($value) : base64_decode 8 time, example:[input: (catbase8_decode("'.$cb8e.'"))] [output: ('.$cb8d.')]
</td>
</tr>
</table>
</body>';
$infofinal = 
'
<title>Catover203 Function - info</title>
<body>
<style>
.infodex{
border: 1px solid black;
}
.plum{
background-color:plum;
}
</style>
<table align="center">
<tr>
<td  class="infodex">
<div style="background-color:lightblue">
<p>Version: <a style="color:blue">'.$infoversion.'</a> | CatDB version: <a style="color:orange">'.$catdb_ver.'</a></p>
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
<p>Function:</p>'.$query_command;
echo $infofinal;
}
function catdb_fetch_assoc($query){
$query_fetch = mysqli_fetch_assoc($query);
return $query_fetch;
}
function catdb_version(){
$catdb_version = "1.0.5";
return $catdb_version;
}
function catover203_function_version(){
$version = "1.1.0";
return $version;
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
if($value1 === $value2){
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
$ver = "1.1.0";
$catdb_ver = "1.0.5";
echo '
<table align="center"><tr><td><p style="font-size:120%; text-align:center; background-color:gray; color:white">Included Catover203-Function v'.$ver.' with catdb(database) v'.$catdb_ver.'</p></td></tr></table>';
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
?>
