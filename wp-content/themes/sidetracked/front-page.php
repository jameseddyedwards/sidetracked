<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage sidetracked
 */

get_header();

?>

<?php /* ID required for screen readers link */ ?>
<section id="body-content">
	<?php get_template_part('content'); ?>
</section>

<section>
	<div class="row">
		<div class="header col">Header</div>
	</div>
	<div class="row">
		<div class="navigation col">Navigation</div>
		<div class="main_content col">Main content</div>
		<div class="related_content col">Related content</div>
	</div>
	<div class="row">
		<div class="media_block col">Media block 1</div>
		<div class="media_block col">Media block 2</div>
		<div class="media_block col">Media block 3</div>
	</div>
	<div class="row">
		<div class="footer col">Footer</div>
	</div>
	<div class="row">
		<div class="span_12 col">Span 12</div>
	</div>
	<div class="row">
		<div class="span_6 col">Span 6</div>
		<div class="span_6 col">Span 6</div>
	</div>
	<div class="row">
		<div class="span_5 col">Span 5</div>
		<div class="span_5 col">Span 5</div>
		<div class="span_2 col">Span 2</div>
	</div>
</section>

<?php
 
/*
*  View array data (for debugging)
*/
 
var_dump( get_field('sidetracked_gallery') );
 
/*
*  Create the Markup for a slider
*  This example will create the Markup for Flexslider (http://www.woothemes.com/flexslider/)
*/
 
$images = get_field('sidetracked_gallery');
 
if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach($images as $image): ?>
                <li>
                    <img src="<?php echo $image['sizes']['thumbnail-square']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p class="flex-caption"><?php echo $image['caption']; ?></p>
                    <?php wp_get_attachment_metadata($attachment_id); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; 
 
?>

<?php get_footer(); ?>