<?php
/*
 * Functions & Actions related to Posts
 */


// Updates "Posts" to "Article" across WP Admin
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Articles';
	$submenu['edit.php'][5][0] = 'Article';
	$submenu['edit.php'][10][0] = 'Add Article';
}


// Updates "Posts" to "Article" across WP Admin
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Article';
	$labels->singular_name = 'Article';
	$labels->add_new = 'Add Article';
	$labels->add_new_item = 'Add Article';
	$labels->edit_item = 'Edit Article';
	$labels->new_item = 'Article';
	$labels->view_item = 'View Article';
	$labels->search_items = 'Search Articles';
	$labels->not_found = 'No Articles found';
	$labels->not_found_in_trash = 'No Articles found in Trash';
}


// Creates a new post type for News Articles
function create_post_type() {
	register_post_type('news-article',
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __('News Article')
			),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'taxonomies' => array('category')
		)
	);
}


/**
 * Template for News Comments
 *
 * @since Sidetracked 1.0
 */
if (!function_exists('sidetracked_comment')) :
	function sidetracked_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
				break;
			default :
		?>
		<div class="comment">
			<div id="li-comment-<?php comment_ID(); ?>" class="span one comment-avatar">
				<?php echo get_avatar($comment, 68); ?>
			</div>
			<div class="span eleven">
				<div class="comment-content">
					<div class="comment-author-meta">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf(
								__('<span class="author">%1$s</span> %2$s', get_comment_author_link()),
								sprintf(get_comment_author_url() != '' ? '<a href="%1$s" target="_new">%2$s</a>' : '%2$s', get_comment_author_url(), get_comment_author()),
								sprintf('<a class="date" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url(get_comment_link($comment->comment_ID)),
									get_comment_time('c'),
									sprintf(__('%1$s at %2$s', 'sidetracked'), get_comment_date(), get_comment_time())
								)				
							);
						?>
						<?php edit_comment_link( __( 'Edit', 'twentytwelve' )); ?>
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>

					<?php if ($comment->comment_approved == '0') : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sidetracked' ); ?></em>
					<?php endif; ?>
					<?php comment_text(); ?>

					<?php $comment->has_children ? '<hr />' : ''; ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	<?php
		break;
	endswitch;
}
endif; // ends check for sidetracked_comment()


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
		printf( __('<a class="date" href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate><span class="day"><em>%4$s</em>%5$s</span><span class="month">%6$s</span><span class="year">%7$s</span></time></a>'),
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date('j')),
			esc_html(get_the_date('S')),
			esc_html(get_the_date('F')),
			esc_html(get_the_date('Y')),
			esc_url(get_author_posts_url( get_the_author_meta('ID'))),
			sprintf(esc_attr__('View all posts by %s', 'sidetracked'), get_the_author()),
			esc_html(get_the_author())
		);
	}
};


// Function Calls
add_action('init', 'change_post_object_label');
add_action('init', 'create_post_type');
add_action('admin_menu', 'change_post_menu_label');

?>
