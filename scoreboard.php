<?php
	require_once("./db_connect.php");
	/****************************************/
	$resA = 'Panels' ;
	$resB = 'Coal' ;
	$resC = 'Turbines' ;
	/****************************************/

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>MSM | Scoreboard</title>
	</head>
	<body>
		<div id="header"><h3>Make Some Money : ScoreBoard</h3></div>
		<br /> <br /><br /> 
	<?php
		if (!isset($_GET['from'])) {
			$from= 0;
		}
		if (!isset($_GET['to'])) {
			$to= 99999999;
		}
		$refreshrate = 10 ;
	?>
		<br>
		<div align="center">

		
		<?php 
			$rsc='Food' ;
			$query="SELECT * FROM apocalypso_rates WHERE Resource='".$rsc."'" ;
			$result=mysql_query($query,$con);
			$info=mysql_fetch_array($result);

			echo "<b>$resA</b>: ".$info['Rate']." , " ;

			$rsc='Wood' ;
			$query="SELECT * FROM apocalypso_rates WHERE Resource='".$rsc."'" ;
			$result=mysql_query($query,$con);
			$info=mysql_fetch_array($result);

			echo "<b>$resB</b>: ".$info['Rate']." , " ;

			$rsc='Stone' ;
			$query="SELECT * FROM apocalypso_rates WHERE Resource='".$rsc."'" ;
			$result=mysql_query($query,$con);
			$info=mysql_fetch_array($result);

			echo "<b>$resC</b>: ".$info['Rate']." . " ;

		?>	
		<br> <hr>
		<table id="board">
			<tr><th>Team #</th><th>Level</th> <th>Bank Balance</th><th class="separator"></th><th>Team #</th><th>Level</th> <th>Bank Balance</th><th class="separator"></th><th>Team #</th><th>Level</th> <th>Bank Balance</th></tr>
			<?php
				$query="SELECT * FROM apocalypso_score ORDER BY TeamNo";
				$result=mysql_query($query,$con);
				$n=0;
				echo "<tr>";
				while($info=mysql_fetch_array($result)){
					if ($info[TeamNo]>=$from && $info[TeamNo]<=$to) {
						$n++ ;
						$level=$info[L1]+$info[L2]+$info[L3] ;
						echo '<td>'.$info[TeamNo].'</td><td>'.$level.'</td><td>'.$info[Money].'</td>';
						if ($n%3==0) echo '</tr><tr>' ;
						else echo '</td><td class="separator"></td>' ;
					}
				}
			?>
			
		</table>
		</div>
		<div id="footer">
      	&copy; 2012, An <a href="http://www.cse.iitb.ac.in/~aamod" target="_blank">Aamod Kore</a> Production
      </div>
		<meta http-equiv="refresh" content="<?php echo $refreshrate ; ?>;url=./scoreboard.php" />		
	</body>
</html>
