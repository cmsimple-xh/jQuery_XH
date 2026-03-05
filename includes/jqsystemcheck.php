<?php

/**
 * jQuery for CMSimple
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

if(basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
{
    die('No direct access.');
}

/**
 * Checks system requirements
 *
 * @return html.
 */
function jquery_Systemcheck($jqCmsVersion_arr, $jqPhpVersion) {

    global $pth, $plugin_cf, $plugin_tx;

    $pcf = $plugin_cf['jquery'];
    $ptx = $plugin_tx['jquery'];

    $o = '<h2>System Check</h2>' . "\n";
// jQuery Core version
    $jqVersionCoreArray = scandir($pth['folder']['plugin'] . 'lib/jquery/');
    $jqVersionCoreArray = array_diff($jqVersionCoreArray, array('.', '..'));
    asort($jqVersionCoreArray);
    if (version_compare($pcf['version_core'], end($jqVersionCoreArray), '<')) {
        $o .= '<p class="xh_warning">jQuery Core: '
           . $pcf['version_core']
           . ' &#x2192 '
           . $ptx['version_not_latest']
           . '</p>'
           . "\n";
    } else {
        $o .= '<p class="xh_success">jQuery Core: '
           . $pcf['version_core']
           . ' &#x2192 '
           . $ptx['version_latest']
           . '</p>'
           . "\n";
    }
// jQuery UI version
    $jqVersionUiArray = scandir($pth['folder']['plugin'] . 'lib/jquery_ui/');
    $jqVersionUiArray = array_diff($jqVersionUiArray, array('.', '..'));
    asort($jqVersionUiArray);
    if (version_compare($pcf['version_ui'], end($jqVersionUiArray), '<')) {
        $o .= '<p class="xh_warning">jQuery UI: '
           . $pcf['version_ui']
           . ' &#x2192 '
           . $ptx['version_not_latest']
           . '</p>'
           . "\n";
    } else {
        $o .= '<p class="xh_success">jQuery UI: '
           . $pcf['version_ui']
           . ' &#x2192 '
           . $ptx['version_latest']
           . '</p>'
           . "\n";
    }
// jQuery migrate
    if ($pcf['load_migrate'] != '') {
        $o .= '<p class="xh_warning">jQuery Migrate: '
           . ' &#x2192 '
           . $ptx['migrate_activated']
           . '</p>'
           . "\n";
    }
// CMSimple_XH version
    $cmsVersionTmp = CMSIMPLE_XH_VERSION;
    $cmsVersionTmp = str_replace(array('CMSimple_XH '), '', $cmsVersionTmp);
    if (version_compare($cmsVersionTmp, $jqCmsVersion_arr[0], '<')) {
        $o .= '<p class="xh_warning">'
            . CMSIMPLE_XH_VERSION
            . ' &#x2192 '
            . $ptx['supported_not']
            . ' '
            . $jqCmsVersion_arr[0]
            . ' - '
            . end($jqCmsVersion_arr)
            . '.</p>'
            . "\n";
    } else {
        $o .= '<p class="xh_success">'
            . CMSIMPLE_XH_VERSION
            . ' &#x2192 '
            . $ptx['supported_yes']
            . '</p>'
            . "\n";
    }
// PHP version
    if(version_compare(phpversion(), $jqPhpVersion, '<')) {
        $o .= '<p class="xh_fail">PHP: '
           . phpversion()
           . ' &#x2192 '
           . $ptx['supported_not']
           . '</p>'
           . "\n";
    } else {
        $o .= '<p class="xh_success">PHP: '
           . phpversion()
           . ' &#x2192 '
           . $ptx['supported_yes']
           . '</p>'
           . "\n";
    }
// write permissions
    $op_filename_arr = array($pth['file']['plugin_config'],
                             $pth['folder']['plugin_languages'],
                             $pth['file']['plugin_language']);
    foreach($op_filename_arr as $op_filename) {
        if(is_writable($op_filename)) {
            $o .= '<p class="xh_success">'
               . $op_filename
               . ' &#x2192 '
               . $ptx['writable_yes']
               . '</p>'
               . "\n";
        } else {
            $o .= '<p class="xh_fail">'
               . $op_filename
               . ' &#x2192 '
               . $ptx['writable_not']
               . '</p>'
               . "\n";
        }
    }

    return $o;
}
