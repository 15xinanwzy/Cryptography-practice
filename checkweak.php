<?php

function strength($psw){
  $score = 0;
  $str = $psw;

  if(preg_match("/[0-9]/",$str))//全为数字

  {

  $score ++;

  }
 if(preg_match("/[a-z]/",$str))//全为小写字母

  {

  $score ++;

  }

  if(preg_match("/[A-Z]/",$str))//全为大写字母

  {

  $score ++;

  }
  if(preg_match("/(.[^a-zA-Z0-9])/",$str))//

  {

  $score ++;

  }

  if(strlen($str)<6)//长度小于6位

  {

  $score=0;

  }
  if(strlen($str)>=8)//长度小于6位

  {

  $score++;

  }

  //echo $score;
  return $score;
}
?>
