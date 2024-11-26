<?php
    /*
    Plugin Name: Device Specific Homepages
    Description: Automatically displays device-specific homepages.
    Version: 1.0
    Author: mohamedyussry
    */

    // Include Mobile_Detect library
    require_once plugin_dir_path(__FILE__) . 'Mobile_Detect.php';

    // Define constants
    define('DSHP_OPTION_NAME', 'dshp_settings');

    // Initialize the plugin
    function dshp_init() {
        // Register settings
        register_setting('dshp_settings_group', DSHP_OPTION_NAME);

        // Register settings fields
        add_settings_section('dshp_settings_section', 'Device Specific Homepages Settings', 'dshp_settings_section_callback', 'dshp_settings_page');

        add_settings_field('dshp_mobile_page', 'Mobile Homepage', 'dshp_mobile_page_callback', 'dshp_settings_page', 'dshp_settings_section');
        add_settings_field('dshp_tablet_page', 'Tablet Homepage', 'dshp_tablet_page_callback', 'dshp_settings_page', 'dshp_settings_section');
        add_settings_field('dshp_desktop_page', 'Desktop Homepage', 'dshp_desktop_page_callback', 'dshp_settings_page', 'dshp_settings_section');
        add_settings_field('dshp_enable', 'Enable Device Specific Homepages', 'dshp_enable_callback', 'dshp_settings_page', 'dshp_settings_section');
    }
    add_action('admin_init', 'dshp_init');

    // Add settings page
    function dshp_add_settings_page() {
        add_options_page('Device Specific Homepages', 'Device Specific Homepages', 'manage_options', 'device-specific-homepages', 'dshp_settings_page');
    }
    add_action('admin_menu', 'dshp_add_settings_page');

    // Settings section callback
    function dshp_settings_section_callback() {
        echo '<p>Configure device-specific homepages.</p>';
    }

    // Settings field callbacks
    function dshp_mobile_page_callback() {
        $options = get_option(DSHP_OPTION_NAME);
        wp_dropdown_pages(array(
            'name' => DSHP_OPTION_NAME . '[mobile_page]',
            'selected' => isset($options['mobile_page']) ? $options['mobile_page'] : '',
            'show_option_none' => 'Select a page',
        ));
    }

    function dshp_tablet_page_callback() {
        $options = get_option(DSHP_OPTION_NAME);
        wp_dropdown_pages(array(
            'name' => DSHP_OPTION_NAME . '[tablet_page]',
            'selected' => isset($options['tablet_page']) ? $options['tablet_page'] : '',
            'show_option_none' => 'Select a page',
        ));
    }

    function dshp_desktop_page_callback() {
        $options = get_option(DSHP_OPTION_NAME);
        wp_dropdown_pages(array(
            'name' => DSHP_OPTION_NAME . '[desktop_page]',
            'selected' => isset($options['desktop_page']) ? $options['desktop_page'] : '',
            'show_option_none' => 'Select a page',
        ));
    }

    function dshp_enable_callback() {
        $options = get_option(DSHP_OPTION_NAME);
        ?>
        <input type="checkbox" name="<?php echo DSHP_OPTION_NAME; ?>[enable]" value="1" <?php checked(1, isset($options['enable']) ? $options['enable'] : 0); ?>>
        <label for="<?php echo DSHP_OPTION_NAME; ?>[enable]">Enable device-specific homepages</label>
        <?php
    }

    // Settings page callback
    function dshp_settings_page() {
        ?>
        <div class="wrap">
            <h1>Device Specific Homepages</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('dshp_settings_group');
                do_settings_sections('dshp_settings_page');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Device detection and redirection
    function dshp_redirect_homepage() {
        $options = get_option(DSHP_OPTION_NAME);

        if (isset($options['enable']) && $options['enable'] && is_front_page()) {
            $detect = new Mobile_Detect;

            if ($detect->isMobile() && ! $detect->isTablet() && isset($options['mobile_page'])) {
                wp_redirect(get_permalink($options['mobile_page']));
                exit;
            } elseif ($detect->isTablet() && isset($options['tablet_page'])) {
                wp_redirect(get_permalink($options['tablet_page']));
                exit;
            } elseif (isset($options['desktop_page'])) {
                wp_redirect(get_permalink($options['desktop_page']));
                exit;
            }
        }
    }
    add_action('template_redirect', 'dshp_redirect_homepage');

    // Caching
    function dshp_cache_homepage($output, $object_cache, $cache_key, $cache_group) {
        if ($cache_group === 'posts' && $object_cache->get($cache_key, $cache_group) === false) {
            $object_cache->set($cache_key, $output, $cache_group, HOUR_IN_SECONDS);
        }
        return $output;
    }
    add_filter('wp_cache_get', 'dshp_cache_homepage', 10, 4);

    // Fallback options
    function dshp_fallback_homepage() {
        $options = get_option(DSHP_OPTION_NAME);

        if (isset($options['enable']) && $options['enable'] && is_front_page()) {
            $detect = new Mobile_Detect;

            if ($detect->isMobile() && ! $detect->isTablet() && ! isset($options['mobile_page'])) {
                wp_redirect(home_url());
                exit;
            } elseif ($detect->isTablet() && ! isset($options['tablet_page'])) {
                wp_redirect(home_url());
                exit;
            } elseif (! isset($options['desktop_page'])) {
                wp_redirect(home_url());
                exit;
            }
        }
    }
    add_action('template_redirect', 'dshp_fallback_homepage', 11);
    ?>
