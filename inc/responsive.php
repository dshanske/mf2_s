<?php
/**
 * Responsive Images Setup
 *
 *
 * @package MF2_S
 */


function get_resp_featured_image($id, $vw = "100vw") {
	$r = '<figure class="entry-media">';
	$large = wp_get_attachment_image_src( $id, 'large' );
	$medium = wp_get_attachment_image_src( $id, 'medium' );
	$thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
	$title = get_post(get_post_thumbnail_id())->post_excerpt;
	$full = wp_get_attachment_image_src( $id, 'full' );
	$r .= '<img class="photo u-photo" src="' . $full[0] .   
	'" sizes="' . $vw . '" srcset="' . $thumbnail[0] . ' 150w, ' 
	. $medium[0] . ' 300w, ' 
	. $large[0] . ' 1024w, ' 
	. $full[0] . ' 1400w" alt="' . $title . '" title="'. $title . '" />';
	$r .= '<figcaption class="p-name">' . $title . '</figcaption></figure>';
	return $r;
}

function resp_featured_image($id, $vw = "100vw") {
	echo get_resp_featured_image($id, $vw);
}
