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
									</div>';
					

			$stmtCategories = retourneStatementSelect('SELECT lettre, nom FROM categorie') ;
			while( $resCategories = $stmtCategories->fetch(PDO::FETCH_ASSOC) ){
					
					$stmtTypes = retourneStatementSelect('SELECT lettre, num, libelle FROM type WHERE lettre="'.$resCategories['lettre'].'"' ) ;
					while( $resTypes = $stmtTypes->fetch(PDO::FETCH_ASSOC) ){
							
							$lignes .= '<div class="form-group">
										  <label for="'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" control-label">'.$resCategories['nom'].' / '.$resTypes['libelle'].'</label>
										  <div>
											<input type="number" class="form-control tarif"  cat="'.$resCategories['lettre'].'" typ="'.$resTypes['num'].'" name = "'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" id="'.$resCategories['lettre'].'-'.$resTypes['num'].'-input_tarif" value="">
										  </div>
										</div>' ;
					}
			}
			
		$lignes .= '
									<div>
										<button type="" class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_tarif_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>