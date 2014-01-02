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
		
		$( ".country-name" ).not( ".country-name." + name_country ).parents(".spot").hide();
		$( ".country-name" ).not( ".country-name." + name_country ).parents(".shop").hide();
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
	
	$( function () {
		$(".country-name").each(function(){
			$(this).addClass($(this).text());
		});
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
	} );
} )( jQuery );