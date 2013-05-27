<?php
/**
 * The template for determining what layout to use for hierarchical pages, defaulting to a standard post layout.
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

$pageTitle = strtolower(get_the_title());
$parentPage = get_post($post->post_parent);
$parentPageTitle = strtolower($parentPage->post_title);

if ($pageTitle == 'editions') {
	$content = 'content-category';
} else if ($parentPageTitle == 'editions') {
	$content = 'content-edition';
} else if ($parentPageTitle == 'explore' || $pageTitle == 'explore') {
	$content = 'content-explore';
} else if ($parentPageTitle == 'survive' || $pageTitle == 'survive') {
	$content = 'content-survive';
} else if ($pageTitle == 'news') {
	$content = 'content-news-landing';
} else if ($parentPageTitle == 'news') {
	$content = 'content-news';
} else {
	$content = 'content';	
}

?>

<?php // ID required for screen readers link ?>
<section id="body-content">
	<?php get_template_part($content); ?>
</section>

<?php get_footer(); ?>