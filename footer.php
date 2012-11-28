	</div><!-- Main Row-->

	<!-- Footer -->
	
	<div id="row-footer">
	    <div class="row">
	
            <footer>
                <?php  evora_footer(); ?>

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar')) : ?>

                <?php endif; ?>

           </footer>
	
	    </div><!-- Footer -->
	</div><!-- Footer -->
	
	
	</div><!-- container -->

	<!-- Incluidos JS Files -->
    <!-- Included JS Files (Compressed) -->



	<script src="<?php bloginfo('template_url'); ?>/javascripts/app.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/menu.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.flexslider-min.js"></script>

	
	<?php wp_footer(); ?>
	
</body>
</html>