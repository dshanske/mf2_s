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


if (!function_exists('webmention_form')) :
  function webmention_form() {
  ?> 
     <br />
     <form id="webmention-form" action="<?php echo site_url('?webmention=endpoint'); ?>" method="post">
      <p>
        <label for="webmention-source"><?php _e('Respond on your own site:', 'webmention_form'); ?></label>
        <input id="webmention-source" size="15" type="url" name="source" placeholder="http://example.com/post/100" />

        <input id="webmention-submit" type="submit" name="submit" value="Send" />

      <input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
        </p>
    </form>
  <?php
  }
endif;


