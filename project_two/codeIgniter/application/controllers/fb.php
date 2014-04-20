<?php
if(!function_exists('file_get_contents')){echo('Se necesita la extencion FILE_GET_CONTENTS de PHP.');}
if(!function_exists('json_decode')){echo('Se necesita la extencion JSON de PHP.');}
class Facebooklogin 
{
private $appId = "";
private $appSecret = "";
private $appUrl = "";
private $dialog_url = "";
private $code = "";
private $access_token = "";
private $abr_gender = array('male'=> 'Masculino','female' => 'Femenino');
private $user = "";
private $permissions = array();
public function __construct($app_id, $app_secret, $app_url) {
if(!($app_id == "") OR ($app_secret == "") OR ($app_url == "")) { 
$this->appId = $app_id;
$this->appSecret = $app_secret;
$this->appUrl = $app_url;
} else { 
echo "Debe ingresar la ID, la ID secret, la URL, y los permisos de su aplicacion en Facebook.";
}
}
public function permissions($permissions) {
if(($permissions == "user_birthday") OR ($permissions == "offline_access")) { 
$this->permissions[$permissions] = "On";
}
}
public function conect() { 
if(isset($_REQUEST["code"])) {
$this->code = $_REQUEST["code"];}else{$this->code = "";}
$this->dialog_url = "https://www.facebook.com/dialog/oauth?client_id=".$this->appId."&redirect_uri=".urlencode($this->appUrl)."&scope=";
if(empty($this->code)){
echo("<script>top.location.href='".$this->dialog_url."'</script>");
}
$this->access_token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$this->appId."&redirect_uri=".$this->appUrl."&client_secret=".$this->appSecret."&code=".$this->code);
}
public function getinfo() { 
if($this->user = json_decode(file_get_contents('https://graph.facebook.com/me?'.$this->access_token))){ 

$r['name'] = $this->user->name;
$r['first_name'] = $this->user->first_name;
$r['last_name'] = $this->user->last_name;
$r['url_perfil'] = $this->user->link;
$r['genero'] = $this->abr_gender[$this->user->gender];
$r['link'] = $this->user->link;

if(isset($this->permissions['user_birthday'])) {
$r['birthday'] = $this->user->birthday;
}
 
$r['url_thumb'] = "https://graph.facebook.com/me/picture?type=large&".$this->access_token;
return $r; 
} else
return array();
}
}
?>