<?php 
/*
Plugin name: Generic Plugin
Description: This is something I am working on to help me develop plugins
Author: Daniel Mulvihill
Author URI: http://embraceyourinnerengineer.com
Version: 0.1
*/



function wpplugin_settings_page()
{
    add_menu_page(
        'Generic Plugin Name',
        'Generic Plugin Menu',
        'manage_options',
        'wpplugin',
        'wpplugin_settings_page_markup',
        'dashicons-wordpress-alt',
        100
    );
	
	  add_submenu_page(
    'wpplugin',
    __( 'Plugin File Paths', 'wpplugin' ),
    __( 'File Paths', 'wpplugin' ),
    'manage_options',
    'wpplugin-feature-1',
    'wpplugin_settings_subpage_markup'
  );

  add_submenu_page(
    'wpplugin',
    __( 'Plugin Feature 2', 'wpplugin' ),
    __( 'Feature 2', 'wpplugin' ),
    'manage_options',
    'wpplugin-feature-2',
    'wpplugin_settings_subpage_markup'
  );

}
add_action( 'admin_menu', 'wpplugin_settings_page' );


function wpplugin_settings_page_markup()
{
    // Double check user capabilities
    if ( !current_user_can('manage_options') ) {
      return;
    }
    ?>
    <div class="wrap">
      <h1><?php esc_html_e( get_admin_page_title() ) ?></h1>
		<?php $content ='Add some content: <input type="text" placeholder="Be creative"><input type="button" value="Go!">';
		
		?>
      <p><?php echo $content; ?></p>
    </div>
    <?php
}

function wpplugin_settings_subpage_markup()
{
  // Double check user capabilities
  if ( !current_user_can('manage_options') ) {
      return;
  }
  ?>
  <div class="wrap">
    <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>

    <?php
      $wpplugin_plugin_basename = plugin_basename( __FILE__ );
      $wpplugin_plugin_dir_path = plugin_dir_path( __FILE__ );
      $wpplugin_plugins_url_default = plugins_url();
      $wpplugin_plugins_url = plugins_url( 'includes', __FILE__ );
      $wpplugin_plugin_dir_url = plugin_dir_url( __FILE__ );
    ?>

    <ul>
      <li>plugin_basename( __FILE__ ) - <?php echo $wpplugin_plugin_basename; ?></li>
      <li>plugin_dir_path( __FILE__ ) - <?php echo $wpplugin_plugin_dir_path; ?></li>
      <li>plugins_url() - <?php echo $wpplugin_plugins_url_default; ?></li>
      <li>plugins_url( 'includes', __FILE__ ) - <?php echo $wpplugin_plugins_url; ?></li>
      <li>plugin_dir_url( __FILE__ ) - <?php echo $wpplugin_plugin_dir_url; ?></li>
      <li>included file test - <?php include( plugin_dir_path( __FILE__ ) . 'includes/include-test.php'); ?></li>
    </ul>

  </div>
  <?php
}


function wpplugin_default_sub_pages() {

  // Can add page as a submenu using the following:
  // add_dashboard_page()
  // add_posts_page()
  // add_media_page()
  // add_pages_page()
  // add_comments_page()
  // add_theme_page()
  // add_plugins_page()
  // add_users_page()
  // add_management_page()
  // add_options_page()

  add_options_page(
    __( 'Cool Default Sub Page', 'wpplugin' ),
    __( 'Custom Sub Page', 'wpplugin' ),
    'manage_options',
    'wpplugin-subpage',
    'wpplugin_settings_page_markup'
  );

}
add_action( 'admin_menu', 'wpplugin_default_sub_pages' );

//Add a link to your settings page in your plugin
function wpplugin_add_settings_link($links){
	$settings_link = '<a href="admin.php?page=wpplugin">' .__('Settings') . '</a>';
	array_push($links,$settings_link);
	return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter( $filter_name, 'wpplugin_add_settings_link');


?>