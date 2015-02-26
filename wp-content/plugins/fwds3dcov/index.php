<?php
/*
Plugin Name: FWD Simple 3D Coverflow
Plugin URI: http://codecanyon.net/user/FWDesign/portfolio
Description: This is the Wordpress plugin with a CMS menu for the installation and configuration of the FWD Simple 3D Coverflow.
Author: FWD
Version: 3.2
Author URI: http://webdesign-flash.ro/
*/

require "update-checker/plugin-update-checker.php";
$fwds3dcovPUC = PucFactory::buildUpdateChecker(
	"http://webdesign-flash.ro/w/s3dcov/update/info.json",
	__FILE__,
	"fwds3dcov"
);

include_once "php/FWDS3DCov.php";
include_once "php/FWDS3DCovData.php";

function fwds3dcov_check_if_admin()
{
	$roles = wp_get_current_user()->roles;
	$role = "administrator";
	 
	return in_array($role, $roles);
}

function fwds3dcov_admin_init()
{
	if (fwds3dcov_check_if_admin())
	{
		$role = get_role("administrator");
		$role->add_cap(FWDS3DCov::CAPABILITY);
	}
}

function fwds3dcov_init_plugin()
{	
	$cov = new FWDS3DCov();
}

add_action("init", "fwds3dcov_init_plugin");
add_action("admin_init", "fwds3dcov_admin_init");
add_filter("plugin_action_links_" . plugin_basename(__FILE__), array("FWDS3DCov", "set_action_links"));

?>