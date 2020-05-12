<?php

/*
Title:      Minecraft Avatar
URL:        http://github.com/jamiebicknell/Minecraft-Avatar
Author:     Jamie Bicknell
Twitter:    @jamiebicknell
*/

$size = isset($_GET['s']) ? max(40, min(800, $_GET['s'])) : 250;
$user = isset($_GET['u']) ? $_GET['u'] : '';
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

$g = 4;
$p = ($size / 100) * 5;
$s = floor(($size - ($p * 2)) / (48 + ($g * 3)));
$p = floor(($size - ($s * (48 + ($g * 3)))) / 2);
$h = ($s * 32) + ($p * 2);

$im = imagecreatefromstring($skin);
$av = imagecreatetruecolor($size, $h);
imagesavealpha($av, true);
imagefill($av, 0, 0, imagecolorallocatealpha($av, 0, 0, 0, 127));

if (imagesy($im) > 32) {
    // 1.8+ Skin
    if ((imagecolorat($im, 54, 20) >> 24) & 0x7F == 127) {
        // Alex Style Skin (3px Arm Width)
        // Front
        imagecopyresized($av, $im, $p + $s * 4, $p, 8, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8, 20, 20, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p + $s * 1, $p + $s * 8, 44, 20, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * 12, $p + $s * 8, 36, 52, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8 + $s * 12, 4, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 8, $p + $s * 8 + $s * 12, 20, 52, $s * 4, $s * 12, 4, 12);

        // Right
        imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 0, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8, 40, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8 + $s * 12, 0, 20, $s * 4, $s * 12, 4, 12);

        // Back
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 24, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8, 32, 20, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 25, $p + $s * 8, 43, 52, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 36, $p + $s * 8, 51, 20, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8 + $s * 12, 28, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 32, $p + $s * 8 + $s * 12, 12, 20, $s * 4, $s * 12, 4, 12);

        // Left
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 16, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8, 39, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8 +$s * 12, 24, 52, $s * 4, $s * 12, 4, 12);

        // Black Hat Issue
        imagecolortransparent($im, imagecolorat($im, 63, 0));

        // Face Accessories
        imagecopyresized($av, $im, $p + $s * 4, $p, 40, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 32, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 56, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 48, 8, $s * 8, $s * 8, 8, 8);
    
        // Body Accessories
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8, 20, 36, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8, 32, 36, $s * 8, $s * 12, 8, 12);
    
        // Arm Accessores
        imagecopyresized($av, $im, $p + $s * 1, $p + $s * 8, 44, 36, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * 12, $p + $s * 8, 52, 52, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 25, $p + $s * 8, 59, 52, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 36, $p + $s * 8, 51, 36, $s * 3, $s * 12, 3, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8, 40, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8, 55, 52, $s * 4, $s * 12, 4, 12);
    
        // Leg Accessores
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8 + $s * 12, 4, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 8, $p + $s * 8 + $s * 12, 4, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8 + $s * 12, 0, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8 + $s * 12, 12, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 32, $p + $s * 8 + $s * 12, 12, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8 +$s * 12, 8, 52, $s * 4, $s * 12, 4, 12);
    } else {
        // Steve Style Skin (4px Arm Width)
        // Front
        imagecopyresized($av, $im, $p + $s * 4, $p, 8, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8, 20, 20, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p, $p + $s * 8, 44, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 12, $p + $s * 8, 36, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8 + $s * 12, 4, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 8, $p + $s * 8 + $s * 12, 20, 52, $s * 4, $s * 12, 4, 12);

        // Right
        imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 0, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8, 40, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8 + $s * 12, 0, 20, $s * 4, $s * 12, 4, 12);

        // Back
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 24, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8, 32, 20, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 24, $p + $s * 8, 44, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 36, $p + $s * 8, 52, 20, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8 + $s * 12, 28, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 32, $p + $s * 8 + $s * 12, 12, 20, $s * 4, $s * 12, 4, 12);

        // Left
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 16, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8, 40, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8 +$s * 12, 24, 52, $s * 4, $s * 12, 4, 12);

        // Black Hat Issue
        imagecolortransparent($im, imagecolorat($im, 63, 0));

        // Face Accessories
        imagecopyresized($av, $im, $p + $s * 4, $p, 40, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 32, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 56, 8, $s * 8, $s * 8, 8, 8);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 48, 8, $s * 8, $s * 8, 8, 8);

        // Body Accessories
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8, 20, 36, $s * 8, $s * 12, 8, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8, 32, 36, $s * 8, $s * 12, 8, 12);

        // Arm Accessores
        imagecopyresized($av, $im, $p, $p + $s * 8, 44, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 12, $p + $s * 8, 52, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 24, $p + $s * 8, 60, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 36, $p + $s * 8, 52, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8, 40, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8, 56, 52, $s * 4, $s * 12, 4, 12);

        // Leg Accessores
        imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8 + $s * 12, 4, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * 8, $p + $s * 8 + $s * 12, 4, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8 + $s * 12, 0, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8 + $s * 12, 12, 52, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 32, $p + $s * 8 + $s * 12, 12, 36, $s * 4, $s * 12, 4, 12);
        imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 42, $p + $s * 8 +$s * 12, 8, 52, $s * 4, $s * 12, 4, 12);
    }
} else {
    $mi = imagecreatetruecolor(64, 32);
    imagecopyresampled($mi, $im, 0, 0, 64 - 1, 0, 64, 32, -64, 32);
    imagesavealpha($mi, true);
    imagefill($mi, 0, 0, imagecolorallocatealpha($mi, 0, 0, 0, 127));
    
    // Front
    imagecopyresized($av, $im, $p + $s * 4, $p, 8, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8, 20, 20, $s * 8, $s * 12, 8, 12);
    imagecopyresized($av, $im, $p, $p + $s * 8, 44, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $mi, $p + $s * 12, $p + $s * 8, 16, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $im, $p + $s * 4, $p + $s * 8 + $s * 12, 4, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $mi, $p + $s * 8, $p + $s * 8 + $s * 12, 56, 20, $s * 4, $s * 12, 4, 12);

    // Right
    imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 0, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8, 40, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $im, $p + $s * $g + $s * 18, $p + $s * 8 + $s * 12, 0, 20, $s * 4, $s * 12, 4, 12);

    // Back
    imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 24, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p + $s * 8, 32, 20, $s * 8, $s * 12, 8, 12);
    imagecopyresized($av, $mi, $p + $s * $g * 2 + $s * 24, $p + $s * 8, 8, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 36, $p + $s * 8, 52, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $mi, $p + $s * $g * 2 + $s * 28, $p + $s * 8 + $s * 12, 48, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 32, $p + $s * 8 + $s * 12, 12, 20, $s * 4, $s * 12, 4, 12);

    // Left
    imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 16, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $mi, $p + $s * $g * 3 + $s * 42, $p + $s * 8, 20, 20, $s * 4, $s * 12, 4, 12);
    imagecopyresized($av, $mi, $p + $s * $g * 3 + $s * 42, $p + $s * 8 +$s * 12, 60, 20, $s * 4, $s * 12, 4, 12);

    // Black Hat Issue
    imagecolortransparent($im, imagecolorat($im, 63, 0));

    // Accessories
    imagecopyresized($av, $im, $p + $s * 4, $p, 40, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * $g + $s * 16, $p, 32, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * $g * 2 + $s * 28, $p, 56, 8, $s * 8, $s * 8, 8, 8);
    imagecopyresized($av, $im, $p + $s * $g * 3 + $s * 40, $p, 48, 8, $s * 8, $s * 8, 8, 8);
    
    imagedestroy($mi);
}

header('Content-type: image/png');
imagepng($av);
imagedestroy($im);
imagedestroy($av);
