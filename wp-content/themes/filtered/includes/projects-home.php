<?php $ttrust_featured_on_home = of_get_option('ttrust_featured_on_home'); ?>	
<?php if($ttrust_featured_on_home) : //show only featured projects ?>
	
	<?php $skills_nav = array(); ?>
	<?php query_posts( 'post_type=projects&posts_per_page=200&meta_key=_ttrust_home_featured_value&meta_value=true' ); ?>
	
	<?php  while (have_posts()) : the_post(); ?>	   			    
		<?php $j=1;
			$skills = get_terms('skill');
			foreach ($skills as $skill) {
				$a = '<li><a href="#" data-filter=".'.$skill->slug.'">';
		    	$a .= $skill->name;					
				$a .= '</a></li>';
				echo $a;
				echo "\n";
				$j++;
			}?>
	<?php endwhile; ?>	
	
	<ul id="filterNav" class="clearfix">				
		<li class="segment-0 selected"><a href="#" data-filter="*" class="selected"><?php _e('All', 'themetrust'); ?></a></li>
		<?php $j=1;
			$skills = get_terms('skill');
			foreach ($skills as $skill) {
				$a = '<li class="segment-'.$j.'"><a href="#" data-filter=".'.$skill->slug.'">';
		    	$a .= $skill->name;					
				$a .= '</a></li>';
				echo $a;
				echo "\n";
				$j++;
		}?>							
	</ul>
	
	<?php  include( TEMPLATEPATH . '/includes/project-grid.php'); ?>		
		
<?php else: //show all projects ?>
	
	<?php query_posts( 'post_type=projects&posts_per_page=200' ); ?>
			
	<ul id="filterNav" class="clearfix">				
		<li class="segment-0 selected"><a href="#" data-filter="*" class="selected"><?php _e('All', 'themetrust'); ?></a></li>
		<?php $j=1;
			$skills = get_terms('skill');
			foreach ($skills as $skill) {
				$a = '<li class="segment-'.$j.'"><a href="#" data-filter=".'.$skill->slug.'">';
		    	$a .= $skill->name;					
				$a .= '</a></li>';
				echo $a;
				echo "\n";
				$j++;
		}?>						
	</ul>	
	
	<?php  include( TEMPLATEPATH . '/includes/project-grid.php'); ?>
		
<?php endif; ?>
	
