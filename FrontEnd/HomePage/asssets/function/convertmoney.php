<?php

require_once ('reverseString.php');
function convertmoney($price)
{
    $numlenstr=strlen($price);
    $strtemp='';
    $temp2= substr($price,2,4);
    if($numlenstr !=0)
    {
    
        while(true)
        {
            // 8-5-2 15.160.000
            // 9-6-3 109.160.000
            // 7-4-1 9.160.000 
            // 6-3-0
            if($numlenstr >3  ) //0-1-2
            {
                $temp= substr($price,$numlenstr-3,3);
                if($strtemp=='')
                {
                    $strtemp=reverseString($temp).',';
                }
                else {
                    $strtemp.=reverseString($temp).',';
                }
                $numlenstr=$numlenstr-3;
            }
            else {
                break;
            }
        }
        $strtemp=$strtemp.reverseString(substr($price,0,$numlenstr));
        
    }
    $endstr = reverseString($strtemp);
    return $endstr;
} 
?>