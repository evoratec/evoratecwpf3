<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juanito
 * Date: 07/05/12
 * Time: 19:12
 * To change this template use File | Settings | File Templates.
 */
 get_header(); ?>
<div class="row">
    <div class="twelve columns">

	<!-- Start the Loop -->
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- Begin the first div -->
        <div>

    <!-- Display the Page's Content in a div box. -->
            <div class="entry">
                <?php the_content(); ?>
            </div>

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
<?php
    /*
     * Action para añadir los widgets en la página principal
     */
    evora_frontpage_sidebar();
?>

<?php get_footer(); ?>