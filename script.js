$(document).ready(function(){

    console.log(structure);

    for(var i = 0 ; i < structure.lignes.length ; i++){

    	var line = '<div class="row ligne">';

    	console.log(structure.lignes[i]);
    	for( var j = 0 ; j < structure.lignes[i].nbVignette ; j++){
	    	switch(structure.lignes[i].type){//structure.lignes[i].vignettes[j].
	    		case "4s":
	    			line += '<div class="col-lg-3 col-md-6 vignette"> <div class="socialMedia"><a class="facebook" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path></svg></a><a class="twitter" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path></svg></a></div><div class="bandeauPromo"><div class="promo"><span class="valEco"><span class="txtJusqua">'+structure.lignes[i].vignettes[j+1].economie+'</span><del class="oldPrice">'+structure.lignes[i].vignettes[j+1].prix_barre+'</del>'+structure.lignes[i].vignettes[j+1].valeur_eco+'</span></div></div><a href="'+structure.lignes[i].vignettes[j+1].lien_vignette+'"><img src="'+structure.lignes[i].vignettes[j+1].image_vignette+'"/></a></div>';
				break;

				case "2b":
	    			line += '<div class="col-lg-6 col-mg-6 vignette"><div class="socialMedia"><a class="facebook" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path></svg></a><a class="twitter" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path></svg></a></div><div class="bandeauPromo"><div class="promo"><span class="valEco"><span class="txtJusqua">'+structure.lignes[i].vignettes[j+1].economie+'</span>'+structure.lignes[i].vignettes[j+1].valeur_eco+'</span></div></div><a href="'+structure.lignes[i].vignettes[j+1].lien_vignette+'"><img src="'+structure.lignes[i].vignettes[j+1].image_vignette+'"></a></div>';
				break;

				case "2s1b2s":
					if(j == 0  || j == 3){
						line += '<div class="col-lg-3 col-mg-6"><div class="xblocs vignette"><div class="socialMedia"><a class="facebook" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path></svg></a><a class="twitter" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path></svg></a></div><a style="display: block;" href="'+structure.lignes[i].vignettes[j+1].lien_vignette+'"><div class="bandeauPromo"><div class="promo"><span class="valEco"><span class="txtJusqua">'+structure.lignes[i].vignettes[j+1].economie+'</span>'+structure.lignes[i].vignettes[j+1].valeur_eco+'</span></div></div><img src="'+structure.lignes[i].vignettes[j+1].image_vignette+'"></a></div>';
					}else if(j == 2){
						line += '<div class="col-lg-6 col-mg-6 vignette mTop1200"><a href="'+structure.lignes[i].vignettes[j+1].lien_vignette+'"><img src="'+structure.lignes[i].vignettes[j+1].image_vignette+'"></a></div>';
					}else if(j == 1 | j ==4){
						line += '<div class="xblocs vignette mTop17"><div class="socialMedia"><a class="facebook" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path></svg></a><a class="twitter" href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path></svg></a></div><a style="display: block;" href="'+structure.lignes[i].vignettes[j+1].lien_vignette+'"><div class="bandeauPromo"><div class="promo"><span class="valEco"><span class="txtJusqua">'+structure.lignes[i].vignettes[j+1].economie+'</span><del class="oldPrice">'+structure.lignes[i].vignettes[j+1].prix_barre+'</del>'+structure.lignes[i].vignettes[j+1].valeur_eco+'</span></div></div><img src="'+structure.lignes[i].vignettes[j+1].image_vignette+'"></a></div></div>';						
					}
	    				
				break;
	    	}
	    }
	    line += '</div>';
    	$('#linesContainer').append(line);
    	resizePromo();
    }

	//
	// DEFINITION DU COMPTEUR
	//
	var compteurVP = new function(){
		this.container = $('.bandeauCompteur');
		this.dateFin = null;
		this.miliDateFin = null;

		this.init = function(dateFin){
			compteurVP.dateFin = dateFin;
			compteurVP.miliDateFin = compteurVP.dateFin.getTime();
			this.lunchChrono();

		}

		this.lunchChrono = function(){

			setInterval(function(){

				dateToday = new Date();
				/*var dateToday = new Date(2016,06,13,00,00,00,00);*/
				miliDateToday = dateToday.getTime();

				var secDateDelta = (compteurVP.miliDateFin - miliDateToday)/1000;

				var secPassee = Math.floor(secDateDelta % 60);
				var minutesPassee = Math.floor(secDateDelta / 60 % 60);
				var heuresPassee = Math.floor(secDateDelta / 3600 );
				var joursPassee = Math.floor(secDateDelta / (3600*24) );

				if(joursPassee>0){heuresPassee-=joursPassee*24;}

				if(joursPassee < 10){joursPassee = '0'+joursPassee;}
				if(heuresPassee < 10){heuresPassee = '0'+heuresPassee;}
				if(minutesPassee < 10){minutesPassee = '0'+minutesPassee;}
				if(secPassee < 10){secPassee = '0'+secPassee;}

				if(secDateDelta > 0){

					compteurVP.container.html("Fin des ventes dans : "+joursPassee+"J:"+heuresPassee+"H:"+minutesPassee+"M:"+secPassee+"S");

				}
				else{

					countHrs.innerHTML = '00';
					countMnts.innerHTML = '00';
					countScs.innerHTML = '00';
					countMscs.innerHTML = '00';

				}

			}, 500);

		}

	}

	//
	// LANCEMENT DU COMPTEUR
	//
	compteurVP.init(new Date(2017,08,21,15,49,00,00));


	// 
	// RESIZE ENCART REDUCTION
	// 
	resizePromo();

	function resizePromo(){
		$('.vignette').each(function(){
			$(this).find('.promo').css({fontSize:$(this).width()*27/270+"px"});
		})
	}

	$(window).on('resize',resizePromo);

	//
	// GESTION DES IMAGES SUIVANT LES BREAKPOINTS
	//
	
	switchSrc();

	function switchSrc(){
		var screenWidth = $(window).width();
		$('img').each(function(){
			if($(this).data('tabsrc') != undefined){

				if(screenWidth <= '991'){
					$(this).attr('src',$(this).data('tabsrc'));
				}
				else{
					$(this).attr('src',$(this).data('pcsrc'));
				}

			}
		})
	}

	$(window).on('resize',switchSrc);

	//
	// GESTION DE LA POSITION DU COMPTEUR
	//
	
	cmptPosition();
	var fixed = false, topCompteurPos = $('.bandeauCompteur').offset().top;

	function cmptPosition(){
		
		if( $(window).scrollTop() > topCompteurPos && !fixed){
			$('.bandeauCompteur').addClass('fixedCompteur');
			$('.spacerFixed').css({'display':'block'});
			fixed = true;
		}else if( $(window).scrollTop() <= topCompteurPos && fixed ){
			$('.bandeauCompteur').removeClass('fixedCompteur');
			$('.spacerFixed').css({'display':'none'});
			fixed = false;
		}

	}

	$(window).on('scroll',cmptPosition);

	//
	// GESTION DE LA POSITION DE LA MONGOLFIERE
	//
	
	function mongPosition(){
		
		$('.ballonBg').css({'top':200-($(window).scrollTop()/30) +'px'});

	}

	$(window).on('scroll',mongPosition);


})