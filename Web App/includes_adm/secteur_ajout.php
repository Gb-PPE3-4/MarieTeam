<?PHP
	
		$lignes = ' 			<form method="post" id="creation_secteur_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un secteur</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_nom" control-label">Nom du secteur</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_secteur_msg"></span>
							</form>';
							
		echo $lignes ;
?>