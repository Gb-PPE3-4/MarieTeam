<?PHP
		$lignes = ' 			<form method="post" id="create_equipement_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un equipement</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_libequip" control-label">Nom de l\'équipement</label>
									  <div>
										<input type="text" class="form-control" name = "input_libequip" id="input_libequip" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_equipement_msg"></span>
							</form>';
							
	
		echo $lignes ;
?>