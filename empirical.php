<!DOCTYPE HTML>
<html>
<?php
require_once 'init.php';
require_once 'chem_util.php';

if(isset($_POST['parse'])){ 
	$element1=$_POST['element1'];
	$weight1 = $_POST['weight1'];
	$element2=$_POST['element2'];
	$weight2 = $_POST['weight2'];
	$element3=$_POST['element3'];
	$weight3 = $_POST['weight3'];
	$element4=$_POST['element4'];
	$weight4 = $_POST['weight4'];
	$element5=$_POST['element5'];
	$weight5 = $_POST['weight5'];

    $cheminfo = array(array());
    $formula = array(array());
    $counter=0;


    $mol1 = $mol2 = $mol3 = $mol4 = $mol5 = 0;

    if (($element1 != "") && ($weight1 != "")){
         //    pull element weight
         $elmlookup ="select * from elements where Symbol = '" . $element1."'" ;
	     $result=$db->query($elmlookup);
         if (mysqli_num_rows($result)) {
    	     $dbElement = mysqli_fetch_assoc($result);
    	     $cheminfo[$counter][0] = $element1;
    	     $cheminfo[$counter++][1] = $weight1 / $dbElement['Mass'];
	     }    
    }
    if (($element2 != "") && ($weight2 != "")){
         //    pull element weight
         $elmlookup ="select * from elements where Symbol = '" . $element2."'" ;
	     $result=$db->query($elmlookup);
         if (mysqli_num_rows($result)) {
    	     $dbElement = mysqli_fetch_assoc($result);
    	     $cheminfo[$counter][0] = $element2;
    	     $cheminfo[$counter++][1] = $weight2 / $dbElement['Mass'];
	     }  
    }
    if (($element3 != "") && ($weight3 != "")){
         //    pull element weight
         $elmlookup ="select * from elements where Symbol = '" . $element3."'" ;
	     $result=$db->query($elmlookup);
         if (mysqli_num_rows($result)) {
    	     $dbElement = mysqli_fetch_assoc($result);
    	     $cheminfo[$counter][0] = $element3;
    	     $cheminfo[$counter++][1] = $weight3 / $dbElement['Mass'];
	     }  
    }
    if (($element4 != "") && ($weight4 != "")){
         //    pull element weight
         $elmlookup ="select * from elements where Symbol = '" . $element4."'" ;
	     $result=$db->query($elmlookup);
         if (mysqli_num_rows($result)) {
    	     $dbElement = mysqli_fetch_assoc($result);
    	     $cheminfo[$counter][0] = $element4;
    	     $cheminfo[$counter++][1] = $weight4 / $dbElement['Mass'];
	     }  
    }
    if (($element5 != "") && ($weight5 != "")){
         //    pull element weight
         $elmlookup ="select * from elements where Symbol = '" . $element5."'" ;
	     $result=$db->query($elmlookup);
         if (mysqli_num_rows($result)) {
    	     $dbElement = mysqli_fetch_assoc($result);
    	     $cheminfo[$counter][0] = $element5;
    	     $cheminfo[$counter++][1] = $weight5 / $dbElement['Mass'];
	     }  
    }  
    // find the smallest moleamt
    $min=999999;
    $min_pos=0;
    $cnt=0;
    foreach($cheminfo as $elem){
    	if ($elem[1]<$min) {
    		$min=$elem[1];
    		$min_pos=$cnt;
    	}
    	$cnt++;
    }

    $cnt=0;
    foreach($cheminfo as $elem){
    	$formula[$cnt][0] =$elem[0];
    	$formula[$cnt++][1] = (int)($elem[1] / $min);
    }
}
?>

	<head>
		<title>Sea Kritters - Calculating Empirical Formula</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
                <meta name="description" content="Chemistry Homework Helper">
                <meta name="keywords" content="Chemistry, Compound Calculator, Element">
                <meta name="author" content="Jeff Compell">
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">Class Home</a>
					<nav id="nav">
						<a href="index.html">Home</a>
						<a href="#">Generic</a>
						<a href="#">Elements</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h1>Calculating Empirical Formulas </h1>
				<p>Enter up to five elements and the empirical formula will be calculated.</p>
			</section>

		<!-- One -->
		<section class="wrapper">
			<?php
			if(isset($_POST['element1'])){
				$element1 = $_POST['element1'];
				$weight1 = $_POST['weight1'];
			} else {
				$element1 = "";	
				$weight1 = "";
			}	
			if(isset($_POST['element2'])){
				$element2 = $_POST['element2'];
				$weight2 = $_POST['weight2'];
			} else {
				$element2 = "";	
				$weight2 = "";
			}	
			if(isset($_POST['element3'])){
				$element3 = $_POST['element3'];
				$weight3 = $_POST['weight3'];
			} else {
				$element3 = "";	
				$weight3 = "";
			}	
			if(isset($_POST['element4'])){
				$element4 = $_POST['element4'];
				$weight4 = $_POST['weight4'];
			} else {
				$element4 = "";	
				$weight4 = "";
			}	
			if(isset($_POST['element5'])){
				$element5 = $_POST['element5'];
				$weight5 = $_POST['weight5'];
			} else {
				$element5 = "";	
				$weight5 = "";
			}	
			?>

			<div class="container">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-8">
							<table class="table table-bordered table-condensed table-striped">
								<thead><th>#</th><th>Element</th><th>grams</th></thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><input type="text" name="element1" value="<?=$element1;?>" required /></td>
										<td><input type="text" name="weight1" value="<?=$weight1;?>" required /></td>
									</tr>  
									<tr>
										<td>2</td>
										<td><input type="text" name="element2" value="<?=$element2;?>" /></td>
										<td><input type="text" name="weight2" value="<?=$weight2;?>" /></td>
									</tr> 
									<tr>
										<td>3</td>
										<td><input type="text" name="element3" value="<?=$element3;?>"  /></td>
										<td><input type="text" name="weight3" value="<?=$weight3;?>"  /></td>
									</tr> 
									<tr>
										<td>4</td>
										<td><input type="text" name="element4" value="<?=$element4;?>"  /></td>
										<td><input type="text" name="weight4" value="<?=$weight4;?>" /></td>
									</tr> 
									<tr>
										<td>5</td>
										<td><input type="text" name="element5" value="<?=$element5;?>"  /></td>
										<td><input type="text" name="weight5" value="<?=$weight5;?>" /></td>
									</tr> 
								</tbody>
							</table>
							<input type="submit" name="parse" value="Calculate" />
						</div>
                        <div>


                           <?php
                            $display_elem="";
                            if(isset($_POST['element1'])){
                            	foreach($formula as $elem){
						            $display_elem = $display_elem . $elem[0]; 
						            if ($elem[1] > 1) {
						                $display_elem = $display_elem . $elem[1]; 						            	
						            }
						        }
						        echo '<h1>' . $display_elem . '</h1>';
						    }        
						    ?>
						</div>     
					</div>
				</form>
			</div>
		</section>



		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; SeaKritters.com
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest-p"><span class="label">Pinterest</span></a></li>
							<li><a href="#" class="icon fa-vimeo"><span class="label">Vimeo</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>