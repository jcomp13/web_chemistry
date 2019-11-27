<!DOCTYPE html>
<?php
 require_once 'init.php';
 ?>


<html>
<head>
	<title>Table of Elements</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
                <meta name="description" content="Chemistry Homework Helper">
                <meta name="keywords" content="Chemistry, Compound Calculator, Element">
                <meta name="author" content="Jeff Compell">
		<link rel="stylesheet" href="assets/css/main.css" />




     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1"> 


    <link rel="stylesheet" href="css/bootstrap.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<script src="js/bootstrap.min.js"></script>

	
	<link rel="stylesheet" href="css/main.css">	
</head>
<body>

<div class="container">
    <div class="table-responsive">
      <table>
         <tr>
            <td id="msgBox">&nbsp;<br/><br/><br/><br/>
            </td>
         </tr>
      </table>
   </div>       
</div>


<!--              -->

<div class="container-fluid">
 <div class="table-responsive">
   <table id="tblMain" border="0">
  <?php 
      for($row =1; $row < 11; $row++) {
      	  echo '<tr>';
          for($col =1; $col < 19; $col++) 
          { 
            $elmlookup ="select * from elements e 
                 join elem_type t on t.id = e.family
                 where e.row = " . $row . " and e.col=" .$col ;
	        $result=mysqli_query($db, $elmlookup);
//	        $dbElement = mysqli_fetch_assoc($result);
	        $num_results = mysqli_num_rows($result);
	        if ($num_results > 0) {

	             $dbElement = mysqli_fetch_assoc($result);
          	     echo '<td class=' . $dbElement['classinfo']   .'>';
	             echo $dbElement['Number'] . '<br>';
	             echo $dbElement['Symbol'] . '<br>';
	             echo '<span style="font-size:75%;">' . $dbElement['Name'] . '</span><br>';
	             echo '<span style="font-size:75%;">' . $dbElement['Mass'] . '</span><br>';
            }
            else{
            	 echo '<td>&nbsp;';
            }

           echo '</td>'; 
          }    
          echo '</tr>';

      }
  ?>





  
   </table>
  </div> 

<p class="currElement"> </p>


<p id="msgBox"> &nbsp;</p>

</div>


 <script language="javascript">
        var tbl = document.getElementById("tblMain");
        if (tbl != null) {
            for (var i = 0; i < tbl.rows.length; i++) {
                for (var j = 0; j < tbl.rows[i].cells.length; j++)
                    tbl.rows[i].cells[j].onmouseover = function () { getval(this); };
            }
        }


        function getval(cel) {
          var ps = document.getElementsByClassName("currElement");
         // for(var i = 0, len = ps.length; i < len; i++) {
         //      ps[i].innerHTML = "element number (" + cel.innerHTML + ")";
         //  }
           parseTag(cel);
        }


        function parseTag(cel){
        	  var inCSS = 0
        	  var newSTR="";
        	  var res;
        	  var str = cel.innerHTML;
        	 for(var i = 0, len = str.length; i < len; i++) {
                res = str.charAt(i);
        	 	if (inCSS == 1) {
        	 		if (res === '>'){
        	 			inCSS=0;
        	 			//  check to make sure look-ahear char is not a "<"
        	 			if (i+1 < str.length){
        	 				if (str.charAt(i+1) != '<'){
        	 					newSTR += '|';
        	 				}
        	 			}
        	 		}
        	 	}
        	 	else if (res === '<') {
        	 		inCSS = 1;
        	 	}
        	 	else {
        	 		newSTR += res;
        	 	}
        	 }
        //	 alert(newSTR);
             popTag2(newSTR);
        }

        function popTag2(info){
        	var elemArray = info.split('|');
        	if (elemArray[0] > 0) {
               document.getElementById("msgBox").innerHTML = elemArray[0] +  '<br>' + elemArray[1] + '<br>' + elemArray[2] + '<br>' + elemArray[3];
        	}
        	else {
        		document.getElementById("msgBox").innerHTML =  '<br>' +  '<br>' + '<br>' + '<br>'; 
        	}

        }


        function popTag(cel){
        	cellValue = cel.innerHTML;
        //	alert (cellValue);
        	if (cel != "") {
               var elemArray = cellValue.split('<');
         //      alert(elemArray);
               document.getElementById("msgBox").innerHTML = elemArray[0];

           }
           else {
           	    alert ("null info");
            	document.getElementById("msgBox").innerHTML = "test";
           }
      //      document.getElementById("msgBox").innerHTML = cellValue;

	
        }




          // input = cel.innerHTML;
          // break the string
  //        var count=0;
  //        for (i=0; i < input.length; i++){
  //            if (input[i] == '<')
  //            	break;
  //            else
  //            	count++;
  //        }
  //        var srchNum = input.substring(0,count);    
 //         alert(srchNum);


  //        document.getElementsById("currElement").innerHTML = "New text inside the text element!"

 //         ps[i].innerHtml = srchNum;
//

//          }
 //       }

    </script>



</body>



</html>