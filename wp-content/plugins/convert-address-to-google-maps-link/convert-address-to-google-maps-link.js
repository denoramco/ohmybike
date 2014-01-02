jQuery(document).ready(function($) {
	//Convert address tags to google map links - Copyright Michael Jasper 2011
	$('.adr-link').each(function () {
		var link = '<a href="http://maps.google.com/maps?q=' + encodeURIComponent( $(this).text() ) + '" target="_blank" title="google map external link"><span class="street-address">' + $(this).children('.street-address').text() + '</span><span class="country-name">' + $(this).children('.country-name').text()+ '</span></a>';
		$(this).html(link);
	});
	$('.adr-gmap').each(function(){
	
		var geocoder = new google.maps.Geocoder();
		var address = $(this).text();
		var street = $('.street-address').text();
		var country = $('.country-name').text();
		var title = street + ', ' + country;
		if($(this).parents('#the-post').find('article.spots').length>0){
			var imgMarker = 'http://localhost/PFE/wp-content/plugins/convert-address-to-google-maps-link/img/bikepark-marker.png';
		}else if($(this).parents('#the-post').find('article.shops').length>0){
			var imgMarker = 'http://localhost/PFE/wp-content/plugins/convert-address-to-google-maps-link/img/bikeshop-marker.png';
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
});