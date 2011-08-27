<?php

// Avoid misusage
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

delete_option('nggdate_options');
?>