<?PHP
	session_cache_expire(30); session_start();
	include 'functions.php' ;
	include '../classes/membre.php' ;
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
		$_REQUEST['fonction']($_REQUEST);
	}
	
	if(isset($_POST['identifiant']) && $_POST['identifiant'] != "" && isset($_POST['mdp']) && $_POST['mdp'] != ""){
		$salarie = new Membre($_POST['identifiant'],$_POST['mdp']) ;
		if($salarie->getNom() == null){
			echo 'Erreur : les informations saisies sont incorrectes ( login : '.$_POST['identifiant'].' )'.$_POST['mdp'] ;
			// header('Location: ../index.php?Erreur=1');
		}else{
			header('Location: ../admin.php');
		}
	}else{
		echo 'Erreur : les informations saisies sont incorrectes!' ;
	}
?>