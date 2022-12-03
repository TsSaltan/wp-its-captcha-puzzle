<?php
/**
 * Plugin Name: [WP] It's Captcha Puzzle
 * Plugin URI: https://dev.tssaltan.top/app/dev-captcha-puzzle
 * Description: Adding captcha script to comment fields
 * Version: 1.0.0
 * Author: tssaltan
 * Author URI: https://tssaltan.top
 * License: GPL
 */

define('CP_PLUGIN_DIR', __DIR__);

if (!defined("ABSPATH")) exit; 
include "vendor/autoload.php";
include "classes/wp-captcha-puzzle.php";
include "classes/wp-captcha-puzzle-configurer.php";

$captchaPuzzle = new WPCaptchaPuzzle;
$captchaPuzzleCfg = new WPCaptchaPuzzleConfigurer($captchaPuzzle);