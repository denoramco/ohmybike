/*
	WP User Control
	Contact: Bill Edgar (bill@palmspark.com)
	http://palmspark.com/wordpress-user-control
	
	Copyright (c) 2012, PalmSpark LLC
	All rights reserved.

	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	    
	    * Redistributions of source code must retain the above copyright
	      notice, this list of conditions and the following disclaimer.
	    * Redistributions in binary form must reproduce the above copyright
	      notice, this list of conditions and the following disclaimer in the
	      documentation and/or other materials provided with the distribution.
	    * Neither the name of the Oakton Data LLC nor the
	      names of its contributors may be used to endorse or promote products
	      derived from this software without specific prior written permission.

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
	ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	DISCLAIMED. IN NO EVENT SHALL Oakton Data LLC BE LIABLE FOR ANY
	DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

function wp_user_control_widget_js( target ) {
	// hide user panel
	jQuery("#drop").hide();
	jQuery(".userbutton").click(function(){
		if(jQuery(this).hasClass("active-panel")){
			jQuery(this).removeClass("active-panel");
			jQuery("#drop").hide();
		}else{
			jQuery(this).addClass("active-panel");
			jQuery("#drop").show();
		}
	});
	// show-hide login-signup tab
	jQuery( ".tab_container_login" ).hide();
	jQuery( "ul.tabs_login li" ).click(function() {
		if(jQuery(this).hasClass("active-login")){
			jQuery( "ul.tabs_login li" ).removeClass( "active-login" );
			jQuery( ".tab_container_login" ).hide();
			jQuery( ".tab_content_login" ).hide();
		}else{
			jQuery( "ul.tabs_login li" ).removeClass( "active-login" );
			jQuery( this ).addClass( "active-login" );
			jQuery( ".tab_container_login" ).show();
			jQuery( ".tab_content_login" ).hide();
			var activeTab = jQuery( this ).find( "a" ).attr( "href" );
			if ( jQuery.browser.msie ) { 
				jQuery( activeTab ).show();
			} else { 
				jQuery( activeTab ).show();
			}
		}
		return false;
	});
	if( jQuery( ".registerfail" ).length ){
		jQuery( "ul.tabs_login li" ).removeClass( "active-login" );
		jQuery("#register_tab").addClass("active-login");
		jQuery( ".tab_container_login, #register_div" ).show();
	}else if( jQuery( ".loginfail" ).length ){
		jQuery( "ul.tabs_login li" ).removeClass( "active-login" );
		jQuery("#login_tab").addClass("active-login");
		jQuery( ".tab_container_login, #login_div" ).show();	
	}else if( jQuery( ".check" ).length ){
		jQuery( "ul.tabs_login li" ).removeClass( "active-login" );
		jQuery("#register_tab").addClass("active-login");
		jQuery( ".tab_container_login, #register_div" ).show();
	};
	// hide label when input is focused
	jQuery("#user_login, #user_pass, #user_signup, #user_email, #user_signup_pass").focus(function() {
		jQuery(this).prev('label').hide();
	});
	jQuery("#user_login, #user_pass, #user_signup, #user_email, #user_signup_pass").focusout(function () {
		if(jQuery(this).val() == ''){
			jQuery(this).prev('label').show();
		}else{
			jQuery(this).prev('label').hide();
		}
	});	
}