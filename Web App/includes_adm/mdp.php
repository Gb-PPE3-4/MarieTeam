<?PHP
		if(isset($_SESSION['ID'])){
			$lignes = ' 			<form method="post" id="update_mdp_form" class="form-horizontal">
										  <legend>Modifier votre mot-de-passe</legend>
									  <fieldset class="col-lg-4">
											<div class="form-group">
											  <label for="input_mdp" control-label">Mot-de-passe du Membre</label>
											  <div>
												<input type="hidden" class="form-control" table = "membre" champs_id ="id" name = "input_id" id="input_id" value="'.$_SESSION['ID'].'">
											  </div>
											  <div>
												<input type="password" class="form-control" name = "input_mdp" id="input_mdp" value="">
											  </div>
											</div>
										<div>
											<button type="" id="upd_choixmdp" class="btn btn-blueish">Mettre à jour</button>
										</div>
									  </fieldset><br>
									  <span id="updt_mdp_msg"></span>
								</form>';	
			echo $lignes ;
		}
?>