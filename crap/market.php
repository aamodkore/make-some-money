<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	if ($_SESSION['id']!='aamod' && $_SESSION['id']!='admin') {
?>
	<meta http-equiv="refresh" content="0;url=./index.php">
<?php
 	}

 	else {
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Mood Indigo 2012: MSM Market</title>
	</head>
	<body>
	<center>
	<!-- <img src="images/kfc2.jpg" height="1000" id="backimg" /> -->
	<?php
		require_once("./db_connect.php");


		function discount($i) {
			switch ($i) {
				case 0:
					return 0 ;
					break;
				case 1:
					return 1 ;
					break;
				case 2:
					return 4 ;
					break;
				case 3:
					return 8 ;
					break;
				case 4:
					return 12 ;
					break;
				case 5:
					return 16 ;
					break;
				case 6:
					return 20 ;
					break;
				case 7:
					return 23 ;
					break;
				
				
			}
		}
				
		
	?>
		<div id="header">
			<h3 id="heading">
				<div id="welcome">Make Some Money</a></div>
			</h3>
		</div>
		<br /><br /><br /><br />

		<?php 
			if (isset($_SESSION['form'])) {

				$tr = mysql_real_escape_string($_POST["transaction"]) ;
				$rs = mysql_real_escape_string($_POST["resource"]) ;
				$id = mysql_real_escape_string($_POST["teamno"]) ;
				$qt = mysql_real_escape_string($_POST["amt"]) ;

				$query="SELECT * FROM apocalypso_rates WHERE Resource='Freeze'";
            $data=mysql_query($query,$con);
            $info=mysql_fetch_array($data);
            $fz=$info['Rate'] ;

            /**************************  UPGRADE  **********************************/

				if ($tr=="upgrade") {
						if (!$fz) {
						$query="SELECT * FROM apocalypso_score WHERE TeamNo='$id'";
		            $data=mysql_query($query,$con);
		            $info=mysql_fetch_array($data);
		            if(mysql_num_rows($data)!=0){
		            	if ($rs=="food") {
		            		$lvl = $info['L1'] ;
		            		if ($lvl<7){ 
		            			$lvl++ ;
		            			
		                  	echo "Transaction Completed. -:- Updated level of <b>".$rs."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;

		                  	if ($info['L1']+$info['L2']+$info['L3']==20) {
				               	$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
										$data=mysql_query($query,$con);
										$inf=mysql_fetch_array($data);
										$wn = $inf['Rate'] ;
										if (!$wn) {
											$query="DELETE FROM apocalypso_rates WHERE Resource='Winner'";
											mysql_query($query,$con);
											$query="INSERT INTO apocalypso_rates (Resource,Rate) VALUES('Winner','$id')";
											mysql_query($query,$con);
										}
									}

		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		$query="DELETE FROM apocalypso_score WHERE TeamNo='$id'";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());
		                  $query="INSERT INTO apocalypso_score (TeamNo,L1,L2,L3,Money) VALUES('".$info['TeamNo']."','".$lvl."','".$info['L2']."','".$info['L3']."','".$info['Money']."')";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());

		               }

		               else if ($rs=="wood") {
		            		$lvl = $info['L2'] ;
		            		if ($lvl<7){ 
		            			$lvl++ ;
		            			
				               echo "Transaction Completed. -:- Updated level of <b>".$rs."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;

				               if ($info['L1']+$info['L2']+$info['L3']==20) {
				               	$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
										$data=mysql_query($query,$con);
										$inf=mysql_fetch_array($data);
										$wn = $inf['Rate'] ;
										if (!$wn) {
											$query="DELETE FROM apocalypso_rates WHERE Resource='Winner'";
											mysql_query($query,$con);
											$query="INSERT INTO apocalypso_rates (Resource,Rate) VALUES('Winner','$id')";
											mysql_query($query,$con);
										}
									}

		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		$query="DELETE FROM apocalypso_score WHERE TeamNo='$id'";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());
		                  $query="INSERT INTO apocalypso_score (TeamNo,L1,L2,L3,Money) VALUES('".$info['TeamNo']."','".$info['L1']."','".$lvl."','".$info['L3']."','".$info['Money']."')";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());

		               }

		               else if ($rs=="stone") {
		            		$lvl = $info['L3'] ;
		            		if ($lvl<7){ 
		            			$lvl++ ;
		            			
		                  	echo "Transaction Completed. -:- Updated level of <b>".$rs."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;
		                  	if ($info['L1']+$info['L2']+$info['L3']==20) {
				               	$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
										$data=mysql_query($query,$con);
										$inf=mysql_fetch_array($data);
										$wn = $inf['Rate'] ;
										if (!$wn) {
											$query="DELETE FROM apocalypso_rates WHERE Resource='Winner'";
											mysql_query($query,$con);
											$query="INSERT INTO apocalypso_rates (Resource,Rate) VALUES('Winner','$id')";
											mysql_query($query,$con);
										}
									}	            			
		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		$query="DELETE FROM apocalypso_score WHERE TeamNo='$id'";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());
		                  $query="INSERT INTO apocalypso_score (TeamNo,L1,L2,L3,Money) VALUES('".$info['TeamNo']."','".$info['L1']."','".$info['L2']."','".$lvl."','".$info['Money']."')";
		                  mysql_query($query,$con) or die("Error: ".mysql_error());

		               }

		               else  {
		               	echo "Select a correct resource ..." ;
							}
		            }
				
		            

		            else {
		            	echo "Invalid Team ID" ;
		         	}
	         	}

	         	
	         	else  {
	         		echo "Market Frozen. No upgrade allowed!" ;
         		}
         	}

         	/****************************************************************************/


				/*******************************  SELL  ************************************/

				else if ($tr=="sell") {

					if ($qt!=0) {

						$query="SELECT * FROM apocalypso_score WHERE TeamNo='$id'";
			         $data=mysql_query($query,$con);
			         $info=mysql_fetch_array($data);

			         $bal = $info['Money'];

			         
			         if ($rs=="food") {
			         	$lvl = $info['L1'] ;
			         	$rsname = "Food" ;
			         	
					      $query="SELECT * FROM apocalypso_rates WHERE Resource='Food'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
					   }
			         else if ($rs=="wood") {
			         	$lvl = $info['L2'] ;
			         	$rsname = "Wood" ;

			         	$query="SELECT * FROM apocalypso_rates WHERE Resource='Wood'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
			         }
			         else if ($rs=="stone") {
			         	$lvl = $info['L3'] ;
			         	$rsname = "Stone" ;

			         	$query="SELECT * FROM apocalypso_rates WHERE Resource='Stone'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
			         }
			         else {
			         	$base = 0 ;
			         	echo "Select a correct resource..." ;
		         	}
			         
	            	if (!$fz) {
	            		$price = (float) ($base*((float) (1+((float) (discount($lvl))/100)))) ;
	            		$newp = (int) ((float) (80000/((float) ((float) ((float) (80000/$base))) + $qt)));
	            		$query="DELETE FROM apocalypso_rates WHERE Resource='$rsname'";
					   	mysql_query($query,$con) or die("Error: ".mysql_error());
					   	$query="INSERT INTO apocalypso_rates (Resource,Rate) VALUES('$rsname','$newp')";
					   	mysql_query($query,$con) or die("Error: ".mysql_error());
	            		
            		}
	            	else {
	            		$price = $base ;
            		}

						$bal += (int) ((float) $qt*$price) ;
						
						$query="SELECT * FROM apocalypso_score WHERE TeamNo='$id'";
			         $data=mysql_query($query,$con);
			         $info=mysql_fetch_array($data);

						$query="DELETE FROM apocalypso_score WHERE TeamNo='$id'";
					   mysql_query($query,$con) or die("Error: ".mysql_error());
					   $query="INSERT INTO apocalypso_score (TeamNo,L1,L2,L3,Money) VALUES('".$id."','".$info['L1']."','".$info['L2']."','".$info['L3']."','".$bal."')";
					   mysql_query($query,$con) or die("Error: ".mysql_error());

					   if ($base!=0) echo "Transaction Complete -:- Team <b>".$id." sold ".$qt." ".$rs."</b> at rate ".$price." to the market" ;
					}

					else {
						echo "Zero resources to be sold. Nothing Done." ;
					}

				}

         	/****************************************************************************/


				/*******************************  BUY  *************************************/

				else if ($tr=="buy") {

					if ($qt!=0) {

						$query="SELECT * FROM apocalypso_score WHERE TeamNo='$id'";
			         $data=mysql_query($query,$con);
			         $info=mysql_fetch_array($data);

			         $bal = $info['Money'];

			         
			         if ($rs=="food") {
			         	$lvl = $info['L1'] ;
			         	$rsname = "Food" ;
			         	
					      $query="SELECT * FROM apocalypso_rates WHERE Resource='Food'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
					   }
			         else if ($rs=="wood") {
			         	$lvl = $info['L2'] ;
			         	$rsname = "Wood" ;

			         	$query="SELECT * FROM apocalypso_rates WHERE Resource='Wood'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
			         }
			         else if ($rs=="stone") {
			         	$lvl = $info['L3'] ;
			         	$rsname = "Stone" ;

			         	$query="SELECT * FROM apocalypso_rates WHERE Resource='Stone'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);
					      $base = $info['Rate'] ;
			         }
			         else {
			         	$base = 0 ;
			         	echo "Select a correct resource..." ;
		         	}
			         
	            	if (!$fz) {
	            		$price = (float) ($base*((float) (1-((float) (discount($lvl))/100)))) ;
            		}
	            	else {
	            		$price = $base ;
            		}

						$bal -= (int) ((float) $qt*$price) ;

						if ($bal>=0) {

							$newp = (int) ((float) (80000/((float) ((float) ((float) (80000/$base))) - $qt)));
	            		$query="DELETE FROM apocalypso_rates WHERE Resource='$rsname'";
					   	mysql_query($query,$con) or die("Error: ".mysql_error());
					   	$query="INSERT INTO apocalypso_rates (Resource,Rate) VALUES('$rsname','$newp')";
					   	mysql_query($query,$con) or die("Error: ".mysql_error());

					   	$query="SELECT * FROM apocalypso_score WHERE TeamNo='$id'";
					      $data=mysql_query($query,$con);
					      $info=mysql_fetch_array($data);

							$query="DELETE FROM apocalypso_score WHERE TeamNo='$id'";
							mysql_query($query,$con) or die("Error: ".mysql_error());
							$query="INSERT INTO apocalypso_score (TeamNo,L1,L2,L3,Money) VALUES('".$id."','".$info['L1']."','".$info['L2']."','".$info['L3']."','".$bal."')";
							mysql_query($query,$con) or die("Error: ".mysql_error());

							if ($base!=0) echo "Transaction Complete -:- Team <b>".$id." bought ".$qt." ".$rs."</b> at rate ".$price." from the market" ;
						}

						else {
							echo "Not enough balance!" ;
						}
					}

					else {
						echo "Zero resources to be sold. Nothing Done." ;
					}

				}

				/****************************************************************************/


				else {
					echo "Select a transaction..." ;

				}


      	}
	
	?>	

		<br /><br /><hr><br /><br />

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate();">
			<label for = "teamno">Team # </label><input type="number" min="10" max="59" name="teamno" id="teamno" />
			<br /><br />
			
			<table>
				<tr>
				<td><input type="radio" name="transaction" id="buy" value="buy"/>Buy from market .</td>
				<td><input type="radio" name="transaction" id="sell" value="sell"/>Sell to market .</td>				
				<td><input type="radio" name="transaction" id="upgrade" value="upgrade"/>Upgrade Level .</td>				
				</tr>
			</table>
			<br /><br />

			<table>
				<tr> <td><b> Resource : </b></td>
				<td width=75><input type="radio" name="resource" id="food" value="food"/>Food  .</td>
				<td width=75><input type="radio" name="resource" id="wood" value="wood"/>Wood .</td>				
				<td width=75><input type="radio" name="resource" id="stone" value="stone"/>Stone .</td>		</tr>	
			
				<tr> <td><b> Amount : </b></td>
				<td width=75><input type="number" width=75 name="amt" id="amt" min=0 max=100 value="0"></td>		</tr>		
			</table>

			<br /><br />
			<input type="submit" value="Complete Transaction"/>
		</form>

		<?php

				$_SESSION['form']=1 ;
			?>

		<br /><hr><br />
		<a href="./index.php">END SESSION</a>
	
	<div id="footer">
      &copy; 2012, An <a href="https://www.cse.iitb.ac.in/~aamod">Aamod Kore</a> Production
      <br />
    </div>
    <center>
	</body>
</html>

<?php 
	}
?>
