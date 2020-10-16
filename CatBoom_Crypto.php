<?php
/**
* @name : CatBoom Crypto
*
* @author : Catover203
* @version : 1.0
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
               $this->loader = $LOADER;
               $this->hash_list = $loader->hash_list();
               $this->digi_hash_list = $loader->digi_hash_list();
               $this->OS = $loader->getOS();
               
               
               
          }else{
               $this->loader = false;
               echo "<p><b>CatBoom Crypto Load Failed: </b>Can't find loader file.</p>";
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
     function encrypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
          }else{
               $crypt = $loader->crypto($str);
               return $crypt;
          }
     }
     function password_crypt($str){
          $loader = $this->loader;
          if(!$loader){
               return false;
          }else{
               $hash = $this->hash_list;
               $crypt = '$1a$e4'.hash('sha512',$loader->crypto($str)).$hash['strong'];
               return $crypt;
           }
     }
}
?>