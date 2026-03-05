<?php

/**
 * jQuery for CMSimple
 *
 * Admin-interface for configuring the plugin
 * via the standard-functions of pluginloader.
 *
 * Version:    1.6.9
 * Build:      20260030501
 * Copyright:  Holger Irmler
 * Email:      CMSimple@HolgerIrmler.de
 * Website:    http://CMSimple.HolgerIrmler.de
 * Copyright:  CMSimple_XH developers
 * Website:    https://www.cmsimple-xh.org/?About-CMSimple_XH/The-XH-Team
 *
 */

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

require($pth['folder']['plugins'] . 'jquery/includes/jqsystemcheck.php');

/*
 * Register the plugin menu items.
 */
if (function_exists('XH_registerStandardPluginMenuItems')) {
    XH_registerStandardPluginMenuItems(false);
}

if(XH_wantsPluginAdministration('jquery')) {

    //Helper-functions
    function jquery_getCoreVersions() {
        global $pth;
        $versions = array();
        $handle = opendir($pth['folder']['plugins'] . 'jquery/lib/jquery/');
        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..') {
                $versions[] = $entry;
            }
        }
        closedir($handle);
        sort($versions);
        return $versions;
    }

    function jquery_getUiVersions() {
        global $pth;
        $versions = array();
        $handle = opendir($pth['folder']['plugins'] . 'jquery/lib/jquery_ui/');
        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..') {
                $versions[] = $entry;
            }
        }
        closedir($handle);
        sort($versions);
        return $versions;
    }

    function jquery_getMigrateVersions() {
        global $pth;
        $temp = glob($pth['folder']['plugins'] . 'jquery/lib/migrate/*.js');
        $versions = array();
        foreach ($temp as $version) {
            $versions[] = basename($version);
        }
        return $versions;
    }

    include_once($pth['folder']['plugins'] . 'jquery/jquery.inc.php');
    include_jQuery();
    include_jQueryUI();

    $o .= print_plugin_admin('on');
    if(($admin != 'plugin_main') && ($admin != '')) {
        $o .= plugin_admin_common($action, $admin, $plugin);
    }

    $jqPluginName = 'jQuery for CMSimple';
    $jqPluginVersion = '1.6.9';
    $jqPluginDate = '2026-03-05';
    $jqCopyright = '2024';
    $jqCmsVersionArray = array('1.7.0', 'and higher');
    $jqPhpVersion = '7.4';

    if($admin == '' || $admin == 'plugin_main') {
        $o .= "\n" . '<div>';
        $o .= "\n" . "<h1>$jqPluginName</h1>";
        $o .= "\n" . "<p>$jqPluginVersion - $jqPluginDate</p>";
        $o .= "\n" . '<p>&copy;2011-2023 <a href="http://cmsimple.holgerirmler.de/" target="_blank">http://CMSimple.HolgerIrmler.de</a></p>';
        $o .= "\n" . "<p>&copy;$jqCopyright <a href=\"https://www.cmsimple-xh.org/?About-CMSimple_XH/The-XH-Team\" target=\"_blank\">The CMSimple_XH developers</a></p>";
        $o .= jquery_Systemcheck($jqCmsVersionArray, $jqPhpVersion);
        $o .= "\n" . '</div>';
    }
}