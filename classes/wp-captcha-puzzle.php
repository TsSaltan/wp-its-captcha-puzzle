<?php
use itsAPI\itsAPI;

class WPCaptchaPuzzle {
    const CONFIG_KEY = 'its-captcha-puzzle';

    /**
     * @var string
     */
    private $publicKey, 
            $privateKey;

    /**
     * @var itsAPI
     */
    private $api;

    public function __construct(){
        $this->loadAPIKeys();

        if($this->isInstalled()){
            $this->api = new itsAPI($this->publicKey, $this->privateKey);
        } else {
            $this->api = new itsAPI();
        }
    }

    private function loadAPIKeys(){
        $values = get_option(self::CONFIG_KEY);

        $this->publicKey = $values['public_key'] ?? null;
        $this->privateKey = $values['private_key'] ?? null;
    }

    public function isInstalled(): bool {
        return (strlen($this->publicKey) > 0) && (strlen($this->privateKey) > 0);
    }

    public function getPublicKey(): ?string {
        return $this->publicKey;
    }
 
    public function getPrivateKey(): ?string {
        return $this->privateKey;
    }

    public function getAPI(): itsAPI {
        return $this->api;
    }

    public function generateAPIKeys(): bool {
        $q = $this->api->post('token', ['description' => '[WPCaptchaPuzzle] Generated from plugin at ' . $_SERVER['HTTP_HOST'], 'access' => 'captcha-puzzle']);
        if(isset($q['result']) && $q['result'] == 'success' && isset($q['response'])){
            return update_option(self::CONFIG_KEY, $q['response']);
        }

        return false;
    }

    public function testAPIKeys(): array {
        $result = ['public' => 'fail', 'private' => 'fail'];
        $q = $this->api->get('whoami');
        if(isset($q['result']) && $q['result'] == 'success' && isset($q['response'])){
            $result['public'] = (isset($q['response']['token']['public_key_valid']) && $q['response']['token']['public_key_valid']) ? 'ok' : 'fail';
            $result['private'] = (isset($q['response']['token']['private_key_valid']) && $q['response']['token']['private_key_valid']) ? 'ok' : 'fail';
        }

        return $result;
    }
}