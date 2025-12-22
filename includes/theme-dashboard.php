<?php
/**
 * Archie Rombo Theme Dashboard
 * 
 * Handles the custom admin page for theme settings.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the custom menu page.
 */
function archie_rombo_register_options_page() {
    add_theme_page(
        __( 'Archie Rombo Dashboard', 'archie-rombo' ),
        __( 'Archie Rombo', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_dashboard',
        'archie_rombo_render_options_page'
    );
}
add_action( 'admin_menu', 'archie_rombo_register_options_page' );

/**
 * Register settings.
 */
function archie_rombo_register_settings() {
    // Register the setting for Custom Logo (syncs with core)
    register_setting( 'archie_rombo_options_group', 'custom_logo', array(
        'sanitize_callback' => 'archie_rombo_sync_custom_logo'
    ) );

    // Register setting for Primary Color
    register_setting( 'archie_rombo_options_group', 'archie_rombo_primary_color', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_hex_color',
        'default' => '#33bbcc'
    ) );

    // Register setting for Fixed Header
    register_setting( 'archie_rombo_options_group', 'archie_rombo_fixed_header', array(
        'type' => 'boolean',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'default' => false
    ) );

    // Register Social Media Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_facebook_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_twitter_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_instagram_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_linkedin_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
}
add_action( 'admin_init', 'archie_rombo_register_settings' );

/**
 * Sync the custom_logo option with the theme_mod.
 * This ensures the logo works with standard WordPress functions like the_custom_logo().
 */
function archie_rombo_sync_custom_logo( $value ) {
    if ( empty( $value ) ) {
        remove_theme_mod( 'custom_logo' );
    } else {
        set_theme_mod( 'custom_logo', $value );
    }
    return $value;
}

/**
 * Render the options page HTML.
 */
function archie_rombo_render_options_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Archie Rombo Theme Dashboard', 'archie-rombo' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'archie_rombo_options_group' ); ?>
            <?php do_settings_sections( 'archie_rombo_options_group' ); ?>

            <table class="form-table">
                <!-- Custom Logo Section -->
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Custom Logo', 'archie-rombo' ); ?></th>
                    <td>
                        <?php
                        // Use theme_mod as the source of truth to ensure sync with Customizer
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo_url = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';
                        ?>
                        <input type="hidden" id="custom_logo" name="custom_logo" value="<?php echo esc_attr( $custom_logo_id ); ?>">
                        <div id="logo-preview-wrapper" style="margin-bottom: 10px;">
                            <?php if ( $logo_url ) : ?>
                                <img id="logo-preview" src="<?php echo esc_url( $logo_url ); ?>" style="max-width: 200px; height: auto;">
                            <?php else : ?>
                                <img id="logo-preview" src="" style="max-width: 200px; height: auto; display: none;">
                            <?php endif; ?>
                        </div>
                        <input type="button" class="button button-secondary" id="upload_logo_button" value="<?php esc_attr_e( 'Upload Logo', 'archie-rombo' ); ?>">
                        <?php if ( $logo_url ) : ?>
                            <input type="button" class="button button-secondary" id="remove_logo_button" value="<?php esc_attr_e( 'Remove Logo', 'archie-rombo' ); ?>">
                        <?php else : ?>
                            <input type="button" class="button button-secondary" id="remove_logo_button" value="<?php esc_attr_e( 'Remove Logo', 'archie-rombo' ); ?>" style="display: none;">
                        <?php endif; ?>
                        <p class="description"><?php esc_html_e( 'Upload a custom logo for your site header.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <!-- Theme Color Section -->
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Primary Theme Color', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_primary_color" value="<?php echo esc_attr( get_option( 'archie_rombo_primary_color', '#33bbcc' ) ); ?>" class="my-color-field" data-default-color="#33bbcc" />
                        <p class="description"><?php esc_html_e( 'Select the primary accent color for buttons and links.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <!-- Header Options Section -->
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Header Behavior', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_fixed_header" value="1" <?php checked( 1, get_option( 'archie_rombo_fixed_header' ), true ); ?> />
                            <?php esc_html_e( 'Enable Fixed Header', 'archie-rombo' ); ?>
                        </label>
                        <p class="description"><?php esc_html_e( 'If checked, the header will stay fixed at the top of the screen while scrolling.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <!-- Social Media Section -->
                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Social Media Links', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Facebook URL', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="url" name="archie_rombo_facebook_url" value="<?php echo esc_attr( get_option( 'archie_rombo_facebook_url' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Twitter / X URL', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="url" name="archie_rombo_twitter_url" value="<?php echo esc_attr( get_option( 'archie_rombo_twitter_url' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Instagram URL', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="url" name="archie_rombo_instagram_url" value="<?php echo esc_attr( get_option( 'archie_rombo_instagram_url' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'LinkedIn URL', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="url" name="archie_rombo_linkedin_url" value="<?php echo esc_attr( get_option( 'archie_rombo_linkedin_url' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue scripts and styles for the dashboard.
 */
function archie_rombo_admin_scripts( $hook ) {
    if ( 'appearance_page_archie_rombo_dashboard' !== $hook ) {
        return;
    }

    // Media Uploader
    wp_enqueue_media();

    // Color Picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'archie-rombo-admin-js', get_template_directory_uri() . '/js/admin.js', array( 'wp-color-picker' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'archie_rombo_admin_scripts' );
