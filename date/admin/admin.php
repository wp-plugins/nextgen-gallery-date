<?php
/**
 * rcwdNggDateAdmin - Admin Section for NextGEN Gallery Date
 * 
 * @package NextGEN Gallery Date
 * @author Roberto Cantarano
 * @copyright 2011
 * @since 0.1
 */
class rcwdNggDateAdmin{
	function rcwdNggDateAdmin(){
		global $rcwdNggDate, $pagenow;
		$this->nggdate_options = $rcwdNggDate->nggdate_options;
		add_action("admin_menu", array(&$this, "admin_menu"));
		add_action('admin_print_styles', array(&$this, 'load_styles') ); 
		if(@$_GET['page'] == 'nggallery-manage-album'){
			require_once(dirname(__FILE__).'/manage-album-support.php');
		}
	}

	function admin_menu(){
		add_menu_page("NextGEN Gallery Date", "NGG Date", 'NextGEN Date change options', 'nggdate', array($this, "plugin_options"), 'div');
		//add_submenu_page('nggallerydate-options', "NextGEN Gallery Date Setup", "Setup", 'NextGEN Date change options', RCWDNGGDATE_DIRNAME, array($this, "nggdate_plugin_options"));
	}	

	function load_styles(){
		wp_enqueue_style( 'nggdatemenu', RCWDNGGDATE_URLPATH.'date/admin/css/style.css', array() );
	}
	
	function plugin_options(){
		switch ($_GET['page']){
			case 'nggdate':	
				require_once(dirname(__FILE__).'/pages/options/class-options.php');
				$this->class_nggdate_options = new rcwdNggdateAdminOptions();
		}
	}	

	function get_output($template){
		ob_start();
		include_once($template);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
		
	function rshow_message($message){
		echo '<div class="wrap"><div class="updated" id="message"><p>'.$message.'</p></div></div>'."\n";
	}

}
?>