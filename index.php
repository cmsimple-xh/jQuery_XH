<?php

/**
 * jQuery for CMSimple
 *
 * Version:    1.6.9
 * Build:      2026012801
 * Copyright:  Holger Irmler
 * Email:      CMSimple@HolgerIrmler.de
 * Website:    http://CMSimple.HolgerIrmler.de
 * Copyright:  CMSimple_XH developers
 * Website:    https://www.cmsimple-xh.org/?About-CMSimple_XH/The-XH-Team
 * */

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

if ($plugin_cf['jquery']['autoload'] == '1' || $plugin_cf['jquery']['autoload'] == 'true') {
    // for security headers
    $jquery_nonce = '';
    if (function_exists('sh_cspHeaderNonce')) {
        $jquery_nonce = ' nonce="' . sh_cspHeaderNonce() . '"';
    }
    include_once($pth['folder']['plugins'] . 'jquery/jquery.inc.php');
    include_jQuery();
    if ($plugin_cf['jquery']['autoload_libraries'] == 'jQuery & jQueryUI') {
        include_jQueryUI();
    }
}