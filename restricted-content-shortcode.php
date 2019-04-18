<?php
/*
Plugin Name: Restricted Content Shortcode
Plugin URI: #
Description: Adds a shortcode that hides content from non-logged in users
Author: Mario Bondici
Author URI:#
License: GPL2
    Copyright 2012 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/**
 * Adds the shortcode
 *
 * @uses add_shortcode
 * @return null
 */
function restricted_content_add_shortcode()
{
    add_shortcode('restricted', 'restricted_content_shortcode_cb');
}

add_action('init', 'restricted_content_add_shortcode');
/**
 * Callback function for the shortcode.  Checks if a user is logged in.  If they
 * are, display the content.  If not, show them a link to the login form.
 *
 * @return string
 */
function restricted_content_shortcode_cb($args, $content=null)
{
    // if the user is logged in just show them the content.  You could check
    // rolls and capabilities here if you wanted as well
    if(is_user_logged_in())
	
	
	
        return $content;
		
		
    // If we're here, they aren't logged in, show them a message
    $defaults = array(
        // message show to non-logged in users
        'msg'    => __('Per visualizzare questo contenuto devi essere un utente registrato.', 'restricted_content'),
        // Login page link
        'link'   => site_url('wp-login.php'),
        // login link anchor text
        'anchor' => __('Login.', 'restricted_content')
    );
    $args = wp_parse_args($args, $defaults);
    $msg = sprintf(
        '<aside class="login-warning">%s <a href="%s">%s</a></aside>',
        esc_html($args['msg']),
        esc_url($args['link']),
        esc_html($args['anchor'])
    );
    return $msg;
}


