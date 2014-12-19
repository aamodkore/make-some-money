<?php
	require_once("./db_connect.php");

	if(isset($_GET['teams'])) $teams=$_GET['teams'];
	else $teams=40 ;

	$r1=$r2=$r3=0 ;
	$cash = 1500 ;
	
	if (isset($_GET['a'])) {
		$pw = $_GET['a'] ;
		if ($pw=='miowwoim') {
			$query="TRUNCATE apocalypso_score";
			$result=mysql_query($query,$con);
			for ($i=1;$i<=$teams;$i++) {
				$query="insert into apocalypso_score (TeamNo, L1, L2, L3, Money) values($i,$r1,$r2,$r3,$cash)";
				$result=mysql_query($query,$con);
			}

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
			echo "<h1>Game initialised for $teams teams</h1>" ;
		}

		else {
			echo "<h1>Bazinga!!!<br />Kya aap ko lagta hai hum ch***** hai ?</h1>" ;
		}
	}
	else {
		echo "<h1>HAHA!!!<br />Kya aap ko lagta hai hum ch***** hai ?</h1>" ;
	}
	
