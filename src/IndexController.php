<?php
/**
 * @link https://www.xinrennet.com/
 *
 * @copyright Copyright (c) 2018 XINRENNET
 */

namespace westhack\swagger;

/**
 * Class IndexController
 * @package westhack\swagger
 * @author westhack 452855489@qq.com
 */
class IndexController extends SwaggerController
{
    /**
     * @var json The swagger-ui component configurations.
     * @see https://github.com/swagger-api/swagger-ui/blob/master/docs/usage/configuration.md
     */
    protected $configurations = <<<EOT
    {
        url: "/swagger/api",
        dom_id: '#swagger-ui',
        deepLinking: true,
        validatorUrl: false,
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],
        plugins: [
            SwaggerUIBundle.plugins.DownloadUrl
        ],
        layout: "StandaloneLayout"
    }
EOT;
    /**
     * @var json The OAuth configuration.
     */
    protected $oauthConfiguration = '';
    /**
     * @var string
     */
    protected $title = 'Swagger-ui';

    public function index()
    {
        $this->title  = !empty($this->config['title']) ? $this->config['title'] : $this->title;
        $this->configurations  = trim($this->config['configurations']) != '' ? trim($this->config['configurations']) : $this->configurations;
        $this->oauthConfiguration  = trim($this->config['oauth_configuration']) != '' ? trim($this->config['oauth_configuration']) : $this->oauthConfiguration;

        return view( __DIR__.'/view/index.html',[
            'title'               => $this->title,
            'assets_path'         => $this->config['assets_path'],
            'configurations'      => $this->configurations,
            'oauthConfiguration'  => $this->oauthConfiguration
        ]);
    }
}

