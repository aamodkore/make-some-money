
<html>

<head>
       <link rel="stylesheet" type="text/css" href="style.css" />
       <title>Make Some Money | Login</title>
</head>
        

<?php
	session_start();

	$_SESSION['id']='notme' ;
	$flag=1 ;

	?>

	<?php
		if (isset($_SESSION['login_form'])) { 
			
			$pw = $_POST['a'] ;
			if ($pw=='miowwoim') {
				$_SESSION['id']='aamod' ;
				echo '<meta http-equiv="refresh" content="0;url=./market.php">';
				$flag=0 ;
			}
			else if ($pw=='infiinfi') {
				$_SESSION['id']='admin' ;
				echo '<meta http-equiv="refresh" content="0;url=./admin.php">';
				$flag=0 ;
			}
			else {
				$_SESSION['id']='notme';
				$flag=2 ;
			}
			
		}

		if ($flag) {
	?>
			<body>
        <img src="images/money.png" height="1000" id="backimg" /> 

        <div id="header">
               <h3 id="heading">
                       <div id="welcome">Make Some Money : The Virtual Trading Strategy Game</a></div>
               </h3>
       </div>
       <br /><br /><br /><br /><br /><br /><br /><br />

       <div id="login_box">	
			<?php if ($flag==2) echo '<b>Invalid Session</b>'; ?>
       	<br /><br />	
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<input type="password" name="a" placeholder="password"></input>
			<br /><br />
			<input type="submit" value="Start Session"></input>
			</form>

		<?php $_SESSION['login_form']=1 ; ?>

		</div>

		<div id="footer">
      	&copy; 2012, An <a href="http://www.cse.iitb.ac.in/~aamod" target="_blank">Aamod Kore</a> Production
      </div>
	</body>

	<?php
		}
	?>

</html>
