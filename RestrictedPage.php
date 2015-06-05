<?php
/*
Plugin Name: Restricted  Page
Plugin URI: 
Description: Hides page content from not logged-in users
Version: 1.0.1
Author: Leonid N. Malyshev
Author URI: http://mln.sk
*/
class WPRegisteredPagePlugin{

	public function __construct() {
		add_shortcode('RP_registered_only', array(&$this,'RP_registered_only'));
		add_filter( 'the_content', array(&$this,'mytheme_content_filter') );
		// Hook for adding admin menus
		if ( is_admin() ){ // admin actions
			add_action('admin_menu', array(&$this,'RP_add_pages'));
			add_action( 'admin_init', array(&$this,'register_mysettings' ));
		} else {
		  // non-admin enqueues, actions, and filters
		}
	}
	
	function register_mysettings() { // whitelist options
	  register_setting( 'RP-settings-group', 'RP_text_before' );
	  register_setting( 'RP-settings-group', 'RP_text_after' );
	  register_setting( 'RP-settings-group', 'RP_text_beforeS' );
	  register_setting( 'RP-settings-group', 'RP_text_afterS' );
	  register_setting( 'RP-settings-group', 'RP_signin_Text' );
	  register_setting( 'RP-settings-group', 'RP_signin' );
	  register_setting( 'RP-settings-group', 'RP_disconnect_Text' );
	  register_setting( 'RP-settings-group', 'RP_disconnect' );
	}

	// action function for above hook
	function RP_add_pages() {
		// Add a new submenu under Options:
		add_options_page('RP Options', 'Restricted  Page Options', 8, 'RPoptions', array(&$this,'RP_options_page'));
	}

	// BS_options_page() displays the page content for the Options submenu
	function RP_options_page() {
		include_once (__DIR__.'/RP_admin.php');
	}

	public function RP_registered_only($atts, $content = null) {
		wp_register_style( 'RP-style', plugins_url( '/CSS/style_RP.css', __FILE__ ), array(), '20150329', 'all' );
		wp_enqueue_style( 'RP-style' );
		if (isset($_POST['logout']))
			{
			   wp_logout();
			   return ("<script>window.location=window.location ;</script>");
			} 
		if( !is_user_logged_in() ) {
			$s= '<div id="RP_registered">';
			$s=$s. "<p>".wp_kses_post(get_option('RP_text_before'))."</p>";
			$s=$s.wp_login_form(array('echo' => false));
			$s=$s. "<p>".wp_kses_post(get_option('RP_text_after'))."</p>";
			if (wp_kses_post(get_option('RP_signin'))=="on"){
				$s=$s. "<p>".wp_kses_post(get_option('RP_text_beforeS'))."</p>";				
				$s=$s. '<form action="'.wp_registration_url().'"> <input type="submit" value="'.wp_kses_post(get_option('RP_signin_Text')).'"> </form>';
				$s=$s. "<p>".wp_kses_post(get_option('RP_text_afterS'))."</p>";
			}
			$s=$s. '</div>';
			return $s;
		} else {
			$s="";
			$s=$s. clearDoubles($content,"RP_registered_only");//$content;
			if (wp_kses_post(get_option('RP_disconnect'))=="on"){
			//$s=$s.'<form action="'.wp_logout_url().'"> <input type="submit" name = "logout" value="'.wp_kses_post(get_option('RP_disconnect_Text')).'"> </form>';
			$s=$s.'<form action="" method="post"> <input type="submit" name = "logout" value="'.wp_kses_post(get_option('RP_disconnect_Text')).'"> </form>';
			}
			return  $s;
		}
	}
	
	public function mytheme_content_filter( $content ) {
		if ( !is_user_logged_in() && has_shortcode( $content, 'RP_registered_only' ) ) {
			return (clearDoubles($content,"RP_registered_only"));
		} else return ($content);
	}
	

	
}
	function clearDoubles($content,$sc_name){
		//Delete everything before shortcode
		$i=strpos($content,"[".$sc_name);
		if ($i!=false &&$i>=0){
			$content=substr($content,$i);
		}
		//Delete 2nd... instances of short-code
		if ($content != "") $j=strpos($content,"[".$sc_name,1); else $j=-1;
		if ($j!=false && $j>=0) $content=substr ($content,0,$j);
		//Delete after shortcode end ([\
		$s="[/".$sc_name."]";
		$i=strpos($content,$s);
		if ($i!=false &&$i>=0){
			$content=substr($content,0,$i+strlen($s));
		}
		return ($content);
	}
 $x=new WPRegisteredPagePlugin();
?>