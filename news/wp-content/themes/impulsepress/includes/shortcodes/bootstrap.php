<?php

function bs_notice($params, $content = null){
    extract(shortcode_atts(array(
        'type' => 'unknown'
    ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="alert alert-'.$type.' alert-dismissable">';
    $result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    $result .= do_shortcode($content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('notification', 'bs_notice');


function bs_buttons($params, $content = null){
    extract(shortcode_atts(array(
        'size' => 'default',
        'type' => 'default',
        'value' => 'button',
        'href' => "#"
    ), $params));

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $value = ! empty( $content ) ? do_shortcode( $content ) : $value;

    $result = '<a href="' .$href . '">';
    $result .= '<button class="btn btn-'.$size.' btn-'.$type.'">' . do_shortcode( $value ) . '</button>';
    $result .= '</a>';
    return force_balance_tags( $result );
}
add_shortcode('button', 'bs_buttons');

function bs_button_group($params, $content = null){
    extract(shortcode_atts(array(
        'type' => 'basic'
    ), $params));

    $content = preg_replace('/<br class="nc".\/>/', '', $content);

    $div_begin = '';

    if (strcmp ( $type , 'basic' ) == 0) {
        $div_begin = '<div class="btn-group">';
        $div_end =  '</div>';
    } elseif (strcmp ( $type , 'toolbar' ) == 0) {
        $div_begin = '<div class="btn-group" role="toolbar"><div class="btn-group">';
        $div_end =  '</div></div>';
    }

    $result = $div_begin;
    $result .= do_shortcode($content);
    $result .= $div_end;
     return force_balance_tags( $result );
}
add_shortcode('button_group', 'bs_button_group');

function bs_collapse($params, $content = null){
    extract(shortcode_atts(array(
        'id'=>''
         ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="panel-group" id="'.$id.'">';
    $result .= do_shortcode($content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('collapse', 'bs_collapse');


function bs_citem($params, $content = null){
    extract(shortcode_atts(array(
        'id'=>'',
        'title'=>'Collapse title',
        'parent' => ''
         ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = ' <div class="panel panel-default">';
    $result .= ' <div class="panel-heading">';
    $result .= '    <h4 class="panel-title">';
    $result .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$parent.'" href="#'.$id.'">';
    $result .= $title;
    $result .= '</a>';
    $result .= '</h4>';
    $result .= '</div>';
    $result .= '<div id="'.$id.'" class="panel-collapse collapse">';
    $result .= '<div class="panel-body">';
    $result .= do_shortcode($content );
    $result .= '</div>';
    $result .= '</div>';
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('citem', 'bs_citem');

function bs_row($params, $content = null){
    extract(shortcode_atts(array(
        'class' => 'row'
    ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="'.$class.'">';
    $result .= do_shortcode($content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('row', 'bs_row');

function bs_span($params,$content=null){
    extract(shortcode_atts(array(
        'class' => 'col-xs-1'
        ), $params));

    $result = '<div class="'.$class.'">';
    $result .= do_shortcode($content);
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('col', 'bs_span');

function bs_icons($params, $content = null){
    extract(shortcode_atts(array(
        'name' => 'default',
        'size'=> '1'
    ), $params));

    $result = '<i class="'.$name.'"></i>';
    return force_balance_tags( $result );
}
add_shortcode('icon', 'bs_icons');

function bs_lead($params, $content = null){

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="lead">';
    $result .= do_shortcode($content );
    $result .= '</div>';

    return force_balance_tags( $result );
}
add_shortcode('lead', 'bs_lead');


//--------------
//  [tabs]
//    [thead]
//      [tab href="#link" title="title"]
//      [dropdown title="title"]
//        [tab href="#link" title="title"]
//      [/dropdown]
//    [/thead]
//    [tcontents]
//      [tcontent id="link"]
//      [/tcontent]
//    [/tcontents]
//  [/tabs]
//  ---------------

function bs_tabs($params, $content = null){
  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $result = '<div class="tab_wrap">';
  $result .= do_shortcode($content );
  $result .= '</div>';
  return force_balance_tags( $result );
}
add_shortcode('tabs', 'bs_tabs');

function bs_thead($params, $content = null){
  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $result = '<ul class="nav nav-tabs">';
  $result .= do_shortcode($content );
  $result .= '</ul>';
  return force_balance_tags( $result );
}
add_shortcode('thead', 'bs_thead');

function bs_tab($params, $content = null){
  extract(shortcode_atts(array(
    'href' => '#',
    'title' => '',
    'class' => ''
    ), $params));

  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $title = ! empty( $content ) ? do_shortcode( $content ) : $title;

  $result = '<li class="'.$class.'">';
  $result .= '<a data-toggle="tab" href="'.$href.'">'.$title.'</a>';
  $result .= '</li>';
  return force_balance_tags( $result );
}
add_shortcode('tab', 'bs_tab');

function bs_dropdown($params, $content = null){
  global $bs_timestamp;
  extract(shortcode_atts(array(
    'title' => '',
    'id' => '',
    'class' => '',
    ), $params));
  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $result = '<li class="dropdown">';
  $result .= '<a class="'.$class.'" id="'.$id.'" class="dropdown-toggle" data-toggle="dropdown">' . do_shortcode( $title ) . '<b class="caret"></b></a>';
  $result .='<ul class="dropdown-menu">';
  $result .= do_shortcode($content);
  $result .= '</ul></li>';
  return force_balance_tags( $result );
}
add_shortcode('dropdown', 'bs_dropdown');

function bs_tcontents($params, $content = null){
  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $result = '<div class="tab-content">';
  $result .= do_shortcode($content );
  $result .= '</div>';
  return force_balance_tags( $result );
}
add_shortcode('tcontents', 'bs_tcontents');

function bs_tcontent($params, $content = null){
  extract(shortcode_atts(array(
    'id' => '',
    'class'=>'',
    ), $params));
  $content = preg_replace('/<br class="nc".\/>/', '', $content);
  $class= ($class=='active')?'active in':'';
  $result = '<div class="tab-pane fade '.$class.'" id='.$id.'>';
  $result .= do_shortcode($content );
  $result .= '</div>';
  return force_balance_tags( $result );
}
add_shortcode('tcontent', 'bs_tcontent');

 
function bs_tooltip($params, $content = null){
    extract(shortcode_atts(array(
        'placement' => 'top',
        'trigger' => 'hover',
        'title' => 'title',
        'href' => "#"
    ), $params));

    $placement = (in_array($placement, array('top', 'right', 'bottom', 'left'))) ? $placement : "top";
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '';

    $tooltip_class = 'tooltip' .rand();
    $result .= '<a class="'  . $tooltip_class. '" href="#" data-toggle="tooltip" title="'.esc_attr($title).'" data-placement="'.esc_attr($placement).'" data-trigger="'.esc_attr($trigger).'">'.do_shortcode($content).'</a>';
    $result .= '<script type="text/javascript">
            (function() {
                $(".' .$tooltip_class .  '").tooltip({selector:"[data-toggle=tooltip]",container:"body"});
             })();</script>';


    return force_balance_tags( $result );
}
add_shortcode('tooltip', 'bs_tooltip');

function bs_well($params, $content = null){
    extract(shortcode_atts(array(
        'size' => 'unknown'
    ), $params));

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="well well-'.$size.'">';
    $result .= do_shortcode($content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('well', 'bs_well');


function bs_label($params, $content = null){
    extract(shortcode_atts(array(
        'class' => 'default'
    ), $params));

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<span class="label label-'.$class.'">';
    $result .= do_shortcode($content );
    $result .= '</span>';
    return force_balance_tags( $result );
}
add_shortcode('label', 'bs_label');



/*
 *
 *

This shortcode:

[carousel class="myslider"]
[slide]
...
[/slide]
[slide]
...
[/slide]
[slide]
...
[/slide]

[/carousel]

Generates
<div id="carousel-example-generic" class="carousel slide myslider " data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
 */

$carousel_slides = array();
function bs_carousel($params, $content = null){

    extract(shortcode_atts(array(
        'class' => 'default',
        'interval' => '5000'
    ), $params));

    global $carousel_slides;
    $carousel_slides = array();
    do_shortcode($content);

    $content = preg_replace('/<br class="nc".\/>/', '', $content);

    $id = 'carousel-' . rand();
    $result = '<div id="'. $id . '" class="carousel slide ' .$class . '" data-ride="carousel" data-interval="'.$interval.'">';
    $result .= '<ol class="carousel-indicators">';
    //loop
    $i = 0;
    foreach ($carousel_slides as $slide) {
        $result .= '<li data-target="#'.$id.'" data-slide-to="' .$i . '" '. ($i==0 ? 'class="active"' : '') .'></li>';
        $i++;
    }
    $result .= '</ol>';
    $result .= '<div class="carousel-inner">';

    // loop
    $i = 0;
    foreach ($carousel_slides as $slide) {
        $result .= '<div class="item ' . ($i==0 ? 'active' : '') . '">';
        $result .=  do_shortcode($slide);
        $result .= '</div>';
        $i++;
    }




    $result .= '</div>';
    $result .= '<a class="left carousel-control" href="#'.$id.'" data-slide="prev">';
    $result .= '<span class="glyphicon glyphicon-chevron-left"></span>';
    $result .= '</a>';
    $result .= '<a class="right carousel-control" href="#'.$id.'" data-slide="next">';
    $result .= '<span class="glyphicon glyphicon-chevron-right"></span>';
    $result .= '</a>';
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('carousel', 'bs_carousel');


function bs_carousel_slide($params, $content = null){
    global $carousel_slides;
    array_push($carousel_slides,$content);
    return "";
}
add_shortcode('carousel_slide', 'bs_carousel_slide');