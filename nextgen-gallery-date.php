<?php
/*
Plugin Name: NextGEN Gallery Date
Plugin URI: 
Description: This plugin add 'added date' and 'modified date' to ngg_album and ngg_gallery db tables
Version: 0.1.5
Author: Roberto Cantarano
Author URI: http://www.cantarano.com
*/
/*
Copyright 2011 Roberto Cantarano  (email : roberto@cantarano.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('Non puoi accedere direttamente a questa pagina...'); }

/* ini_set('display_errors', '1');
 ini_set('error_reporting', E_ALL);*/

$rcwd_ngg_base_page = 'admin.php?page=nggallery-manage-gallery';

if (!class_exists('rcwdNggDate')){
	class rcwdNggDate{
		
		function init(){
			$this->vars_and_constants();	
			if (in_array($this->depends, $this->active_plugins)){
				$this->load_options();				
				$this->functions();				
				$this->classes();				
				register_activation_hook( $this->plugin_name, array(&$this, 'activate') );
				register_deactivation_hook( $this->plugin_name, array(&$this, 'deactivate') );
				//register_uninstall_hook( $this->plugin_name, array(&$this, 'uninstall') );
				add_action( 'plugins_loaded', array(&$this, 'start_plugin') );		
				include_once(dirname(__FILE__).'/date/date.php');
				if(is_admin()){
					if(isset($_GET['action']) and $_GET['action'] == 'remove-notice'){
						$this->nggdate_options['remove-notice'] = true;
						update_option('nggdate_options', $this->nggdate_options);
					}
					if($this->nggdate_options['remove-notice'] !== true){
						add_action( 'admin_notices', array(&$this, 'notice') );
					}
					require_once(dirname(__FILE__).'/date/admin/admin.php');
					$this->rcwdNggDateAdmin = new rcwdNggDateAdmin();
				}
			}				
		}

		function vars_and_constants(){
			global $wpdb;
			define('RCWDNGGDATE_VERSION', '0.1.5');
			define('RCWDNGGDATE_DIRNAME', plugin_basename( dirname(__FILE__)));
			define('RCWDNGGDATE_URLPATH', trailingslashit(plugins_url('',__FILE__)));
			define('RCWDNGGDATE_ALBUM_TAB', $wpdb->prefix.'ngg_album');
			define('RCWDNGGDATE_GALLERY_TAB', $wpdb->prefix.'ngg_gallery');
			$this->plugin_name 		= plugin_basename(__FILE__);
			$this->depends	   		= 'nextgen-gallery/nggallery.php';
			$this->active_plugins   = get_option('active_plugins', FALSE);
		}
	
		function functions(){
			require_once(dirname(__FILE__).'/functions/functions.php');
		}
	
		function classes(){
			require_once( dirname(__FILE__).'/classes/humanrelativedate/humanRelativeDate.class.php' );	
		}	
	
		function activate(){
			global $wpdb;
			if (version_compare(PHP_VERSION, '5.2.0', '<')) { 
				deactivate_plugins(plugin_basename(__FILE__));
				wp_die("Il plugin richiede una versione di PHP pari o maggiore di 5.2.0"); 
				return; 
			} 
			if (!in_array($this->depends, $this->active_plugins)){
				deactivate_plugins(plugin_basename(__FILE__));
				wp_die("Questo plugin necessita l'attivazione di NEXTGEN... che non risulta essere presente.");
				return; 
			}
	
			if(!current_user_can('activate_plugins')) return;	
			update_option( 'rcwdnggdate_version', RCWDNGGDATE_VERSION );
			
			if($wpdb->get_var( "SHOW TABLES LIKE '".RCWDNGGDATE_ALBUM_TAB."'")){
				$result = $wpdb->get_row("DESC ".RCWDNGGDATE_ALBUM_TAB." added_date", ARRAY_A);
				if(empty($result)){
					$wpdb->query("ALTER TABLE ".RCWDNGGDATE_ALBUM_TAB." ADD added_date datetime default NULL");
					$albums = $wpdb->get_results( "SELECT * FROM ".RCWDNGGDATE_ALBUM_TAB);	
					if($albums !== false){
						foreach($albums as $key => $value){
						  $wpdb->query( "UPDATE ".RCWDNGGDATE_ALBUM_TAB." SET added_date = now() WHERE id = $value->id" );
						}
					}
				}else{
					$albums = $wpdb->get_results( "SELECT * FROM ".RCWDNGGDATE_ALBUM_TAB." WHERE added_date is null" );
					if($albums !== false){
						foreach($albums as $key => $value){
						  $wpdb->query( "UPDATE ".RCWDNGGDATE_ALBUM_TAB." SET added_date = now() WHERE id = $value->id" );
						}
					}				
				}				
				$result = $wpdb->get_row("DESC ".RCWDNGGDATE_ALBUM_TAB." modified_date", ARRAY_A);
				if(empty($result)){
					$wpdb->query("ALTER TABLE ".RCWDNGGDATE_ALBUM_TAB." ADD modified_date datetime default NULL");	
				}
			}
			
			if($wpdb->get_var( "SHOW TABLES LIKE '".RCWDNGGDATE_GALLERY_TAB."'")){
				$result = $wpdb->get_row("DESC ".RCWDNGGDATE_GALLERY_TAB." added_date", ARRAY_A);
				if(empty($result)){
					$wpdb->query("ALTER TABLE ".RCWDNGGDATE_GALLERY_TAB." ADD added_date datetime default NULL");
					$galleries = $wpdb->get_results( "SELECT * FROM ".RCWDNGGDATE_GALLERY_TAB);	
					if($galleries !== false){
						foreach($galleries as $key => $value){
						  $wpdb->query( "UPDATE ".RCWDNGGDATE_GALLERY_TAB." SET added_date = now() WHERE gid = $value->gid" );
						}
					}						
				}else{
					$galleries = $wpdb->get_results( "SELECT * FROM ".RCWDNGGDATE_GALLERY_TAB." WHERE added_date is null" );	
					if($galleries !== false){
						foreach($galleries as $key => $value){
						  $wpdb->query( "UPDATE ".RCWDNGGDATE_GALLERY_TAB." SET added_date = now() WHERE id = $value->id" );
						}
					}				
				}
				$result = $wpdb->get_row("DESC ".RCWDNGGDATE_GALLERY_TAB." modified_date", ARRAY_A);
				if(empty($result)){
					$wpdb->query("ALTER TABLE ".RCWDNGGDATE_GALLERY_TAB." ADD modified_date datetime default NULL");	
				}				
			}	
			
			// set default values if option not exists  ___________________________________________________________________
			
				$values = get_option('nggdate_options');
				if($values === false){
					$values = array( 	'sortgalleries' 			=> 'N', 
										'galleries_default_order' 	=> 'YD'
									);
					update_option('nggdate_options', $values);	
				}
						
		}
		
		function start_plugin(){
			load_plugin_textdomain('nggdate', false, dirname(plugin_basename(__FILE__)).'/lang');
			nggGallery::add_capabilites('NextGEN Date change options');
			$this->version_check();
		}			

		function update(){
			update_option( 'rcwdnggdate_version', RCWDNGGDATE_VERSION );
		}
		
		function version_check(){
			$old_rcwdnggdate_version = get_option('rcwdnggdate_version');
			if( empty($old_rcwdnggdate_version) or (version_compare(RCWDNGGDATE_VERSION, $old_rcwdnggdate_version, '>') )){
				$this->update();
			}
		}
		
		function notice(){
			echo '<div id="message" class="error">'.__('<p><strong>NextGEN Gallery Date: * * A T T E N T I O N * *</strong><br />This first release require a (little and simple) NextGen GALLERY core modification in order to work.</p><p><a href="admin.php?page=nggdate#nggcoremod">Click here to read instructions</a> and <a href="admin.php?page=nggdate&action=remove-notice">click here to remove this alert.</a></p>', 'nggdate').'</div>';
		}
		
		function load_options(){
			$this->nggdate_options = get_option('nggdate_options');
		}
		
		function deactivate(){
			global $wp_roles;
			foreach($wp_roles->role_names as $role => $name){
				$wp_roles->remove_cap( $role, 'NextGEN Date change options' );
			}				
		}	
		
/*		function uninstall(){
			 
		}*/
		
	}
}
$rcwdNggDate = new rcwdNggDate();
$rcwdNggDate->init();
?>