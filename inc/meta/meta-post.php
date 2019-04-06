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
 
add_action('add_meta_boxes', 'bean_metabox_post');
function bean_metabox_post(){

$prefix = '_bean_';

 
/*===================================================================*/                                         
/*  VIDEO POST FORMAT SETTINGS                                                                      
/*===================================================================*/
$meta_box = array(
    'id' => 'bean-meta-box-video',
    'title' =>  esc_html__('Video Settings', 'mark'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Lightbox Embed:', 'mark'),
            'desc' => esc_html__('Insert a embeded URL for a video lightbox.', 'mark'),
            'id' => $prefix . 'post_embed_url',
            'type' => 'text',
            'std' => ''
            ),
        array(
            'name' => esc_html__('Embed:', 'mark'),
            'desc' => esc_html__('Alternatively, insert an embed code.', 'mark'),
            'id' => $prefix . 'post_embed',
            'type' => 'textarea',
            'std' => ''
            ),
    )
);
bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()