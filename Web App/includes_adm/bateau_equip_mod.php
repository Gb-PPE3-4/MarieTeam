<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE BATEAU ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;		$selVoy = "" ; $selFret = "" ;		$table = "" ;
			$stmtBateau = retourneStatementSelect('SELECT idbateau, nom, longueurBat, largeurBat, heritage FROM bateau WHERE idbateau='.$ID) ;
			while( $resultatBateau = $stmtBateau->fetch(PDO::FETCH_ASSOC) ){
				$NOM = $resultatBateau['nom'] ;
				$LONG = $resultatBateau['longueurBat'] ;
				$LARG = $resultatBateau['largeurBat'] ;
				if($resultatBateau['heritage'] == 0){ 
					$selVoy = 'selected="selected"' ; $selFret = "" ; $table = "bvoyageur" ;
					$styleBF = 'style="display:none"' ; 
					$styleBV = 'style="display:block"' ; 
					
				}else if($resultatBateau['heritage'] == 1){ 
					$selFret = 'selected="selected"' ; $selVoy = "" ; $table = "bfret" ;
					$styleBF = 'style="display:block"' ; 
					$styleBV = 'style="display:none"' ; 
				}
			}	
				// initialisation des vars des tables héritages
				$PDSMAX = "" ;
				$IMG = "" ;
				$VITESSE = "" ;
				
				$stmtHerit = retourneStatementSelect('SELECT * FROM '.$table.' WHERE idbateau='.$ID) ;
				while( $resultatHerit = $stmtHerit->fetch(PDO::FETCH_ASSOC) ){
					if($table == "bfret"){ 
						$PDSMAX = $resultatHerit['poidsMaxBatFret'] ; 
					}else{
						$IMG = $resultatHerit['imageBatVoyageur'] ;
						$VITESSE = $resultatHerit['vitesseBatVoy'] ;
					}
				}
			$lignes = '
							<form method="post" id="update_bateau_equip_form" class="form-horizontal col-lg-4">
									  <legend>Modifier les équipements</legend>
								  <fieldset>	
										  <div>
											<input type="hidden" class="form-control" table = "equiper" champs_id ="idbateau" name = "input_id" id="input_id" value="'.$ID.'">
										  </div>
									<div class="form-group">
									  <label for="input_nom" class="control-label">Nom</label>
									  <div>
										<input type="text" disabled="disabled"  class="form-control" name = "input_nom" id="input_nom" value="'.$NOM.'">
									  </div>
									</div>
									<div class="form-group">' ;
										
			$stmt = retourneStatementSelect('SELECT idequip, libequip FROM equipement') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$nb_rows = PDO_num_rows('SELECT * FROM equiper WHERE idbateau='.$ID.' AND idequip='.$resultat['idequip']) ;
				if($nb_rows == 1){$checked = 'checked="checked"' ;}else{$checked="" ;}
				
				$lignes .= '
									  <div class="col-lg-12">
										<div class="input-group">
										  <span class="input-group-addon">
											<input type="checkbox" aria-label="..." value="'.$resultat['idequip'].'" '.$checked.'>
										  </span>
										  <input type="text" class="form-control" aria-label="'.$resultat['libequip'].'" value="'.$resultat['libequip'].'" disabled="disabled">
										</div><!-- /input-group -->
									  </div><!-- /.col-lg-6 -->';
			}			
			$lignes .= '			</div>
									<div>
										<button type="submit" class="btn btn-blueish">Mettre à jour</button>
									  </div>
								  </fieldset><br>
								  <span id="updt_bateau_equip_msg"></span>
							</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un bateau pour gérer ses équipements</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idbateau, nom, longueurBat, largeurBat, heritage FROM bateau') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idbateau'].'">'.$resultat['nom'].'</option>';
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