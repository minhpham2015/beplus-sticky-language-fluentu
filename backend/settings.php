<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

 add_action('admin_enqueue_scripts', 'fluentu_admin_enqueue');
 function fluentu_admin_enqueue(){
   if(isset($_GET['page']) && $_GET['page'] == 'fluentu'){
     wp_enqueue_media();
     wp_enqueue_script('admin-fluentu', BSL_FLUENTU_PLUGIN_URL . 'assets/js/admin.js');
   }
 }

/**
 * custom option and settings
 */
function fluentu_settings_init() {
    // Register a new setting for "fluentu" page.
    register_setting( 'fluentu', 'fluentu_options' );
    register_setting( 'fluentu_langs', 'fluentu_langs_options' );

    // Register a new section in the "fluentu" page.
    add_settings_section(
        'fluentu_section_developers',
        __( 'Genaral', 'fluentu' ), 'fluentu_section_developers_callback',
        'fluentu'
    );

    // Register a new section in the "fluentu" page.
    add_settings_section(
        'fluentu_langs_developers',
        __( 'Languages', 'fluentu' ), 'fluentu_section_developers_callback',
        'fluentu_langs'
    );

    // Tab Genaral
    add_settings_field(
        'fluentu_field_enable', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'ON/OFF Sticky Language', 'fluentu' ),
        'fluentu_field_enable_cb',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_enable',
            'class'             => 'fluentu_row'
        )
    );

    add_settings_field(
        'fluentu_field_heading', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Title', 'fluentu' ),
        'fluentu_field_text_cb',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_heading',
            'class'             => 'fluentu_row'
        )
    );

    add_settings_field(
        'fluentu_field_sub_heading', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Sub Title', 'fluentu' ),
        'fluentu_field_text_cb_sub',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_sub_heading',
            'class'             => 'fluentu_row'
        )
    );

    add_settings_field(
        'fluentu_field_text_sticky', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Text on Sticky Language', 'fluentu' ),
        'fluentu_field_text_cb_sub',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_text_sticky',
            'class'             => 'fluentu_row'
        )
    );

    add_settings_field(
        'fluentu_field_link_more', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'URL (show more language)', 'fluentu' ),
        'fluentu_field_text_cb',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_link_more',
            'class'             => 'fluentu_row'
        )
    );

    add_settings_field(
        'fluentu_field_position', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Position After(add any tag or id or class) <br> <code>ex: header or .site-header or #site-header</code>', 'fluentu' ),
        'fluentu_field_text_cb',
        'fluentu',
        'fluentu_section_developers',
        array(
            'label_for'         => 'fluentu_field_position',
            'class'             => 'fluentu_row'
        )
    );


    //Tab Languages

    add_settings_field(
        'fluentu_field_languages', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Add Languages', 'fluentu' ),
        'fluentu_field_languages_cb',
        'fluentu_langs',
        'fluentu_langs_developers',
        array(
            'label_for'         => 'fluentu_field_languages',
            'class'             => 'fluentu_row'
        )
    );
}

/**
 * Register our fluentu_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'fluentu_settings_init' );


/**
 * Custom option and settings:
 *  - callback functions
 */


/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function fluentu_section_developers_callback( $args ) {

}

/**
 * field callbakc function.
 *
 * @param array $args
 */

function fluentu_field_enable_cb($args){
  // Get the value of the setting we've registered with register_setting()
  $options = get_option( 'fluentu_options' );
  ?>
  <input type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>"
  name="fluentu_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php checked($options[ $args['label_for'] ], 1 ); ?>>
  <?php
}

function fluentu_field_text_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'fluentu_options' );
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>"
    name="fluentu_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[ $args['label_for'] ] ?>">
    <?php
}

function fluentu_field_text_cb_sub( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'fluentu_options' );
    ?>
    <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="fluentu_options[<?php echo esc_attr( $args['label_for'] ); ?>]" rows="4" cols="100"><?php echo $options[ $args['label_for'] ] ?></textarea>
    <?php
}

function fluentu_field_languages_cb($args){
  // Get the value of the setting we've registered with register_setting()
  $langs = get_option( 'fluentu_langs_options' );
  ?>
  <style media="screen">
    .parent-container .container .insert-my-media{
      padding: 0 5px;
      display: inline-flex;
      max-height: 30px;
      min-width: 42px;
      justify-content: center;
    }
    .parent-container .container:not(:last-child){
      margin-bottom: 5px;
    }
    .parent-container .container .insert-my-media img{
      padding: 5px 0;
    }
    .fluentu_row #add{
      margin-top: 5px;
    }
  </style>
  <div class="parent-container">
      <?php
      if(!empty($langs)):
         foreach ($langs as $key => $lang) {
            $imag_url = wp_get_attachment_image_url($lang['icon'],'full ');
            ?>
            <div class="container">
                <input type='hidden' class='icon' name='fluentu_langs_options[<?php echo $key; ?>][icon]' placeholder='Icon' value="<?php echo $lang['icon']; ?>">
                <a href='javascript:;' class='insert-my-media button'><?php if($imag_url){ ?><img src="<?php echo $imag_url; ?>" width="30"/> <?php }else { echo "Icon"; } ?></a>
                <input type='text' placeholder='Name' name='fluentu_langs_options[<?php echo $key; ?>][name]' class='name' value="<?php echo $lang['name']; ?>">
                <input type='text'placeholder='URL' name='fluentu_langs_options[<?php echo $key; ?>][url]' class='url' value="<?php echo $lang['url']; ?>">
                <button type='button' id='remove'>-</button>
            </div>
            <?php
        }
      endif;
      ?>
  </div>
  <button type='button' id='add'>+</button>
  <?php

}

/**
 * Add the top level menu page.
 */
function fluentu_options_page() {
    add_menu_page(
        'Sticky Languages',
        'Sticky Languages',
        'manage_options',
        'fluentu',
        'fluentu_options_page_html'
    );
}


/**
 * Register our fluentu_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'fluentu_options_page' );


/**
 * Top level menu callback function
 */
function fluentu_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'fluentu_messages', 'fluentu_message', __( 'Settings Saved', 'fluentu' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'fluentu_messages' );

    //Get the active tab from the $_GET param
    $default_tab = null;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
    ?>
    <div class="wrap">
      <!-- Print the page title -->
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <!-- Here are our tabs -->
      <nav class="nav-tab-wrapper">
        <a href="?page=fluentu" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Genaral</a>
        <a href="?page=fluentu&tab=languages" class="nav-tab <?php if($tab==='languages'):?>nav-tab-active<?php endif; ?>">Languages</a>
      </nav>

      <div class="tab-content">
      <?php switch($tab) :
        case 'languages':
          ?>
          <form action="options.php" method="post">
            <?php
              settings_fields( 'fluentu_langs' );
              do_settings_sections( 'fluentu_langs' );
              submit_button( 'Save Settings' );
            ?>
          </form>
          <?php
          break;
        default:
          ?>
          <form action="options.php" method="post">
            <?php
              settings_fields( 'fluentu' );
              do_settings_sections( 'fluentu' );
              submit_button( 'Save Settings' );
            ?>
          </form>
          <?php
          break;
      endswitch; ?>
      </div>
    </div>
    <?php
}
