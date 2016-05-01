<?PHP
		$lignes = ' 			<form method="post" id="create_port_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un port</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_nom" control-label">Nom du port</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_port_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>