<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <?php
      /*================================================================================*/
        //require composer laoder
        require 'vendor/autoload.php';

        //bunch of variables
        //dark to light array collection
        $string = array('@','#','$','&','*','!',';',':','~','-',',','.','=', '=');

        $imagine = new Imagine\Gd\Imagine();
        $filename = 'glasses.png';
        $lineheight = 10;
        $fontsize = $lineheight * 2;

        //grab image
        $image = $imagine->open($filename);

        //get size
        $width = $image->getSize()
          ->getWidth();
        $height = $image->getSize()
          ->getHeight();

        //calculate new width
        $newWidth = round($width / 2.5);
        $newHeight = round($height / 2.5);

        //instanciate new size and mode for thumbnail method
        $size = new Imagine\Image\Box($newWidth, $newHeight);
        $mode = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

        $newfilename = 'v2'.$filename;

        //crop the image using thumnail method and save it
        $image->thumbnail($size, $mode)
          ->save($newfilename);

        //get new image to analyze pixel by pixel to draw ascii
        $source = imagecreatefrompng($newfilename);

        //paste character in a pre html tag
        echo '<pre class="white" style="font: ' . $fontsize . 'px/' . $lineheight . 'px monospace; text-align: center;">';
        //loop through all pixel by
        //every row of every column
        for($h = 0; $h < $newHeight; $h++){
          for($w = 0; $w <= $newWidth; $w++){
            //if it is the last row
            if($w == $newWidth){
              echo "\n";
              continue;
            }
            //get colorindex
            $colorindex = imagecolorat($source, $w, $h);
            //get colorindex rgb
            $rgb = imagecolorsforindex($source, $colorindex);
            //get the dark - light number and generate value from string array
            $value = max($rgb['red'], $rgb['green'], $rgb['blue'])/255;
            //echo $value;
            echo generate($value);
          }
        }
        echo '</pre>';

        function generate($value){
          global $string;
          $length = count($string) - 1;
          return $string[intval($value * $length, 10)];
        }

        function dd($data){
          var_dump($data);
          die();
        }
      /*================================================================================*/
    ?>
  </body>
</html>
