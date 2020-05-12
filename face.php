<?php

/*
Title:      Minecraft Avatar
URL:        http://github.com/jamiebicknell/Minecraft-Avatar
Author:     Jamie Bicknell
Twitter:    @jamiebicknell
*/

$user = isset($_GET['u']) ? $_GET['u'] : '';
$size = isset($_GET['s']) ? max(8, min(250, $_GET['s'])) : 48;
$view = isset($_GET['v']) ? substr($_GET['v'], 0, 1) : 'f';
$view = in_array($view, array('f', 'l', 'r', 'b')) ? $view : 'f';
$hat = isset($_GET['h']) ? $_GET['h'] : true;
$uuid_url = 'https://api.mojang.com/users/profiles/minecraft/';
$img_url = 'https://sessionserver.mojang.com/session/minecraft/profile/';

function api_get($url,$user){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url.$user);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $output = json_decode($response, true);

    curl_close($curl);
    return $output;
};

if ($user!=''){
    $user_detail = api_get($uuid_url,$user);
    $enc_jsn = api_get($img_url,$user_detail['id']);
    $avater = json_decode(json_encode(json_decode(base64_decode($enc_jsn['properties'][0]['value']))), true);
    $skin = file_get_contents($avater['textures']['SKIN']['url']);
}else{
    $skin = file_get_contents('http://assets.mojang.com/SkinTemplates/steve.png');
};

$im = imagecreatefromstring($skin);
$av = imagecreatetruecolor($size, $size);

$x = array('f' => 8, 'l' => 16, 'r' => 0, 'b' => 24);

imagecopyresized($av, $im, 0, 0, $x[$view], 8, $size, $size, 8, 8);         // Face
imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
if ($hat) {
    imagecopyresized($av, $im, 0, 0, $x[$view] + 32, 8, $size, $size, 8, 8);    // Accessories
}


header('Content-type: image/png');
imagepng($av);
imagedestroy($im);
imagedestroy($av);
