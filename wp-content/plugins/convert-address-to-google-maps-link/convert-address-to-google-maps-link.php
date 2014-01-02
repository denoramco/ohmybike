<?php
/*
 Plugin Name: Convert Address to Google Maps Link
 Plugin URI: http://www.themightymo.com/
 Description: Changes all addresses into links that open a Google Map in a new window/tab 
 Version: 1.0
 Author: Toby Cryns
 Author URI: http://www.themightymo.com
 Text Domain: convert-address-to-google-maps-link
 */

/*  Copyright Toby Cryns  (email : toby@themightymo.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function tmm_enqueue_map_scripts() {
	wp_enqueue_script('jquery');
	wp_register_script('convert-address-to-google-maps-link', plugins_url( 'convert-address-to-google-maps-link.js' , __FILE__ ) , array( 'jquery' ) );
	wp_enqueue_script('convert-address-to-google-maps-link');
	
}
add_action( 'wp_print_scripts', 'tmm_enqueue_map_scripts' );