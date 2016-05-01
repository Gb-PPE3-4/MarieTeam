<?PHP
		$lignes = ' 			<form method="post" id="create_traversee_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez une traversée</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_date" control-label">Date de la traversée</label>
									  <div>
										<input type="date" class="form-control" name = "input_date" id="input_date" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_heure" control-label">Heure de la traversée</label>
									  <div>
										<input type="text" class="form-control" name = "input_heure" id="input_heure" placeholder="9:30" value="">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_liaison" control-label">Liaison effectuée</label>
										<select class="form-control" name="select_liaison" id="select_liaison">' ;
		
		$stmt = retourneStatementSelect('SELECT code, idportdepart, idportarrivee FROM liaison') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['code'].'">'.returnNomLiaison($resultat['idportdepart'], $resultat['idportarrivee']).'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_bateau" control-label">Bateau utilisé</label>
										<select class="form-control" name="select_bateau" id="select_bateau">' ;
		
		$stmt = retourneStatementSelect('SELECT idbateau, nom FROM bateau') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultat['idbateau'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div>
										<button type="" class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_traversee_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>