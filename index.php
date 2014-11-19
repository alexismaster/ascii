<?php
  //array that'll contain color's letter
  $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890';
  $associations = array();

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
      $r = ($colorindex >> 16) & 0xFF;
      $g = ($colorindex >> 8 ) & 0xFF;
      $b = $colorindex & 0xFF;

      //check for white and offwhite
      if($r > 200 && $g > 200 && $b > 200){
       echo '=';
       continue;
      }

      //check if exist in association, if it does, echo
      //if it doesnt, add it and echo it
      if (!isset($associations[$colorindex])){
        $associations[$colorindex] = generate();
      }
      echo $associations[$colorindex];
    }
  }
  echo '</pre>';

  function generate(){
    global $string;
    str_shuffle($string);
    return $string[mt_rand(0, strlen($string))];
  }
?>
