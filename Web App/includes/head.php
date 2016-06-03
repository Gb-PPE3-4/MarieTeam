<!DOCTYPE html>
<html lang="fr">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site de réservations MarieTeam">
    <meta name="author" content="Vandesompele Pierre Robin Faure Polowczak Raphael">
    <link rel="icon" href="images/gouvernail.ico">
    <title>MarieTeam, entreprise de transport de fret et voyageurs</title>
	
    <!-- Custom styles for this template -->
    <link href="assets/bootstrap/theme_bootstrap.css" rel="stylesheet">
		
	<!-- Bootstrap table with search, pagination, sorting and responsive http://bootstrap-table.wenzhixin.net.cn/getting-started/ -->
	<link rel="stylesheet" href="assets/bootstrap/bootstrap-table-master/src/bootstrap-table.min.css">
	<!--<link rel="stylesheet" href="http://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css">-->
	
	<!-- Simple SideBar Panel -->
	<link rel="stylesheet" href="assets/bootstrap/simple-sidebar.css">
	
	<link rel="stylesheet" href="assets/bootstrap/bootstrap-submenu-2.0.3/dist/css/bootstrap-submenu.min.css">
	
	<link rel="stylesheet" href="css/stylesheet.css" />
	
	<!-- CLASSES & Fonctions PHP -->
	<?PHP 	include "classes/membre.php" ; 
			session_start();
			include "includes/functions.php" ; 
			if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
			{
				$_REQUEST['fonction']($_REQUEST);
			}	
	?>
	
	
	<!-- Magnific Popup core CSS file 
	<link rel="stylesheet" href="assets/magnific-popup/dist/magnific-popup.css">-->
	<!-- FONT AWESOME ICONS 
	<link rel="stylesheet" href="assets/font-awesome-4.4.0/css/font-awesome.min.css">-->
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>