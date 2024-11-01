<?php

/*
  Plugin Name: Our Test Plugin
  Description: A truly amazing plugin.
  Version: 1.0
  Author: Brad
  Author URI: https://www.udemy.com/user/bradschiff/
*/

class WordCountAndTimePlugin
{

  // Constructor to initialize the plugin
  function __construct()
  {
    // Hook to add the settings page to the admin menu
    add_action('admin_menu', array($this, 'adminPage'));
    // Hook to register settings and fields
    add_action('admin_init', array($this, 'settings'));
    add_filter('the_content', array($this, 'ifWrap'));
  }

  function ifWrap($content) {
    if((is_main_query() AND is_single()) 
    AND 
    (
      get_option('wpc_wordCount', '1')
      // get_option('wp_wordCount', '1') OR
      // get_option('wp_wordCount', '1') 
    )) {
      return $this->createHTML($content);
    }
    return $content;
  }

  function createHTML($content) {
    return $html = '<h3>' . get_option('wcp_headline', 'Post Statistic') . '</h3><p>';

    if(get_option('wcp_location', '0') == '0') {
      return $content .'hello';
    }

  }

  // Registers settings, sections, and fields
  function settings()
  {
    // Add a section to the settings page
    add_settings_section(
      'wcp_first_section', // Section ID
      null,                 // Title (null since it's optional here)
      null,                 // Callback function (null for no description)
      'word-count-settings-page' // Page on which to add this section
    );

    // Add a field to the above section
    // option 1: display LOCATION 
    add_settings_field(
      'wpc_location',         // Field ID
      'Display Location',     // Field title shown to the user
      array($this, 'locationHTML'), // Callback function to render field HTML
      'word-count-settings-page',   // Page where this field appears
      'wcp_first_section'           // Section to which this field belongs
    );

    // Register the setting to make it saveable
    register_setting(
      'wordcountplugin',       // Option group
      'wcp_location',          // Option name
      array(
        'sanitize_callback' => 'sanitize_text_field', // Validation function
        'default' => '0'      // Default value if none is set
      )
    );

    // Add a field to the above section
    // option 2: display HEADLINE 

    add_settings_field(
      'wpc_headline',         // Field ID
      'Display Headline',     // Field title shown to the user
      array($this, 'headlineHTML'), // Callback function to render field HTML
      'word-count-settings-page',   // Page where this field appears
      'wcp_first_section'           // Section to which this field belongs
    );

    // Register the setting to make it saveable
    register_setting(
      'wordcountplugin',       // Option group
      'wcp_headline',          // Option name
      array(
        'sanitize_callback' => 'sanitize_text_field', // Validation function
        'default' => '0'      // Default value if none is set
      )
    );

    // Add a field to the above section
    // option 2: display HEADLINE 

    add_settings_field(
      'wpc_wordCount',         // Field ID
      'Word Count',     // Field title shown to the user
      array($this, 'wordCountHTML'), // Callback function to render field HTML
      'word-count-settings-page',   // Page where this field appears
      'wcp_first_section'           // Section to which this field belongs
    );

    // Register the setting to make it saveable
    register_setting(
      'wordcountplugin',       // Option group
      'wpc_wordCount',          // Option name
      array(
        'sanitize_callback' => 'sanitize_text_field', // Validation function
        'default' => '1'      // Default value if none is set
      )
    );
  }

  // Renders the HTML for the 'Display Location' field
  function locationHTML()
  { ?>
    <select name="wcp_location">
      <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Begining of Post</option>
      <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of Post</option>
    </select>
  <?php }

  function wordCountHTML()
  {
  ?>
    <input type='checkbox' name="wpc_wordCount" value="1" <?php checked(get_option('wpc_wordCount'), '1'); ?> />
  <?php
  }

  function headlineHTML()
  {
  ?>
    <input type='text' name="wcp_headline" value='<?php echo esc_attr(get_option('wcp_headline')); ?>' />
  <?php
  }

  // Adds a new page under the "Settings" menu in the admin dashboard
  function adminPage()
  {
    add_options_page(
      'Word Count Settings',  // Page title
      'Word Count',           // Menu title
      'manage_options',       // Capability required to access this page
      'word-count-settings-page', // Unique slug for the page
      array($this, 'ourHTML') // Callback function to render the page content
    );
  }

  // Outputs the HTML for the settings page form
  function ourHTML()
  { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method='POST'>
        <?php
        settings_fields('wordcountplugin');
        // Output registered sections and fields for the specified page
        do_settings_sections('word-count-settings-page');
        // Adds a submit button to save changes
        submit_button();
        ?>
      </form>
    </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
