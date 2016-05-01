<?PHP
		$lignes = ' 			<form method="post" id="create_liaison_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez une liaison</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_code" control-label">Code de la liaison</label>
									  <div>
										<input type="text" class="form-control" name = "input_code" id="input_code" value="">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_secteur" control-label">Secteur</label>
										<select class="form-control" name="select_secteur" id="select_secteur">' ;
		
		$stmt = retourneStatementSelect('SELECT idsecteur, nom FROM secteur') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['idsecteur'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_depart" control-label">Port de départ</label>
										<select class="form-control" name="select_depart" id="select_depart">' ;
		
		$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_arrivee" control-label">Port d\'arrivée</label>
										<select class="form-control" name="select_arrivee" id="select_arrivee">' ;
		
		$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_dist" control-label">Distance en km</label>
									  <div>
										<input type="text" class="form-control" name = "input_dist" id="input_dist" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_liaison_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>