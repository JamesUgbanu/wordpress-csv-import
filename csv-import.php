<?php

/*
Plugin Name: CSV import
Plugin URI: https://crystalwebpro.com
Description: Plugin to demonstrate CSV import
Version: 0.1
Author: James Ugbanu
Author URI: https://crystalwebpro.com
*/

// Add menu
function plugin_menu() {

   add_menu_page("CSV import", "CSV import","manage_options", "csv-import", "displayList",plugins_url('/myplugin/img/icon.png'));

}
add_action("admin_menu", "plugin_menu");

function displayList(){
    include "displaylist.php";
}