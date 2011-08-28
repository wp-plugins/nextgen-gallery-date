=== NextGEN Gallery Date===
Contributors: Roberto Cantarano
Tags: photos,flash,slideshow,images,gallery,media,admin,post,photo-albums,pictures,widgets,photo,picture,image,nextgen-gallery,nextgen gallery,date,nextgen-gallery-date,nextgen gallery date
Requires at least: 3.1
Tested up to: 3.2
Stable tag: 0.1.2

This plugin will let you sort the galleries by date and get info about gallery creation (and modification) date. 

== Description ==

**Please use at least version 1.8.3 of NextGEN Gallery. This plugin is not tested with lower versions**

NextGEN Gallery Date is an add-on for the best wordpress gallery plugin i have seen! With my plugin, you can sort galleries by date, show gallery creation and modificatio date inside gallery templates.
It adds two new columns for gallery table:
 
- added_date (on gallery creation)

- modified_date (on gallery modification and upload of pics) 

= Features =

* Gallery order by date: Check the Ngg Date admin panel to activate the order options in every manage album page.
* Date info: show 3 kinds of date format (read installation info)

== Credits ==

Copyright 2011 by Roberto Cantarano

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Installation ==

**[ A T T E N T I O N ] NextGEN Gallery core modification required!**

To use this plugin, you need to make a simple change to a NextGEN Gallery file(tested with version 1.8.3).
This will be necessary until the change will not be integrated (I have already sent the request to Alex Rabe).
To make the change, follow the instructions:

1. Open the following file: /wp-content/plugins/nextgen-gallery/nggfunctions.php;

2. The changes affect the function nggCreateAlbum, go to row 580, just before the
    -----------------------
    // check for page navigation
    if ($maxElement > 0) {
    ------------------------

3.  Enter the following filter:
    -----------------------
    $galleries = apply_filters('ngg_album_galleries_before_paging', $galleries, $album)
    ------------------------;

4.  To check if you have done correctly, check the screenshot (plugins/nextgen-gallery-date/date/admin/images/ngg-new-filter.png);

Now, install the plugin:

1. 	Install & Activate the plugin (you need NextGEN Gallery plugin to be active!)

2.	Check if there is a nggallery folder (and the gallery.php inside) in your theme folder. If not, create that folder, then open the "nextgen-gallery" folder in wordpress plugin folder, open "view" folder, copy gallery.php and paste it in the nggallery folder you created before.

3.      in gallery.php you have access to the main variable $gallery. This variable contains 3 type of date (well, 3 for added date and 3 for modified date):
          * $gallery->sql_added_date (the original date format saved in db table);
          * $gallery->added_date (formatted date, according to wordpress date settings);
          * $gallery->since_added_date ("Humanized" date, in ex. "three days ago");   

That's it ... Have fun

== Screenshots ==

== Frequently Asked Questions ==

== Changelog ==

= V0.1 - 24.08.2011 =
* Initial release