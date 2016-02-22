<?PHP
	$lignes = 'Désolé, le site vient de rencontrerune erreur.' ;

	if(isset($_POST['select_bateau']) && $_POST['select_bateau'] != ""){$choixBateau = $_POST['select_bateau'] ;}else{$choixBateau = '' ;}
	
	if(isset($_GET['mod'])){
		if($_GET['mod'] == 0 && $_GET['mod'] == 0){
			
							$lignes = '
							<form method="post" class="form-horizontal">
									  <legend>Choisissez un bateau à modifier :</legend>
								  <fieldset>
									<div class="form-group">
									  <div class="col-lg-3">
										<select class="form-control" name="select_bateau" id="select_bateau">' ;
							
							$stmt = retourneStatementSelect('SELECT idbateau, nom FROM bateau') ;
							while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
								if($choixBateau == $resultat['idbateau']){$selected = 'selected' ;}else{$selected = '' ;}
								$lignes .= '	<option value="'.$resultat['idbateau'].'" '.$selected.'>'.$resultat['nom'].'</option>';
							}
							$stmt = null ;
							
							$lignes .= '
										</select>
									  </div>
									  <div class="col-lg-3">
										<button type="submit" class="btn btn-primary">Valider</button>
									  </div>
									</div>
								  </fieldset>
							</form>';
							echo $lignes ;
			
		}
		if($_GET['mod'] == 1 || ($_GET['mod'] == 0 && $choixBateau != '')){
			
							$stmt = retourneStatementSelect('SELECT idbateau, nom, longueurBat, largeurBat, heritage FROM bateau WHERE idbateau ='.$choixBateau) ;
							$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
								if($resultat['heritage'] == 0){$table = 'bvoyageur' ;}else{$table = 'bfret' ;}
								$stmtHeritage = retourneStatementSelect('SELECT * FROM '.$table.' WHERE idbateau ='.$choixBateau) ;
								$resultatHeritage = $stmtHeritage->fetch(PDO::FETCH_ASSOC);
							
							
			$lignes = '
							<br><form method="post" class="form-horizontal">
								  <fieldset>	
									<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Nom</label>
									  <div class="col-lg-6">
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="'.$resultat['nom'].'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Longueur du bateau</label>
									  <div class="col-lg-6">
										<input type="number" class="form-control" name = "input_longueurBat" id="input_longueurBat" value="'.$resultat['longueurBat'].'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Largeur du bateau</label>
									  <div class="col-lg-6">
										<input type="number" class="form-control" name = "input_largeurBat" id="input_largeurBat" 	value="'.$resultat['largeurBat'].'">
									  </div>
									</div>';

			if($table == 'bvoyageur'){
				$lignes .= '		<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Image du bateau</label>
									  <div class="col-lg-6">
										<input type="text" class="form-control" name = "input_imageBatVoyageur" id="input_imageBatVoyageur" value="'.$resultatHeritage['imageBatVoyageur'].'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Vitesse en noeuds</label>
									  <div class="col-lg-6">
										<input type="number" class="form-control" name = "input_vitesseBatVoy" id="input_vitesseBatVoy" value="'.$resultatHeritage['vitesseBatVoy'].'">
									  </div>
									</div>
							';
			}else{
				$lignes .= '		<div class="form-group">
									  <label for="input_nom" class="col-lg-2 control-label">Poids supporté en Kg</label>
									  <div class="col-lg-6">
										<input type="number" class="form-control" name = "input_poidsMaxFret" id="input_poidsMaxFret" value="'.$resultatHeritage['poidsMaxBatFret'].'">
									  </div>
									</div>
							';
			}
			
			$lignes .= '
									  <div class="col-lg-16">
										<button type="submit" class="btn btn-primary">Valider</button>
									  </div>
								  </fieldset>
							</form>';
							
			
			echo $lignes ;
		}
	}	
?>