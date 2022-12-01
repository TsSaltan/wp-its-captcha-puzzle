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
if (!defined("ABSPATH")) exit; 
include "vendor/autoload.php";

class WPCaptchaPuzzle {
    const META_KEY = 'wp-its-cp';

    private $publicKey, 
            $privateKey;

    public function __construct(){
        $installed = $this->loadAPIKeys();

        if(!$installed){
            add_action('admin_notices', function(){ $this->showAdminInstallingNotice(); });
        }
    }

    private function loadAPIKeys(): bool {
        $this->publicKey = get_metadata('custom_type', self::META_KEY, 'public_key', true);
        $this->privateKey = get_metadata('custom_type', self::META_KEY, 'private_key', true);

        return (strlen($this->publicKey) > 0) && (strlen($this->privateKey) > 0);
    }

    public function showAdminInstallingNotice(){
        $this->showAdminNotice('error', '<strong>It\'s Captcha Puzzle</strong>: Open plugin <a href="">config page</a> for complete installation.');
    }

    /**
     * @param string $type = updated|error
     */
    public function showAdminNotice(string $type, string $text){
        echo '<div class="'. $type .'"><p>' . $text . '</p></div>';
    }
}

$wpCaptchaPuzzle = new WPCaptchaPuzzle;