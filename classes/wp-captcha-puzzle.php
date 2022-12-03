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
}