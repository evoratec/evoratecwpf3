<?php
/*
* Template Name: Page 100W
*/
?>
<?php get_header(); ?>
<div class="row">
<div class="page tweelve columns">

	<!-- Start the Loop -->
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- Begin the first div -->
<div class="page-header">
    <h2>
        <?php the_title(); ?>
    </h2>
</div>
<!-- Display the Page's Content in a div box. -->
<div class="page-content entry">
    <?php the_content(); ?>
</div>


<!-- Closes the first div -->

<!-- Stop The Loop (but note the "else:" - see next line). -->
<?php endwhile; else: ?>

<!-- The very first "if" tested to see if there were any Posts to -->
<!-- display.  This "else" part tells what do if there weren't any. -->
<div class="alert-box error">Sorry, the page you requested was not found</div>

<!--End the loop -->
<?php endif; ?>

</div>
</div>
<?php get_footer(); ?>