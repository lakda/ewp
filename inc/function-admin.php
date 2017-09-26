<?php

function ewp_add_admin_page() {

    // Luodaan teeman admin sivu
    add_menu_page( 'Theme Options', 'ewp', 'manage_options', 'admin_options', 'ewp_theme_create_page', 'dashicons-money', 110 );

    // luodaan teeman admin ala-sivu
    //add_submenu_page( parent_slug, page_title, menu_title, capability, menu_slug, function )
    add_submenu_page( 'admin_options', 'Sivupalkin asetukset', 'Sivupalkki', 'manage_options', 'admin_options', 'ewp_theme_create_page' );
    add_submenu_page( 'admin_options', 'Yhteystietolomake', 'Yhteydenottolomake', 'manage_options', 'ewp_theme_contact', 'ewp_contact_form_page' );

    // Aktivoidaan mukautetut asetukset
    add_action( 'admin_init', 'ewp_custom_setttings' );
}

add_action( 'admin_menu', 'ewp_add_admin_page' );

function ewp_custom_setttings() {

    //Sivupalkin asetukset
    register_setting( 'ewp-settings-group', 'profile_picture'  );
    register_setting( 'ewp-settings-group', 'first_name'  );
    register_setting( 'ewp-settings-group', 'last_name'  );
    register_setting( 'ewp-settings-group', 'user_description'  );
    register_setting( 'ewp-settings-group', 'twitter_handler', 'ewp_sanitize_twitter_handler'  );
    register_setting( 'ewp-settings-group', 'facebook_handler'  );
    register_setting( 'ewp-settings-group', 'instagram_handler'  );
    register_setting( 'ewp-settings-group', 'github_handler'  );

    //add_settings_section( id, title, callback, page )
    add_settings_section( 'ewp-sidebar-options', 'Sivupalkki', 'ewp_sidebar_options', 'adm_options' );

    //add_settings_field( id, title, callback, page, section, args )
     //add_settings_field( 'sidebar-email', 'Sähköposti', 'ewp_sidebar_name', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-profile-picture', 'Kuva', 'ewp_sidebar_profile', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-name', 'Nimi', 'ewp_sidebar_name', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-description', 'Kuvaus', 'ewp_sidebar_description', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter', 'ewp_sidebar_twitter', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook', 'ewp_sidebar_facebook', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-instagram', 'Instagram', 'ewp_sidebar_instagram', 'adm_options', 'ewp-sidebar-options' );
    add_settings_field( 'sidebar-github', 'GitHub', 'ewp_sidebar_github', 'adm_options', 'ewp-sidebar-options' );
   



    //Yhteystietolomakkeen asetukset
    register_setting( 'ewp-contact-options', 'activate_contact' );

    add_settings_section( 'ewp-contact-section', 'Yhteystietolomake', 'ewp_contact_section', 'ewp_theme_contact' );

    add_settings_field( 'activate-form', 'Aktivoi yhteystietolomake', 'ewp_activate_contact', 'ewp_theme_contact', 'ewp-contact-section' );
    
    
    
}

function ewp_contact_section() {
    echo 'Activate and deactivate the built-in contact form';
}

function ewp_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="" name="activate_contact" value="1" '. $checked .'/> </label>';
}

function ewp_sidebar_options() {

 echo 'Muokkaa Sivupalkin Tietoja';
}

function ewp_sidebar_profile() {

    $profilePicture = esc_attr( get_option( 'profile_picture' ) );
    if( empty($profilePicture) ) {
        echo '<input type="button" class="button button-secondary" value="Lataa profiilikuva" id="upload-button" ><input type="hidden" id="profile-picture" name="profile_picture" value=""  /> ';
    } else {
        echo '<input type="button" class="button button-secondary" value="Vaihda profiilikuva" id="upload-button" ><input type="hidden" id="profile-picture" name="profile_picture" value="'. $profilePicture .'"  /> <input type="button" class="button button-secondary" value="Poista " id="remove-picture"> ';
    }
    
}


function ewp_sidebar_name() {

    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    echo '<input type="text" name="first_name" value="'. $firstName .'" placeholder="Etunimi" /> <input type="text" name="last_name" value="'. $lastName .'" placeholder="Sukunimi" />';
}

function ewp_sidebar_description() {

    $description = esc_attr( get_option( 'user_description' ) );
    echo '<input type="text" name="user_description" value="'. $description .'" placeholder="Kuvaus" /><p class="description">Kirjoita jotain itsestäsi. </p> ';
}

function ewp_sidebar_twitter() {

    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="'. $twitter .'" placeholder="Twitter" /><p class="description">Syötä Twitter käyttäjänimi ilman @ merkkiä. </p> ';
}

function ewp_sidebar_facebook() {

    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="'. $facebook .'" placeholder="Facebook" /> ';
}

function ewp_sidebar_github() {

    $github = esc_attr( get_option( 'github_handler' ) );
    echo '<input type="text" name="github_handler" value="'. $github .'" placeholder="GitHub" /> ';
}

function ewp_sidebar_instagram() {

    $instagram = esc_attr( get_option( 'instagram_handler' ) );
    echo '<input type="text" name="instagram_handler" value="'. $instagram .'" placeholder="Instagram" /> ';
}

// Ylimääräisten merkkien poisto twitteriä varten
function ewp_sanitize_twitter_handler( $input ) {

    $output = sanitize_text_field( $input );
    $output = str_replace ( '@', '', $output );
    return $output;
}



function ewp_theme_create_page() {
    // Admin sivun luominen
    require_once( get_template_directory() . '/inc/templates/admin-page.php');
}

function ewp_theme_settings_page() {
    // Admin ala-sivun luominen

}

function ewp_contact_form_page(){
    require_once( get_template_directory() . '/inc/templates/ewp-contact-form.php');
}


/* Admin enqueue functions*/

function ewp_load_admin_scripts( $hook ) {

    if( 'toplevel_page_admin_options' != $hook ) {
        return;
    }

    wp_register_style( 'ewp_admin', get_template_directory_uri() . '/inc/admin-styles.css' , false, '1.0.0' );
    wp_enqueue_style( 'ewp_admin' );

    // Enqueue Font Awesome
    wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0' );
    wp_enqueue_style( 'font-awesome' );

    wp_enqueue_media();

    wp_register_script( 'ewp-admin-script', get_template_directory_uri() . '/js/ewp.admin.js', array('jquery-core'), false, true );
    wp_enqueue_script( 'ewp-admin-script' );

}

add_action( 'admin_enqueue_scripts', 'ewp_load_admin_scripts' );



?>

