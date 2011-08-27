<?php 
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('Non puoi accedere direttamente a questa pagina...'); }
/**
 * function to be executed with hooks inside nggallery-manage-album page of NextGEN Gallery
 *
 *  
 */
function rcwd_ngg_edit_album_settings($currentID){
	global $rcwdNggDate;
	$nggda = $rcwdNggDate;
	if($nggda->nggdate_options['sortgalleries'] == 'Y'){
?>
		<tr>
			<th>
<?php 				_e('sets the order of the galleries by date:','nggdate') ?><br />
				<select id="nggdate_sortgallery" name="nggdate_sortgallery">
					<option value="D" <?php selected('D', $nggda->nggdate_options['albums'][$currentID]['sort']); ?>><?php _e('Yes, sort by default settings','nggdate') ?></option>
					<option value="YD" <?php selected('YD', $nggda->nggdate_options['albums'][$currentID]['sort']); ?>><?php _e('Yes, sort by newest to oldest','nggdate') ?></option>
					<option value="YA" <?php selected('YA', $nggda->nggdate_options['albums'][$currentID]['sort']); ?>><?php _e('Yes, sort by oldest to newest','nggdate') ?></option>
					<option value="N" <?php selected('N', $nggda->nggdate_options['albums'][$currentID]['sort']); ?>><?php _e('No','nggdate') ?></option>
				</select>
			</th>
		</tr>
<?php
	}
}
add_action('ngg_edit_album_settings', 'rcwd_ngg_edit_album_settings' );

function rcwd_ngg_update_album($currentID, $_POST){
	global $rcwdNggDate;
	$nggda = $rcwdNggDate;
	$nggdate_options 								= $nggda->nggdate_options;
	$nggdate_options['albums'][$currentID]['sort'] 	= isset($_POST['nggdate_sortgallery']) ? trim($_POST['nggdate_sortgallery']) : false;
	update_option('nggdate_options', $nggdate_options);
	$nggda->nggdate_options = get_option('nggdate_options');
}
add_action('ngg_update_album', 'rcwd_ngg_update_album', 10, 2 );

/*	function rcwd_ngg_display_album_item_content($empty, $obj_id){
	return' <p><strong>xyz : </strong>lorem</p>';
}
add_filter('ngg_display_album_item_content', array(&$this, 'rcwd_ngg_display_album_item_content'), 10, 2 );*/
?>