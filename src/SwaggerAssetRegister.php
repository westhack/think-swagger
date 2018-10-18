<?php
/**
 * @link https://www.xinrennet.com/
 *
 * @copyright Copyright (c) 2018 XINRENNET
 */

namespace westhack\swagger;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

/**
 * Class SwaggerAssetRegister 注册资源
 * @package westhack\swagger
 * @author westhack 452855489@qq.com
 */
class SwaggerAssetRegister extends Command
{
    protected function configure()
    {
        $this->setName('swaggerAssetRegister')
             ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to move', null)
             ->addOption('config', null, Option::VALUE_OPTIONAL, 'config to init', null)
             ->setDescription('move swagger assets');
    }

    protected function execute(Input $input, Output $output)
    {
        if ($input->hasOption('config')) { // 安装配置文件
            $src = __DIR__.DS.'config'.DS.'swagger.php';
            $path = CONF_PATH.'extra'.DS.'swagger.php';
            copy($src, $path);
            $output->writeln('<info>init Swagger config Successed</info>');

            return;
        }

        // 安装静态资源
        $option = $input->getOption('path');
        $path = $option ?: ROOT_PATH.'public'.DS.'static'.DS;

        //不是根目录 放到默认目录下面的相对目录
        if (DS != substr($option, 0, 1)) {
            $path = ROOT_PATH.'public'.DS.'static'.DS.$option;
        }

        if (is_dir($path)) {
            $src = __DIR__.DS.'..'.DS.'assets';
            $this->moveAssets($src, $path);
            $output->writeln('<info>move Swagger assets Successed</info>'); //编辑器资源文件初始化成功
        } else {
            $output->writeln('<info>input path is not dir</info>');  //输入的路径不存在
        }
    }

    /**
     * 迁移 swagger 静态资源.
     *
     * @param @string $src  原来目录
     * @param @string $path 目标目录
     */
    protected function moveAssets($src, $path)
    {
        $dir = opendir($src);
        @mkdir($path);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.'/'.$file)) {
                    $this->moveAssets($src.'/'.$file, $path.'/'.$file);
                } else {
                    copy($src.'/'.$file, $path.'/'.$file);
                }
            }
        }
        closedir($dir);
    }
}
