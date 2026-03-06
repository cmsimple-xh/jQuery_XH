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
 * read directory
 *
 * @return array
 */
function jqScanDir($path) {

    $scanArray = scandir($path);
    $scanArray = array_diff($scanArray, array('.', '..'));
    asort($scanArray);

    return $scanArray;
}

/**
 * Checks system requirements
 *
 * @return html.
 */
function jquery_Systemcheck($jqCmsVersionArray, $jqPhpVersion) {

    global $pth, $plugin_cf, $plugin_tx;

    $pcf = $plugin_cf['jquery'];
    $ptx = $plugin_tx['jquery'];

    $o = '<h2>System Check</h2>' . "\n";
// jQuery Core version
    $jqVersionCoreArray = jqScanDir($pth['folder']['plugin'] . 'lib/jquery/');
// jQuery UI version
    $jqVersionUiArray = jqScanDir($pth['folder']['plugin'] . 'lib/jquery_ui/');
// check jQuery
    $jqCheckArray = array(array($jqVersionCoreArray, $pcf['version_core']),
                          array($jqVersionUiArray, $pcf['version_ui']));
    foreach($jqCheckArray as $jqCheck) {
        if (version_compare($jqCheck[1], end($jqCheck[0]), '<')) {
            $o .= '<p class="xh_warning">jQuery Core: '
               . $jqCheck[1]
               . ' &#x2192 '
               . $ptx['version_not_latest']
               . '</p>'
               . "\n";
        } else {
            $o .= '<p class="xh_success">jQuery Core: '
               . $jqCheck[1]
               . ' &#x2192 '
               . $ptx['version_latest']
               . '</p>'
               . "\n";
        }
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
    if (version_compare($cmsVersionTmp, $jqCmsVersionArray[0], '<')) {
        $o .= '<p class="xh_warning">'
            . CMSIMPLE_XH_VERSION
            . ' &#x2192 '
            . $ptx['supported_not']
            . ' '
            . $jqCmsVersionArray[0]
            . ' - '
            . end($jqCmsVersionArray)
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
    $jqFilenameArray = array($pth['file']['plugin_config'],
                             $pth['folder']['plugin_languages'],
                             $pth['file']['plugin_language']);
    foreach($jqFilenameArray as $jqFilename) {
        if(is_writable($jqFilename)) {
            $o .= '<p class="xh_success">'
               . $jqFilename
               . ' &#x2192 '
               . $ptx['writable_yes']
               . '</p>'
               . "\n";
        } else {
            $o .= '<p class="xh_fail">'
               . $jqFilename
               . ' &#x2192 '
               . $ptx['writable_not']
               . '</p>'
               . "\n";
        }
    }
// checks access protection
        if (XH_isAccessProtected($pth['file']['plugin_config']) === true) {
            $o .= '<p class="xh_success"><a target="_blank" href="'
                . $pth['file']['plugin_config']
                . '">'
                . $pth['file']['plugin_config']
                . '</a> &#x2192 '
                . $ptx['protected_yes']
                . '</p>'
                . "\n";
        } else {
            $o .= '<p class="xh_warning"><a target="_blank" href="'
                . $pth['file']['plugin_config']
                . '">'
                . $pth['file']['plugin_config']
                . '</a> &#x2192 '
                . $ptx['protected_not']
                . '</p>'
                . "\n";
        }

    return $o;
}
