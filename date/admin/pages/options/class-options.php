<?php 
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } 
/**
 * rcwdNggdateOptions
 *
 *  
 */
class rcwdNggdateAdminOptions{
	
	function init(){
	}

    function nggOptions(){
        return $this->__construct();        
    }

    function __construct(){
		global $rcwdNggDate;
		add_action('nggdate_after_title', array($this, 'message_after_title'));
		if (!empty($_POST)) $this->update();
		echo $rcwdNggDate->rcwdNggDateAdmin->get_output(dirname(__FILE__).'/template.php');
    }
			
	function update(){
		if(!empty($_POST)){
			if (isset($_POST['updateoption'])){	
				check_admin_referer('nggdate_settings');
				$this->nggdate_options['sortgalleries'] 			= isset($_POST['sortgalleries']) 			? trim($_POST['sortgalleries']) 			: 'N';
				$this->nggdate_options['galleries_default_order'] 	= isset($_POST['galleries_default_order']) 	? trim($_POST['galleries_default_order']) 	: 'YD';
				update_option('nggdate_options', $this->nggdate_options);
				header('location:'.admin_url('admin.php?page=nggdate&action=updated') ); exit;
				//$this->nggdate_options = get_option('nggdate_options');
			}
		}			
	}
	
	function message_after_title(){
		global $rcwdNggDate;
		if(isset($_GET['action'])){
			switch($_GET['action']){
				case 'updated':
					$message = __('Successfully updated', 'nggdate');
					$rcwdNggDate->rcwdNggDateAdmin->rshow_message($message);
					break;	
			}
		}
	}	 
	
}
?>