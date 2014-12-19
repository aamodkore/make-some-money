<?php
	require_once("./db_connect.php");

	session_start() ;
	
	if($_SESSION['id']!='admin') {
?>
	<meta http-equiv="refresh" content="0;url=./index.php">
<?php
	}

	else {

		if (isset($_GET['rate'])) {
			$intrate = $_GET['rate'] ;
		}
		else {
			$intrate = 60 ;
		}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>MSM | Interest</title>
	</head>
	<body>
		<center>
		<div id="header"><h3>MSM Interest | <?php echo $_SESSION['id'] ;?></h3></div>
		<br /> <br /><br /><br /><br /><br /><br /> 
			<?php
				$query="SELECT * FROM apocalypso_score ORDER BY TeamNo";
				$result=mysql_query($query,$con);
				if (!isset($_GET['num']))$num=0;
				else $num = $_GET['num'] ;
				$num++ ;
				$count = 0 ; $total = 0.0 ;
				while($info=mysql_fetch_array($result)){
					$level=$info['L1']+$info['L2']+$info['L3'] ;
					$bal = (int) ((float) $info['Money']*(1+ ((float) $level/100))) ;
					$total += $level ; $count += 1 ;

					$query="UPDATE apocalypso_score SET Money='".$bal."' WHERE TeamNo='".$info['TeamNo']."'";
					mysql_query($query,$con);

					$query="UPDATE apocalypso_score SET Money='$bal' WHERE TeamNo='$id'";
					mysql_query($query,$con) or die("Error: ".mysql_error());
				}
				
				/// Inflation 
				$inflation = $total/((float) $count * 3) ;
				
				$query="SELECT * FROM apocalypso_rates WHERE Resource='Food'";
				$result = mysql_query($query,$con);
				$info=mysql_fetch_array($result) ;
				if ($info) {
					$price = $info['Rate'] ;
					$nprice = (int) ((1+ ($inflation/100))*((float) $price)) ;
					$query="UPDATE apocalypso_rates SET Rate='$nprice' WHERE Resource='Food'";
					mysql_query($query,$con) or die("Error: ".mysql_error());
				}
					
				$query="SELECT * FROM apocalypso_rates WHERE Resource='Wood'";
				$result = mysql_query($query,$con);
				$info=mysql_fetch_array($result) ;
				if ($info) {
					$price = $info['Rate'] ;
					$nprice = (int) ((1+ ($inflation/100))*((float) $price)) ;
					$query="UPDATE apocalypso_rates SET Rate='$nprice' WHERE Resource='Wood'";
					mysql_query($query,$con) or die("Error: ".mysql_error());
				}
					
				$query="SELECT * FROM apocalypso_rates WHERE Resource='Stone'";
				$result = mysql_query($query,$con);
				$info=mysql_fetch_array($result) ;
				if ($info) {
					$price = $info['Rate'] ;
					$nprice = (int) ((1+ ($inflation/100))*((float) $price)) ;
					$query="UPDATE apocalypso_rates SET Rate='$nprice' WHERE Resource='Stone'";
					mysql_query($query,$con) or die("Error: ".mysql_error());
				}
					

				$logfile = 'transactions.log.txt' ;
				$timestamp = getdate();

				$logstr = 'team-ALL'."\t".'*INTRST'."\t".'resource: null'."\t".'%r: LVL'."\t".' [...] AUTH by -:- '.$_SESSION['id']."\t".' [TS] '.$timestamp['year'].':'.$timestamp['mon'].':'.$timestamp['mday'].' ; '.$timestamp['hours'].':'.$timestamp['minutes'].':'.$timestamp['seconds'].' [...]'."\n" ;

				file_put_contents($logfile, $logstr, FILE_APPEND | LOCK_EX);
			?>
			Interest is given every <b> <?php echo $intrate; ?> seconds</b>.<br /><br />Interest added <?php echo $num; ?> times.<br />
			<br />Inflation rate @ <?php echo $inflation ; ?>% per <?php echo $intrate ; ?> seconds<br />
			<hr><br />

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

         Rate : <input type="number" name="rate" min=30 max=3600 value="<?php echo $intrate; ?>"></input> seconds.
         <input type="hidden" name="num" value="<?php echo $num; ?>"></input>
         <br /><br />
         <input type="submit" value="Change Interest Rate"></input>
         </form>
			<br /><hr><br />
			To stop giving interest, simply close this tab! (<b>Ctrl</b> + <b>W</b>)<br /><br />

			(Do <b><i><u>NOT</b></i></u> press <b>BACK(Backspace)</b>, <b>Forward</b> or <b>Refresh</b>. This might result in interest added multiple times.)
                
			</center>
		
		<meta http-equiv="refresh" content="<?php echo $intrate; ?>;url=./interest.php?rate=<?php echo $intrate; ?>&num=<?php echo $num; ?>" />		
	</body>
</html>

<?php
	}
?>
