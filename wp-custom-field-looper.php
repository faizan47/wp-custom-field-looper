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

function get_Query(){
  return new WP_Query( array( 'post_type' => 'fine', 'post_status'=>'publish',  'posts_per_page' => -1, ) );
}

function count_fines() { 
  $query = get_Query();
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
      $query = get_Query();
      return $query->found_posts;
}
add_shortcode('number_of_fines', 'count_posts');

