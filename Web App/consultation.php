<?PHP
	include 'includes/head.php' ; ; 	
	include 'includes/header.php' ; 
?>
	<div id = "wrapper_main">
		<?PHP
		if(isset($_GET['secteur']) && $_GET['secteur'] != ''){
			$idliaison = '' ;
			$prix= '' ;
			if(isset($_GET['idliaison']) && $_GET['idliaison'] != ''){
				$idliaison = $_GET['idliaison'] ;
			}else if(!isset($idliaison) || $idliaison == ""){
				$idliaison=15 ;
			}
			echo '
			<form  style="text-align:left;" class="form-horizontal">
				  <fieldset>
					<h4>Sélectionner la liaison et la date souhaitée :</h4>
					  <div class="col-lg-4 noMargin">
							<select class="form-control" id="slct_idLiaison" style="width:100%;">' ;
			echo 				afficheLiaisonSelect($_GET['secteur'])
							.'</select>
						</div>';
						
			if(isset($_GET['idliaison']) && $_GET['idliaison'] != ''){
				echo afficheDateTraverseeSelect($idliaison).'<div class="col-lg-4 noMargin">
						<a href="tarifs.php?secteur='.$_GET['secteur'].'&idliaison='.$idliaison.'" style="width:100%;" class="btn btn-primary">Afficher les tarifs de cette liaison</a>
					</div>';
			}
								
			echo '</fieldset>
			</form>';
			if((isset($_GET['secteur']) && $_GET['secteur'] != '') && (isset($_GET['idliaison']) && $_GET['idliaison'] != '') && (isset($_GET['date']) && $_GET['date'] != '' && $_GET['date'] != 0)){
				echo '<form class="form-horizontal">
						<fieldset>'.
							afficheTraverseeTableCheck()
						.'</fieldset>
					</form>';
				echo 	'<div id="txtOnReserv" class="col-lg-8 noMargin"><h5>Ne choisir qu\'une option</h5></div>
						<div class="col-lg-4 noMargin">
							<a id="reserver" style="width:100%;" class="btn btn-warning">Commencer la réservation</a>
						</div>
						<div id="alert"></div>';		
				//popup reservation
				echo  '<div id="div_tabContainer" attr_idTraversee="0" attr_idLiaison="'.$idliaison.'" attr_date="'.$_GET['date'].'" style="display:none;">' ;
				echo  '</div>' ;
			}
			include 'includes/popup_confirmation.php' ;
		    
		}else{ echo '<div class="col-lg-12 alert alert-dismissible alert-danger">
						<button type="button" class="close" data-dismiss="alert">x</button>
						Veuillez choisir un <strong>secteur !</strong>
					</div>' ;
		}
		include 'includes/popup_connexion.php' ;
       					  ?>
		<!-- /#wrapper main -->
		<div id="separateur"></div>
<?PHP
	include 'includes/footer.php' ;
?>