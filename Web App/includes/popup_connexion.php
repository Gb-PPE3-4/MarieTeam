<!-- Modal/Popup Login with form -->
			<div class="bs-component live-less-editor-hovercontainer" data-relatedvars="modal-content-bg,modal-content-fallback-border-color,modal-content-border-color,modal-backdrop-bg,modal-backdrop-opacity,modal-title-padding,modal-header-border-color,modal-title-padding,modal-title-line-height,modal-inner-padding,modal-footer-border-color,modal-md,modal-sm,modal-lg">
				<div id="modal_connexion" class="modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title">Connexion collaborateurs MarieTeam</h4>
							</div>
							<div class="modal-body">
								<form action="includes/login_connexion.php" method="post" class="form-horizontal">
									<fieldset>
										<div class="form-group">
											<label for="input_login" class="col-lg-3 control-label">Pseudo</label>
											<div class="col-lg-9 input-group">
												<input required="required" type="text" name="identifiant" class="form-control" id="input_login" placeholder="Pseudo" aria-describedby="basic-addon1">
												<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="input_password" class="col-lg-3 control-label">Mot de passe</label>
											<div class="col-lg-9 input-group">
												<input required="required" type="password" name="mdp" class="form-control" id="input_password" placeholder="Mot de passe">
												<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-asterisk"></span>
											</div>
										</div>
										<div id = "alert_connexion" style="display:none;">
											<div class="alert alert-dismissible alert-danger">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<strong>Informations incorrectes! </strong>Il manque des données.
											</div>
										</div>
										<div class="modal-footer">
											<div class="btn-group">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Annuler</button>
												<button type="reset" class="btn btn-warning">Effacer</button>
												<button type="submit" id="connexion_salarie" class="btn btn-success">Se connecter</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
		   </div>