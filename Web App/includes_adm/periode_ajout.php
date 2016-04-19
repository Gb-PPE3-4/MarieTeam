<?PHP
		$lignes = ' 			<form method="post" id="create_periode_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez une période</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_datedeb" control-label">Date de début de la période</label>
									  <div>
										<input type="date" class="form-control" name = "input_datedeb" id="input_datedeb" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_datefin" control-label">Date de fin</label>
									  <div>
										<input type="date" class="form-control" name = "input_datefin" id="input_datefin" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_periode_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>