<?php
/**
 * The snippet of code which displays the Previous / Next arrow buttons
 *
 * @package WordPress
 * @subpackage Sidetracked
 * @since Sidetracked 1.0
 */

$pageTitle = get_the_title();

$editionNumber = explode(" ", $pageTitle);
$editionNumber = (int)$editionNumber[1];

if ($editionNumber < 9) {
	$nextEdition = "Edition 0" . ($editionNumber + 1);
} else {
	$nextEdition = "Edition " . ($editionNumber + 1);
}

$nextEditionId = get_page_by_title($nextEdition);
$nextEditionLink = get_permalink($nextEditionId);

if ($editionNumber < 11) {
	$previousEdition = "Edition 0" . ($editionNumber - 1);
} else {
	$previousEdition = "Edition " . ($editionNumber - 1);
}
$previousEditionId = get_page_by_title($previousEdition);
$previousEditionLink = get_permalink($previousEditionId);

$editionsPage = get_page_by_title('Editions');
$editionsLink = get_permalink($editionsPage->ID);

$editionsCatId = get_cat_ID("Editions");
$editionsArgs = array(
	'child_of'                 => $editionsCatId,
	'hide_empty'               => 0
);
$editionsCategories = get_categories($editionsArgs);
$numberOfEditions = count($editionsCategories);
$imageSizeCount = 0;


?>
		<section class="next-prev-arrows">
			<span class="prev">
				<?php if ($pageTitle == "Edition 1") { ?>
					<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
				<?php } else { ?>
					<a href="<?php echo $previousEditionLink; ?>"><?php echo $previousEdition; ?></a>
				<?php } ?>
			</span>
			<span class="next">
				<?php echo $pageTitle;
				echo "Edition " . $numberOfEditions; ?>
				<?php if ($pageTitle == ("Edition " . $numberOfEditions)) { ?>
					<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
				<?php } else { ?>
					<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
				<?php } ?>
			</span>
		</section>