<?php 

function bs_font_awesome($params, $content = null){
    extract(shortcode_atts(array(
        'name' => 'default',
        'size'=> '1'
    ), $params));

   $result = '<i class="fa fa-'.$name. ' fa-'. $size.'x"></i>';
    return force_balance_tags( $result );
}
add_shortcode('font_awesome', 'bs_font_awesome');
