<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE tarifer ****/
		if(isset($_POST['select_ChoixLiaison']) && $_POST['select_ChoixLiaison'] != "" 
				&& isset($_POST['select_ChoixPeriode']) && $_POST['select_ChoixPeriode'] != ""){
					
			$IDliaison = $_POST['select_ChoixLiaison'] ; 
			$IDperiode = $_POST['select_ChoixPeriode'] ; 
			$verifTarif = false ;
			
			$lignes = ' 			<form method="post" id="update_tarif_form" class="form-horizontal col-lg-4">
									  <legend>Modifier un tarif (€) pour une liaison et une période</legend>
								  <fieldset><div class="form-group">
									  <div>
											<input type="hidden" name = "idliaison" id="idliaison" value="'.$IDliaison.'">
											<input type="hidden" name = "idperiode" id="idperiode" value="'.$IDperiode.'">
									  </div>';
								  
			$stmtCategories = retourneStatementSelect('SELECT lettre, nom FROM categorie') ;
			while( $resCategories = $stmtCategories->fetch(PDO::FETCH_ASSOC) ){
					
					$stmtTypes = retourneStatementSelect('SELECT lettre, num, libelle FROM type WHERE lettre="'.$resCategories['lettre'].'"' ) ;
					while( $resTypes = $stmtTypes->fetch(PDO::FETCH_ASSOC) ){
						
						$stmtTarif = retourneStatementSelect('SELECT tarif FROM tarifer WHERE idliaison='.$IDliaison.' AND idperiode='.$IDperiode.' AND lettre="'.$resTypes['lettre'].'" AND num='.$resTypes['num']) ;
						while( $resTarif = $stmtTarif->fetch(PDO::FETCH_ASSOC)){
							
							// vérifie qu'il y a des tarifs à afficher sinon on affichera un message pour en ajouter
							if(!isset($resTarif['tarif']) || $resTarif['tarif'] == null || $resTarif['tarif'] == "" ){
								$verifTarif = false ;
							}else{
								$verifTarif = true ;
							}
							
							$lignes .= '<div class="form-group">
										  <label for="'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" control-label">'.$resCategories['nom'].' / '.$resTypes['libelle'].'</label>
										  <div>
											<input type="number" class="form-control tarif"  cat="'.$resCategories['lettre'].'" typ="'.$resTypes['num'].'" name = "'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" id="'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" value="'.$resTarif['tarif'].'">
										  </div>
										</div>' ;
						}
					}
			}
									
			$lignes .= '
									<div>
										<button class="btn btn-blueish">Mettre à jour</button>
										<a id="del_choix" idliaison="'.$IDliaison.'" idperiode="'.$IDperiode.'" table="tarifer" class="btn btn-reddish">Supprimer</a>
									</div>
								  </fieldset><br>
								  <span id="updt_tarif_msg"></span>
									  <span id="del_msg"></span>
							</form>';
							
			if($verifTarif){
				echo $lignes ;
			}else{
				echo "Il n'y pas de tarif pour cette liaison et cette période, veuillez d'abord en ajouter." ;
			}
			
							
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez une liaison et une période pour le tarif à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
											<label for="select_ChoixLiaison" control-label">Liaison</label>
										<select class="form-control" name="select_ChoixLiaison" id="select_ChoixLiaison">' ;
										
			$stmt = retourneStatementSelect('SELECT code, idsecteur, idportdepart, idportarrivee, distance FROM liaison') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['code'].'">'.$resultat['code'].' - '.returnNomLiaison($resultat['idportdepart'], $resultat['idportarrivee']).'</option>';
			}			
			$lignesFormChoix .= '		</select>
									</div>
									<div class="form-group">
											<label for="select_ChoixPeriode" control-label">Période</label>
										<select class="form-control" name="select_ChoixPeriode" id="select_ChoixPeriode">' ;
										
			$stmt = retourneStatementSelect('SELECT idperiode, datedeb, datefin FROM periode') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idperiode'].'">'.setDateFormatLecture($resultat['datedeb']).' - '.setDateFormatLecture($resultat['datefin']).'</option>';
			}			
			$lignesFormChoix .= '		</select>
									</div>
									<div>
										<button type="submit" class="btn btn-blueish">Modifier cet élément</button>
									</div>
								</form>' ;
			echo $lignesFormChoix ;
		}
?>