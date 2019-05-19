<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
			$categories_tmp 	= array_unshift($of_categories, "Select a category:");    

		//Access the WordPress Pages via an Array
			$of_pages 			= array();
			$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
			foreach ($of_pages_obj as $of_page) {
				$of_pages[$of_page->ID] = $of_page->post_name; }
				$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       

		//Testing 
				$of_options_select 	= array("one","two","three","four","five"); 
				$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

        $of_styling_options_radio 	= array("theme" => "Theme","options" => "Options");

				$font_size = array( 'select', '12px', '13px', '14px' );
				$font_style = array( "normal", "italic", "bold", "bold italic");

		//Sample Homepage blocks for the layout manager (sorter)
				$of_options_homepage_blocks = array
				( 
					"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
				), 
					"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
				),
					);


		//Background Images Reader
		$bg_images_path = impulse_press_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = impulse_press_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}    
			}
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		$menu_color = array( 'Default', 'Inverse' );

		// Buttons
		$btn_color = array("default" => "Default Gray","primary" => "Primary","info" => "Info","success" => "Success","warning" => "Warning","danger" => "Danger","inverse" => "Inverse");
		$btn_size = array("mini" => "Mini","small" => "Small","default" => "Medium","large" => "Large");
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/


        // Set the Options Array
		global $of_options;
		$of_options = array();

		$of_options[] = array( "name"	=> __( 'General', 'impulse-press' ),
			"type"	=> "heading",
			);

		$of_options[] = array( "name"	=> __( 'Login Logo', 'impulse-press' ),
			"desc"	=> __( 'Upload a custom logo for your Wordpress login screen. (Recommended 300px x 80px)', 'impulse-press' ),
			"id"	=> "custom_login_logo",
			"std"	=> "",
			"type"	=> "media");

		$of_options[] = array( "name"	=> __( 'Login Logo Height', 'impulse-press' ),
			"desc"	=> __( 'Enter the height of your custom logo to override the default WordPress image height. Width, can not change.', 'impulse-press' ),
			"id"	=> "custom_login_logo_height",
			"std"	=> "67px",
			"type"	=> "text");

		$of_options[] = array( "name"	=> __( 'Favicon', 'impulse-press' ),
			"desc"	=> __( 'Upload or paste the URL for your custom favicon.', 'impulse-press' ),
			"id"	=> "custom_favicon",
			"std"	=> "",
			"type"	=> "media");

		$of_options[] = array( "name"	=> __( 'Breadcrumbs', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable breadcrumbs', 'impulse-press' ),
			"id"	=> "enable_disable_breadcrumbs",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");

		// Header
		$of_options[] = array( "name"	=> __( 'Header', 'impulse-press' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Fixed Navbar', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable a fixed navbar.', 'impulse-press' ),
			"id"	=> "disable_fixed_navbar",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");

		$of_options[] = array( "name"	=> __( 'Main Logo', 'impulse-press' ),
			"desc"	=> __( 'Use this field to upload your custom logo for use in the theme header. (Recommended 200px x 40px)', 'impulse-press' ),
			"id"	=> "custom_logo",
			"std"	=> "",
			"type"	=> "media",
			);


		$of_options[] = array( "name"	=> __( 'Header Search Bar', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable the search bar in the header', 'impulse-press' ),
			"id"	=> "enable_disable_search",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");

		$of_options[] = array( "name"	=> __( 'Social Icons In Header', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable the social icons in the header.', 'impulse-press' ),
			"id"	=> "enable_social",
			"std"	=> '2',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");

        /* Footer options */
		$of_options[] = array( "name"	=> __( 'Footer', 'impulse-press' ),
			"type"	=> "heading");


		$of_options[] = array( "name"	=> __( 'Social Icons In Footer', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable the social icons in the footer.', 'impulse-press' ),
			"id"	=> "enable_social_footer",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");


		$of_options[] = array( "name"	=> __( 'Custom Copyright', 'impulse-press' ),
			"desc"	=> __( 'Add your own custom text/html for copyright region.', 'impulse-press' ),
			"id"	=> "custom_copyright",
			"std"	=> "",
			"type"	=> "textarea");

		$of_options[] = array( "name"	=> __( 'Custom Powered By Text', 'impulse-press' ),
			"desc"	=> __( 'Add your own custom text/html for powered by region.', 'impulse-press' ),
			"id"	=> "custom_poweredby",
			"std"	=> "",
			"type"	=> "textarea");

		// STYLING
		$of_options[] = array( "name"	=> __( 'Styling', 'impulse-press' ),
			"type"	=> "heading");

         $of_options[] = array( 	"name"	=> "",
			"desc"	=> "",
			"id"	=> "subheading",
			"std"	=> "<h3 style=\"margin: 0;\">". __( 'Styling Options or CSS Themes', 'impulse-press' ) ."</h3>",
			"icon"	=> true,
			"type"	=> "info"
			);

        $of_options[] = array( "name"	=> "Theme",
            "desc"	=> __( 'Select one of the themes from the list. The files are loaded from the <b>css-themes</b> directory','impulse-press') ,
            "id"	=> "theme",
            "std"	=> 'impulse-press.css',
            "type"	=> "select",
            "options" 	=>  impulse_press_print_list_css_themes() );

        $of_options[] = array( 	"name"	=> "",
            "desc"	=> "",
            "id"	=> "subheading",
            "std"	=> "<h3 style=\"margin: 0;\">". __( 'Font Options', 'impulse-press' ) ."</h3>",
            "icon"	=> true,
            "type"	=> "info"
        );

        $of_options[] = array( "name"	=> "Website Font",
            "desc"	=> __( 'Select your font', 'impulse-press' ),
            "id"	=> "body_gfont",
            "std"	=> 'Raleway',
            "type"	=> "select_google_font",
            "preview"	=> array(
                "text"	=> __( 'Font Preview Text', 'impulse-press' ),
                "size"	=> "30px"
            ),
            "options" 	=> list_google_font_options() );


	    //Blog
		$of_options[] = array( "name"	=> __( 'Blog', 'impulse-press' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Display Meta Data', 'impulse-press' ),
			"desc"	=> __( 'Select to enable/disable the date and author.', 'impulse-press' ),
			"id"	=> "enable_disable_meta",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'impulse-press' ),
			"off"	=> __( 'Disable', 'impulse-press' ),
			"type"	=> "switch");

		$of_options[] = array( 	"name" 		=> "Read More Button Text",
			"desc" 		=> "This is the text that will replace Read More.",
			"id" 		=> "read_more_text",
			"std" 		=> "Read More",
			"type" 		=> "text"
			);


		// Social links
		$of_options[] = array( "name"	=> __( 'Social', 'impulse-press' ),
			"type"	=> "heading");



		$url =  ADMIN_DIR . 'assets/images/';
		$of_options[] = array( "name"	=> __( 'Social Style', 'impulse-press' ),
			"desc"	=> __( 'Select your social icon style. Some icons don\'t have both styles. Refer to <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a>.', 'impulse-press' ),
			"id"	=> "social_style",
			"std"	=> "one",
			"type"	=> "images",
			"options"	=> array(
				'one'	=> $url . 'facebook.jpg',
				'two'	=> $url . 'facebook2.jpg' )
			);

		$social_links = get_social_links();
		foreach( $social_links as $social_link ) {
			$of_options[] = array( "name"	=> ucfirst($social_link),
				'desc'	=> ' '. __( 'Enter your ', 'impulse-press' ) . $social_link . __( ' url', 'impulse-press' ) .' <br />'. __( 'Include http:// at the front of the url.', 'impulse-press' ),
				'id'	=> $social_link,
				'std'	=> '#',
				'type'	=> 'text' );
		}



		$of_options[] = array( "name"	=> __( 'Tracking', 'impulse-press' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Header Tracking Code', 'impulse-press' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.', 'impulse-press' ),
			"id"	=> "tracking_header",
			"std"	=> "",
			"type"	=> "textarea");

		$of_options[] = array( "name"	=> __( 'Footer Tracking Code', 'impulse-press' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'impulse-press' ),
			"id"	=> "tracking_footer",
			"std"	=> "",
			"type"	=> "textarea");


        // Backup Options
		$of_options[] = array( 	"name" 		=> "Backup Options",
			"type" 		=> "heading",
			);

		$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
			"id" 		=> "of_backup",
			"std" 		=> "",
			"type" 		=> "backup",
			"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
			);

		$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
			"id" 		=> "of_transfer",
			"std" 		=> "",
			"type" 		=> "transfer",
			"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
			);

	}

    function get_smof_color_option($name, $description, $id, $std_value)
    {
        $res = array("name" => __($name, 'impulse-press'),
                              "desc" => __($description, 'impulse-press'),
                              "id" => $id,
                              "std" => $std_value,
                              "type" => "color");
        return $res;
    }

    //End function: of_options()
}//End chack if function exists: of_options()
?>
