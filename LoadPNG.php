<?php
//function by Przemys³aw Cios
function LoadPNG($nazwa_zbioru)
{   $sciezka="http://pluton/barcode/code39.php?kod=";
    $nazwa_zbioru_cala="$sciezka$nazwa_zbioru";
    $nazwa_zbioru_f = @imagecreatefrompng($nazwa_zbioru_cala);
         
   
    if(!$nazwa_zbioru_f)
    {
       
        $nazwa_zbioru_f  = imagecreatetruecolor(780, 83);
        $bgc = imagecolorallocate($nazwa_zbioru_f, 0, 0, 0);
        $tc  = imagecolorallocate($nazwa_zbioru_f, 255, 255, 255);// 0 0 0

        imagefilledrectangle(@imagecreatefrompng($nazwa_zbioru_cala), 320, 0, 780, 83, $bgc);

       
        imagestring($nazwa_zbioru_f, 1, 5, 5, 'Error loading ' . $nazwa_zbioru_cala, $tc);
    }

    return $nazwa_zbioru_f;
}
?>
