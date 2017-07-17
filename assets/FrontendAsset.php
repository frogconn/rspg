<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'themes/frontend/css/bootstrap.css',
        'themes/frontend/css/bootstrap.min.css',
        'themes/frontend/css/clean-blog.min.css',
        'themes/frontend/css/clean-blog.css',
        'themes/frontend/css/style.css'
    ];
    public $js = [
        //'js/yii_overrides.js',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',
        'themes/frontend/js/bootstrap.js',
        'themes/frontend/js/bootstrap.min.js',
        'themes/frontend/js/clean-blog.js',
        'themes/frontend/js/clean-blog.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\SweetAlertAsset',
    ];


}

