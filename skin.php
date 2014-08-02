<?php

/*
Title:      Minecraft Avatar
URL:        http://github.com/jamiebicknell/Minecraft-Avatar
Author:     Jamie Bicknell
Twitter:    @jamiebicknell
*/

$size = isset($_GET['s']) ? max(40, min(800, $_GET['s'])) : 250;
$user = isset($_GET['u']) ? $_GET['u'] : 'char';

function get_skin($user = 'char')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://s3.amazonaws.com/MinecraftSkins/' . $user . '.png');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $output = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($status != '200') {
        // Default Skin: http://www.minecraft.net/skin/char.png
        $output = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAAAgCAMAAACVQ462AAAABGdBTUEAALGPC/xhBQAAAwBQTFRFAAAAHxALIxcJJBgIJBgKJhg';
        $output .= 'LJhoKJxsLJhoMKBsKKBsLKBoNKBwLKRwMKh0NKx4NKx4OLR0OLB4OLx8PLB4RLyANLSAQLyIRMiMQMyQRNCUSOigUPyoVKCgoP';
        $output .= 'z8/JiFbMChyAFtbAGBgAGhoAH9/Qh0KQSEMRSIOQioSUigmUTElYkMvbUMqb0UsakAwdUcvdEgvek4za2trOjGJUj2JRjqlVkn';
        $output .= 'MAJmZAJ6eAKioAK+vAMzMikw9gFM0hFIxhlM0gVM5g1U7h1U7h1g6ilk7iFo5j14+kF5Dll9All9BmmNEnGNFnGNGmmRKnGdIn';
        $output .= '2hJnGlMnWpPlm9bnHJcompHrHZaqn1ms3titXtnrYBttIRttolsvohst4Jyu4lyvYtyvY5yvY50xpaA////AAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $output .= 'AAAAAAAAAAAAAAAAAAAAAPSUN6AAAAQB0Uk5T/////////////////////////////////////////////////////////////';
        $output .= '//////////////////////////////////////////////////////////////////////////////////////////////////';
        $output .= '//////////////////////////////////////////////////////////////////////////////////////////////////';
        $output .= '///////////////////////////////////////////////////////////////////////////////////AFP3ByUAAAAYdEV';
        $output .= 'YdFNvZnR3YXJlAFBhaW50Lk5FVCB2My4zNqnn4iUAAAKjSURBVEhLpZSLVtNAEIYLpSlLSUITLCBaGhNBQRM01M2mSCoXNUURI';
        $output .= 'kZFxQvv/wz6724Wij2HCM7J6UyS/b+dmZ208rsww6jiqo4FhannZb5yDqjaNgDVwE/8JAmCMqF6fwGwbU0CKjD/+oAq9jcM27g';
        $output .= 'xAFpNQxU3Bwi9Ajy8fgmGZuvaGAcIuwFA12CGce1jJESr6/Ot1i3Tnq5qptFqzet1jRA1F2XHWQFAs3RzwTTNhQd3rOkFU7c0D';
        $output .= 'ijmohRg1TR9ZmpCN7/8+PX954fb+sTUjK7VLKOYi1IAaTQtUrfm8pP88/vTw8M5q06sZoOouSgHEDI5vrO/eHK28el04yxf3N8';
        $output .= 'ZnyQooZiLfwA0arNb6d6bj998/+vx8710a7bW4E2Uc1EKsEhz7WiQBK9eL29urrzsB8ngaK1JLDUXpYAkGSQH6e7640fL91dWX';
        $output .= 'jxZ33138PZggA+Sz0WQlAL4gmewuzC1uCenqXevMPWc9XrMX/VXh6Hicx4ByHEeAfRg/wtgSMAvz+CKEkYAnc5SpwuD4z70PM+';
        $output .= 'hUf+4348ixF7EGItjxmQcCx/Dzv/SOkuXAF3PdT3GIujjGLELNYwxhF7M4oi//wsgdlYZdMXCmEUUSsSu0OOBACMoBTiu62BdR';
        $output .= 'PEjYxozXFyIpK7IAE0IYa7jOBRqGlOK0BFq3Kdpup3DthFwP9QDlBCGKEECoHEBEDLAXHAQMQnI8jwFYRQw3AMOQAJoOADoAVc';
        $output .= 'DAh0HZAKQZUMZdC43kdeqAPwUBEsC+M4cIEq5KEEBCl90mR8CVR3nxwCdBBS9OAe020UGnXb7KcxzPY9SXoEEIBZtgE7UDgBKy';
        $output .= 'LMhgBS2YdzjMJb4XHRDAPiQhSGjNOxKQIZTgC8BiMECgarxprjjO0OXiV4MAf4A/x0nbcyiS5EAAAAASUVORK5CYII=';
        $output = base64_decode($output);
    }
    return $output;
}

$skin = get_skin($user);

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
    // 1.8+ skin
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
