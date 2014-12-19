<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	if ($_SESSION['id']!='aamod' && $_SESSION['id']!='admin') {
?>
	<meta http-equiv="refresh" content="0;url=./index.php">
<?php
 	}

 	else {
		/****************************************/
		$resA = 'Panels' ;
		$resB = 'Coal' ;
		$resC = 'Turbines' ;
		/****************************************/
			
		function resname($rs) {
			/****************************************/
						$resA = 'Panels' ;
						$resB = 'Coal' ;
						$resC = 'Turbines' ;
			/***************************************/
			$rs = ucwords($rs) ;
			if ($rs=='Food') return $resA ;
			else if ($rs=='Wood') return $resB ;
			else if ($rs=='Stone') return $resC ;
			else return $rs ;
		}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>MSM | Market</title>
	</head>
	<body>
	<center>
	<img src="images/money.png" height="1000" id="backimg" /> 
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
				<div id="welcome">Make Some Money | <?php echo $_SESSION['id'] ; ?></a></div>
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
		            			
		                  	echo "Transaction Completed. -:- Updated level of <b>".resname($rs)."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;

		                  	$query="UPDATE apocalypso_score SET L1='$lvl' WHERE TeamNo='$id'";
		                  	mysql_query($query,$con) or die("Error: ".mysql_error());

		                  	$logfile = 'transactions.log.txt' ;
									$timestamp = getdate();

									$logstr = 'team- '.$id."\t".'UPGRADE'."\t".'resource: '.$rs."\t".'lvl: '.$lvl."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

									file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

	                  		$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
									$data=mysql_query($query,$con);
									$infa=mysql_fetch_array($data);
									$wn = $infa['Rate'] ;

									if ($wn==0) {
										$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
		                  		mysql_query($query,$con) or die("Error: ".mysql_error());

		                  		$logfile = 'prices.log.txt' ;
										$timestamp = getdate();

										$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

										file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
									}

									else {
										$query="SELECT * FROM apocalypso_score WHERE TeamNo='$wn'";
										$data=mysql_query($query,$con);
										$infb=mysql_fetch_array($data);									

										if ($info['L1']+$info['L2']+$info['L3']>=$infb['L1']+$infb['L2']+$infb['L3']) {
											$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
				               		mysql_query($query,$con) or die("Error: ".mysql_error());

				               		$logfile = 'prices.log.txt' ;
											$timestamp = getdate();

											$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

											file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
										}
									}
										
								
		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		
		               }

		               else if ($rs=="wood") {
		            		$lvl = $info['L2'] ;
		            		if ($lvl<7){ 
		            			$lvl++ ;
		            			
		                  	echo "Transaction Completed. -:- Updated level of <b>".resname($rs)."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;

		                  	$query="UPDATE apocalypso_score SET L2='$lvl' WHERE TeamNo='$id'";
		                  	mysql_query($query,$con) or die("Error: ".mysql_error());

		                  	$logfile = 'transactions.log.txt' ;
									$timestamp = getdate();

									$logstr = 'team- '.$id."\t".'UPGRADE'."\t".'resource: '.$rs."\t".'lvl: '.$lvl."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

									file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

	                  		$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
									$data=mysql_query($query,$con);
									$infa=mysql_fetch_array($data);
									$wn = $infa['Rate'] ;

									if ($wn==0) {
										$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
		                  		mysql_query($query,$con) or die("Error: ".mysql_error());

		                  		$logfile = 'prices.log.txt' ;
										$timestamp = getdate();

										$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

										file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
									}

									else {
										$query="SELECT * FROM apocalypso_score WHERE TeamNo='$wn'";
										$data=mysql_query($query,$con);
										$infb=mysql_fetch_array($data);									

										if ($info['L1']+$info['L2']+$info['L3']>=$infb['L1']+$infb['L2']+$infb['L3']) {
											$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
				               		mysql_query($query,$con) or die("Error: ".mysql_error());

				               		$logfile = 'prices.log.txt' ;
											$timestamp = getdate();

											$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

											file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
										}
									}

		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		
		               }

		               else if ($rs=="stone") {
		            		$lvl = $info['L3'] ;
		            		if ($lvl<7){ 
		            			$lvl++ ;
		            			
		                  	echo "Transaction Completed. -:- Updated level of <b>".resname($rs)."</b> for <b>Team ".$id."</b> to <b>".$lvl."</b> -:- " ;

		                  	$query="UPDATE apocalypso_score SET L1='$lvl' WHERE TeamNo='$id'";
		                  	mysql_query($query,$con) or die("Error: ".mysql_error());

		                  	$logfile = 'transactions.log.txt' ;
									$timestamp = getdate();

									$logstr = 'team- '.$id."\t".'UPGRADE'."\t".'resource: '.$rs."\t".'lvl: '.$lvl."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

									file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

	                  		$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
									$data=mysql_query($query,$con);
									$infa=mysql_fetch_array($data);
									$wn = $infa['Rate'] ;

									if ($wn==0) {
										$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
		                  		mysql_query($query,$con) or die("Error: ".mysql_error());

		                  		$logfile = 'prices.log.txt' ;
										$timestamp = getdate();

										$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

										file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
									}

									else {
										$query="SELECT * FROM apocalypso_score WHERE TeamNo='$wn'";
										$data=mysql_query($query,$con);
										$infb=mysql_fetch_array($data);									

										if ($info['L1']+$info['L2']+$info['L3']>=$infb['L1']+$infb['L2']+$infb['L3']) {
											$query="UPDATE apocalypso_rates SET Rate='$id' WHERE Resource='Winner'";
				               		mysql_query($query,$con) or die("Error: ".mysql_error());

				               		$logfile = 'prices.log.txt' ;
											$timestamp = getdate();

											$logstr = '[LVL WINNER]'."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

											file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
										}
									}	            			
		         			}
		         			else {
		            			echo "Maximum level already! " ;
		         			}
		            		
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

			         if(mysql_num_rows($data)!=0){
			         
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
			         		
		         		}
			         	else {
			         		$price = $base ;
		         		}

							$bal += (int) ((float) $qt*$price) ;

							if ($base!=0) {

								if (!$fz) {
									$newp = (int) ((float) (100000/((float) ((float) ((float) (100000/$base))) + $qt)));
					      		$query="UPDATE apocalypso_rates SET Rate='$newp' WHERE Resource='$rsname'";
									mysql_query($query,$con) or die("Error: ".mysql_error());

									$logfile = 'prices.log.txt' ;
									$timestamp = getdate();

									$logstr = 'resource: '.$rs."\t".'[$$]: '.$newp."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

									file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

								}
						
								$query="UPDATE apocalypso_score SET Money='$bal' WHERE TeamNo='$id'";
								mysql_query($query,$con) or die("Error: ".mysql_error());

								echo "Transaction Complete -:- Team <b>".$id." sold ".$qt." ".resname($rs)."</b> at rate ".$price." to the market" ;

								$logfile = 'transactions.log.txt' ;
								$timestamp = getdate();

								$logstr = 'team- '.$id."\t".'* SELL*'."\t".'resource: '.$rs."\t".'amt: '.$qt."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

								file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
							}
						}

						else {
							echo "Invalid Team ID !" ;
						}
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

			         if(mysql_num_rows($data)!=0){ 

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

								if ($base!=0) {
									if (!$fz) {
										$newp = (int) ((float) (100000/((float) max(($qt+100),((float) ((float) (100000/$base)))) - $qt)));
							   		$query="UPDATE apocalypso_rates SET Rate='$newp' WHERE Resource='$rsname'";
										mysql_query($query,$con) or die("Error: ".mysql_error());

										$logfile = 'prices.log.txt' ;
										$timestamp = getdate();

										$logstr = 'resource: '.$rs."\t".'[$$]: '.$newp."\t".'[TEAM] '.$id."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

										file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
									}

									$query="UPDATE apocalypso_score SET Money='$bal' WHERE TeamNo='$id'";
									mysql_query($query,$con) or die("Error: ".mysql_error());

									echo "Transaction Complete -:- Team <b>".$id." bought ".$qt." ".resname($rs)."</b> at rate ".$price." from the market" ;

									$logfile = 'transactions.log.txt' ;
									$timestamp = getdate();

									$logstr = 'team- '.$id."\t".'* BUY *'."\t".'resource: '.$rs."\t".'amt: '.$qt."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

									file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
								}
							}

							else {
								echo "Not enough balance!" ;
							}
						}

						else {
							echo "Invalid Team ID!" ;
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

		<br /><br /><hr><br />

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate();">
			<label for = "teamno">Team # </label><input type="number" min="10" max="99" name="teamno" id="teamno" />
			<br /><br />
			
			<table>
				<tr>
				<td><input type="radio" name="transaction" id="buy" value="buy"/>Buy from market .</td>
				<td><input type="radio" name="transaction" id="sell" value="sell"/>Sell to market .</td>				
				<td><input type="radio" name="transaction" id="upgrade" value="upgrade"/>Upgrade Level .</td>				
				</tr>
			</table>
			<br />

			<table>
				<tr> <td><b> Resource : </b></td>
				<td width=100><input type="radio" name="resource" id="food" value="food"/><?php echo $resA; ?></td>
				<td width=100><input type="radio" name="resource" id="wood" value="wood"/><?php echo $resB; ?></td>				
				<td width=100><input type="radio" name="resource" id="stone" value="stone"/><?php echo $resC; ?></td>		</tr>	
			
				<tr> <td><b> Amount : </b></td>
				<td width=75><input type="number" width=75 name="amt" id="amt" min=0 max=15 value="0"></td>		</tr>		
			</table>

			<br /><br />
			<input type="submit" value="Complete Transaction"/>
		</form><br />

		(Do <b><i><u>NOT</b></i></u> press <b>BACK</b>(<b>Backspace)</b>, <b>Forward</b> or <b>Refresh</b>. This might result in duplicate entries.)
		<br />

		<?php

				$_SESSION['form']=1 ;
			?>

		<br /><hr><br />
		<?php 
			if ($_SESSION['id']=='admin') {
		?>
		<a href="./admin.php">ADMIN CONTROLS</a><br />
		<?php } ?>
		<a href="./index.php">END SESSION</a>
	
	<div id="footer">
      &copy; 2012, An <a href="http://www.cse.iitb.ac.in/~aamod" target="_blank">Aamod Kore</a> Production
      <br />
    </div>
    <center>
	</body>
</html>

<?php 
	}
?>
