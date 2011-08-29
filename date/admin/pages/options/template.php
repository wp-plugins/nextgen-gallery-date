<?php 
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } 
/**
 * template for options page
 *
 *  
 */
?>
<div class="wrap">
<?php screen_icon( 'nggdate' ); ?>
	<h2><?php _e( 'NextGEN Gallery Date Options', 'nggdate' ); ?></h2>
<?php do_action('nggdate_after_title', $this->nggdate_options); ?>
	<form name="att_img_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'&noheader=true'; ?>">
<?php 	wp_nonce_field('nggdate_settings') ?>
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row">
                    <label for="sortgalleries"><?php echo _e('Enable the option to sort the galleries by date added','nggdate') ?></label>
                </th>
                <td>
                <select id="sortgalleries" name="sortgalleries">
                    <option value="Y" <?php selected('Y', $this->nggdate_options['sortgalleries']); ?>><?php _e('Yes','nggdate') ?></option>
                    <option value="N" <?php selected('N', $this->nggdate_options['sortgalleries']); ?>><?php _e('No','nggdate') ?></option>
                </select>
                <span class="description"><?php echo _e('If you choose YES, you will find the option to set the order when you edit an album.','nggdate') ?></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="sortgalleries"><?php echo _e('Set the default value for the "sort galleries" option','nggdate') ?></label>
                </th>
                <td>
                <select id="galleries_default_order" name="galleries_default_order">
                    <option value="YD" <?php selected('YD', $this->nggdate_options['galleries_default_order']); ?>><?php _e('Yes, sort by newest to oldest','nggdate') ?></option>
                    <option value="YA" <?php selected('YA', $this->nggdate_options['galleries_default_order']); ?>><?php _e('Yes, sort by oldest to newest','nggdate') ?></option>
                </select>
                <span class="description"><?php echo _e('If the above option is set to YES, this will define the default value for the order option you will find when you edit an album.','nggdate') ?></span>
                </td>
            </tr>            
            </tbody>
        </table>
		<div class="submit"><input class="button-primary" type="submit" name="updateoption" value="<?php _e('Save Changes'); ?>"/></div>        
    </form>
    <div id="poststuff">
        <div class="postbox">
            <h3 class="hndle"><span><?php _e(' <span style="color:#ff0000">[ A T T E N T I O N ] NextGEN Gallery core modification required!</span>', 'nggdate'); ?></span></h3>
            <div class="inside">
                <?php _e('<p>To use this plugin, you need to make a simple change to a NextGEN Gallery file(tested with version 1.8.3).<br />This will be necessary until the change will not be integrated (I have already sent the request to Alex Rabe).</p>To make the change, follow the instructions:<br /><br /><ol><li>Open the following file: <code>/wp-content/plugins/nextgen-gallery/<strong>nggfunctions.php</strong></code>;</li><li>The changes affect the function <strong>nggCreateAlbum</strong>, go to row <strong>580</strong>, just before the<br /><code>-----------------------<br />// check for page navigation<br />if ($maxElement > 0) {<br />------------------------</code></li><li>Enter the following filter:<br /><code>-----------------------<br /><strong>$galleries = apply_filters(\'ngg_album_galleries_before_paging\', $galleries, $album);</strong><br />------------------------</code>;</li><li>To check if you have done correctly, <a href="/wp-content/plugins/nextgen-gallery-date/date/admin/images/ngg-new-filter.png" target="_blank"><strong>check this screenshot</strong></a>;</li><li>That\'s it :), <a href="admin.php?page=nggdate&action=remove-notice"><strong>Click here to remove the notice at the top</strong></a> if it is still visible.</li></ol></p>', 'nggdate'); 
				?>
            </div>
        </div>    
        <div class="postbox">
            <h3 class="hndle"><span><?php _e('About NextGEN Gallery Date', 'nggdate'); ?></span></h3>
            <div class="inside">
                <?php _e('<p>This plugin, born as an add-on for the n.1 Wordpress Gallery Plugin <a href="http://wordpress.org/extend/plugins/nextgen-gallery/" target="_blank">NextGEN Gallery</a> (by <a href="http://alexrabe.de" target="_blank">Alex Rabe</a>), is developed by me (<a href="http://www.cantarano.com" target="_blank">check my website</a>), but it is only with your help that i can improve it, fix bugs, add some enhancements, etc...</p><p><strong>If you need to report bugs / errors / suggestions or any plugin related questions</strong>, you can leave me a message <a href="http://wordpress.org/tags/nextgen-gallery-date?forum_id=10" target="_blank">in the plugin forum</a>.</p><p style="font-size:20px;margin-top:20px">Enjoy the web ;)</p>', 'nggdate'); ?>
            </div>
        </div>
    </div>    
</div>