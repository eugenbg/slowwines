<?php
/**
 * Builds our Customizer controls.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'nandi_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 */
function nandi_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'nandi_customize_register' ) ) {
	add_action( 'customize_register', 'nandi_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function nandi_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = nandi_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control('blogdescription')->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control('blogname')->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}

		// Add control types so controls can be built using JS
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Nandi_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Nandi_Range_Slider_Control' );
		}

		// Add upsell section type
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'Nandi_Upsell_Section' );
		}

		// Add selective refresh to site title and description
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.main-title a',
				'render_callback' => 'nandi_customize_partial_blogname',
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'render_callback' => 'nandi_customize_partial_blogdescription',
			) );
		}

		// Remove title
		$wp_customize->add_setting(
			'nandi_settings[hide_title]',
			array(
				'default' => $defaults['hide_title'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'nandi_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'nandi' ),
				'section' => 'title_tagline',
				'priority' => 2
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'nandi_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'nandi_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'nandi' ),
				'section' => 'title_tagline',
				'priority' => 4
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[retina_logo]',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'nandi_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'nandi' ),
					'section' => 'title_tagline',
					'settings' => 'nandi_settings[retina_logo]',
					'active_callback' => 'nandi_has_custom_logo_callback'
				)
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[side_inside_color]', array(
				'default' => $defaults['side_inside_color'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nandi_settings[side_inside_color]',
				array(
					'label' => __( 'Inside padding', 'nandi' ),
					'section' => 'colors',
					'settings' => 'nandi_settings[side_inside_color]',
					'active_callback' => 'nandi_is_side_padding_active',
				)
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nandi_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'nandi' ),
					'section' => 'colors',
					'settings' => 'nandi_settings[text_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nandi_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'nandi' ),
					'section' => 'colors',
					'settings' => 'nandi_settings[link_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nandi_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'nandi' ),
					'section' => 'colors',
					'settings' => 'nandi_settings[link_color_hover]'
				)
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nandi_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'nandi' ),
					'section' => 'colors',
					'settings' => 'nandi_settings[link_color_visited]'
				)
			)
		);

		if ( ! function_exists( 'nandi_colors_customize_register' ) && ! defined( 'NANDI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Nandi_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'colors',
						'type' => 'addon',
						'label' => __( 'More info', 'nandi' ),
						'description' => __( 'More colors are available in Nandi premium version. Visit wpkoi.com for more info.', 'nandi' ),
						'url' => esc_url( NANDI_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'nandi_layout_panel' ) ) {
				$wp_customize->add_panel( 'nandi_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'nandi' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'nandi_layout_container',
			array(
				'title' => __( 'Container', 'nandi' ),
				'priority' => 10,
				'panel' => 'nandi_layout_panel'
			)
		);

		// Container width
		$wp_customize->add_setting(
			'nandi_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_integer',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control(
			new Nandi_Range_Slider_Control(
				$wp_customize,
				'nandi_settings[container_width]',
				array(
					'type' => 'nandi-range-slider',
					'label' => __( 'Container Width', 'nandi' ),
					'section' => 'nandi_layout_container',
					'settings' => array(
						'desktop' => 'nandi_settings[container_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 700,
							'max' => 2000,
							'step' => 5,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 0,
				)
			)
		);

		// Add Top Bar section
		$wp_customize->add_section(
			'nandi_top_bar',
			array(
				'title' => __( 'Top Bar', 'nandi' ),
				'priority' => 15,
				'panel' => 'nandi_layout_panel',
			)
		);

		// Add Top Bar width
		$wp_customize->add_setting(
			'nandi_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'nandi_settings[top_bar_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Width', 'nandi' ),
				'section' => 'nandi_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'nandi' ),
					'contained' => __( 'Contained', 'nandi' )
				),
				'settings' => 'nandi_settings[top_bar_width]',
				'priority' => 5,
				'active_callback' => 'nandi_is_top_bar_active',
			)
		);

		// Add Top Bar inner width
		$wp_customize->add_setting(
			'nandi_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'nandi_settings[top_bar_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Inner Width', 'nandi' ),
				'section' => 'nandi_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'nandi' ),
					'contained' => __( 'Contained', 'nandi' )
				),
				'settings' => 'nandi_settings[top_bar_inner_width]',
				'priority' => 10,
				'active_callback' => 'nandi_is_top_bar_active',
			)
		);

		// Add top bar alignment
		$wp_customize->add_setting(
			'nandi_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[top_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Alignment', 'nandi' ),
				'section' => 'nandi_top_bar',
				'choices' => array(
					'left' => __( 'Left', 'nandi' ),
					'center' => __( 'Center', 'nandi' ),
					'right' => __( 'Right', 'nandi' )
				),
				'settings' => 'nandi_settings[top_bar_alignment]',
				'priority' => 15,
				'active_callback' => 'nandi_is_top_bar_active',
			)
		);

		// Add Header section
		$wp_customize->add_section(
			'nandi_layout_header',
			array(
				'title' => __( 'Header', 'nandi' ),
				'priority' => 20,
				'panel' => 'nandi_layout_panel'
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'nandi_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'nandi_settings[header_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Width', 'nandi' ),
				'section' => 'nandi_layout_header',
				'choices' => array(
					'fluid-header' => __( 'Full', 'nandi' ),
					'contained-header' => __( 'Contained', 'nandi' )
				),
				'settings' => 'nandi_settings[header_layout_setting]',
				'priority' => 5
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'nandi_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'nandi_settings[header_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Header Width', 'nandi' ),
				'section' => 'nandi_layout_header',
				'choices' => array(
					'contained' => __( 'Contained', 'nandi' ),
					'full-width' => __( 'Full', 'nandi' )
				),
				'settings' => 'nandi_settings[header_inner_width]',
				'priority' => 6
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[header_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Alignment', 'nandi' ),
				'section' => 'nandi_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'nandi' ),
					'center' => __( 'Center', 'nandi' ),
					'right' => __( 'Right', 'nandi' )
				),
				'settings' => 'nandi_settings[header_alignment_setting]',
				'priority' => 10
			)
		);

		$wp_customize->add_section(
			'nandi_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'nandi' ),
				'priority' => 30,
				'panel' => 'nandi_layout_panel'
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Width', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'fluid-nav' => __( 'Full', 'nandi' ),
					'contained-nav' => __( 'Contained', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_layout_setting]',
				'priority' => 15
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Navigation Width', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'contained' => __( 'Contained', 'nandi' ),
					'full-width' => __( 'Full', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_inner_width]',
				'priority' => 16
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Alignment', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'nandi' ),
					'center' => __( 'Center', 'nandi' ),
					'right' => __( 'Right', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_alignment_setting]',
				'priority' => 20
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => ( '' !== nandi_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Location', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'nav-below-header' => __( 'Below Header', 'nandi' ),
					'nav-above-header' => __( 'Above Header', 'nandi' ),
					'nav-float-right' => __( 'Float Right', 'nandi' ),
					'nav-float-left' => __( 'Float Left', 'nandi' ),
					'nav-left-sidebar' => __( 'Left Sidebar', 'nandi' ),
					'nav-right-sidebar' => __( 'Right Sidebar', 'nandi' ),
					'' => __( 'No Navigation', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_position_setting]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_dropdown_type]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Dropdown', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'hover' => __( 'Hover', 'nandi' ),
					'click' => __( 'Click - Menu Item', 'nandi' ),
					'click-arrow' => __( 'Click - Arrow', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_dropdown_type]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'nandi_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'nandi_settings[nav_search]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Search', 'nandi' ),
				'section' => 'nandi_layout_navigation',
				'choices' => array(
					'enable' => __( 'Enable', 'nandi' ),
					'disable' => __( 'Disable', 'nandi' )
				),
				'settings' => 'nandi_settings[nav_search]',
				'priority' => 23
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'nandi_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'nandi_settings[content_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content Layout', 'nandi' ),
				'section' => 'nandi_layout_container',
				'choices' => array(
					'separate-containers' => __( 'Separate Containers', 'nandi' ),
					'one-container' => __( 'One Container', 'nandi' )
				),
				'settings' => 'nandi_settings[content_layout_setting]',
				'priority' => 25
			)
		);

		$wp_customize->add_section(
			'nandi_layout_sidecontent',
			array(
				'title' => __( 'Fixed Side Content', 'nandi' ),
				'priority' => 39,
				'panel' => 'nandi_layout_panel'
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[fixed_side_content]',
			array(
				'default' => $defaults['fixed_side_content'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[fixed_side_content]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Fixed Side Content', 'nandi' ),
				'description'=> __( 'Content that You want to display fixed on the left.', 'nandi' ),
				'section'    => 'nandi_layout_sidecontent',
				'settings'   => 'nandi_settings[fixed_side_content]',
			)
		);

		$wp_customize->add_section(
			'nandi_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'nandi' ),
				'priority' => 40,
				'panel' => 'nandi_layout_panel'
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'nandi_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'nandi_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Sidebar Layout', 'nandi' ),
				'section' => 'nandi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'nandi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'nandi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'nandi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'nandi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'nandi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'nandi' )
				),
				'settings' => 'nandi_settings[layout_setting]',
				'priority' => 30
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'nandi_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'nandi_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'nandi' ),
				'section' => 'nandi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'nandi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'nandi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'nandi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'nandi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'nandi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'nandi' )
				),
				'settings' => 'nandi_settings[blog_layout_setting]',
				'priority' => 35
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'nandi_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'nandi_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'nandi' ),
				'section' => 'nandi_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'nandi' ),
					'right-sidebar' => __( 'Content / Sidebar', 'nandi' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'nandi' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'nandi' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'nandi' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'nandi' )
				),
				'settings' => 'nandi_settings[single_layout_setting]',
				'priority' => 36
			)
		);

		$wp_customize->add_section(
			'nandi_layout_footer',
			array(
				'title' => __( 'Footer', 'nandi' ),
				'priority' => 50,
				'panel' => 'nandi_layout_panel'
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'nandi_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'nandi_settings[footer_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Width', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'fluid-footer' => __( 'Full', 'nandi' ),
					'contained-footer' => __( 'Contained', 'nandi' )
				),
				'settings' => 'nandi_settings[footer_layout_setting]',
				'priority' => 40
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'nandi_settings[footer_widgets_inner_width]',
			array(
				'default' => $defaults['footer_widgets_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
			)
		);

		// Add content control
		$wp_customize->add_control(
			'nandi_settings[footer_widgets_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Widgets Width', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'nandi' ),
					'full-width' => __( 'Full', 'nandi' )
				),
				'settings' => 'nandi_settings[footer_widgets_inner_width]',
				'priority' => 41
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'nandi_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'nandi_settings[footer_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Width', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'nandi' ),
					'full-width' => __( 'Full', 'nandi' )
				),
				'settings' => 'nandi_settings[footer_inner_width]',
				'priority' => 41
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'nandi_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'nandi_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				),
				'settings' => 'nandi_settings[footer_widget_setting]',
				'priority' => 45
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'nandi_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'nandi_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'left' => __( 'Left','nandi' ),
					'center' => __( 'Center','nandi' ),
					'right' => __( 'Right','nandi' )
				),
				'settings' => 'nandi_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'nandi_is_footer_bar_active'
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'nandi_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_choices'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'nandi_settings[back_to_top]',
			array(
				'type' => 'select',
				'label' => __( 'Back to Top Button', 'nandi' ),
				'section' => 'nandi_layout_footer',
				'choices' => array(
					'enable' => __( 'Enable', 'nandi' ),
					'' => __( 'Disable', 'nandi' )
				),
				'settings' => 'nandi_settings[back_to_top]',
				'priority' => 50
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'nandi_blog_section',
			array(
				'title' => __( 'Blog', 'nandi' ),
				'priority' => 55,
				'panel' => 'nandi_layout_panel'
			)
		);

		$wp_customize->add_setting(
			'nandi_settings[blog_header_image]',
			array(
				'default' => $defaults['blog_header_image'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'nandi_settings[blog_header_image]',
				array(
					'label' => __( 'Blog Header image', 'nandi' ),
					'section' => 'nandi_blog_section',
					'settings' => 'nandi_settings[blog_header_image]',
					'description' => __( 'Recommended size: 1920*1080px', 'nandi' )
				)
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[blog_header_display_frame]',
			array(
				'default' => $defaults['blog_header_display_frame'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'nandi_settings[blog_header_display_frame]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Display frame on image', 'nandi' ),
				'section' => 'nandi_blog_section'
			)
		);

		// Blog header texts
		$wp_customize->add_setting(
			'nandi_settings[blog_header_title]',
			array(
				'default' => $defaults['blog_header_title'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[blog_header_title]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header title', 'nandi' ),
				'section'    => 'nandi_blog_section',
				'settings'   => 'nandi_settings[blog_header_title]',
				'description' => __( 'HTML allowed.', 'nandi' )
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[blog_header_text]',
			array(
				'default' => $defaults['blog_header_text'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[blog_header_text]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header text', 'nandi' ),
				'section'    => 'nandi_blog_section',
				'settings'   => 'nandi_settings[blog_header_text]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[blog_header_button_text]',
			array(
				'default' => $defaults['blog_header_button_text'],
				'type' => 'option',
				'sanitize_callback' => 'esc_html',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[blog_header_button_text]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button text', 'nandi' ),
				'section'    => 'nandi_blog_section',
				'settings'   => 'nandi_settings[blog_header_button_text]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[blog_header_button_url]',
			array(
				'default' => $defaults['blog_header_button_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[blog_header_button_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button url', 'nandi' ),
				'section'    => 'nandi_blog_section',
				'settings'   => 'nandi_settings[blog_header_button_url]',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'nandi_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_blog_excerpt'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'nandi' ),
				'section' => 'nandi_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'nandi' ),
					'excerpt' => __( 'Excerpt', 'nandi' )
				),
				'settings' => 'nandi_settings[post_content]',
				'priority' => 10
			)
		);

		if ( ! function_exists( 'nandi_blog_customize_register' ) && ! defined( 'NANDI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Nandi_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'nandi_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'nandi' ),
						'description' => __( 'More options are available for this section in our premium version.', 'nandi' ),
						'url' => esc_url( NANDI_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'nandi_general_section',
			array(
				'title' => __( 'General', 'nandi' ),
				'priority' => 99
			)
		);

		if ( ! apply_filters( 'nandi_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'nandi_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'nandi_sanitize_checkbox'
				)
			);

			$wp_customize->add_control(
				'nandi_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'nandi' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'nandi' ),
					'section' => 'nandi_general_section',
					'settings' => 'nandi_settings[font_awesome_essentials]',
				)
			);
		}

		// Add Socials section
		$wp_customize->add_section(
			'nandi_socials_section',
			array(
				'title' => __( 'Socials', 'nandi' ),
				'priority' => 99
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_display_side]',
			array(
				'default' => $defaults['socials_display_side'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_display_side]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Display on fixed side', 'nandi' ),
				'section' => 'nandi_socials_section'
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_display_top]',
			array(
				'default' => $defaults['socials_display_top'],
				'type' => 'option',
				'sanitize_callback' => 'nandi_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_display_top]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Display on top bar', 'nandi' ),
				'section' => 'nandi_socials_section'
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_facebook_url]',
			array(
				'default' => $defaults['socials_facebook_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_facebook_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Facebook url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_facebook_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_twitter_url]',
			array(
				'default' => $defaults['socials_twitter_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_twitter_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Twitter url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_twitter_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_google_url]',
			array(
				'default' => $defaults['socials_google_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_google_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Google url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_google_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_tumblr_url]',
			array(
				'default' => $defaults['socials_tumblr_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_tumblr_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Tumblr url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_tumblr_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_pinterest_url]',
			array(
				'default' => $defaults['socials_pinterest_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_pinterest_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Pinterest url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_pinterest_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_youtube_url]',
			array(
				'default' => $defaults['socials_youtube_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_youtube_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Youtube url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_youtube_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_linkedin_url]',
			array(
				'default' => $defaults['socials_linkedin_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_linkedin_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Linkedin url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_linkedin_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_linkedin_url]',
			array(
				'default' => $defaults['socials_linkedin_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_linkedin_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Linkedin url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_linkedin_url]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_1]',
			array(
				'default' => $defaults['socials_custom_icon_1'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_1]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 1', 'nandi' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'nandi' ), 'https://fontawesome.com/icons' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_1]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_url_1]',
			array(
				'default' => $defaults['socials_custom_icon_url_1'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_url_1]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 1 url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_url_1]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_2]',
			array(
				'default' => $defaults['socials_custom_icon_2'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_2]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 2', 'nandi' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'nandi' ), 'https://fontawesome.com/icons' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_2]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_url_2]',
			array(
				'default' => $defaults['socials_custom_icon_url_2'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_url_2]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 2 url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_url_2]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_3]',
			array(
				'default' => $defaults['socials_custom_icon_3'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_3]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 3', 'nandi' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'nandi' ), 'https://fontawesome.com/icons' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_3]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_custom_icon_url_3]',
			array(
				'default' => $defaults['socials_custom_icon_url_3'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_custom_icon_url_3]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 3 url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_custom_icon_url_3]',
			)
		);
		
		$wp_customize->add_setting(
			'nandi_settings[socials_mail_url]',
			array(
				'default' => $defaults['socials_mail_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'nandi_settings[socials_mail_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'E-mail url', 'nandi' ),
				'section'    => 'nandi_socials_section',
				'settings'   => 'nandi_settings[socials_mail_url]',
			)
		);

		// Add Nandi Premium section
		if ( ! defined( 'NANDI_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new Nandi_Upsell_Section( $wp_customize, 'nandi_upsell_section',
					array(
						'pro_text' => __( 'Get Premium for more!', 'nandi' ),
						'pro_url' => esc_url( NANDI_THEME_URL ),
						'capability' => 'edit_theme_options',
						'priority' => 555,
						'type' => 'nandi-upsell-section',
					)
				)
			);
		}
	}
}

if ( ! function_exists( 'nandi_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'nandi_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 */
	function nandi_customizer_live_preview() {
		wp_enqueue_script( 'nandi-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), NANDI_VERSION, true );
	}
}
