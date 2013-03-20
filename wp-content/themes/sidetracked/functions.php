<?php
/**
 * Sidetracked functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, sidetracked_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We arLeave a Replye providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'sidetracked_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

/* Includes */
include TEMPLATEPATH . '/inc/shortcodes.php';
include TEMPLATEPATH . '/inc/styles.php';
include TEMPLATEPATH . '/inc/scripts.php';
include TEMPLATEPATH . '/inc/images.php';
include TEMPLATEPATH . '/inc/utilities.php';


/**
 * Add theme support
 */
add_theme_support('menus');
register_nav_menu('navigation', __('Navigation', 'sidetracked'));
register_nav_menu('navigation-footer', __('Footer Navigation', 'sidetracked'));

// Add default posts and comments RSS feed links to <head>.
add_theme_support('automatic-feed-links');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override sidetracked_setup() in a child theme, add your own sidetracked_setup to your child theme's
 * functions.php file.
*
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Sidetracked 1.0
 */
function sidetracked_setup() {

	/* Make Sidetracked available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Sidetracked, use a find and replace
	 * to change 'sidetracked' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('sidetracked', TEMPLATEPATH . '/languages');

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if (is_readable($locale_file)) {
		require_once($locale_file);

	}
}
add_action('after_setup_theme', 'sidetracked_setup');


/*
 * Adds parent class onto menu parents
*/
function add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ($items as $item) {
		if ($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ($items as $item) {
		if (in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;    
}
add_filter('wp_nav_menu_objects', 'add_menu_parent_class');


/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function sidetracked_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'sidetracked_excerpt_length');


/**
 * Display navigation to next/previous pages when applicable
 */
function sidetracked_content_nav($nav_id) {
	global $wp_query;

	if ($wp_query->max_num_pages > 1) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'sidetracked' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sidetracked' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sidetracked' ) ); ?></div>
		</nav>
	<?php endif;
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sidetracked_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Sidetracked 1.0
 */
if (!function_exists('sidetracked_comment')) :
	function sidetracked_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
		?>
		<!-- Do nothing for pingbacks & trackbacks
		<li class="post pingback">
			<p>
				<?php _e('Pingback:', 'sidetracked'); ?>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __('| Edit', 'sidetracked'), '<span class="edit-link">', '</span>'); ?>
			</p>
		</li>
		-->
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			
			<div class="comment-author vcard">
				<?php
					$avatar_size = 68;
					echo get_avatar($comment, $avatar_size);
				?>
				<div class="author-meta">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf(__('<span class="author">%1$s</span> <span class="posted">Posted %2$s</span>', get_comment_author_link()),
							sprintf(get_comment_author_url() != '' ? '<a href="%1$s" target="_new">%2$s</a>' : '%2$s', get_comment_author_url(), get_comment_author()),
							sprintf('<a class="date" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url(get_comment_link($comment->comment_ID)),
								get_comment_time('c'),
								sprintf(__('%1$s<br />at %2$s', 'sidetracked'), get_comment_date(), get_comment_time())
							)
						);
					?>
				</div>

			</div>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sidetracked' ); ?></em>
				<?php endif; ?>
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'sidetracked' ), '<span class="edit-link">', '</span>' ); ?>
				<?php comment_reply_link(array_merge($args,array(
					'reply_text' => __( 'Reply', 'sidetracked' ),
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				))); ?>
			</div>
			<div class="clear"></div>
		</li>
	<?php
		break;
	endswitch;
}
endif; // ends check for sidetracked_comment()


/**
 * Returns a select box with a list of posts and pages
 *
 * @param object $post
 * @return string
 */
function get_posts_pages_select($post, $field) {

	$html = "<select name='attachments[{$post->ID}][$field]' id='attachments[{$post->ID}][$field]'>";
	$html .= '<option value="">Please select</option>';
	$posts = get_posts('posts_per_page=-1');
	$pages = get_pages();
	$_field = '_' . $field;
	$currentMetaValue = get_post_meta(get_the_ID(), $_field, true);

	// Add all posts into dropdown list
	$html .= '<optgroup label="Posts">';
	foreach($posts as $post) :
		setup_postdata($post);
		$selected = $currentMetaValue == get_permalink($post->ID) ? ' selected="selected"' : '';
		$html .= '<option' . $selected . ' value="' . get_permalink($post->ID) . '">' . $post->post_title . '</option>';
	endforeach;
	$html .= '</optgroup>';

	// Add all pages into dropdown list
	$html .= '<optgroup label="Pages">';

	foreach($pages as $page) {
		$isCurrent = $currentMetaValue == get_permalink($post->ID) ? ' selected="selected"' : '';
		$html .= '<option' . $isCurrent . ' value="' . get_page_link($page->ID) . '">' . $page->post_title . '</option>';
	}
	$html .= '</optgroup>';
	$html .= '</select>';

	return $html;
}


/**
 * Adding our custom fields to the $form_fields array
 *
 * @param array $form_fields
 * @param object $post
 * @return array
 */
function my_image_attachment_fields_to_edit($form_fields, $post) {
	// if you will be adding error messages for your field,
	// then in order to not overwrite them, as they are pre-attached
	// to this array, you would need to set the field up like this:
	$form_fields["custom1"]["label"] = __("Image Link");
	$form_fields["custom1"]["input"] = "html";
	$form_fields["custom1"]["html"] = get_posts_pages_select($post, 'custom1');
	$form_fields["custom1"]["value"] = get_post_meta($post->ID, "_custom1", true);
	return $form_fields;
}
// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2);


/**
 * @param array $post
 * @param array $attachment
 * @return array
 */
function my_image_attachment_fields_to_save($post, $attachment) {
	// $attachment part of the form $_POST ($_POST[attachments][postID])
	// $post attachments wp post array - will be saved after returned
	//     $post['post_type'] == 'attachment'
	if (isset($attachment['custom1'])){
		// update_post_meta(postID, meta_key, meta_value);
		update_post_meta($post['ID'], '_custom1', $attachment['custom1']);
	}
	return $post;
}
// attach our function to the correct hook
add_filter("attachment_fields_to_save", "my_image_attachment_fields_to_save", null, 2);


/**
 * Display image link
 *
 * Display the "Link" custom fields added to media attachments 
 *
 * Uses get_children() http://codex.wordpress.org/Function_Reference/get_children
 * Uses get_post_custom() http://codex.wordpress.org/Function_Reference/get_post_custom
 * @global $post The current post data
 * @return Prints the caption HTML
 */
function base_image_credit($ID = null) {
	// Get the post ID of the current post if not set
	if (!$ID) {
		$ID = get_the_ID();
	}
 
	// Get all the attachments for the current post (object stdClass)
	$attachments = get_children('post_type=attachment&post_parent=' . $ID);
 
	// If attachments are found
	if (isset($attachments) && !empty($attachments)) {
		// Get the first attachment
		$first_attachment = current($attachments);
		$attachment_fields = get_post_custom( $first_attachment->ID );
 
		// Get custom attachment fields
		$credit_text = ( isset($attachment_fields['_credit_text'][0]) && !empty($attachment_fields['_credit_text'][0]) ) ? esc_attr($attachment_fields['_credit_text'][0]) : '';
		$credit_link = ( isset($attachment_fields['_credit_link'][0]) && !empty($attachment_fields['_credit_link'][0]) ) ? esc_url($attachment_fields['_credit_link'][0]) : '';
 
		// Output HTML if you want
		$credit = ( $credit_text && $credit_link ) ? "Image provided by <a href='$credit_link'>$credit_text</a>" : false;
	}
 
	return $credit;
}


/**
 * Template for displaying a Posted On date
 *
 * @since Sidetracked 1.0
 */

if (!function_exists('sidetracked_posted_on')) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 * Create your own sidetracked_posted_on to override in a child theme
	 *
	 * @since Sidetracked 1.0
	 */
	function sidetracked_posted_on() {
		printf( __('<a href="%1$s" title="%2$s" rel="bookmark"><time class="month" datetime="%3$s" pubdate>%4$s</time><span class="year">%5$s</span></a>'),
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date('d/m')),
			esc_html(get_the_date('Y')),
			esc_url(get_author_posts_url( get_the_author_meta('ID'))),
			sprintf(esc_attr__('View all posts by %s', 'sidetracked'), get_the_author()),
			esc_html(get_the_author())
		);
	}
};

