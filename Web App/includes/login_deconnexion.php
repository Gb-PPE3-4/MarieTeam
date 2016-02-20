<?PHP
	session_cache_expire(30); session_start();
	$_SESSION['droit'] = "" ;
	$_SESSION['ID'] = "" ;
	$_SESSION['login'] = "" ;
	$_SESSION['nom'] = "" ;
	$_SESSION['prenom'] = "" ;
	header('Location: ../index.php');
?>