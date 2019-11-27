<!DOCTYPE HTML>
<html>
<?php
 require_once 'init.php';
 require_once 'chem_util.php';

if(isset($_POST['process'])){ 
         $c_element = $_POST['c_element'];
         $p_grams = $_POST['c_grams'];
         $p_atoms = $_POST['c_atoms'];
         $p_moles = $_POST['c_moles'];


         $data = compoundBrk($c_element);
         
         $lp=0;
         $m_mass=0;
         $ctr=count($data);
         while($lp<$ctr):  


            $elmlookup ="select * from elements where Symbol = '" . $data[$lp][0]."'" ;
	        $result=$db->query($elmlookup);
	        $dbElement = mysqli_fetch_assoc($result);
            $m_mass =  $m_mass + ($dbElement['Mass'] * (int)$data[$lp][1]);
            $lp=$lp+1;

        endwhile;


         if ($p_grams != "") {
            echo '<script language="javascript">';
            $c_moles = $p_grams / $m_mass;
            $c_grams = $p_grams;
            $c_atoms = $c_moles * 602200000000000000000000;
            echo '</script>';
         }
         else if ($p_moles != "") {
            echo '<script language="javascript">';
            $c_moles = $p_moles;
            $c_grams = $m_mass * $p_moles;
            $c_atoms = $c_moles * 602200000000000000000000;
            echo '</script>';
         }
         else if ($p_atoms != "") {
            echo '<script language="javascript">';
            $c_atoms = $p_atoms;
            $snot = +$p_atoms;
            $c_moles = $snot/602200000000000000000000;
            $c_grams = $c_moles  * $m_mass;
            echo '</script>';
         }






}
else {
         $c_element = "";
         $c_atoms = "";
         $c_grams = "";	
         $c_moles = "";	
}


if(isset($_POST['clear'])){ 
         $c_element = "";
         $c_atoms = "";
         $c_grams = "";	
         $c_moles = "";
}
?>





	<head>
		<title>Sea Kritters - Compound Weight Calculator</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
                <meta name="description" content="Chemistry Homework Helper">
                <meta name="keywords" content="Chemistry, Compound Calculator, Element">
                <meta name="author" content="Jeff Compell">
		<link rel="stylesheet" href="assets/css/main.css" />


          <script language="javascript">
            function isExpKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
               if ((charCode < 48 || charCode > 57) && (!(charCode == 69 || charCode == 46)))
                 return false;
               return true;
            }
          </script>




          <script language="javascript">
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
               if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
                 return false;
               return true;
            }
          </script>



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
				<h1>Compound Weight Calculator</h1>
				<p>Enter a compund and the elements and total weight will be calculated.</p>
			</section>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner">
					<div class="flex flex-3">
			        	     <article>
                                                   <form action="" method="post" enctype="multipart/form-data">
                                                        <p>Enter Element: <input type="text" name="c_element" value="<?=$c_element;?>" required /></p>
                                                         <p>Grams: <input type="text" name="c_grams" value="<?=$c_grams;?>" onkeypress="return isNumberKey(event)" /></p>

						</article>
						<article>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        <p>Moles: <input type="text" name="c_moles" value="<?=$c_moles;?>" onkeypress="return isNumberKey(event)" /></p>
                                                        <input type="submit" name="clear" value="clear" />

						</article>
						<article>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        <p>Atoms: (ex 1.23E23) <input type="text" name="c_atoms" value="<?=$c_atoms;?>" onkeypress="return isExpKey(event)" /></p>
                                                        <input type="submit" name="process" value="Analyze" />

						</article>
                                              </form>
					</div>
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