<?php
  //array that'll contain color's letter
  $string = 'abcdefghijklmnopqrstuvwxyz01234567890';
  $associations = array();

  //grab image
  //WIP detect extension
  //and use appropriate function ex: for jpg or png
  $img = imagecreatefrompng('globe.png');

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
<br>
<p>salutt</p>
