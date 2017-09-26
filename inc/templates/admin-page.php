<h1>Sivupalkin Asetukset</h1>
<?php settings_errors(); ?>

<?php

    $profilePicture = esc_attr( get_option( 'profile_picture' ) );
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName .' '. $lastName;
    $description = esc_attr( get_option( 'user_description' ) );

    $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
    $facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
    $github_icon = esc_attr( get_option( 'github_handler' ) );
    $instagram_icon = esc_attr( get_option( 'instagram_handler' ) );




?>
<div class="ewp-sidebar-preview">
    <div class="ewp-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $profilePicture; ?>);"></div><!-- .profile-picture -->
        </div><!-- .image-container -->
        <h1 class="ewp-username"><?php print $fullName; ?></h1>
        <h2 class="ewp-description"><?php print $description; ?></h2>
        <div class="icons-wrapper">
                <?php if( !empty( $twitter_icon ) ): ?>
                    <span class="ewp-icon-sidebar dashicons-before dashicons-twitter"></span>
                <?php endif; 
                 if( !empty( $facebook_icon ) ): ?>
                    <span class="ewp-icon-sidebar dashicons-before dashicons-facebook-alt"></span>
                <?php endif; 
                if( !empty( $instagram_icon ) ): ?>
                    <span class="ewp-icon-sidebar"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></span>
                <?php endif;             
                if( !empty( $github_icon ) ): ?>
                    <span class="ewp-icon-sidebar"><i class="fa fa-github fa-lg" aria-hidden="true"></i></span>
                <?php endif; ?>
        </div><!-- .icons-wrapper -->
    </div><!-- .ewp-sidebar -->
    
</div><!-- .ewp-sidebar-preview -->

<form method="post" action="options.php" class="ewp-general-form">
    <?php settings_fields( 'ewp-settings-group' ); ?>    
    <?php do_settings_sections( 'adm_options' ); ?>
    <?php submit_button( 'Talenna muutokset', 'primary', 'btnSubmit' ); ?>
</form>
