<?php
/**
* @name : CatBoom Crypto Loader Module
*
* @author : Catover203
* @version : 2.0
* @access public
* @editable : yes                     
* @author_link :
* * Github: https://www.github.com/Catover203
* * Youtube: https://www.youtube.com/channel/UCJGbwB4wGzB39xF71iGwAjg
* * Discord
*
*
* This a loader module of CBCrypto. Don't edit, it can have a lot error if you edit.
* Anyway, you can edit that if you understand php and known how to fix this error.
**/
class CBCLOADER{
     function CBCR($plaintext, $key) {
	  $key = $this->text2ascii($key);
	  $plaintext = $this->text2ascii($plaintext);
	  $keysize = count($key);
	  $input_size = count($plaintext);
          $cipher = "";
	       for ($i = 0; $i < $input_size; $i++)
	            $cipher .= chr(($plaintext[$i] ^ $key[$i % $keysize])+512);
	  return $cipher;
     }
     function CBCRP($cipher, $key) {
	   $key = $this->text2ascii($key);
	   $cipher = $this->text2ascii($cipher);
	   $keysize = count($key);
	   $input_size = count($cipher);
	   $plaintext = "";
	   for ($i = 0; $i < $input_size; $i++)
	        $plaintext .= chr(($cipher[$i] ^ $key[$i % $keysize])+512);
	   return $plaintext;
	}
     function XORcrypt($plaintext, $key) {
	  $key = $this->text2ascii($key);
	  $plaintext = $this->text2ascii($plaintext);
	  $keysize = count($key);
	  $input_size = count($plaintext);
          $cipher = "";
	       for ($i = 0; $i < $input_size; $i++)
	            $cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);
	  return $cipher;
     }

     function crack($cipher, $keysize) {
	  $cipher = $this->text2ascii($cipher);
	  $occurences = $key = array();
	  $input_size = count($cipher);
	  for ($i = 0; $i < $input_size; $i++) {
		  $j = $i % $keysize;
		       if (++$occurences[$j][$cipher[$i]] > $occurences[$j][$key[$j]])
	               $key[$j] = $cipher[$i];
	     }
          return $this->ascii2text(array_map(function($v) { return $v ^ 32; }, $key));
     }

	public function plaintext($cipher, $key) {
		$key = $this->text2ascii($key);
		$cipher = $this->text2ascii($cipher);
		$keysize = count($key);
		$input_size = count($cipher);
		$plaintext = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$plaintext .= chr($cipher[$i] ^ $key[$i % $keysize]);

		return $plaintext;
	}

	private function text2ascii($text) {
		return array_map('ord', str_split($text));
	}

	private function ascii2text($ascii) {
		$text = "";

		foreach($ascii as $char)
			$text .= chr($char);

		return $text;
	}
     function getOS(){
     $os = PHP_OS;
     return $os;
     }
     function gen_hash(){
          $str = hash('sha512', '$A1$b4'.base64_encode(rand()));
          $hash = hash('sha256', 'gfettyuu4ds345g'.$str.'ea255fs22ww24rfsqy6rq12f6d');
          $bc = base64_encode($hash);
          $bc2 = hash('sha512', 'a5dc421ab7630b'.$bc.rand().'$a2$14');
          $bc3 = substr($bc2,0,16);
          $bc4 = '$a2$d41'.$bc3.'#$a34fra277gs';
          return $bc4;
     }
     
     function hash_list(){
          $list = 
          [
          'strong' => '8f62c6a5723a718eb423996a52cc4885ca6abe2a',
          0 => 'qr43qaf37bd28kgds25fe3sa13r',
          1 => 'a46fe383af589ae4217h5315135',
          2 => 'ae328fao94218ue21q4680pl942',
          3 => 'aq16gsaq147hfe3yh53x4ygr356',
          4 => 'f24ea68gb64d359es27ru75wfg6',
          5 => '15fe32ae87ye4fd3de654f90o21',
          6 => '13fe25wt9o2wq25r2w1y0pw21fy',
          7 => '10rsa147pkg54k974pkp0481pgp',
          8 => '11edsa42ecc85cloudflare3147',
          9 => '17gt94c1a1t1b1o1o1m13732qet'
          ];
          return $list;
     }
     function digi_hash_list(){
          $list = 
          [
          'strong' => '1476314679861124678995113466852167843333',
          0 => '664311356700998765212345752',
          1 => '554125899876531123796543223',
          2 => '346777651112258865310713455',
          3 => '442456996521156789985211292',
          4 => '443118011388454116892145732',
          5 => '244689009811134624789995213',
          6 => '267098753211456808431776522',
          7 => '577521954333459110155116621',
          8 => '612680523458998411340953355',
          9 => '168941458832864350279136932'
          ];
          return $list;
     }
     function crypto($str){
          $list = $this->hash_list();
          $use = $list[1];
          $encodestr = '$1$a4'.md5($list[2].$list[3]).sha1($use.md5($str).$list[4]).$list['strong'];
          return $encodestr;
     }
     function saver_decrypto($str){
          $a = array('|', '%', '-', '@', '*', '?', '>', '<', '~', ':');
          $b = array('a', 'A', 'Y', 'Q', '0', 'w', 'W', '=', '+', 's');
          $replace = str_replace($a,$b,$str);
          $decrypt = base64_decode($replace);
          return $decrypt;
     }
     function saver_encrypto($str){
          $encrypt = base64_encode($str);
          $a = array('a', 'A', 'Y', 'Q', '0', 'w', 'W', '=', '+', 's');
          $b = array('|', '%', '-', '@', '*', '?', '>', '<', '~', ':');
          $replace = str_replace($a,$b,$encrypt);
          return $replace;
     }
     function save($file,$path,$data, $mode = 'w'){
          $open = fopen($path.$file, $mode);
          fwrite($open, $this->saver_encrypto($data));
          fclose($open);
          return true;
     }
     function open($file){
          $read = file_get_contents($file);
          $decode = $this->saver_decrypto($read);
          return $decode;
     }
}
?>