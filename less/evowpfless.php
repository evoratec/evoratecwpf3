<?php
/*
This code come from http://briteweb.com/
This code is modified by evora sistemas información,s.l. aka evoratec
Contributors: briteweb, evoratec
Donate link: http://briteweb.com/
Tags: css,less,stylesheet,style
Requires at least: 3.0
Tested up to: 3.2.1
*/
define(STYLESHEETPATH,get_stylesheet_directory() );

add_action( 'after_setup_theme', 'lesscss_include' );


function lesscss_include() {
    evowpf_less_css( 'evora_wpf.less' );

  //  evowpf_less_css( 'css/print.css', array( 'media' => 'print', 'minify' => true, 'mobile' => false, 'force' => false );
}

function evowpf_less_css( $less = "", $args = array() ) {
    if (is_admin()) return ;

    $defaults = array( 'media' => 'all', 'minify' => false, 'mobile' => false, 'hide_mobile' => false, 'force' => true );
    extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );

    if ( !file_exists( STYLESHEETPATH . '/' . $less )) return ;
    $output_name =  $less.'.css';

    $changed = false;

    if ( file_exists( STYLESHEETPATH . '/' . $output_name ) && filemtime( STYLESHEETPATH . '/' . $less ) > filemtime( STYLESHEETPATH . '/' . $output_name ) ) $changed = true;
    if ( $force ) $changed = true;
    try {
        lessc::ccompile( STYLESHEETPATH . '/' . $less, STYLESHEETPATH . '/' . $output_name, $force );
    } catch ( Exception $ex ) {
        wp_die( '<strong>#BW LESS-CSS:</strong> lessc fatal error<br />' . $ex->getMessage() );
    }

    $name = str_replace( '.', '', $less ) . "_css";

    wp_enqueue_style( $name, get_bloginfo( 'stylesheet_directory' ) . '/' . $output_name, false, false, $media );

}

