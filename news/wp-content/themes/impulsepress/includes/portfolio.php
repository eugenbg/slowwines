<?php
  add_action('init', 'project_custom_init');  
  
  /*-- Custom Post Init Begin --*/
  function project_custom_init()
  {
    $labels = array(
    'name' => _x('Projects', 'post type general name','impulse-press'),
    'singular_name' => _x('Project', 'post type singular name','impulse-press'),
    'add_new' => _x('Add New', 'project','impulse-press'),
    'add_new_item' => __('Add New Project','impulse-press'),
    'edit_item' => __('Edit Project','impulse-press'),
    'new_item' => __('New Project','impulse-press'),
    'view_item' => __('View Project','impulse-press'),
    'search_items' => __('Search Projects','impulse-press'),
    'not_found' =>  __('No projects found','impulse-press'),
    'not_found_in_trash' => __('No projects found in Trash','impulse-press'),
    'parent_item_colon' => '',
    'menu_name' =>  __('Projects','impulse-press')

    );
    
   $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments', 'post-formats')
    );
    // The following is the main step where we register the post.
    register_post_type('project',$args);
    
    // Initialize New Taxonomy Labels
    $labels = array(
    'name' => _x( 'Tags', 'taxonomy general name' ,'impulse-press'),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ,'impulse-press'),
    'search_items' =>  __( 'Search Types' ,'impulse-press'),
    'all_items' => __( 'All Tags' ,'impulse-press'),
    'parent_item' => __( 'Parent Tag' ,'impulse-press'),
    'parent_item_colon' => __( 'Parent Tag:','impulse-press'),
    'edit_item' => __( 'Edit Tags' ,'impulse-press'),
    'update_item' => __( 'Update Tag' ,'impulse-press'),
    'add_new_item' => __( 'Add New Tag','impulse-press' ),
    'new_item_name' => __( 'New Tag Name' ,'impulse-press'),
    );
    // Custom taxonomy for Project Tags
    register_taxonomy('tagportfolio',array('project'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag-portfolio' ),
    ));
    
  }
  /*-- Custom Post Init Ends --*/
  
  /*--- Custom Messages - project_updated_messages ---*/
  add_filter('post_updated_messages', 'project_updated_messages');
  
  function project_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['project'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Project updated. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.','impulse-press'),
    3 => __('Custom field deleted.','impulse-press'),
    4 => __('Project updated.','impulse-press'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s','impulse-press'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Project published. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Project saved.','impulse-press'),
    8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>','impulse-press'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>','impulse-press'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ,'impulse-press'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>','impulse-press'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
  }
  
  /*--- #end SECTION - project_updated_messages ---*/
