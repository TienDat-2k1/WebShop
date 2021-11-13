<?php
 function reverseString($str1)  
 {  
  $n = strlen($str1);  
  if($n == 1||$n==0)  
  {  
     return $str1;  
  }  
  else  
  {  
    $n--;  
    return reverseString(substr($str1,1, $n)) . substr($str1, 0, 1);  
  }  
 }  
?>