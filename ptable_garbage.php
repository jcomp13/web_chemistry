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
   <table id="tblMain" border="0">
  <?php 
      for($row =1; $row < 8; $row++) {
      	  echo '<tr>';
          for($col =1; $col < 19; $col++) 
          { 
          	echo '<td>';
            $elmlookup ="select * from elements where row = " . $row . " and col=" .$col ;
	        $result=mysqli_query($db, $elmlookup);
//	        $dbElement = mysqli_fetch_assoc($result);
	        $num_results = mysqli_num_rows($result);
	        if ($num_results > 0) {

	             $dbElement = mysqli_fetch_assoc($result);

	             echo $dbElement['Number'] . '<br>';
	             echo $dbElement['Symbol'];

            }
           // else {
             //	echo "?";
           // }
	           echo '</td>'; 
          }    
          echo '</tr>';

      }
  ?>





  
   </table>

<p class="currElement"> </p>


<p id="msgBox"> </p>




 <script language="javascript">
        var tbl = document.getElementById("tblMain");
        if (tbl != null) {
            for (var i = 0; i < tbl.rows.length; i++) {
                for (var j = 0; j < tbl.rows[i].cells.length; j++)
                    tbl.rows[i].cells[j].onmouseover = function () { getval(this); };
            }
        }


        function getval(cel) {
          //  alert(cel.innerHTML);
          var ps = document.getElementsByClassName("currElement");
          for(var i = 0, len = ps.length; i < len; i++) {
               ps[i].innerHTML = "element number (" + cel.innerHTML + ")";
          }
          popTag(cel);
        }



        function popTag(cel){
        	cellValue = cel.innerHTML;
     //   	alert (celValue);
            var elemArray = cellValue.split('<');
            document.getElementById("msgBox").innerHTML = elemArray[0];
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