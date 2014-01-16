( function( $ ) {
	"use strict";
	
	var itemSize;
	var isLoading = false;
	
	var filters = function(){
		var name_country = $(this).val();	
		var name_tag = $(this).val();
		
		$(".spot").show();
		$(".shop").show();
		$(".image").show();		
		
		$( ".spot" ).not( ".spot." + name_country ).hide();
		$( ".shop" ).not( ".shop." + name_country ).hide();
		$( ".image" ).not( ".image." + name_tag ).hide();
		
	};
	
	var displayForm = function(){
		var form = $(this).attr("id");
		var state = $(this).attr("class");
		if(state == "on"){
			if(form == "add-video" ){
				$("#add-image").removeClass("on");				
				$("#add-image").addClass("off");	
				$(".add-image").hide();
				$("."+form).hide();
				$(this).removeClass("on");
				$(this).addClass("off");
			}else if(form == "add-image" ){
				$("#add-video").removeClass("on");
				$("#add-video").addClass("off");		
				$(".add-video").hide();
				$("."+form).hide();
				$(this).removeClass("on");
				$(this).addClass("off");
			}else{
				$("."+form).hide();
				$(this).removeClass("on");
				$(this).addClass("off");
			}
		}else if(state == "off"){
			if(form == "add-video" ){
				$("#add-image").removeClass("on");
				$("#add-image").addClass("off");	
				$(".add-image").hide();
				$("."+form).show();
				$(this).removeClass("off");
				$(this).addClass("on");
			}else if(form == "add-image" ){
				$("#add-video").removeClass("on");
				$("#add-video").addClass("off");	
				$(".add-video").hide();
				$("."+form).show();
				$(this).removeClass("off");
				$(this).addClass("on");
			}else{
				$("."+form).show();
				$(this).removeClass("off");
				$(this).addClass("on");
			}
		}	
	};
	
	/* 
	var displayForm = function( data ){
		console.log(data.selector);
		var state = $(this).attr("class");
		if( state === "on" ){
			if( ( data.selector === "add-image" ) || ( data.selector === "add-video" ) ){
				$( "#" + data.selector ).removeClass( "on" ).addClass( "off" );
				$( "." + data.selector ).hide();
				$( this ).removeClass( "on" ).addClass( "off" );
			}else{
				$( "."+ data.selector ).hide();
				$( this ).removeClass( "on" ).addClass( "off" );
			}
		}else if( state === "off" ){
			if( ( data.selector === "add-image" ) || ( data.selector === "add-video" ) ){
				$( "#" + data.selector ).removeClass( "on" ).addClass( "off" );
				$( "." + data.selector ).hide().show();
				$( this ).removeClass( "off" ).addClass( "on" );
			}else{
				$( "."+ data.selector ).show();
				$( this ).removeClass( "off" ).addClass( "on" );
			}
		}
	 };
	 */
	 
	var displayFeedbacks = function (){
		if( $( ".error" ).length ){
			var form = $( ".error" ).parents("form");
			var formClass = form.attr("class").replace("add-content ", "");
			console.log(formClass);
			form.show();
			form.parents(".content-menu").find("#"+formClass).removeClass("off").addClass("on");
		}
	};	
	
	var loadMore = function(){		
		if($(window).scrollTop() + $(window).height() > ( $(document).height() - 10 ) && !isLoading){
			isLoading = true;
			for(var i = 0; i < 5; i++){				
				$(".item").eq(itemSize+i).show();	
				if(i === 4){
					isLoading = false;
				}
			}
			itemSize = $(".item:visible").size();
		}
	};
	
	var isEmpty = function(selector){
		if(selector.val() !== ""){
			$(selector).prev("label").hide();
		}
	};
	
	var smoothScroll = function(selector){
		selector.click( function( e ){
			e.preventDefault();
			var ancre = $(this).attr('href');
			var ancrePosition = $(ancre).position();
			$("html, body").animate({
			scrollTop : (ancrePosition.top+1)+"px"
			}, 1000 , function(){
				$("#login_tab").addClass("active-login");
				$(".tab_container_login, #login_div").show();
				$("#user_login").focus();
			});			
		});
	}; 
	
	$( function () {
		// hide mobile nav submit
		$("#mobile-nav-submit").hide();
		$("#filters").change(filters);
		$(".add-content, .add-image, .add-video, .add-article").hide();
		$("#add-spot, #add-shop, #add-article").on("click", displayForm);
		$( "#add-image" ).on( "click", { selector: "add-image" }, displayForm );
		$( "#add-video" ).on( "click", { selector: "add-video" }, displayForm );
		displayFeedbacks();
		$("nav select").change(function() {
			window.location = $(this).find("option:selected").val();
		});
		$(".item:gt(14)").hide();	
		itemSize =  $(".item:visible").size();
		$(document).scroll( function(){
			 loadMore();
		} );
		$("#lightbox a, .the-image a").colorbox();
		// $("#main-content").on("click", loadMore);
		isEmpty($("#user_login"));
		isEmpty($("#user_email"));
		isEmpty($("#user_signup"));
		
		// Smoothscroll the gotologin
		smoothScroll($('.gotologin'));
		
		//Convert address tags to google map links
		$('.adr-link').each(function () {
			var link = '<a href="http://maps.google.com/maps?q=' + encodeURIComponent( $(this).text() ) + '" target="_blank" title="google map external link"><span class="street-address">' + $(this).children('.street-address').text() + '</span><span class="country-name">' + $(this).children('.country-name').text()+ '</span></a>';
			$(this).html(link);
		});
		//Convert address tags to styled google map
		$('.adr-gmap').each(function(){
		
			var geocoder = new google.maps.Geocoder();
			var address = $(this).text();
			var street = $('.street-address').text();
			var country = $('.country-name').text();
			var title = street + ', ' + country;
			if($(this).parents('#the-post').find('article.spots').length>0){
				var imgMarker = 'http://ohmywebstudio.be/pfe/wp-content/themes/ohmybike/img/bikepark-marker.png';
			}else if($(this).parents('#the-post').find('article.shops').length>0){
				var imgMarker = 'http://ohmywebstudio.be/pfe/wp-content/themes/ohmybike/img/bikeshop-marker.png';
			}		
			
			var styles = [
				{
					stylers: [
						{ saturation : -100 },	
						{ lightness : -40 }
					]
				},{
					featureType: "road",
					elementType: "geometry",
					stylers: [
						{ hue: "#24bc0b" },
						{ saturation : 50 }	
					]
				},{
					featureType: "road",
					elementType: "labels",
					stylers: [
						{ hue: "#24bc0b" },
						{ gamma: 1.5 }
					]
				},{
					featureType: "road.local",
					elementType: "geometry",
					stylers: [
						{ saturation : 10 }
					]
				},{
					featureType: "landscape",
					elementType: "geometry",
					stylers: [			
						{ lightness : -60 },
						{ saturation : -60 }		  
					]
				}
			  ];
			
			geocoder.geocode(
				{ 'address': address }, function(results, status) {
					if( status == google.maps.GeocoderStatus.OK){
						var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
					}
					
					var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
					
					var mapOptions = {
						zoom: 12,
						center: new google.maps.LatLng(latitude,longitude),
						scrollwheel: false,
						mapTypeControlOptions: {							
							mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
						}
					}
					
					var gmap = new google.maps.Map(document.getElementById("gmap"), mapOptions);
					var marker = new google.maps.Marker({
						map: gmap,
						position: new google.maps.LatLng(latitude,longitude),
						title: title,
						icon: imgMarker
					});
					
					gmap.mapTypes.set('map_style', styledMap);
					gmap.setMapTypeId('map_style');
				}
			);
			
			
			/*
			var embed ="<iframe width='620' height='350' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";
			$(this).html(embed);
			*/
	   });
		
	} );
} )( jQuery );