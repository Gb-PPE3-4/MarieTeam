<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	if(isset($_GET['mod']) && $_GET['mod'] != ""){
		$lignes = ' 			<form method="post" class="form-horizontal">
									  <legend>Choisissez un port à modifier :</legend>
								  <fieldset class="col-lg-4">
									<div class="form-group">
									  <div>
										<select class="form-control" name="select_port" id="select_port">' ;
		
		$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" control-label">Nom du port</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div>
										<button type="" id="crea_choixSect" class="btn btn-primary">Valider</button>
										<button type="" id="upd_choixSect" class="btn btn">Mettre à jour</button>
										<button type="" id="del_choixSect" class="btn btn-warning">Supprimer</button>
									</div>
								  </fieldset>
							</form>';
							
	}
		echo $lignes ;
?>