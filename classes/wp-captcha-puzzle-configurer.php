<?php
class WPCaptchaPuzzleConfigurer {
    const CONFIG_SECTION = 'cp-configs';
    const CONFIG_PAGE = 'cp-plugin-page';
    
    /**
     * @var WPCaptchaPuzzle
     */    
    private $captchaPuzzle;

    public function __construct(WPCaptchaPuzzle $captchaPuzzle){
        $this->captchaPuzzle = $captchaPuzzle;

        if(!$this->captchaPuzzle->isInstalled()){
            add_action('admin_notices', function(){ 
                $this->htmlNotice('error', '<strong>It\'s Captcha Puzzle</strong>: Open plugin <a href="options-general.php?page=captcha-puzzle-settings">config page</a> for complete installation.');
            });
        }

        add_action('admin_menu', function(){
            add_options_page('It\'s Captcha Puzzle', 'Captcha Puzzle', 'activate_plugin', WPCaptchaPuzzle::CONFIG_KEY, 
                function(){ 
                    include CP_PLUGIN_DIR . "/pages/configs.php"; 
                }
            );
        });

        add_action('admin_init', function(){
            register_setting(self::CONFIG_SECTION, WPCaptchaPuzzle::CONFIG_KEY, null);
            //register_setting(self::CONFIG_SECTION, WPCaptchaPuzzle::CONFIG_KEY, [$this, 'sanitizeInputConfigs']);

            add_settings_section(self::CONFIG_SECTION, 'Plugin params', null, self::CONFIG_PAGE);

            add_settings_field('api_public_key', 'Публичный ключ', function(){ $this->htmlInputConfigField('public_key', $this->captchaPuzzle->getPublicKey()); }, self::CONFIG_PAGE, self::CONFIG_SECTION);
            add_settings_field('api_private_key', 'Приватный ключ', function(){ $this->htmlInputConfigField('private_key', $this->captchaPuzzle->getPrivateKey()); }, self::CONFIG_PAGE, self::CONFIG_SECTION);
        });

    }


    /**
     * @param string $type = updated|error
     */
    public function htmlNotice(string $type, string $text){
        ?>
            <div class="<?php echo $type; ?>"><p><?php echo $text; ?></p></div>
        <?php
    }

    public function htmlInputConfigField(string $fieldName, ?string $value = null){
        ?><input type="text" name="<?php echo WPCaptchaPuzzle::CONFIG_KEY; ?>[<?php echo $fieldName; ?>]" value="<?php echo esc_attr($value); ?>" /><?php
    }

    public function sanitizeInputConfigs($options){
        foreach($options as $name => $val){
            if($name == 'input'){
                $val = strip_tags($val);
            }

            if($name == 'checkbox'){
                $val = intval($val);
            }
        }
        return $options;
    }
}