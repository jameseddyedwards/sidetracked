<?php
/**
 * The snippet of code which displays the AddThis social buttons
 *
 * @package WordPress
 * @subpackage Sidetracked
 * @since Sidetracked 1.0
 */

$pageTitle = get_the_title();

$editionNumber = explode(" ", $pageTitle);
$editionNumber = (int)$editionNumber[1];
$nextEdition = "Edition " . ($editionNumber + 1);
$nextEditionId = get_page_by_title($nextEdition);
$nextEditionLink = get_permalink($nextEditionId);

$previousEdition = "Edition " . ($editionNumber - 1);
$previousEditionId = get_page_by_title($previousEdition);
$previousEditionLink = get_permalink($previousEditionId);

$editionsCatId = get_cat_ID("Editions");
$editionsArgs = array(
	'child_of'                 => $editionsCatId,
	'hide_empty'               => 0
);
$editionsCategories = get_categories($editionsArgs);
$numberOfEditions = count($editionsCategories);

?>

<section class="next-prev-bar">
	<div class="block">
		<span class="prev">
			<?php if ($pageTitle == "Edition 1") { ?>
				<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
			<?php } else { ?>
				<a href="<?php echo $previousEditionLink; ?>"><?php echo $previousEdition; ?></a>
			<?php } ?>
		</span>
		<span class="next">
			<?php if ($pageTitle == "Edition " . $numberOfEditions) { ?>
				<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
			<?php } else { ?>
				<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
			<?php } ?>
		</span>
	</div>
</section>