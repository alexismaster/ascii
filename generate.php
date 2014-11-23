<?php
  require 'inc/config.php';

  /*================================================================================*/
  //check post img first
  $destination = 'tmp/' . basename($_FILES["file"]["name"]);
  $imageFileType = pathinfo($destination, PATHINFO_EXTENSION);
  $postpath = '';
  $return = false;

  //if post, treat image
  //else return
  if(isset($_POST["submit"])) {
    $postpath = $_FILES["file"]["tmp_name"];
    //img verification
    if (!checkImg() || !checkSize())
      $return = true;
  }
  else{
    $return = true;
  }

  //if there's error
  //dont go further
  if ($return){
    echo 'Could not proceed';
    return false;
  }

  //post image validation has passes, now generate the img
  //require composer laoder
  require 'vendor/autoload.php';

  //bunch of variables
  //dark to light array collection
  $string = array('@','#','$','&','*','!',';',':','~','-',',','.','=', '=');

  $imagine = new Imagine\Gd\Imagine();
  $lineheight = 10;
  $fontsize = $lineheight * 2;

  //grab image
  $image = $imagine->open($postpath);

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

  //crop the image using thumnail method and save it
  $image->thumbnail($size, $mode)
    ->save($destination);

  //get new image to analyze pixel by pixel to draw ascii
  $source = imagecreatefrompng($destination);

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
      echo generate($value);
    }
  }
  echo '</pre>';

  //we returned the ascii output, now delete the tmp img
  unlink($destination);

  //get value from color
  function generate($value){
    global $string;
    $length = count($string) - 1;
    return $string[intval($value * $length, 10)];
  }

  //check if real image
  function checkImg(){
    global $postpath;
    return getimagesize($postpath) !== false;
  }

  //check is below 1mb
  function checkSize(){
    global $postpath;
    return (filesize($postpath) / 1000000) < 1;
  }
  /*================================================================================*/
?>
