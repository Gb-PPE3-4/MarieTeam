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
							params: {ID:$('#input_id').val(), TABLE:'equiper', CHAMPS_ID:'idbateau'}
						},
						success: function(data)
						{
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
						}
				});
			}else if($(this).attr('table') == "tarifer"){
					$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'delTuple',
							params: {idliaison:$(this).attr('idliaison'), idperiode:$(this).attr('idperiode'), TABLE:$(this).attr('table'), CHAMPS_ID:'none'}
						},
						success: function(data)
						{
							$("#del_msg").html("Les données ont bien été supprimées.");
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
			$("#input_poidsMaxFret").val("") ;
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
	// UPDATE PERIODE
	$("#update_periode_form").submit(function(e){
		e.preventDefault();
		if($("#input_id").val() != "" && $("#input_datedeb").val() != "" && $("#input_datefin").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updatePeriode',
							params: {idperiode:$('#input_id').val(), datedeb:$('#input_datedeb').val(), datefin:$('#input_datefin').val()}
						},
						success: function(data)
						{
							$("#updt_periode_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_periode_msg").html("Vous n'avez pas rempli les champs nécessaires.");
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
				parametres = {'nom':$("#input_nom").val(), 'longueur':$("#input_longueurBat").val(), 'largeur':$("#input_largeurBat").val(), 'heritage':'0', 'img_name':$("#input_imageBatVoyageur").val(), 'vitesse':$("#input_vitesseBatVoy").val()} ;
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
							$.ajax({
								url: "includes_adm/ajax_php_file.php", // Url to which the request is send
								type: "POST",             // Type of request to be send, called as method
								data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								processData:false,        // To send DOMDocument or non processed data file it is set to false
								success: function(data)   // A function to be called if request succeeds
								{
									$("#updt_bateau_msg").html("Les nouvelles données ont bien été enregistrées." + "<br>" + data);
								}
							});
			}else{$("#crea_bateau_msg").html("Vous n'avez pas rempli les champs nécessaires.");}
		}else{
			$("#crea_bateau_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE bateau
	$("#update_bateau_form").submit(function(e){
		e.preventDefault();
		if($('#input_id').val() != "" && $("#input_nom").val() != "" && $("#input_longueurBat").val() != "" && $("#input_largeurBat").val() != "" && $("#select_typebat").val() != ""){
			var parametres ;
			var champs = false ;
			if($("#select_typebat").val() == '1' && $("#input_poidsMaxFret").val() != ""){
				champs = true ;
				parametres = {'idbateau':$('#input_id').val(), 'nom':$("#input_nom").val(), 'longueur':$("#input_longueurBat").val(), 'largeur':$("#input_largeurBat").val(), 'heritage':'1', 'poidsMax':$("#input_poidsMaxFret").val()} ;
			}else if($("#input_vitesseBatVoy").val() != ""){
				champs = true ;
				parametres = {'idbateau':$('#input_id').val(), 'nom':$("#input_nom").val(), 'longueur':$("#input_longueurBat").val(), 'largeur':$("#input_largeurBat").val(), 'heritage':'0', 'img_name':$("#input_imageBatVoyageur").val(), 'vitesse':$("#input_vitesseBatVoy").val()} ;
			}
			if(champs){
				$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateBateau',
							params: parametres
						},
						success: function(data)
						{
						}
			 });
							$.ajax({
								url: "includes_adm/ajax_php_file.php", // Url to which the request is send
								type: "POST",             // Type of request to be send, called as method
								data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								processData:false,        // To send DOMDocument or non processed data file it is set to false
								success: function(data)   // A function to be called if request succeeds
								{
									$("#updt_bateau_msg").html("Les nouvelles données ont bien été enregistrées." + "<br>" + data);
								}
							});
			}
		}else{
			$("#updt_bateau_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// Function to preview image after validation
	$(function() {
		$("#input_image").change(function() {
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				$('#previewing').attr('src','noimage.png');
				return false;
			}
			else
			{
				if($("#input_image").val().indexOf("fakepath") != -1){
					var filename = $("#input_image").val().substring(12) ;
				}else{
					var filename = $("#input_image").val() ;
				}
				$("#input_imageBatVoyageur").val(filename) ;
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	function imageIsLoaded(e) {
		$("#file").css("color","green");
		$('#image_preview').css("display", "block");
		$('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '250px');
		$('#previewing').attr('height', '230px');
	};
	// CREATE EQUIPEMENT
	$("#create_equipement_form").submit(function(e){
		e.preventDefault();
		if($("#input_libequip").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'createEquipement',
							params: {libequip:$('#input_libequip').val()}
						},
						success: function(data)
						{
							$("#crea_equipement_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#crea_equipement_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE EQUIPEMENT
	$("#update_equipement_form").submit(function(e){
		e.preventDefault();
		if($("#input_id").val() != "" && $("#input_libequip").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateEquipement',
							params: {idequip:$('#input_id').val(), libequip:$('#input_libequip').val()}
						},
						success: function(data)
						{
							$("#updt_equipement_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_equipement_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE BATEAU / EQUIPEMENT
	$("#update_bateau_equip_form").submit(function(e){
		e.preventDefault();
		var countChecked = 0 ;
		var parametres = {} ;
		
		if($("#input_id").val() != ""){
			
			parametres.idbateau = $('#input_id').val() ;
			parametres.idequip = "" ;
			
			$( "input:checked" ).each(function(){
				countChecked++ ;
				parametres.idequip = parametres.idequip + $(this).val() + "*" ;
			});
			parametres.idequip = parametres.idequip.substring(0, parametres.idequip.length-1) ;
			
			if(countChecked > 0){
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'updateBateauEquipement',
								params: parametres
							},
							success: function(data)
							{
								$("#updt_bateau_equip_msg").html("Les nouvelles données ont bien été enregistrées.");
							}
				 });
			}
		}else{
			$("#updt_bateau_equip_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	//UPDATE BATEAU / CAPACITE MAX
	$("#update_bateau_cptmax_form").submit(function(e){
		e.preventDefault();
		
		if($("#input_id").val() != "" && $("#input_cptmax").val() > 0 && $("#input_lettre").val() != ""){
			
				$.ajax({
							url: 'includes/functions.php',
							type:'POST',
							data: {
								fonction:'updateBateauContenir',
								params: {idbateau:$('#input_id').val(), lettre:$('#input_lettre').val(),cptMax:$('#input_cptmax').val()}
							},
							success: function(data)
							{
								$("#updt_bateau_cptmax").html("Les nouvelles données ont bien été enregistrées.");
							}
				 });
		}else{
			$("#updt_bateau_cptmax").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE TRAVERSEE
	$("#create_traversee_form").submit(function(e){
		e.preventDefault();
		var heure = $("#input_heure").val() ;
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
	// UPDATE TRAVERSEE
	$("#update_traversee_form").submit(function(e){
		e.preventDefault();
		if($("#input_id").val() != "" && $("#input_date").val() != "" && $("#input_heure").val() != "" && $("#select_liaison").val() != "" && $("#select_bateau").val() != ""){
			$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateTraversee',
							params: {num:$('#input_id').val(), dateTraversee:$('#input_date').val(), heure:$('#input_heure').val(), idliaison:$("#select_liaison").val(), idbateau:$("#select_bateau").val()}
						},
						success: function(data)
						{
							$("#updt_traversee_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
		}else{
			$("#updt_traversee_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// CREATE TARIF
	$("#create_tarif_form").submit(function(e){
		e.preventDefault();
		var verifTarif = true ;
		var catype = "" ;
		var id = "" ;
		var valeur = "" ;
		
		if($("#select_liaison").val() != "" && $("#select_periode").val() != ""){
						parametres = {} ;
						parametres['idliaison'] = $("#select_liaison").val() ;
						parametres['idperiode'] = $("#select_periode").val() ;
			
				$(".tarif").each(function(){
					
					id = $(this).attr('name') ;
					if($(this).val() != "" && $(this).val() != "0" && $(this).val() != 0){
						
							catype = id.substring(0, id.lastIndexOf('-'));
							parametres[catype] = $(this).val() ;
						
					}else{
							verifTarif = false ;
					}
				});
				if(verifTarif){
					$.ajax({
								url: 'includes/functions.php',
								type:'POST',
								data: {
									fonction:'createTarif',
									params: parametres
								},
								success: function(data)
								{	
									$("#crea_tarif_msg").html("Les nouvelles données ont bien été enregistrées.");
								}
					 });
				}else{
					$("#crea_tarif_msg").html("Vous n'avez pas rempli les champs nécessaires.");
				}
		}else{
			$("#crea_tarif_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
	// UPDATE TARIF
	$("#update_tarif_form").submit(function(e){
		e.preventDefault();
		var verifTarif = true ;
		var catype = "" ;
		var id = "" ;
		var valeur = "" ;
		
		if($("#idliaison").val() != "" && $("#idperiode").val() != ""){
						parametres = {} ;
						parametres['idliaison'] = $("#idliaison").val() ;
						parametres['idperiode'] = $("#idperiode").val() ;
			
				$(".tarif").each(function(){
					
					id = $(this).attr('name') ;
					if($(this).val() != "" && $(this).val() != "0" && $(this).val() != 0){
						
							catype = id.substring(0, id.lastIndexOf('-'));
							parametres[catype] = $(this).val() ;
						
					}else{
							verifTarif = false ;
					}
				});
				
			if(verifTarif){
					$.ajax({
						url: 'includes/functions.php',
						type:'POST',
						data: {
							fonction:'updateTarif',
							params: parametres
						},
						success: function(data)
						{
							$("#updt_tarif_msg").html("Les nouvelles données ont bien été enregistrées.");
						}
			 });
			}else{
					$("#updt_tarif_msg").html("Vous n'avez pas rempli les champs nécessaires.");
			}
		}else{
			$("#updt_tarif_msg").html("Vous n'avez pas rempli les champs nécessaires.");
		}
	});
});