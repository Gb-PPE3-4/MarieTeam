$(window).load(function(){	

	// bootstrap submenus
	// For v2 [data-toggle="dropdown"] is required for [data-submenu].
	// For v2 .dropdown-submenu > [data-toggle="dropdown"] is forbidden.
	$('[data-submenu]').submenupicker();

	// menu lateral
	$(".menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#close_secteur_panel").toggle();
    });
	
	// selection de la liaison et actualisation de la page avec l'idliaison en url
	$("#slct_idLiaison").change(function(){
		var url = window.location.href; 
		if (url.indexOf("&idliaison") >= 0){
			url = url.substring(0, url.indexOf("&idliaison"));
		}
		location.href = url+'&idliaison='+$("#slct_idLiaison").val()+'#slct_idLiaison' ;
	});
	
	// selection de la date et actualisation de la page avec la date en url
	$("#slct_dateLiaison").change(function(){
		var url = window.location.href; 
		if (url.indexOf("&date") >= 0){
			url = url.substring(0, url.indexOf("&date"));
		}else if(url.indexOf("#") >= 0){
			url = url.substring(0, url.indexOf("#"));
		}
		location.href = url+'&date='+$("#slct_dateLiaison").val()+'#header_tableTraversee' ;
	});
	
	// annule la reservation en cours
	var cptCheck = 0 ;
	var cpt = 1 ;
	var tableau_data = {};
	$("#div_tabContainer").on("click", '#btn_retourVersTraversee',function() {
		$('#div_tableTraversee').slideDown(  "slow"  );
		$('#desc_options').show();
		$('#reserver').show();
		$('#txtOnReserv').show();
		$('#div_tabContainer').hide();
		$('html,body').animate({scrollTop: $("#div_tableTraversee").offset().top}, 'slow'      );
	});
	
	// sur clic du bouton commençant la reservation, on recupere les infos de la table des traversees
	$("#reserver").click(function() {
		// pour chaque elements de la classe row_traversee correspondant a une traversee, on recupere celle qui est "selectionnee" (1 et 1 seule)
		$(".row_traversee").each(function() {
			if($(this).hasClass("selected")){
				cptCheck++ ;
				if(cptCheck==1){
					// dans la version pc
					//debugging alert($(this).children().first().children().first().hasClass("card-view"));
					if(!$(this).first().hasClass("bs-checkbox") && !$(this).children().first().children().first().hasClass("card-view")){
						$(this).children().each(function() {
							// alert($(this).children().first().hasClass("card-view"));
							// alert($(this).hasClass("bs-checkbox"));
							if(!$(this).hasClass("bs-checkbox")){
								tableau_data[cpt] = $(this).html() ;
								cpt = cpt +1 ;
							}
						});
					// dans la version mobile
					}else if($(this).children().first().children().first().hasClass("card-view")){
						$(this).children().first().children().each(function() {
							if($(this).children().first().attr("checked")!='checked'){
								if($(this).children().last().hasClass("value")){
									// alert($(this).children().last().hasClass("value")) ;
									tableau_data[cpt] = $(this).children().last().html() ;
									cpt = cpt +1 ;
								}
							}
						});
					}
				}
			}
		});
		cpt = 1 ;
		// si il y a plus d'une traversee selectionnee, on envoie un msg d'alerte
		if(cptCheck > 1){
			// affichage d'un mesg d'alerte
			$('#alert').html('<div style="margin-top: 20px;" class="col-lg-12 alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>Veuillez ne choisir<strong> qu\'une </strong>traversée !</div>');
			$('html,body').animate({scrollTop: $("#alert").offset().top}, 'slow'      );
			$('#alert').animate({width: "100%"}, "slow" );
			$( "#alert" ).css({width: ""})
			cptCheck = 0 ;
		
		// s'il n'y en a bien qu'une on affiche le tableau de reservation en php via ajax
		}else if(cptCheck == 1){
			cptCheck = 0 ;
			$.ajax({
                    url: 'includes/functions.php',
                    type:'POST',
                    data: {
                        fonction:'retourneTabReservation',
						params: {idliaison:$('#div_tabContainer').attr("attr_idLiaison"),date:$('#div_tabContainer').attr("attr_date"), idtraversee:tableau_data['1']}
					},
					success: function(data)
                    {
						$("#div_tabContainer").html(data);
                    }
            });
			$('#div_tabContainer').attr("attr_idtraversee",tableau_data['1']);
			$('#span_portsLiaison').html($("#slct_idLiaison option:selected").html());
			$('#span_numTraversee').html(tableau_data['1']);
			$('#span_date').html(tableau_data['2']);
			$('#span_heure').html(tableau_data['3'].replace(":", "H"));
			//debugging alert($('#slct_idLiaison').attr("id_traversee"));
			$('#div_tableTraversee').hide();
			$('#desc_options').hide();
			$('#reserver').hide();
			$('#txtOnReserv').hide();
			$('#div_tabContainer').show();
			$('html,body').animate({scrollTop: $("#div_tabContainer").offset().top}, 'slow'      );
			metNbPlacesAJour();
		
		// si il n'y a aucune traversee selectionnee, on envoie un msg d'alerte
		}else if(cptCheck == 0){
			$('#alert').html('<div style="margin-top: 20px;" class="col-lg-12 alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">x</button>Veuillez choisir une <strong>traversée !</strong></div>');
			$('html,body').animate({scrollTop: $("#alert").offset().top}, 'slow'      );
			$('#alert').animate({width: "100%"}, "slow" );
			$( "#alert" ).css({width: ""});
			cptCheck = 0 ;
		}
    });
	
	var total = 0 ;
	$("#div_tabContainer").on("change", '.qte',function() {
		$('.qte').each(function(){
			//debugging alert($(this).val());
			//debugging alert($(this).closest("td").next().html());
			total = parseFloat(parseFloat(total) + parseFloat($(this).val()) * parseFloat($(this).closest("td").next().html())) ;
		});
		$('#txt_totalPrix').val(0);
		//debugging alert(total);
		$('#txt_totalPrix').val(parseFloat(total).toFixed(2));
		total = 0 ;
	});
	
	$("#div_tabContainer").on("click", '#btn_validerRservation',function() {
		$('#btn_validerRservation').attr('data-toggle', '');
		var verifPrsceInfos = false ;
		$('#span_nom').html($('#txt_nomR').val());
		$('#span_adresse').html($('#txt_adresseR').val());
		$('#span_cp').html($('#txt_cpR').val());
		$('#span_ville').html($('#txt_villeR').val());
		
		var qteCT=0;
		var idQte='';
		var idSpan='';
		$('.qte').each(function(){
			idQte = $(this).attr("id").substring(0, $(this).attr("id").indexOf("qte")) ;
			qteCT = $(this).val() ;
			$('.span_libCategType').each(function(){
				idSpan = $(this).attr("id");
				// console.log(idSpan.substring(5,idSpan.length));
				
				if(idSpan.substring(5,idSpan.length) == idQte){
					$(this).html(qteCT);
					if(qteCT == 0){
						$(this).parent().hide();
					}else{
						$(this).parent().show();
					}
				}
			});
			if(qteCT > 0 && verifPrsceInfos == false){
				verifPrsceInfos = true ;
			}
			if($('#txt_nomR').val() == '' || $('#txt_adresseR').val() == '' || $('#txt_cpR').val() == '' || $('#txt_villeR').val() == ''){verifPrsceInfos = false ;}
		});
		
		$('#span_totalPrix').html($('#txt_totalPrix').val());
		if(verifPrsceInfos == true){
			$('#btn_validerRservation').attr('data-toggle', 'modal');
			$('#div_confirmReserv').toggle();
		}else{
			$('#th_qteTableReserv').addClass('txt_red');
			$('#div_tabContainer').find("input").each(function(){
				if($(this).attr("required")=="required"){
					$(this).css("border-color","red");
				}
			});
		}
	});
	
	$("#btn_confimerReservation").click(function() {
		var tableau_dataReservation = {};
		// alert("we're in!");
		var idTravReserv = $('#span_numTraversee').html();
		var nomReserv = $('#span_nom').html();
		var adresseTravReserv = $('#span_adresse').html();
		var cpReserv = $('#span_cp').html();
		var villeTravReserv = $('#span_ville').html();
		
		$('.span_libCategType').each(function(){
			idQte = $(this).attr("id").substring($(this).attr("id").indexOf("_")+1) ;
			qteCT = $(this).html() ;
			tableau_dataReservation[idQte] = qteCT ;
		});
		console.log(tableau_dataReservation);
		$.ajax({
                url: 'includes/functions.php',
                type:'POST',
                data: {
                    fonction:'enregistrerNouvelleReserv',
					params: {idtraversee:idTravReserv,nom:nomReserv,adresse:adresseTravReserv,cp:cpReserv,ville:villeTravReserv,tab:tableau_dataReservation}
				},
				success: function(data)
                {
					// console.log(data);
					if(data == 'false'){	location.href = 'message.php?status=0' ;					
					}else{ location.href = 'message.php?status=1' ;	}
                }
        });
	});
	
});

function metNbPlacesAJour(){
	var chainePropre = '' ;
	var collectionPrix = '' ;
	var cpt = 0 ;
	$.ajax({
                url: 'includes/functions.php',
                type:'POST',
                data: {
                    fonction:'recupPlacesRestantes',
					params: {idtraversee: $('#div_tabContainer').attr("attr_idtraversee")}
				},
				success: function(data)
                {
					console.log(data);
					chainePropre = data.split(',');
					//debugging console.log(chainePropre);
					if(chainePropre != '' && chainePropre != null){
						
						$(".placesRest").each(function(){
							collectionPrix += $(this).html(chainePropre[cpt])+',';
							cpt++;
						});
						//debugging console.log(collectionPrix);
						//debugging console.log(chainePropre);
					}
                   }
    });
	setTimeout(metNbPlacesAJour, 30000);
}
	

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    //debugging alert(out);
}