<?PHP
							
			$lignes = '
							<form method="post" id="create_bateau_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez un bateau</legend>
								  <fieldset>	
									<div class="form-group">
									  <label for="input_nom" class="control-label">Nom</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_longueurBat" class="control-label">Longueur du bateau</label>
									  <div>
										<input type="number" class="form-control" name = "input_longueurBat" id="input_longueurBat" value="">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_largeurBat" class="control-label">Largeur du bateau</label>
									  <div>
										<input type="number" class="form-control" name = "input_largeurBat" id="input_largeurBat" 	value="">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_typebat" control-label">Type de bateau</label>
										<select class="form-control" name="select_typebat" id="select_typebat">
											<option value="0">Voyageurs</option>
											<option value="1">Fret</option>
										</select>
									  </div>
									</div>
									<div class="form-group bvoyageur_form">
									  <label for="input_imageBatVoyageur" class="control-label">Image du bateau</label>
									  <div>
										<input disabled="disabled" type="text" class="form-control" name = "input_imageBatVoyageur" id="input_imageBatVoyageur" value="">
									  </div>
									</div>
									
									
									<div class="form-group bvoyageur_form">
										<div id="image_preview"><img id="previewing" src="" /></div>
									  <label for="input_image" class="control-label">Image du bateau</label>
									  <div>
										<input type="file" class="form-control" name = "input_image" id="input_image">
									  </div>
									</div>
									
									
									<div class="form-group bvoyageur_form">
									  <label for="input_vitesseBatVoy" class="control-label">Vitesse en noeuds</label>
									  <div>
										<input type="number" class="form-control" name = "input_vitesseBatVoy" id="input_vitesseBatVoy" value="">
									  </div>
									</div><div class="form-group bfret_form">
									  <label for="input_poidsMaxFret" class="control-label">Poids supporté en Kg</label>
									  <div>
										<input type="number" class="form-control" name = "input_poidsMaxFret" id="input_poidsMaxFret" value="">
									  </div>
									</div>
									<div>
										<button type="submit" class="btn btn-primary">Valider</button>
									  </div>
								  </fieldset><br>
								  <span id="crea_bateau_msg"></span>
							</form>';
							
			
			echo $lignes ;
?>