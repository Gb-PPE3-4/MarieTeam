<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE BATEAU ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;		$selVoy = "" ; $selFret = "" ;
			$stmtSecteur = retourneStatementSelect('SELECT idbateau, nom, longueurBat, largeurBat, heritage FROM bateau WHERE idbateau='.$ID) ;
			while( $resultatSecteur = $stmtSecteur->fetch(PDO::FETCH_ASSOC) ){
				$NOM = $resultatSecteur['nom'] ;
				$LONG = $resultatSecteur['longueurBat'] ;
				$LARG = $resultatSecteur['largeurBat'] ;
				if($resultatSecteur['heritage'] == 0){ $selVoy = 'selected="selected"' ; $selFret = "" ;}
				else if($resultatSecteur['heritage'] == 1){ $selFret = 'selected="selected"' ; $selVoy = "" ;}
			}	
			$lignes = '
							<form method="post" id="update_bateau_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un bateau</legend>
								  <fieldset>	
									<div class="form-group">
									  <label for="input_nom" class="control-label">Nom</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="'.$NOM.'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_longueurBat" class="control-label">Longueur du bateau</label>
									  <div>
										<input type="number" class="form-control" name = "input_longueurBat" id="input_longueurBat" value="'.$LONG.'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_largeurBat" class="control-label">Largeur du bateau</label>
									  <div>
										<input type="number" class="form-control" name = "input_largeurBat" id="input_largeurBat" 	value="'.$LARG.'">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_typebat" control-label">Type de bateau</label>
										<select class="form-control" name="select_typebat" id="select_typebat">
											<option '.$selVoy.' value="0">Voyageurs</option>
											<option '.$selFret.' value="1">Fret</option>
										</select>
									  </div>
									</div>
									<div class="form-group bvoyageur_form">
									  <label for="input_imageBatVoyageur" class="control-label">Image du bateau</label>
									  <div>
										<input type="file" class="form-control" name = "input_imageBatVoyageur" id="input_imageBatVoyageur" value="">
									  </div>
									</div>
									<div class="form-group bvoyageur_form">
									  <label for="input_vitesseBatVoy" class="control-label">Vitesse en noeuds</label>
									  <div>
										<input type="number" class="form-control" name = "input_vitesseBatVoy" id="input_vitesseBatVoy" value="">
									  </div>
									</div><div class="form-group bfret_form">
									  <label for="input_poidsMaxFret" class="control-label">Poids supporté en Kg</label>
									  <div>
										<input type="number" class="form-control" name = "input_poidsMaxFret" id="input_poidsMaxFret" value="">
									  </div>
									</div>
									<div>
										<button type="submit" class="btn btn-primary">Valider</button>
									  </div>
								  </fieldset><br>
								  <span id="updt_bateau_msg"></span>
							</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un secteur à modifier</legend>
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