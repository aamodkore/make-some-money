<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
        session_start();
			
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

		 function opp($x) {
			if ($x==0) return 1 ;
			else return 0 ;
		}        


        if ($_SESSION['id']!='admin') {
?>
        <meta http-equiv="refresh" content="0;url=./market.php">
<?php
        }

        else {
?>
<html>
        <head>
                <link rel="stylesheet" type="text/css" href="style.css" />
                <title>MSM | Admin</title>
        </head>
        <?php
                require_once("./db_connect.php");
        ?>

	<body>
		<img src="images/money.png" height="1000" id="backimg" /> 
		  <center>
		  
		  <div id="header">
               <h3 id="heading">
                       <div id="welcome">Make Some Money | ADMIN PAGE</a></div>
               </h3>
       </div>
       <br /><br /><br /><br />

<!-- ****************************************  MAIN LINKS ****************************************** -->
		<table>
		<tr>  
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
		</tr>
		<tr>  
			<td class="separator"></td>
			<td><a href="./admin.php?act=home">ADMIN HOME</a></td><td class="separator"></td>
			<td><a href="./market.php">MARKET PORTAL</a></td><td class="separator"></td>
			<td><a href="./scoreboard.php" target="_blank">COMPLETE SCOREBOARD</a></td><td class="separator"></td>
			<td><a href="./index.php">END SESSION</a></td><td class="separator"></td>
		</tr>
		<tr>  
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
			<td class="separator"></td><td class="separator"></td><td class="separator"></td>
		</tr>
		</table>

<!-- ****************************************  MAIN LINKS ENDS ****************************************** -->

		<br /><hr><br />
		
		<?php
			if (!isset($_GET['act'])) {
				$act = 'home' ;
			}
			else {
				$act = $_GET['act'] ;
			}

			if ($act=='home') {
		?>

<!-- ****************************************  HOME BEGINS ****************************************** -->

			<a href="./admin.php?act=score">EDIT SCORES</a><br /><br />
			<a href="./admin.php?act=rates">EDIT PRICES TABLE</a><br /><br />
			<a href="./interest.php?num=0" target="_blank">INTEREST PAGE</a><br /><hr><br />
			<a href="./admin.php?act=backup">CREATE BACKUP</a><br /><br />
			<a href="./admin.php?act=restbkp">RESTORE FROM LAST BACKUP</a><br /><br />
			<a href="./admin.php?act=viewlog">VIEW SAVED LOGS</a><br /><hr><br />
			<a href="./admin.php?act=newgame">NEW GAME</a><br /><br />
			<a href="./admin.php?act=addteams">ADD TEAMS</a><br /><br />
			<a href="./admin.php?act=delteams">DELETE TEAMS</a>
						
<!-- ****************************************  HOME ENDS ****************************************** -->

		<?php
			}

			else if ($act=='rates') {

				/********************************************  RATES BEGINS ******************************************/
				
				if (isset($_GET['edit'])) {

					if ($_GET['edit']=='1' && isset($_POST['rate_food']) && isset($_POST['rate_wood']) && isset($_POST['rate_stone']) && isset($_POST['rate_win']) && isset($_POST['rate_freeze'])) {

						$fd = mysql_real_escape_string($_POST["rate_food"]) ;
						$wd = mysql_real_escape_string($_POST["rate_wood"]) ;
						$st = mysql_real_escape_string($_POST["rate_stone"]) ;
						$wn = mysql_real_escape_string($_POST["rate_win"]) ;
						$fz = mysql_real_escape_string($_POST["rate_freeze"]) ;

						$query="UPDATE apocalypso_rates SET Rate='$fd' WHERE Resource='Food'";
		         	mysql_query($query,$con) or die("Error: ".mysql_error());
						$query="UPDATE apocalypso_rates SET Rate='$wd' WHERE Resource='Wood'";
		         	mysql_query($query,$con) or die("Error: ".mysql_error());
						$query="UPDATE apocalypso_rates SET Rate='$st' WHERE Resource='Stone'";
		         	mysql_query($query,$con) or die("Error: ".mysql_error());
						$query="UPDATE apocalypso_rates SET Rate='$wn' WHERE Resource='Winner'";
		         	mysql_query($query,$con) or die("Error: ".mysql_error());
						$query="UPDATE apocalypso_rates SET Rate='$fz' WHERE Resource='Freeze'";
		         	mysql_query($query,$con) or die("Error: ".mysql_error());

		         	$timestamp = getdate();

						$logstr = '[...] '."\t".'[ADMIN] [RATES] '."\t".'[...] Food:-'.$fd.' ;  Wood:-'.$wd.' ;  Stone:-'.$st.' ;  Winner:-'.$wn.' ;  Freeze:-'.$fz.' [...]'."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

						$logfile = 'transactions.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						$logfile = 'prices.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						
					} 
				}
		?>
			<h4> EDIT PRICES TABLE </h4>
			
			<form id="rate_form" action="./admin.php?act=rates&edit=1" method="post">
				<table>
				<tr>
				<td><?php echo $resA; ?> :</td>
				<td><input type="number" name="rate_food" required=required min=10 max=800 value=
					<?php $query="SELECT * FROM apocalypso_rates WHERE Resource='Food'";
		         $info=mysql_query($query,$con);
		         $info=mysql_fetch_array($info);
		         echo $info['Rate'] ; ?> >
            </input></td>
				</tr>
				<tr>
				<td><?php echo $resB; ?> :</td>
				<td><input type="number" name="rate_wood" required=required min=10 max=800 value=
					<?php $query="SELECT * FROM apocalypso_rates WHERE Resource='Wood'";
		         $info=mysql_query($query,$con);
		         $info=mysql_fetch_array($info);
		         echo $info['Rate'] ; ?> >
            </input></td>
				</tr>
				<tr>
				<td><?php echo $resC; ?> :</td>
				<td><input type="number" name="rate_stone" required=required min=10 max=800 value=
					<?php $query="SELECT * FROM apocalypso_rates WHERE Resource='Stone'";
		         $info=mysql_query($query,$con);
		         $info=mysql_fetch_array($info);
		         echo $info['Rate'] ; ?> >
            </input></td>
				</tr>
				<tr>
				<td>Winner :</td>
				<td><select name="rate_win" required=required>

					<?php 
						$query="SELECT * FROM apocalypso_rates WHERE Resource='Winner'";
				      $info=mysql_query($query,$con);
				      $info=mysql_fetch_array($info);

				      echo '<option value=0 selected>No winner yet</option>' ;
				      
				      $query="SELECT * FROM apocalypso_score ORDER BY TeamNo";
				      $data=mysql_query($query,$con);
				      while($result=mysql_fetch_array($data)){
				      	echo '<option value='.$result['TeamNo'] ;
				      	if ($result['TeamNo']==$info['Rate']) echo ' selected' ;
				      	echo '>'.$result['TeamNo'].'</option>' ;				      		
				      }
				   ?> 
				   
            </select></td>
				</tr>
				<tr>
				<td>Freeze :</td>
				<td><select name="rate_freeze" required=required>
					
					<?php $query="SELECT * FROM apocalypso_rates WHERE Resource='Freeze'";
				      $info=mysql_query($query,$con);
				      $info=mysql_fetch_array($info);
				      echo '<option value='.$info['Rate'].' selected>'.$info['Rate'].'</option>' ;
				      echo '<option value='.(opp($info['Rate'])).'>'.(opp($info['Rate'])).'</option>' ; 
		         ?>
            </select></td>
				</tr>
				
			</table>

			<br /><input type="submit" name="submit" value="Save"></input><br /><br />
			<a href="./admin.php">BACK</a>
				
		<?php
			/********************************************  RATES ENDS ******************************************/
		
			}

			else if ($act=='backup') {
			
			/********************************************  BACKUP BEGINS ******************************************/

				$query="CREATE TABLE IF NOT EXISTS apocalypso_score_bkp LIKE apocalypso_score";
         	mysql_query($query,$con) or die("Error: ".mysql_error());
				$query="TRUNCATE apocalypso_score_bkp";
         	mysql_query($query,$con) or die("Error: ".mysql_error());
				$query="INSERT INTO apocalypso_score_bkp SELECT * FROM apocalypso_score";
         	mysql_query($query,$con) or die("Error: ".mysql_error());

         	$query="CREATE TABLE IF NOT EXISTS apocalypso_rates_bkp LIKE apocalypso_rates";
         	mysql_query($query,$con) or die("Error: ".mysql_error());
				$query="TRUNCATE apocalypso_rates_bkp";
         	mysql_query($query,$con) or die("Error: ".mysql_error());
				$query="INSERT INTO apocalypso_rates_bkp SELECT * FROM apocalypso_rates";
         	mysql_query($query,$con) or die("Error: ".mysql_error());

         	$timestamp = getdate();

				$logstr = "\n".'[...] '."\t".'[ADMIN] [BACKUP CREATED] '."\t".'[...] AUTH by -:- '.$_SESSION['id'].' [...]'."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n\n" ;

				$logfile = 'transactions.log.txt' ;
				file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
				$logfile = 'prices.log.txt' ;
				file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

				echo "<b>Backup Created</b><br />".$logstr."<br />" ;
				echo '<br />
						Redirecting you to Home Page in 4 seconds ...
						<meta http-equiv="refresh" content="5;url=./admin.php">' ;
			}

			/********************************************  BACKUP ENDS ******************************************/

			else if ($act=='newgame') {

			/********************************************  NEW GAME BEGINS ******************************************/

				if (isset($_GET['edit'])) {

					if ($_GET['edit']==1) {

						$query="TRUNCATE apocalypso_score";
				      $result=mysql_query($query,$con);
				      $query="TRUNCATE apocalypso_rates";
				      $result=mysql_query($query,$con);

				      $query="insert into apocalypso_rates (Resource, Rate) values('Food','150')";
				      $result=mysql_query($query,$con);
				      $query="insert into apocalypso_rates (Resource, Rate) values('Wood','120')";
				      $result=mysql_query($query,$con);
				      $query="insert into apocalypso_rates (Resource, Rate) values('Stone','100')";
				      $result=mysql_query($query,$con);
				      $query="insert into apocalypso_rates (Resource, Rate) values('Winner','0')";
				      $result=mysql_query($query,$con);
				      $query="insert into apocalypso_rates (Resource, Rate) values('Freeze','0')";
				      $result=mysql_query($query,$con);

				      $timestamp = getdate();

						$substr = '[NEW GAME]'."\t".'[...] AUTH by -:- '.$_SESSION['id']."\t".'[...]  [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]' ;
						$starstr = '****************************************************************************************************'."\n" ;

						$logstr = "\n".$starstr."[GAME ENDS]\n".$starstr."\n\n".$starstr.$starstr."\n\n\n\n\n\n".$starstr.$starstr."\n\n".$starstr.$substr."\n".$starstr."";

						$logfile = 'transactions.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						$logfile = 'prices.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
				
				      echo $substr ;
				      echo '<br /><br /><b>New game started with ZERO teams.</b><br />
				      		You need to add teams to the game.<br /><br />
				      		Redirecting to the <strong>Add Teams</strong> page in 5 seconds ...<br />
				      		<meta http-equiv="refresh" content="6;url=./admin.php?act=addteams">' ;
			      }
		      }

		      else {
		      	echo '<h3>Are you sure you want to start a new game ?</h3>
		      			All old data will be deleted. (Although trasaction logs may remain in history)<br /><br />
		      			<table><tr>
		      			<td style="min-witdh:150;" align=center><a href="./admin.php?act=newgame&edit=1">YES</a></td>
		      			<td class=separator></td>
		      			<td style="min-witdh:150;" align=center><a href="./admin.php?act=home">NO</a></td>
		      			</tr></table> ' ;
   			}
	      
        /********************************************  NEW GAME ENDS ******************************************/

        }

        else if ($act=='restbkp') {

			/********************************************  Restore Backup BEGINS ******************************************/

				if (isset($_GET['edit'])) {

					if ($_GET['edit']==1) {

						$timestamp = getdate();

						$substr = '[RESTORE BKP]'."\t".'[...] AUTH by -:- '.$_SESSION['id']."\t".'[...]  [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]' ;
						$starstr = '****************************************************************************************************'."\n" ;

						$logstr = "\n".$stqarstr.$substr."\n".$starstr;

						$logfile = 'transactions.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						$logfile = 'prices.log.txt' ;
						file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);

						$query="TRUNCATE apocalypso_score";
				      mysql_query($query,$con) or die("Error: ".mysql_error());
				      $query="TRUNCATE apocalypso_rates";
				      $result=mysql_query($query,$con) or die("Error: ".mysql_error());

				      $query="insert into apocalypso_rates select * from apocalypso_rates_bkp";
				      mysql_query($query,$con) or die("Error: ".mysql_error());
				      
				      $query="insert into apocalypso_score select * from apocalypso_score_bkp";
				      mysql_query($query,$con) or die("Error: ".mysql_error());
				      
				      echo $substr ;
				      echo '<br /><br /><b>Game restored from last backup</b><br />
				      		Redirecting to home page in 3 seconds ...<br />
				      		<meta http-equiv="refresh" content="3;url=./admin.php?act=home">' ;
			      }
		      }

		      else {
		      	echo '<h3>Are you sure you want to restore from last backup ?</h3>
		      			All changes after backup will be deleted. (Although trasaction logs may remain in history)<br />
		      			<b>Note:</b> If no backup is found garbage values may be loaded or you may run into error (like your hard-drive being deleted completely, :-P)<br /><br />
		      			<table><tr>
		      			<td style="min-witdh:150;" align=center><a href="./admin.php?act=restbkp&edit=1">YES</a></td>
		      			<td class=separator></td>
		      			<td style="min-witdh:150;" align=center><a href="./admin.php?act=home">NO</a></td>
		      			</tr></table> ' ;
   			}
	      
        /********************************************  Restore Backup ENDS ******************************************/

        }

        else if ($act=='viewlog') {
			
			/********************************************  LOGS BEGINS ******************************************/

		?>

			<br />To download log files right-click and select 'Save As...'<br /><br />

			->> <b>Transaction Logs :</b><a href="./transactions.log.txt" target="_blank">transactions.log.txt</a><br />
			->> <b>Price Changes :</b><a href="./prices.log.txt" target="_blank">prices.log.txt</a><br />
			
		<?php
					
			/********************************************  LOGS ENDS ******************************************/
			}

			else if ($act=='addteams') {

			/********************************************  ADD TEAMS BEGINS ******************************************/

				if (isset($_GET['edit'])) {

					if ($_GET['edit']==2) {

						if (isset($_POST['addfrom']) && isset($_POST['addto'])) {

				   		$from = $_POST['addfrom'] ;
				   		$to = $_POST['addto'] ;

				   		/****** STARTING STATS ******/
				   		/****/ $r1 = 0 ;			/****/
				   		/****/ $r2 = 0 ;			/****/
				   		/****/ $r3 = 0 ;			/****/
				   		/****/ $cash = 1500 ;	/****/
				   		/****************************/	
				   		

							for ($i=$from; $i<=$to; $i++) {
								$query="DELETE FROM apocalypso_score WHERE TeamNo='$i'";
				      		mysql_query($query,$con) or die("Error: ".mysql_error());
				      		$query="INSERT INTO apocalypso_score (TeamNo, L1, L2, L3, Money) VALUES($i,$r1,$r2,$r3,$cash)";
				      		mysql_query($query,$con) or die("Error: ".mysql_error());
			      		}				      

						   $timestamp = getdate();

							$logstr = '[ADD TEAMS]'."\t".'[FROM] #: '.$from."\t".'[TO] #: '.$to."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".'[...]  [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

							$logfile = 'transactions.log.txt' ;
							file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						
						   echo $logstr ;
						   echo '<br /><br /><b>Teams added.</b><br />
						   		Redirecting to the home page in 3 seconds ...<br />
						   		<meta http-equiv="refresh" content="3;url=./admin.php?act=home">' ;
			   		}
			      }
		      
				   else if ($_GET['edit']==1){
				   	if (isset($_POST['addfrom']) && isset($_POST['addto'])) {

				   		$from = $_POST['addfrom'] ;
				   		$to = $_POST['addto'] ;
				   		
							echo '<h3>Are you sure you want to add teams '.$from.' to '.$to.'?</h3>
									If the teams already exist all their data will be reset to starting stats,<br />
									Plus they\'ll all be pretty mad at you !<br /><br />
									<form id="confirmation_yes" action="./admin.php?act=addteams&edit=2" method="post">
										<input type="hidden" name="addfrom" value="'.$from.'"></input>
										<input type="hidden" name="addto" value="'.$to.'"></input>
										<input type="submit" value="Yes, Continue"></input>
									</form>
									<form id="confirmation_no" action="./admin.php?act=home" method="post">
										<input type="submit" value="No, Go Back..."></input>
									</form>
									<br /><br /> ' ;
						}
					}
				}

   			else {
   				?>

   				<h3>ADD TEAMS</h3>
   				<form id="selection" action="./admin.php?act=addteams&edit=1" method="post">
						Add teams from team #.: 
						<input type="number" name="addfrom" required=required min=10 max=99 value="99"></input>
						 ... to ... team #.: 
						<input type="number" name="addto" required=required min=10 max=99 value="99"></input><br />(both teams inclusive)<br /><br />
						<input type="submit" value="Add Teams"></input><br /><br />
						(To add a single team enter the same team in both <b>FROM</b> and <b>TO</b> fields.)
					</form><br />

   				<?php
   			}
	      
        /********************************************  ADD TEAMS ENDS ******************************************/

        }

        else if ($act=='delteams') {

			/********************************************  DELETE TEAMS BEGINS ******************************************/

				if (isset($_GET['edit'])) {

					if ($_GET['edit']==2) {

						if (isset($_POST['delfrom']) && isset($_POST['delto'])) {

				   		$from = $_POST['delfrom'] ;
				   		$to = $_POST['delto'] ;

				   		for ($i=$from; $i<=$to; $i++) {
								$query="DELETE FROM apocalypso_score WHERE TeamNo='$i'";
				      		mysql_query($query,$con) or die("Error: ".mysql_error());
				      	}				      

						   $timestamp = getdate();

							$logstr = '[DELETE TEAMS]'."\t".'[FROM] #: '.$from."\t".'[TO] #: '.$to."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".'[...]  [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

							$logfile = 'transactions.log.txt' ;
							file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
						
						   echo $logstr ;
						   echo '<br /><br /><b>Teams deleted.</b><br />
						   		Redirecting to the home page in 3 seconds ...<br />
						   		<meta http-equiv="refresh" content="3;url=./admin.php?act=home">' ;
			   		}
			      }
		      
				   else if ($_GET['edit']==1){
				   	if (isset($_POST['delfrom']) && isset($_POST['delto'])) {

				   		$from = $_POST['delfrom'] ;
				   		$to = $_POST['delto'] ;
				   		
							echo '<h3>Are you sure you want to delete teams '.$from.' to '.$to.'?</h3>
									All the data of these teams will be deleted.<br />
									So if any of these teams isn\'t supposed to be trashed, they\'re gonna be pretty mad at you !<br /><br />
									<form id="confirmation_yes" action="./admin.php?act=delteams&edit=2" method="post">
										<input type="hidden" name="delfrom" value="'.$from.'"></input>
										<input type="hidden" name="delto" value="'.$to.'"></input>
										<input type="submit" value="Yes, Continue"></input>
									</form>
									<form id="confirmation_no" action="./admin.php?act=home" method="post">
										<input type="submit" value="No, Go Back..."></input>
									</form>
									<br /><br /> ' ;
						}
					}
				}

   			else {
   				?>

   				<h3>DELETE TEAMS</h3>
   				<form id="selection" action="./admin.php?act=delteams&edit=1" method="post">
						Delete teams from team #.: 
						<input type="number" name="delfrom" required=required min=10 max=99 value="99"></input>
						 ... to ... team #.: 
						<input type="number" name="delto" required=required min=10 max=99 value="99"></input><br />(both teams inclusive)<br /><br />
						<input type="submit" value="Delete Teams"></input><br /><br />
						(To delete a single team enter the same team in both <b>FROM</b> and <b>TO</b> fields.)
					</form><br />

   				<?php
   			}
	      
        /********************************************  DELETE TEAMS ENDS ******************************************/

        }

        else if ($act=='score') {

        		if (isset($_GET['edit'])) {
        			$edit = $_GET['edit'] ;
     				if ($edit==1 && isset($_POST['teamno'])) {
     					$teamno = $_POST['teamno'] ;

     					$query="SELECT * FROM apocalypso_score WHERE TeamNo='".$teamno."'";
			      	$data=mysql_query($query,$con);
						if (mysql_num_rows($data)!=0){
			      
	     					$info=mysql_fetch_array($data);
							echo '<h3>EDIT | Team # '.$teamno.'</h3>
	     							<form id="teamscore" action="./admin.php?act=score&edit=2" method="post">
	     								<table><tr>
	     								<b><td>Team #</td><td>'.$resA.'</td><td>'.$resB.'</td><td>'.$resC.'</td><td>Money</td><td class=separator></td>
	     								</tr><tr>
	     								<td><input type="hidden" name="teamno" value='.$teamno.'></input>'.$teamno.'</td></b>
	     								<td><input type="number" name="lvlfood" required=required min=0 max=7 value='.$info['L1'].'></input></td>
	     								<td><input type="number" name="lvlwood" required=required min=0 max=7 value='.$info['L2'].'></input></td>
	     								<td><input type="number" name="lvlstone" required=required min=0 max=7 value='.$info['L3'].'></input></td>
	     								<td><input type="number" name="money" required=required min=0 value='.$info['Money'].'></input></td>
	     								<td><input type="submit" name="submit" value="Save"></input></td>
	     								</tr></table>
     								</form>		     								
	     							<br /><br />';
	     			}
					else {
					     echo '<br />Invalid Team ID<br /><br />
					     <a href="./admin.php?act=score">TRY AGAIN</a><br /> ' ;
				   }
			   }

			   else if ($edit==2 && isset($_POST['teamno']) && isset($_POST['lvlfood']) && isset($_POST['lvlwood']) && isset($_POST['lvlstone']) && isset($_POST['money'])) {
			   	$teamno = $_POST['teamno'] ;
					$lvlfood = $_POST['lvlfood'] ;
					$lvlwood = $_POST['lvlwood'] ;
					$lvlstone = $_POST['lvlstone'] ;
					$money = $_POST['money'] ;

					$query="DELETE FROM apocalypso_score WHERE TeamNo='$teamno'";
			      mysql_query($query,$con) or die("Error: ".mysql_error());

			      $query="INSERT INTO apocalypso_score (TeamNo, L1, L2, L3, Money) VALUES($teamno,$lvlfood,$lvlwood,$lvlstone,$money)";
			      mysql_query($query,$con) or die("Error: ".mysql_error());

			      $timestamp = getdate() ;

			      $logstr = '[TEAM SCORE]'."\t".'Team# : '.$teamno."\t".'L1 : '.$lvlfood."\t".'L2 : '.$lvlwood."\t".'L3 : '.$lvlstone."\t".'Money : '.$money.' [...] AUTH by -:- '.$_SESSION['id']."\t".'[...]  [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

					$logfile = 'transactions.log.txt' ;
					file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
			
					echo $logstr ;

					echo '<br /><br /><b>Score Updated.</b><br />
							<table><tr>
  								<b><td>Team #</td><td>'.$resA.'</td><td>'.$resB.'</td><td>'.$resC.'</td><td>Money</td>
							</tr><tr>
  								<td>'.$teamno.'</td></b>
  								<td>'.$lvlfood.'</td>
  								<td>'.$lvlwood.'</td>
  								<td>'.$lvlstone.'</td>
  								<td>'.$money.'</td>
  							</tr></table><br /><br />
							<a href="./admin.php?act=home">Back to HOME</a>' ;
			   }
		   }

		   else {
	   ?>
				<form id="selector" action="./admin.php?act=score&edit=1" method="post">
					<h4>Select Team ID # :</h4>
					<input type=number min=10 max=99 name="teamno" required=required value=99></input><br /><br />
					<input type=submit name=submit value="Edit Scores..."></input>
				</form><br /><br />
	   <?php
		   }		   						     				      					
        	
     	}
		
		?>
		
			<br /><br /><hr />
			(Do <b><i><u>NOT</b></i></u>, at any time press <b>BACK</b>(<b>Backspace)</b>, <b>Forward</b> or <b>Refresh</b>. This might result in duplicate entries.)
		</center>
	</body>	
</html>

<?php
	}
?>
