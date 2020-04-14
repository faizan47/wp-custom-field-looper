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


$query = new WP_Query( array( 'post_type' => 'fine', 'post_status'=>'publish' ) );

function count_fines() { 
  global $query;
  if ( $query->have_posts() ) {
		$total_fine = 0;
		while ( $query->have_posts() ) {
				$query->the_post();
				$total_fine = $total_fine + get_post_meta( get_the_id(), 'fine_usd_equivalent', true );
        }
    
    $total_fine = number_format($total_fine);
    wp_reset_postdata();
    }
     
    return $total_fine;
} 
add_shortcode('total_fine', 'count_fines');

function count_posts(){
      global $query;
      $query = new WP_Query( array( 'post_type' => 'fine', 'post_status'=>'publish' ) );
      return $query->found_posts;
}
add_shortcode('number_of_fines', 'count_posts');

