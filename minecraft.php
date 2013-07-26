<?php

$size = isset($_GET['s']) ? max(8,min(250,$_GET['s'])) : 48;
$user = isset($_GET['u']) ? $_GET['u'] : 'char';

function get_avatar($user = 'char') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://s3.amazonaws.com/MinecraftSkins/' . $user . '.png');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $output = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($status!='200') {
        // Default Avatar: http://www.minecraft.net/skin/char.png
        $output = 'R0lGODlhMAAQAPUuALV7Z6p9ZkUiDkEhDIpMPSgcC2pAMFI9ibSEbZxpTP///7uJciodDTMkEYNVO7eCcpZfQJBeQ5xjRkIdCsaWgL2OdL';
        $output .= '6IbL2OcqJqRyweDj8qFXpOMy8fDyQYCC8gDUIqEiYaCraJbL2Lco9ePoBTNG1DKpxyXK2AbbN7Yqx2WjQlEoFTOW9FLCseDQAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QRD94cDIzRThDRkQwQzcyIiB4';
        $output .= 'bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkU2RTVBQzAwMDFwYWNrZXQgZW5kPSJyIj8+ACH5BAUAAC4ALAAAAAAwABAAQAZkQJdwSCwaj';
        $output .= '8ik0uVpcQodUIuxrFqv2OwRoTgAFgdFQEsum8/ocit0oYgqKVVaG4EMCATBaDXv+/+AgYKDVS2GDR8aGQWESAEIAScmCwkJjUcSKA8GBh';
        $output .= 'YYJJdGLCUDEwICDhuEQQA7';
        $output = base64_decode($output);
    }
    return $output;
}

$skin = get_avatar($user);

$im = imagecreatefromstring($skin);
$av = imagecreatetruecolor($size,$size);
imagecopyresized($av,$im,0,0,8,8,$size,$size,8,8);    // Face
imagecolortransparent($im,imagecolorat($im,63,0));    // Black Hat Issue
imagecopyresized($av,$im,0,0,40,8,$size,$size,8,8);   // Accessories
header('Content-type: image/png');
imagepng($av);
imagedestroy($im);
imagedestroy($av);

?>