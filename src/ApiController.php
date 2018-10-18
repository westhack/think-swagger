<?php
/**
 * @link https://www.xinrennet.com/
 *
 * @copyright Copyright (c) 2018 XINRENNET
 */

namespace westhack\swagger;

use think\Cache;
use think\Response;

class ApiController extends SwaggerController
{
    /**
     * @var string|array|\Symfony\Component\Finder\Finder The directory(s) or filename(s).
     * If you configured the directory must be full path of the directory.
     */
    protected $scanDir;
    /**
     * @var string api key, if configured will perform the authentication.
     */
    protected $apiKey;
    /**
     * @var string The `apiKey` name specified.
     */
    protected $apiKeyParam = 'api_key';
    /**
     * @var array The options passed to `Swagger`, Please refer the `Swagger\scan` function for more information.
     */
    protected $scanOptions = [];
    /**
     * @var \think\Cache the cache object or the ID of the cache application component that is used to store
     * Cache the \Swagger\Scan
     */
    protected $cache = 'cache';
    /**
     * @var bool If enable caching the scan result.
     */
    protected $enableCache = false;
    /**
     * @var string Cache key
     * [[cache]] must not be null
     */
    protected $cacheKey = 'api-swagger-cache';

    public function _initialize()
    {
        parent::_initialize();

        $this->scanDir = $this->config['scan_dir'];
        $this->apiKey = $this->config['api_key'];
        $this->apiKeyParam  = isset($this->config['api_key_param']) ? $this->config['api_key_param'] : $this->apiKeyParam;
        $this->scanOptions = isset($this->config['scan_options']) ? $this->config['scan_options'] :  $this->scanOptions;
        $this->enableCache = isset($this->config['enable_cache']) ? $this->config['enable_cache'] : $this->enableCache;
        $this->cacheKey = isset($this->config['cache_key']) ? $this->config['cache_key'] : $this->cacheKey;
        $this->cache = new Cache();

        $this->initCors();
    }

    public function api()
    {
        config('default_return_type', 'json');
        $this->clearCache();

        if ($this->enableCache) {
            if (($swagger = $this->cache->get($this->cacheKey)) === false) {
                $swagger = $this->getSwagger();
                $this->cache->set($this->cacheKey, $swagger);
            }
        } else {
            $swagger = $this->getSwagger();
        }

        return $swagger;
    }

    /**
     * Init cors.
     */
    protected function initCors()
    {
        $response = Response::create();

        $response->header('Access-Control-Allow-Headers', implode(', ', [
            'Content-Type',
            $this->apiKeyParam,
            'Authorization',
        ]));
        $response->header('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT');
        $response->header('Access-Control-Allow-Origin', '*');
    }

    protected function clearCache()
    {
        $clearCache = input('clear-cache', false);
        if ($clearCache !== false) {
            $this->cache->rm($this->cacheKey);

            echo 'Succeed clear swagger api cache.';
        }
    }

    /**
     * Get swagger object
     *
     * @return \Swagger\Annotations\Swagger
     */
    protected function getSwagger()
    {
        return \Swagger\scan($this->scanDir, $this->scanOptions);
    }
}

