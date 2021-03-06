<?php

// directorio del tema. Ruta completa. Nos sirve para incluir las diferentes librerias
define(TEMPLATE_DIR,get_bloginfo('template_directory'));
define(THEMEEVORA, dirname(__FILE__));


// Procesador Less para PHP
require_once( THEMEEVORA .'/less/lessc.inc.php');
require_once (THEMEEVORA . '/less/evowpfless.php');

show_admin_bar(FALSE);

// Shortcodes
include('shortcodes.php');

//Añadimos soporte para los menús de wp 3.0
add_theme_support('nav-menus' );
add_theme_support('post-thumbnails');
// Add theme support for Automatic Feed Links
add_theme_support( 'automatic-feed-links' );

// Habilita los shortcodes en los widgets de texto
add_filter('widget_text', 'do_shortcode');

$dirtemplate = get_bloginfo('template_directory');


// Localización del tema / theme localization
function evoratec_lenguaje_theme(){
    load_theme_textdomain('evoratecwpf3', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'evoratec_lenguaje_theme');

// ---------- "Child Theme Options" menu STARTS HERE
function childtheme_add_admin() {
    add_submenu_page('themes.php', 'Opciones', 'Opciones', 'edit_themes', basename(__FILE__), 'childtheme_admin');
}
add_action('admin_menu' , 'childtheme_add_admin');
// Heredado de thematic
function childtheme_admin() {

    $child_theme_image = get_option('child_theme_image');
    $enabled = get_option('child_theme_logo_enabled');

    if ($_POST['options-submit']){
        $enabled = htmlspecialchars($_POST['enabled']);
        update_option('child_theme_logo_enabled', $enabled);

        $file_name = $_FILES['logo_image']['name'];
        $temp_file = $_FILES['logo_image']['tmp_name'];
        $file_type = $_FILES['logo_image']['type'];

        if($file_type=="image/gif" || $file_type=="image/jpeg" || $file_type=="image/pjpeg" || $file_type=="image/png"){
			$fd = fopen($temp_file,'rb');
			$file_content=file_get_contents($temp_file);
			fclose($fd);

			$wud = wp_upload_dir();

			if (file_exists($wud[path].'/'.strtolower($file_name))){
                unlink ($wud[path].'/'.strtolower($file_name));
            }

			$upload = wp_upload_bits( $file_name, '', $file_content);
		//	echo $upload['error'];

			$child_theme_image = $wud[url].'/'.strtolower($file_name);
			update_option('child_theme_image', $child_theme_image);
		}

        ?>
    <div class="updated"><p>Your new options have been successfully saved.</p></div>
    <?php

    }

    if($enabled) $checked='checked="checked"';

    ?>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2>Opciones evoratec wpf </h2>
    <form name="theform" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>">
        <table class="form-table">
            <tr>
                <td width="200">Usar logo en vez del título del blog y su descripción:</td>
                <td><input type="checkbox" name="enabled" value="1" <?php echo $checked; ?>/></td>
            </tr>
            <tr>
                <td>Imagen:</td>
                <td><img src="<?php echo $child_theme_image; ?>" /></td>
            </tr>
            <tr>
                <td>Cargar imagen usando (gif/jpeg/png):</td>
                <td><input type="file" name="logo_image"><br />(debes de tener permisos para tu directorio de descargas)</td>
            </tr>
        </table>
        <input type="hidden" name="options-submit" value="1" />
        <p class="submit"><input type="submit" name="submit" value="Guardar Opciones" /></p>
    </form>
</div>
<?php
}



// Slider con FlexSlider

function evora_slider() {
    global $post ;
    if (!is_front_page()) return ; // si no está en la página principal no visualiza nada.

	echo '<div  class="row-slider">';
	echo '<div id="slider-evora" >';
	echo "<script type='text/javasscript'>
			jQuery.noConflict();
		</script>";
   // $template_dir =  bloginfo('template_url')  ;
   // esto no sería correcto
	echo "<script type='text/javascript' src='".TEMPLATE_DIR."/javascripts/jquery.flexslider-min.js'></script>";

    $args = array( 'post_type' => 'Orbit');
	$loop = new WP_Query( $args );
	
	echo '<div class="flexslider">
		    <ul class="slides ">';
			
		$slide = 1 ;
		while ( $loop->have_posts() ) : $loop->the_post();
		
			echo '<li id="slide-'.$slide.'" class="slide">';
			
			if(has_post_thumbnail()) {
			
				?>

					<?php the_post_thumbnail( 'orbit-slider', array( 'class'	=> 'orbit-slider' ) ); ?>
                    <?php // the_post_thumbnail(  ); ?>

				<?php
			}
            ?>
            <div class="slide-content-container">
	    	    	<article class="slide-content col-full ">
	    	    		<header>
	    	    			<h1>
                                <?php $url = get_post_meta( $post->ID, "_slide_link_url", true ); ?>

	    	    				<?php if ( isset($url) && $url != '' ) { ?><a href="<?php echo $url ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php } ?>
	    	    					<?php
	    	    						$slide_title = get_the_title();
	    	    						echo  $slide_title
	    	    					?>
	    	    				<?php if ( isset($url) && $url != '' ) { ?></a><?php } ?>
	    	    			</h1>

	    	    			<div class="entry">
                                <?php
                                $slide_excerpt = get_the_excerpt();
                                echo $slide_excerpt;
                                ?>
                            </div>

	    	    		</header>

	    	    	</article>
	    	   </div>

            <?php

			echo '</li>';
			$slide++ ;
		endwhile;
	
	
	 
	 		
		echo '</ul></div><div class="flex-nav-container"></div>';

  //  echo '</ul></div><div class="flex-nav-container"></div><div class="pie-slider"><img src="http://evoratecwpf:8888/wp-content/themes/evoratecwpfc/imagenes/fondo-slider.png"/></div>';


    echo '<script type="text/javascript">
		   jQuery(window).load(function() {
		   	jQuery(".flexslider").flexslider({
		   		/* slideDirection: "", */
		   		animation: "fade",
		   			controlsContainer: ".flex-nav-container",
				
		   		slideshow: true,
		   		directionNav: true,
		   		controlNav: true,
		   		pauseOnHover: true,
		   		slideshowSpeed: 7000, 
		   		animationDuration: 600 
				});
		   //	jQuery("#slides").addClass("loaded");
		   });

		</script>
		';
	echo '</div></div>';
	
}

 add_action('evoratec_before_main','evora_slider',2);




// Disable WordPress version reporting as a basic protection against attacks
function remove_generators() {
	return '';
}		
add_filter('the_generator','remove_generators');
// evoratec
function evoratec_before_header() {
    do_action('evoratec_before_header');
}
// evoratec hook header
function evoratec_header() {
	do_action('evoratec_header');
}
function evoratec_header_init(){
	?>
		<!-- Header Row -->
		<div id="row-header">
		<div class="row">
				<!-- Header Column -->
				<div class="twelve columns" id="access" role="navigation">
					<!-- Site Description & Title -->
					<hgroup id="header">
                    <?php
                        if(get_option('child_theme_logo_enabled')){
                            echo '<div id="logo-image"><a href="'.get_option('home').'"><img src="'.get_option('child_theme_image').'" /></a></div>';
                            
                        } else
                        {
                    ?>

						<h1><a href="<?php echo site_url(); ?>"><?php bloginfo('title'); ?></a></h1>
						<h4 class="subheader"><?php bloginfo('description'); ?></h4>
                        <?php
                        }
                        ?>
					</hgroup>
					
					<!-- Navigation --> 						
					<?php
					
					menu_evora();
					?>
				</div>
				<!-- Header Column -->
				
		</div>
		</div>
	<?php
}
add_action('evoratec_header','evoratec_header_init');

// Definimos hooks
function evoratec_before_main() {
	do_action('evoratec_before_main');
}

function menu_evora() {
	do_action('menu_evora');
}

function menu_principal(){ ?>
	<div id="menu-header">					
    <?php  wp_nav_menu( array( 'theme_location' => 'menu_principal',
                               'menu'=>'menu_es',
                                'menu_class' => 'responsive-menu',
                                'walker'=> new menu_walker()) );
	?>
	</div>
	<?php
}
add_action('menu_evora','menu_principal');

//Replaces "current-menu-item" with "active"
function current_to_active($text){
    $replace = array(
        //List of menu item classes that should be changed to "active"
        'current_page_item' => 'active',
        'current_page_parent' => 'active',
        'current_page_ancestor' => 'active',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter ('wp_nav_menu','current_to_active');

add_filter( 'nav_menu_css_class', 'add_parent_url_menu_class', 10, 2 );

function add_parent_url_menu_class( $classes = array(), $item = false ) {
    // Get current URL
    $current_url = current_url();
    // Get homepage URL
    $homepage_url = trailingslashit( get_bloginfo( 'url' ) );
    // Exclude 404 and homepage
    if( is_404() or $item->url == $homepage_url ) return $classes;
    if ( strstr( $current_url, $item->url) ) {
        // Add the 'parent_url' class
        $classes[] = 'parent_url';
    }
    return $classes;
}

function current_url() {
    // Protocol
    $url = ( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';

    $url .= $_SERVER['SERVER_NAME'];

    // Port
    $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];

    $url .= $_SERVER['REQUEST_URI'];

    return trailingslashit( $url );
}


// Disable the admin bar, set to true if you want it to be visible.





if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  // - Header Navigation
		  'menu_principal' => 'Header Navigation',
          'menu_mobil' => 'Navigation Mobil',
		)
	);
}

// Sidebars

if (function_exists('register_sidebar')) {

	// Right Sidebar

	register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'right_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	//  Sidebar
	
	register_sidebar(array(
		'name'=> 'Pie',
		'id' => 'footer_sidebar',
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
    register_sidebar(array(
        'name'=> 'Front Page SideBar Left',
        'id' => 'fps_left',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name'=> 'Frontpage Right sidebar',
        'id' => 'fps_right',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}


function evora_frontpage_sidebar_init(){

    echo '<div class="row">';

    if ( is_active_sidebar( 'fps_left' ) ) {
        echo '<div class="six columns">';
        dynamic_sidebar( 'fps_left' );
        echo '</div>';
    }
    if ( is_active_sidebar( 'fps_right' ) ) {
        echo '<div class="six columns">';
        dynamic_sidebar( 'fps_right' );
        echo '</div>';
    }
    echo '</div>';
}
add_action('evora_frontpage_sidebar','evora_frontpage_sidebar_init');
// Comments

// Custom callback to list comments in the Foundation style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'evoratecwpf3'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'evoratecwpf3'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'evoratecwpf3') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','evoratecwpf3'),
                    'login_text' => __('Log in to reply.','evoratecwpf3'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
        ?>
<?php } // end custom_comments

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function evoratecwp_excerpt_more($more) {
    global $post;
    // edit here if you like
    return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Leer '.get_the_title($post->ID).'">Leer más &raquo;</a>';
}
add_filter('excerpt_more', 'evoratecwp_excerpt_more');

// Orbit, for WordPress

add_action('init', 'Orbit');

function Orbit(){
	$Orbit_args = array(
		'label'	=> __('Orbit'),
		'singular_label' =>	__('Orbit'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'editor','page-attributes','thumbnail','excerpt')
		);
		register_post_type('Orbit', $Orbit_args);
}
/**
 * Add meta box for slides.
 *
 * @since 0.1
 */

add_action( 'add_meta_boxes', 'orbit_create_slide_metaboxes' );
/* Save meta box data. */
add_action( 'save_post', 'orbit_slider_save_meta', 1, 2 );

function orbit_create_slide_metaboxes() {
    add_meta_box( 'orbit_slider_metabox_1', __( 'Link', 'evoratecwpf3' ), 'orbit_slider_metabox_1', 'Orbit', 'normal', 'default' );
}

/**
 * Output the meta box #1.
 *
 * @since 0.1
 */
function orbit_slider_metabox_1() {

    global $post;

    /* Retrieve the metadata values if they already exist. */
    $slide_link_url = get_post_meta( $post->ID, '_slide_link_url', true ); ?>

    <p>URL: <input type="text" style="width: 90%;" name="slide_link_url" value="<?php echo esc_attr( $slide_link_url ); ?>" /></p>
    <span class="description"><?php echo _e( 'The URL this slide should link to.', 'evoratecwpf3' ); ?></span>

<?php }

/**
 * Save meta box data.
 *
 * @since 0.1
 */
function orbit_slider_save_meta( $post_id, $post ) {

    if ( isset( $_POST['slide_link_url'] ) ) {
        update_post_meta( $post_id, '_slide_link_url', strip_tags( $_POST['slide_link_url'] ) );
    }
}




function evoratec_register_sidebars() {

    register_sidebar(array(
        'name' => 'Espacio para banners superior',
        'id' => 'header-aside',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => "<h3 class=\"widgettitle\">",
        'after_title' => "</h3>\n",
    ));

    register_sidebar( array(
        'name' => __('Pie 1', 'evoratecwpf3'),
        'id' => 'pie_1',
        'description' => __('The main widget area, most often used as a sidebar.', 'evoratecwpf3'),
        'before_widget' => '<div id="%1$s" class="column widget %2$s widget-%2$s  ">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => __('Pie 2', 'evoratecwpf3'),
        'id' => 'pie_2',
        'description' => __('The main widget area, most often used as a sidebar.', 'evoratecwpf3'),
        'before_widget' => '<div id="%1$s" class="column widget %2$s widget-%2$s  ">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => __('Pie 3', 'evoratecwpf3'),
        'id' => 'pie_3',
        'description' => __('The main widget area, most often used as a sidebar.', 'evoratecwpf3'),
        'before_widget' => '<div id="%1$s" class="column widget %2$s widget-%2$s  ">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );

}
add_action( 'init', 'evoratec_register_sidebars' );


// Walker para crear los menús segun nuestras necesidades.
class menu_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes = ' class="evomenulink" ';
        $attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $prepend = '';
        $append = '';

        // $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

function evora_meta_datos() {
    global $post ;
    $postmeta = '<div class="entry-meta">';
    $postmeta .= '<p class="meta">';
    $postmeta .= _e("", "evoratecwp");
    $postmeta .= the_time('j F Y');
    $postmeta .= '</p>';
    echo apply_filters('evora_meta_datos',$postmeta); // creamos el filtro
}


// Creamos acciones - Creating actions hooks

function evora_footer(){
    do_action('evora_footer');
}

function evora_frontpage_sidebar(){
    do_action('evora_frontpage_sidebar');
}


function evora_add_footer(){

        echo '<div class="row"><div class="twelve columns home-middle">';

        if ( is_active_sidebar( 'pie_1' ) ) {
            echo '<div class="four columns">';
            dynamic_sidebar( 'pie_1' );
            echo '</div>';
        }

        if ( is_active_sidebar( 'pie_2' ) ) {
            echo '<div class="four columns">';
            dynamic_sidebar( 'pie_2' );
            echo '</div>';
        }

        if ( is_active_sidebar( 'pie_3' ) ) {
            echo '<div class="four columns">';
            dynamic_sidebar( 'pie_3' );
            echo '</div>';
        }

        echo '</div></div>';
}
add_action('evora_footer','evora_add_footer');

function evowpf_limit_words($string, $word_limit)
{
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit)
        array_pop($words);
    return implode(' ', $words);
}

function evo_columnas( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'col'   => '',
        'clase' => ''
    ), $atts ) );

    $numColumnas = 'twelve';
    if ($col==1) $numColumnas = 'one' ;
    if ($col==2) $numColumnas = 'two' ;
    if ($col==3) $numColumnas = 'three' ;
    if ($col==4) $numColumnas = 'four' ;
    if ($col==5) $numColumnas = 'five' ;
    if ($col==6) $numColumnas = 'six' ;
    if ($col==7) $numColumnas = 'seven' ;
    if ($col==8) $numColumnas = 'eight' ;
    if ($col==9) $numColumnas = 'nine' ;
    if ($col==10) $numColumnas = 'ten' ;
    if ($col==11) $numColumnas = 'eleven' ;
    if ($col==12) $numColumnas = 'twelve' ;

    return '<div class="'.$numColumnas.' columns '.$clase .' ">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('columnas', 'evo_columnas');
?>