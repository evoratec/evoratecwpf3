<?php

// Shortcodes
add_shortcode( 'tabgroup', 'jqtools_tab_group' );

function jqtools_tab_group( $atts, $content ){
    $GLOBALS['tab_count'] = 0;

    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ){
        $cont = 0 ;
        foreach( $GLOBALS['tabs'] as $tab ){
            $cont++ ;
            $clase = '' ;
            if ($cont == 1) $clase = 'class="active"';
            $selectors[] = '<dd '.$clase.'><a href="#evotab'.$cont.'">'.$tab['title'].'</a></dd>';

        }
        $cont = 0 ;
        foreach( $GLOBALS['tabs'] as $tab ){
            $cont++ ;
            $clase = 'mobile-four twelve columns ' ;
            if ($cont == 1) $clase .="active";
            $tabs[] = '<li class="'.$clase.'" id="evotab'.$cont.'Tab"><div>'.$tab['content'].'</div></li>';

        }

        $return = '<dl class="tabs">'.implode( "\n", $selectors ).'</dl><ul class="tabs-content">'.implode( "\n", $tabs ).'</ul>'."\n";
    }
    return $return;
}


add_shortcode( 'tab', 'jqtools_tab' );

function jqtools_tab( $atts, $content ){
    extract(shortcode_atts(array(
        'title' => 'Tab %d'
    ), $atts));
    do_shortcode( $content );
    $x = $GLOBALS['tab_count'];

    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

    $GLOBALS['tab_count']++;
}

?>