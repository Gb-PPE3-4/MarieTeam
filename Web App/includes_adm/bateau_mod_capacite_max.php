<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE BATEAU ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != "" && isset($_POST['select_ChoixCat']) && $_POST['select_ChoixCat'] != ""){
			
			$ID = $_POST['select_Choix'] ;	$LETTRE = $_POST['select_ChoixCat'] ; 	$cptMax = 0 ; $NOM = "" ;
			$stmtContenir = retourneStatementSelect('SELECT capaciteMax AS cpt FROM contenir WHERE idbateau="'.$ID.'" AND lettre="'.$LETTRE.'"') ;
			while( $resultatContenir = $stmtContenir->fetch(PDO::FETCH_ASSOC) ){
				$cptMax = $resultatContenir['cpt'] ;
			}	
				
				$stmtBateau = retourneStatementSelect('SELECT * FROM bateau WHERE idbateau='.$ID) ;
				while( $resultatBateau = $stmtBateau->fetch(PDO::FETCH_ASSOC) ){
					$NOM = $resultatBateau['nom'] ;
				}
			$lignes = '
							<form method="post" id="update_bateau_cptmax_form" class="form-horizontal col-lg-4">
									  <legend>Modifier la capacité d\'accueil du bateau :<br> '.$NOM.' type '.$LETTRE.'</legend>
								  <fieldset>	
										  <div>
											<input type="hidden" class="form-control" table = "contenir" champs_id ="idbateau" name = "input_id" id="input_id" value="'.$ID.'">
											<input type="hidden" class="form-control" table = "contenir" champs_id ="lettre" name = "input_lettre" id="input_lettre" value="'.$LETTRE.'">
										  </div>
									<div class="form-group">
									  <label for="input_nom" class="control-label">Nom</label>
									  <div>
										<input type="text" disabled="disabled"  class="form-control" name = "input_nom" id="input_nom" value="'.$NOM.'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" class="control-label">Capacité (nombre de places)</label>
									  <div>
										<input type="number" min="0" class="form-control" name = "input_cptmax" id="input_cptmax" value="'.intval($cptMax).'">
									  </div>
									</div>
										<button type="submit" class="btn btn-blueish">Mettre à jour</button>
									  </div>
								  </fieldset><br>
								  <span id="updt_bateau_cptmax"></span>
							</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un bateau à modifier pour une catégorie</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idbateau, nom, longueurBat, largeurBat, heritage FROM bateau WHERE heritage=0') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idbateau'].'">'.$resultat['nom'].'</option>';
			}			
			$lignesFormChoix .= '		</select>
									</div>
									<div class="form-group">
										<select class="form-control" name="select_ChoixCat" id="select_ChoixCat">' ;
										
			$stmt = retourneStatementSelect('SELECT lettre, nom FROM categorie') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['lettre'].'">'.$resultat['lettre'].' - '.$resultat['nom'].'</option>';
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