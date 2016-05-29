<?PHP
	
		$lignes = ' 			<form method="post" id="creation_membre_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un membre</legend>
								  <fieldset>
									<div class="form-group">
									  <label for="input_login" control-label">Login du membre</label>
									  <div>
										<input type="text" class="form-control" name = "input_login" id="input_login" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" control-label">Nom du membre</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_prenom" control-label">Prénom du membre</label>
									  <div>
										<input type="text" class="form-control" name = "input_prenom" id="input_prenom" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_mail" control-label">Mail du membre</label>
									  <div>
										<input type="text" class="form-control" name = "input_mail" id="input_mail" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_droit" control-label">Droits du membre (0 base ; 1 admin)</label>
									  <div>
										<input type="text" class="form-control" name = "input_droit" id="input_droit" value="">
									  </div>
									</div>
									<div>
										<button class="btn btn-primary">Valider</button>
									</div>
								  </fieldset><br>
								  <span id="crea_membre_msg"></span>
							</form>';
							
		echo $lignes ;
?>