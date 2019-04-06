<?php
/**
 * The file is for creating the portfolio post type meta. 
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Mark
 * @author ThemeBeans
 */
 
add_action('add_meta_boxes', 'bean_metabox_portfolio');
function bean_metabox_portfolio(){

$prefix = '_bean_';




/*===================================================================*/
/*  PORTFOLIO FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-type',
	'title' =>  esc_html__('Portfolio Format', 'mark'),
	'description' => esc_html__('', 'mark'),
	'page' => 'portfolio',
	'context' => 'side',
	'priority' => 'core',
	'fields'   => array(
		array(  
			'name' => esc_html__('Gallery','mark'),
			'desc' => esc_html__('','mark'),
			'id' => $prefix.'portfolio_type_gallery',
			'type' => 'checkbox',
			'std' => true 
			),	
		array(  
			'name' => esc_html__('Video','mark'),
			'desc' => esc_html__('','mark'),
			'id' => $prefix.'portfolio_type_video',
			'type' => 'checkbox',
			'std' => false 
			),							
	)
);
bean_add_meta_box( $meta_box );





/*===================================================================*/
/*  PORTFOLIO META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-meta',
	'title' =>  esc_html__('Portfolio Settings', 'mark'),
	'description' => esc_html__('', 'mark'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array( 
			'name' => esc_html__('Gallery Images:','mark'),
			'desc' => esc_html__('Upload, reorder and caption the post gallery.','mark'),
			'id' => $prefix .'portfolio_upload_images',
			'type' => 'images',
			'std' => esc_html__('Browse & Upload', 'mark')
			),
        
        array( 
            'name'     => esc_html__('Project Color', 'mark'),
            'desc'     => esc_html__('Modify the background color of this post in the portfolio grid. Defaults to the Customizer option.', 'mark'),
            'id'       => $prefix.'portfolio_color',
            'type'     => 'color',
            'val'      => '',
            'std'      => ''
            ),   
        array( 
            'name'     => esc_html__('Hover Project Color', 'mark'),
            'desc'     => esc_html__('Modify the hover background color of this post in the portfolio grid. Defaults to the Customizer option.', 'mark'),
            'id'       => $prefix.'portfolio_color_hover',
            'type'     => 'color',
            'val'      => '',
            'std'      => ''
            ), 

		array(
			'name' => esc_html__('Date:', 'mark'),
			'id' => $prefix.'portfolio_date',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the date.', 'mark'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Views:', 'mark'),
			'id' => $prefix.'portfolio_views',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the view count.', 'mark'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Categories:', 'mark'),
			'id' => $prefix.'portfolio_cats',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the portfolio categories.', 'mark'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Tags:', 'mark'),
			'id' => $prefix.'portfolio_tags',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the portfolio tags.', 'mark'),
			'std' => false 
			),
        array(
            'name' => esc_html__('Permalink:', 'mark'),
            'id' => $prefix.'portfolio_permalink',
            'type' => 'checkbox',
            'desc' => esc_html__('Display the post permalink.', 'mark'),
            'std' => false 
            ),
		array(  
			'name' => esc_html__('Role:','mark'),
			'desc' => esc_html__('Display the role.','mark'),
			'id' => $prefix.'portfolio_role',
			'type' => 'text',
			'std' => ''
			),
		array(  
			'name' => esc_html__('Client:','mark'),
			'desc' => esc_html__('Display the client meta.','mark'),
			'id' => $prefix.'portfolio_client',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => esc_html__('URL:','mark'),
			'desc' => esc_html__('Display a URL to link to.','mark'),
			'id' => $prefix.'portfolio_url',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => esc_html__('External URL:','mark'),
			'desc' => esc_html__('Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.','mark'),
			'id' => $prefix.'portfolio_external_url',
			'type' => 'text',
			'std' => ''
			),				
	)
);
bean_add_meta_box( $meta_box );
 
 
 
 
/*===================================================================*/
/*  VIDEO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-video',
	'title' => esc_html__('Video Settings', 'mark'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',	
	'fields' => array(
		array(
			'name' => esc_html__('Lightbox Embed URL:', 'mark'),
			'desc' => esc_html__('Insert your embeded URL to play in the blogroll grid pages.', 'mark'),
			'id' => $prefix . 'portfolio_embed_url',
			'type' => 'text',
			'std' => ''
			),
		array(
			'name' => esc_html__('Embed 1:', 'mark'),
			'desc' => esc_html__('Insert your embeded code here.', 'mark'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => esc_html__('Embed 2:', 'mark'),
			'desc' => esc_html__('Insert your embeded code here.', 'mark'),
			'id' => $prefix . 'portfolio_embed_code_2',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => esc_html__('Embed 3:', 'mark'),
			'desc' => esc_html__('Insert your embeded code here.', 'mark'),
			'id' => $prefix . 'portfolio_embed_code_3',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => esc_html__('Embed 4:', 'mark'),
			'desc' => esc_html__('Insert your embeded code here.', 'mark'),
			'id' => $prefix . 'portfolio_embed_code_4',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => esc_html__('Video Shortcodes:', 'mark'),
			'desc' => esc_html__('Insert any <a target="blank" href="https://codex.wordpress.org/Video_Shortcode">video shortcodes</a> here.', 'mark'),
			'id' => $prefix . 'portfolio_video_shortcodes',
			'type' => 'textarea',
			'std' => ''
			),		
	),
	
);
bean_add_meta_box( $meta_box );
}