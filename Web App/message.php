<?PHP
	include 'includes/head.php' ; ; 	
	include 'includes/header.php' ; 
?>
	<div id = "wrapper_main">
		<?PHP
		if(isset($_GET['status']) && $_GET['status'] == '1'){
			echo '<h3>Votre paiement et votre réservation ont bien été pris en compte.</h3>' ;
		}else{
			echo "<h2 class='txt_red'>Il y a eu un souci dans votre réservation.</h2><h3>Peut-être qu'il n'y avait plus de place pour cette traversée.<br>Nous vous présentons nos plus sincères excuses et nous vous prions de réitérer votre tentative.</h3>" ;
		}
		include 'includes/popup_connexion.php' ;
       					  ?>
		<!-- /#wrapper main -->
		<div id="separateur"></div>
<?PHP
	include 'includes/footer.php' ;
?>