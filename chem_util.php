<?php

function compoundBrk($element){

	// Returns : array in format
    //     array(4) { 
    //       [0]=> array(2) { [0]=> string(1) "C" [1]=> string(1) "2" } 
    //       [1]=> array(2) { [0]=> string(1) "H" [1]=> string(1) "5" } 
    //       [2]=> array(2) { [0]=> string(1) "O" [1]=> string(1) "1" } 
    //       [3]=> array(2) { [0]=> string(1) "H" [1]=> string(1) "1" } 
    //     } 

	$elm_array = array(array());
	$x=0;
	$elem='';
	$amt='';
	$Pos=-1;   // hod location in elm_array, start at -1 so first element goes in as 0
	$factor='';
	$moles = 1;
	$moleloc = 0;  //set to 1 if any first character is not a number

	$data = array(array());

 //  Parse the element and place into an array
	While ($x < strlen($element)) {
		$chr=substr($element, $x, 1);
		if (ord($chr)>64 and ord($chr)<91){         //A-Z
			$moleloc = 1;
			if(strlen($elem)>0){
				$Pos=$Pos+1;
				$elm_array[$Pos][0]=$elem;
				if ($factor=='') {
					if ($amt=='')
						$amt='1';
					$elm_array[$Pos][1]=$amt;
				}	
				else {
					if ($amt=='')
						$amt=$factor;
					else 
						$amt = (string)((int)$amt * (int)$factor);
					$elm_array[$Pos][1]=$amt;											
				}										
				$elem='';
				$amt='';
			}
			$elem=$chr;
		}
		else if (ord($chr)>96 and ord($chr)<123) {   // a-z
			$elem=$elem . $chr;
			$moleloc = 1;
		}
		else if (ord($chr)>47 and ord($chr)<58){     // 0-9
			if ($elem!='')
				$amt= $amt . $chr;
			if ($moleloc==0) {
				if ($x==0)
					$moles = $chr;
				else
				    $moles = $moles . $chr;
			}
		}
     else if ((ord($chr))==40){           //    char (
     	$moleloc = 1;
     	$compound='T';
     	if(strlen($elem)>0){
     		$Pos=$Pos+1;
     		$elm_array[$Pos][0]=$elem;
     		if ($amt=='')
     			$amt='1';
     		$elm_array[$Pos][1]=$amt;										
     		$elem='';
     		$amt='';
     	}		
       //  read until we hit the ) and find the number_format
     	$y=$x+1;
     	while ($y < strlen($element)){
     		$chr=substr($element, $y, 1);										
     		if ((ord($chr))==41 )
     			break;
     		$y=$y+1;
     	}  
       //  puled the factor for the compound
     	$y=$y+1;
     	while ($y < strlen($element)){
     		$chr=substr($element, $y, 1);										
     		if (ord($chr)>47 and ord($chr)<58)
     			$factor=$factor . $chr;
     		else 
     			break;
     		$y=$y+1;
     	}	 
     }
     else if ((ord($chr))==41){           //    char )
     	$moleloc = 1;
     	$compound='F';
     	if(strlen($elem)>0){
     		$Pos=$Pos+1;
     		$elm_array[$Pos][0]=$elem;
     		if ($factor=='') {
     			if ($amt=='')
     				$amt='1';
     			$elm_array[$Pos][1]=$amt;
     		}	
     		else {
     			if ($amt=='')
     				$amt=$factor;
     			else 
     				$amt = (string)((int)$amt * (int)$factor);
     			$elm_array[$Pos][1]=$amt;											
     		}										
     		$elem='';
     		$amt='';
     	}
     	$factor='';
     }							   
     else
     	echo 'Bad Element ' .$chr . '!';                      
     $x=$x+1;
 }

// finished parsing, record the last element to enter
 if ($elem != '') {
      $Pos=$Pos+1;
      $elm_array[$Pos][0]=$elem;							
      if ($factor=='') {
        if ($amt=='')
             $amt='1';
	    $elm_array[$Pos][1]=$amt;
      }	
      else {
	     if ($amt=='')
	        $amt=$factor;
	     else 
	        $amt = (string)((int)$amt * (int)$factor);
	     $elm_array[$Pos][1]=$amt;											
      }	
  }


  //  increase all elements by the number of moles
  if ($moles > 1){
  	  for ($x=0; $x<$Pos+1; $x++) {
  	  	$elm_array[$x][1]= ((int)$elm_array[$x][1] * $moles);
  	  }
  }
  //  join duplicte elements
  $loc=0;
  foreach($elm_array as $atom){
  	$process=0;
  	$elem=$atom[0];
  	$amt=$atom[1];
  	if ($loc > 0 ) {
  	   $pos=0;
  	   foreach($data as $cur){
  	   	   $elem_cpr = $cur[0];
  		   if ($elem_cpr == $elem){
  			   $process=1;
  			   $data[$pos][1] = $data[$pos][1]+$amt;
  			}
  			$pos++;
  		}
  	}
  	if ($process == 0) {
  		$data[$loc][0] = $elem;
  		$data[$loc][1] = $amt;
  		$loc++;
  	}
  }
return $data;

}

?>