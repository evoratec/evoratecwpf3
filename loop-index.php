<?php
/*
 * <p class="meta"><?php _e("", "evoratecwp"); ?> <time datetime="<?php echo the_time('j-m-Y'); ?>" pubdate><?php the_time('j F , Y'); ?></time> <?php _e("por", "evoratecwp"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e(" categoria", "evoratecwp"); ?> <?php the_category(', '); ?>.</p>

 */
?>
<div class="eight columns">

<!-- Skip Nav -->
<a id="content"></a>
	
	<!-- Start the Loop -->	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<!-- Begin the first article -->
		<article>
				
			<!-- Display the Title as a link to the Post's permalink. -->
			<h2>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>

            <?php evora_meta_datos(); ?>
			<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

			
			<!-- Display the Post's Content in a div box. -->
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
			
			<!-- Display a comma separated list of the Post's Categories. -->
			<p class="postmetadata">Posted in <?php the_category(', '); ?></p>
			
	        <span class="comment-count"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>  
		
		</article>
		<hr>
		<!-- Closes the first article -->
	
	<!-- Stop The Loop (but note the "else:" - see next line). -->
	<?php endwhile; else: ?>
	
		<!-- The very first "if" tested to see if there were any Posts to -->
		<!-- display.  This "else" part tells what do if there weren't any. -->
		<p>Sorry, no posts matched your criteria.</p>
	
	<!--End the loop -->
	<?php endif; ?>
	
	<!-- Begin Pagination -->
	<?php if (function_exists("emm_paginate")) {
	    emm_paginate();
	} ?>	        	
	<!-- End Pagination -->

</div>