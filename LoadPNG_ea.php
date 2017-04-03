<?php
//function by Przemys³aw Cios
function LoadPNG_ea($nazwa_zbioru)
{   
    

  
    $nazwa_zbioru_cala="$nazwa_zbioru";
     
    $nazwa_zbioru_f = @imagecreatefrompng($nazwa_zbioru_cala);
      $rozmiar		= GetImageSize($nazwa_zbioru_cala);
  
   
    if(!$nazwa_zbioru_f)
    {
       
        $nazwa_zbioru_f  = imagecreatetruecolor($rozmiar[0], $rozmiar[1]);
        $bgc = imagecolorallocate($nazwa_zbioru_f, 255, 255, 255);
        $tc  = imagecolorallocate($nazwa_zbioru_f, 255, 255, 255);// 0 0 0
      

        imagefilledrectangle(@imagecreatefrompng($nazwa_zbioru_cala), 255, 255, $rozmiar[0],$rozmiar[1] , $bgc);

       
        //imagestring($nazwa_zbioru_f, 1, 5, 5, 'Error loading ' . $nazwa_zbioru_cala, $tc);
    }

    return $nazwa_zbioru_f;
}
?>
