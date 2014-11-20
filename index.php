<?php
  //dark to light array collection
  $string = array('@','#','$','=','*','!',';',':','~','-',',','.','&nbsp;', '&nbsp;');

  //grab image
  //WIP detect extension
  //and use appropriate function ex: for jpg or png
  $img = imagecreatefrompng('example.png');

  //get width/height
  $width = imagesx($img);
  $height = imagesy($img);

  //paste character in a pre html tag
  echo '<pre>';
  //loop through all pixel by
  //every row of every column
  for($h=0; $h < $height; $h++){
    for($w=0; $w<=$width; $w++){
      //if it is the last row
      if($w == $width){
        echo "\n";
        continue;
      }
      //get colorindex
      $colorindex = imagecolorat($img, $w, $h);
      //get colorindex rgb
      $rgb = imagecolorsforindex($img, $colorindex);
      //get the dark - light number and generate value from string array
      $value = max($rgb['red'], $rgb['green'], $rgb['blue'])/255;
      echo generate($value);
    }
  }
  echo '</pre>';

  function generate($value){
    global $string;
    $length = count($string) - 1;
    return $string[intval($value * $length, 10)];
  }
?>
