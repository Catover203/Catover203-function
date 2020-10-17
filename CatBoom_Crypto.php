<?php
/**
* @name : CatBoom Crypto
*
* @author : Catover203
* @version : 1.5
* @access public
* @editable : yes
* @author_link :
* + Github: https://www.github.com/Catover203/
* + Youtube: https://www.youtube.com/channel/UCJGbwB4wGzB39xF71iGwAjg
* + Discord: 
* 
* 
* This a module CBCrypto. Don't edit, it can have a lot error if you edit.
* Anyway, you can edit that if you understand php and known how to fix this error.
**/
class CBCrypto{
     function __construct(){
          $file = 'CBCRYPT_LOADER.php';
          if(file_exists($file)){
               include($file);
               $loader = new CBCLOADER();
               $this->loader = $loader;
               $this->hash_list = $loader->hash_list();
               $this->digi_hash_list = $loader->digi_hash_list();
               $this->OS = $loader->getOS();
               $this->gen_hash = $loader->gen_hash();
               
          }else{
               $this->loader = false;
               echo "<p><b>CatBoom Crypto Load Failed: </b>Can't find loader file.</p>";
          }
     }
     function encrypt($string, $key){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $crypto = $loader->CBCR($string, $key);
               return $crypto;
          }
     }
     function decrypt($string, $key){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $crypto = $loader->CBCRP($string, $key);
               return $crypto;
          }
     }
     function SSEcrypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $hash = $this->hash_list;
               $digi = $this->digi_hash_list;
               $crypt = '$1$a0'.hash('sha256',md5(hash('sha512',base64_encode('#!#$$_-@=#'.$digi[5].hash('sha512',sha1(md5(base64_encode($loader->crypto($str).$digi['strong'])))).$hash[1]).hash('sha256',base64_encode(md5($hash['strong']))))));
               return $crypt;
          }
     }
     function BXHcrypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $hash = $this->hash_list;
               $SSE_pass = $this->SSEcrypt($hash['strong']);
               $XOR_pass = $this->password_crypt($SSE_pass);
               $crypto = '$1$0'.sha1($loader->XORcrypt(base64_encode(hash('sha256',base64_encode(md5($loader->XORcrypt($str, $XOR_pass))))), $SSE_pass));
               return $crypto;
          }
     }
     function XORcrypt($str, $key){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $crypto = $loader->XORcrypt($str, $key);
               return $crypto;
          }
     }
     function crypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $crypto = $loader->crypto($str);
               return $crypto;
          }
     }
     function getOS(){
          $loader = $this->loader;
          if(!$loader){
               return false;
               echo '<p><b>CatBoom Crypto Load Failed: </b>Loader file not found.</p>';
          }else{
               $OS = $this->OS;
               return $OS;
          }
     }
     function cloud_save($path, $file, $data, $mode = 'w'){
          $loader = $this->loader;
          if(isset($path) && isset($file) && !strstr($file,'/') && $loader != false){
               $loader->save($file, $path, $data, $mode);
          }else{
               return false;
               echo '<p><b>CatBoomCrypto Execute Failed: </b>Failed to run function, not engnougt data to run.<br>Loader Function: <b>CBCLOADER::save</b></p>';
          }
     }
     function cloud_read($path){
          $loader = $this->loader;
          if($loader != false){
               $loader->open($path);
               return $loader;
          }else{
               return false;
               echo '<p><b>CatBoomCrypto Load Failed: </b>Failed load Loader file.<br>Loader File not found</p>';
          }
     }
/*
     function CBCrypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
          }else{
               $crypt = $loader->crypto($str);
               return $crypt;
          }
     }
*/
     function password_crypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
          }else{
               $hash = $this->hash_list;
               $crypt = '$1a$e4'.md5(hash('sha512',$loader->crypto($str).$hash[5].$hash[1].$hash[2]).$hash[5]).$hash['strong'];
               return $crypt;
          }
     }
}
?>