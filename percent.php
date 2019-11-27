<!DOCTYPE HTML>
<html>
<?php
require_once 'init.php';
require_once 'chem_util.php';

if(isset($_POST['parse'])){ 
	$element=$_POST['c_element'];
	$data = compoundBrk($element);
} 
?>

<head>
	<title>Sea Kritters - Percent of Composition</title>
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
		<h1>Compound Percent of Composition</h1>
		<p>Enter a compound and the elements and the percent of composition will be calculated.</p>
	</section>

	<!-- One -->
	<section id="one" class="wrapper">
		<div class="inner">
			<div class="flex flex-3">
				<article>
					<form action="" method="post" enctype="multipart/form-data">
						<?php
						if(isset($_POST['c_element'])){
							$c_element = $_POST['c_element'];
						}
						else
							$c_element = "";		
						?>
						<p>Enter Element: <input type="text" name="c_element" value="<?=$c_element;?>" required /></p>

						<input type="submit" name="parse" value="Analyze" />
					</form>
				</article>
				<article>
					<?php
					if(isset($_POST['c_element'])){
						?>
						<table align="center" width="750">
							<tr align="center">
								<td colspan="6">Element</td>
								<td colspan="2">Amount</td>	
								<td colspan="2">Weight</td>		
								<td colspan="2">Total Weight</td>									   
							</tr>

							<?php
							$lp=0;
							$totalWeight=0.0;						   
							$ctr=count($data);
							while($lp<$ctr):   ?>
                              <?php     //    pull element weight
                                  $elmlookup ="select * from elements where Symbol = '" . $data[$lp][0]."'" ;
                                  $result=$db->query($elmlookup);
                                  $dbElement = mysqli_fetch_assoc($result);
                                  $data[$lp][2]=$dbElement['Mass'];

                               ?>
                              <tr>
	                             <td colspan="6"><?= $data[$lp][0];?></td>
	                             <td colspan="2"><?= $data[$lp][1];?></td>	
	                             <td colspan="2"><?= $dbElement['Mass'];?></td>								 
	                             <td colspan="2"><?= ((int)$data[$lp][1] * $dbElement['Mass']);?></td>
                              </tr>
                              <?php    
                                 $totalWeight=$totalWeight + ((int)$data[$lp][1] * $dbElement['Mass']) ;
                                 $lp = $lp +1;
                              ?>
                              <?php   endwhile;   ?>
                              <td colspan="6"></td>
                              <td colspan="2"></td>	
                              <td colspan="2"></td>								 
                              <td colspan="2"><?= $totalWeight;?></td>							
                        </table>
                     <?php } ?>   
                </article>

                <article>    
                    <?php      // display the percentage
					if(isset($_POST['c_element'])){
					?>
                       <table align="center" width="750">
                          <tr align="center">
	                         <td colspan="6">Element</td>
	                         <td colspan="6">Percent</td>	
	                      </tr>

                          <?php
                             $lp=0;
                            $ctr=count($data);
                            while($lp<$ctr):   ?>
                               <tr>
                                  <td colspan="6"><?= $data[$lp][0];?></td>
	                              <td colspan="6"><?= round(((((int)$data[$lp][1] * $data[$lp][2]) / $totalWeight )* 100),3);?></td>
	                           </tr>
                              <?php    
                                 $lp = $lp +1;
                              ?>
                              <?php   endwhile;   ?>
	                   </table>
				    <?php } ?>  
                </article>
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