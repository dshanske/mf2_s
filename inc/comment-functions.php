<?php
/**
 * Comment functions for this theme.
 *
 *
 * @package MF2_S
 */

add_filter('comment_form_defaults','mf2_s_comments_form_defaults');

function mf2_s_comments_form_defaults($default) {
  $default['comment_notes_after']=' ';
  return $default;
}


