<?php
if (is_admin()){	

	// FUNC: save creation date __________________________________________________________________________________________________
	
		function rcwd_ngg_gallery_date_insert($gid){
			global $wpdb, $nggdb;
			$wpdb->query("UPDATE ".$wpdb->prefix."ngg_gallery SET added_date = now() WHERE gid = ".$gid);	
		}
		add_action('ngg_created_new_gallery', 'rcwd_ngg_gallery_date_insert');

	// FUNC: save modification date _______________________________________________________________________________________________
	
		function rcwd_ngg_gallery_date_update($gid, $post){
			global $wpdb, $nggdb;
			$wpdb->query("UPDATE ".$wpdb->prefix."ngg_gallery SET modified_date = now() WHERE gid = ".$gid);
		}
		add_action('ngg_update_gallery', 'rcwd_ngg_gallery_date_update', 10, 2);

	// FUNC: save modification date on image add __________________________________________________________________________________
	
		function rcwd_ngg_date_update_after_new_images_added($galleryID, $image_ids){
			global $wpdb;
			$wpdb->query("UPDATE ".$wpdb->prefix."ngg_gallery SET modified_date = now() WHERE gid = ".$galleryID);		
		}
		add_action('ngg_after_new_images_added', 'rcwd_ngg_date_update_after_new_images_added', 10, 2);
		
}else{	

	// FUNC: order by creation date _______________________________________________________________________________________________

		function rcwd_ngg_gallery_order($galleries, $album){
			global $rcwdNggDate;
			if(!empty($album->id)){
				$order_default		= $rcwdNggDate->nggdate_options['galleries_default_order'];
				$order				= $rcwdNggDate->nggdate_options['albums'][$album->id]['sort'];
				if($order == 'D') $order = $order_default;
				switch($order){			
					case 'YD':
						$sort = 'arsort';
						break;
					case 'YA':
						$sort = 'asort';
						break;
					default:
													
				}
				if($order == 'YD' or $order == 'YA'){
					$galleries			= rcwd_objectToArray($galleries);
					$galleries			= rcwd_multidimsort(array('array' => $galleries, 'index' => 'added_date', 'sort' => $sort ));
					foreach($galleries as $key => $value){
						$galleries[$key] = rcwd_arrayToObject($galleries[$key]);
					}
				}
			}
			return $galleries;
		}
		if($this->nggdate_options['sortgalleries'] == 'Y'){
			add_filter('ngg_album_galleries_before_paging', 'rcwd_ngg_gallery_order', 10, 2);	
		}
		
}

// FUNC: add date info to gallery object ______________________________________________________________________________________________

	function rcwd_add_date_to_gallery_object($gallery, $galleryID){
		global $wpdb;
		$gallery_info 					= $wpdb->get_row('SELECT * FROM '.$wpdb->nggallery.' WHERE gid = '.$galleryID);
		$picturesCounter 				= $wpdb->get_row('SELECT COUNT(*) as counter FROM '.$wpdb->nggpictures.' WHERE galleryid = '.$galleryID);
		$gallery->sql_added_date		= $gallery_info->added_date;
		$gallery->added_date 			= date_i18n( get_option('date_format'), strtotime($gallery_info->added_date) );
		$gallery->added_time			= date_i18n( get_option('time_format'), strtotime($gallery_info->added_date) );
		$gallery->since_added_date		= rcwd_nggdate_since($gallery->sql_added_date);
		$gallery->sql_modified_date		= $gallery_info->modified_date;
		$gallery->modified_date			= $gallery_info->modified_date;
		$gallery->modified_time			= $gallery_info->modified_date;
		$gallery->since_modified_date	= $gallery_info->modified_date;
		if(!is_null($gallery_info->modified_date) and $gallery_info->modified_date != ''){
			$gallery->modified_date 		= date_i18n( get_option('time_format'), strtotime($gallery_info->modified_date) );
			$gallery->modified_time			= date_i18n( get_option('time_format'), strtotime($gallery_info->modified_date) );	
			$gallery->since_modified_date	= rcwd_nggdate_since($gallery->modified_date);
		}
		$gallery->author 				= $gallery_info->author;
		$gallery->counter 				= $picturesCounter->counter;
		return $gallery;
	}
	add_filter('ngg_gallery_object', 'rcwd_add_date_to_gallery_object', 10, 2);
?>