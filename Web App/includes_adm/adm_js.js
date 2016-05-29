$(window).load(function(){	
	
	// ADMIN SECTEUR
	
	// DELETE POUR TOUS LES TUPLES
	$("#del_choix").click(function(){
		if($("#input_id").val() != ""){
			if($('#input_id').attr('table') == 'bateau'){
				//del bateau heritage puis bateau
				var table = "" ;
				if($("#select_typebat").val() == '1'){
					table = "bfret" ;
				}else if($("#select_typebat").val() == '0'){
					table = "bvoyageur" ;
				}
				$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'delTuple',
							params: {ID:$('#input_id').val(), TABLE:table, CHAMPS_ID:'idbateau'}
						},
						success: function(data)
						{
							$.ajax({
										url: 'includes/functions.php',
										type:'POST',
										data: {
											fonction:'delTuple',
											params: {ID:$('#input_id').val(), TABLE:'bateau', CHAMPS_ID:'idbateau'}
										},
										success: function(data)
										{
											$("#del_msg").html("Les données ont bien été supprimées.");
										}
							 });
						}
				});
			}else{			
				// del generique
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'delTuple',
								params: {ID:$('#input_id').val(), TABLE:$('#input_id').attr('table'), CHAMPS_ID:$('#input_id').attr('champs_id')}
							},
							success: function(data)
							{
								$("#del_msg").html("Les données ont bien été supprimées.");
							}
				 });
			}
		}
	});
	
	// SELECT TYPE BATEAU > changement de form
	$("#select_typebat").change(function(){
		
		if($("#select_typebat").val() == '0'){
			//$("#input_poidsMaxFret").val("") ;
			$(".bvoyageur_form").show() ;
			$(".bfret_form").hide() ;
		}else if($("#select_typebat").val() == '1'){
			/*$("#input_imageBatVoyageur").val("") ; 
			$("#input_vitesseBatVoy").val("") ;*/
			$(".bvoyageur_form").hide() ;
			$(".bfret_form").show() ;
		}
	});
	// CREATE MEMBRE
	$("#creation_membre_form").submit(function(e){
		e.preventDefault();
		if($("#input_login").val() != "" && $("#input_nom").val() != "" && $("#input_prenom").val() != "" && $("#input_mail").val() != "" && $("#input_droit").val() != "" && ($("#input_droit").val() == "1" || $("#input_droit").val() == "0")){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createMembre',
							params: {login:$('#input_login').val(),nom:$('#input_nom').val(),prenom:$('#input_prenom').val(),mail:$('#input_mail').val(),droit:$('#input_droit').val()}
						},
						success: function(data)
						{
							$(crea_membre_msg).html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_membre_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE MEMBRE
	$("#update_membre_form").submit(function(e){
		e.preventDefault();
		if($("#input_login").val() != "" && $("#input_nom").val() != "" && $("#input_prenom").val() != "" && $("#input_mail").val() != "" && $("#input_droit").val() != "" && ($("#input_droit").val() == "1" || $("#input_droit").val() == "0")){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateMembre',
							params: {id:$('#input_id').val(),login:$('#input_login').val(),nom:$('#input_nom').val(),prenom:$('#input_prenom').val(),mail:$('#input_mail').val(),droit:$('#input_droit').val()}
						},
						success: function(data)
						{
							$("#updt_membre_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_membre_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE SELF PASSWORD
	$("#update_mdp_form").submit(function(e){
		e.preventDefault();
		if($("#input_mdp").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updatePassword',
							params: {id:$('#input_id').val(),mdp:$('#input_mdp').val()}
						},
						success: function(data)
						{
							$("#updt_mdp_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_mdp_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE SECTEUR
	$("#creation_secteur_form").submit(function(e){
		e.preventDefault();
		if($("#input_nom").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createSecteur',
							params: {nom:$('#input_nom').val()}
						},
						success: function(data)
						{
							$("#crea_secteur_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_secteur_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE SECTEUR
	$("#update_secteur_form").submit(function(e){
		e.preventDefault();
		if($("#input_nom").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateSecteur',
							params: {idsecteur:$('#input_id').val(), nom:$('#input_nom').val()}
						},
						success: function(data)
						{
							$("#updt_secteur_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_secteur_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE PORT
	$("#create_port_form").submit(function(e){
		e.preventDefault();
		if($("#input_nom").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createPort',
							params: {nom:$('#input_nom').val()}
						},
						success: function(data)
						{
							$("#crea_port_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_port_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE PORT
	$("#update_port_form").submit(function(e){
		e.preventDefault();
		if($("#input_nom").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updatePort',
							params: {idport:$('#input_id').val(), nom:$('#input_nom').val()}
						},
						success: function(data)
						{
							$("#updt_port_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_port_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE PERIODE
	$("#create_periode_form").submit(function(e){
		e.preventDefault();
		var deb = $("#input_datedeb").val() ;
		var fin = $("#input_datefin").val() ;
		if(deb != "" && fin != "" && new Date(deb) < new Date(fin)){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createPeriode',
							params: {'datedeb':deb, 'datefin':fin}
						},
						success: function(data)
						{
							$("#crea_periode_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_periode_msg").html("Vous n'avez pas rempli les champs nécessaires ou vous avez inversé les dates.");
		}
	});
	// CREATE LIAISON
	$("#create_liaison_form").submit(function(e){
		e.preventDefault();
		if($("#input_code").val() != "" && $("#select_secteur").val() != "" && $("#select_depart").val() != "" && $("#select_arrivee").val() != "" && $("#input_dist").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createLiaison',
							params: {'code':$("#input_code").val(),'idsecteur':$("#select_secteur").val(), 'idportdepart':$("#select_depart").val(), 'idportarrivee':$("#select_arrivee").val(), 'distance':$("#input_dist").val()}
						},
						success: function(data)
						{
							$("#crea_liaison_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_liaison_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE LIAISON
	$("#update_liaison_form").submit(function(e){
		e.preventDefault();
		if($("#select_secteur").val() != "" && $("#select_depart").val() != "" && $("#select_arrivee").val() != "" && $("#input_dist").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateLiaison',
							params: {code:$('#input_code').val(), idsecteur:$("#select_secteur").val(), idportdepart:$("#select_depart").val(), idportarrivee:$("#select_arrivee").val(), distance:$("#input_dist").val()}
						},
						success: function(data)
						{
							$("#updt_liaison_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_liaison_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE BATEAU
	$("#create_bateau_form").submit(function(e){
		e.preventDefault();
		if($("#input_nom").val() != "" && $("#input_longueurBat").val() != "" && $("#input_largeurBat").val() != "" && $("#select_typebat").val() != ""){
			var parametres ;
			var champs = false ;
			if($("#select_typebat").val() == '1' && $("#input_poidsMaxFret").val() != ""){
				champs = true ;
				parametres = {'nom':$("#input_nom").val(), 'longueur':$("#input_longueurBat").val(), 'largeur':$("#input_largeurBat").val(), 'heritage':'1', 'poidsMax':$("#input_poidsMaxFret").val()} ;
			}else if($("#input_vitesseBatVoy").val() != ""){
				champs = true ;
				parametres = {'nom':$("#input_nom").val(), 'longueur':$("#input_longueurBat").val(), 'largeur':$("#input_largeurBat").val(), 'heritage':'0', 'img':$("#input_imageBatVoyageur").val(), 'vitesse':$("#input_vitesseBatVoy").val()} ;
			}
			if(champs){
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'createBateau',
								params: parametres
							},
							success: function(data)
							{	
								$("#crea_bateau_msg").html("Les nouvelles données ont bien été enregistrées.");
							}
				 });
			}else{$("#crea_bateau_msg").html("Vous n'avez pas rempli les champs nécessaires.");}
		}else{
			$("#crea_bateau_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE TRAVERSEE
	$("#create_traversee_form").submit(function(e){
		e.preventDefault();
		var heure = $("#input_heure").val() ;
		alert(heure.length);
		alert(heure.indexOf(":"));
		if($("#input_date").val() != "" && heure.length < 6 && heure.length > 3 && heure.indexOf(":") != -1 && $("#select_liaison").val() != "" && $("#select_bateau").val() != ""){
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'createTraversee',
								params: {'dateTraversee':$("#input_date").val(), 'heure':$("#input_heure").val(), 'idliaison':$("#select_liaison").val(), 'idbateau':$("#select_bateau").val()}
							},
							success: function(data)
							{	
								$("#crea_traversee_msg").html("Les nouvelles données ont bien été enregistrées.");
							}
				 });
		}else{
			$("#crea_traversee_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE TARIF
	$("#create_tarif_form").submit(function(e){
		e.preventDefault();
		
		if($("#select_liaison").val() != "" && $("#select_periode").val() != "" 
			&& $("#A-1-input_tarif").val() != "" && $("#A-2-input_tarif").val() != "" && $("#A-3-input_tarif").val() != ""
			&& $("#B-1-input_tarif").val() != "" && $("#B-2-input_tarif").val() != ""
			&& $("#C-1-input_tarif").val() != "" && $("#C-2-input_tarif").val() != "" && $("#C-3-input_tarif").val() != ""){
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'createTarif',
								params: {'idliaison':$("#select_liaison").val(), 'idperiode':$("#select_periode").val(), 'A-1-input_tarif':$("#A-1-input_tarif").val(), 'A-2-input_tarif':$("#A-2-input_tarif").val(), 'A-3-input_tarif':$("#A-3-input_tarif").val(), 'B-1-input_tarif':$("#B-1-input_tarif").val(), 'B-2-input_tarif':$("#B-2-input_tarif").val(), 'C-1-input_tarif':$("#C-1-input_tarif").val(), 'C-2-input_tarif':$("#C-2-input_tarif").val(), 'C-3-input_tarif':$("#C-3-input_tarif").val()}
							},
							success: function(data)
							{	
								$("#crea_tarif_msg").html("Les nouvelles données ont bien été enregistrées.");
							}
				 });
		}else{
			$("#crea_tarif_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
});