<?php
/*
Plugin Name: WP Custom Field Looper
Plugin URI:  
Description: Counts the total from a custom fields & returns the message in a currency format.
Version:     1.0.0
Author:      Quvor
Author URI:  https://quvor.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );


function count_fines() { 
 	$query = new WP_Query( array( 'post_type' => 'fine' ) );
	if ( $query->have_posts() ) {
		$total_fine = 0;
		while ( $query->have_posts() ) {
				$query->the_post();
				$total_fine = $total_fine + get_post_meta( get_the_id(), 'fine_usd_equivalent', true );
    }

    wp_reset_postdata();
    $total_fine = number_format($total_fine);
    $post_count =  $query->post_count;
    }
    
    $message = "{$post_count} fines equalling a total of USD {$total_fine}"; 
 
    return $message;
} 
add_shortcode('total', 'count_fines');
