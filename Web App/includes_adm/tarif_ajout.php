<?PHP
		$lignes = ' 			<form method="post" id="create_tarif_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un tarif pour une liaison et une période</legend>
								  <fieldset>
									<div class="form-group">
									  <div>
									    <label for="select_liaison" control-label">Liaison</label>
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
									    <label for="select_periode" control-label">Période</label>
										<select class="form-control" name="select_periode" id="select_periode">' ;
		
		$stmtPeriode = retourneStatementSelect('SELECT idperiode FROM periode') ;
		while( $resultatPeriode = $stmtPeriode->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '	<option value="'.$resultatPeriode['idperiode'].'">'.returnNomPeriode($resultatPeriode['idperiode']).'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="A-1-input_tarif" control-label">Tarif Passager Adulte</label>
									  <div>
										<input type="text" class="form-control" name = "A-1-input_tarif" id="A-1-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="A-2-input_tarif" control-label">Tarif Passager Mineur</label>
									  <div>
										<input type="text" class="form-control" name = "A-2-input_tarif" id="A-2-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="A-3-input_tarif" control-label">Tarif Passager Mineur < 8 ans</label>
									  <div>
										<input type="text" class="form-control" name = "A-3-input_tarif" id="A-3-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="B-1-input_tarif" control-label">Tarif Véhicule < à 2m et longueur < 4m</label>
									  <div>
										<input type="text" class="form-control" name = "B-1-input_tarif" id="B-1-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="B-2-input_tarif" control-label">Tarif Véhicule < à 2m et longueur < 5m</label>
									  <div>
										<input type="text" class="form-control" name = "B-2-input_tarif" id="B-2-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="C-1-input_tarif" control-label">Tarif Véhicule < à 2m - Fourgon</label>
									  <div>
										<input type="text" class="form-control" name = "C-1-input_tarif" id="C-1-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="C-2-input_tarif" control-label">Tarif Véhicule < à 2m - Camping Car</label>
									  <div>
										<input type="text" class="form-control" name = "C-2-input_tarif" id="C-2-input_tarif" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="C-3-input_tarif" control-label">Tarif Véhicule < à 2m - Camion</label>
									  <div>
										<input type="text" class="form-control" name = "C-3-input_tarif" id="C-3-input_tarif" value="">
									  </div>
									</div>
									<div>
										<button type="" class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_tarif_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>