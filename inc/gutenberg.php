<?php
function createAuthorAvatar() {

    wp_register_script( 'isceb-author-avatar-block', 
    get_template_directory_uri() .  '/build/index.js', array('wp-blocks','wp-editor','wp-components'));

    register_block_type( 'isceb-theme/isceb-author-img', array(
        'editor_script' => 'isceb-author-avatar-block'
    ));

    // add_theme_support( 'editor-style' );
    // add_editor_style( 'sass/theme/_theme.scss' );

   
}

add_action('init', 'createAuthorAvatar');

?>