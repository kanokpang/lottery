<?php
namespace frontend\assets;
use yii\web\AssetBundle;
?>

    <?php
class AppAssetLogin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@web/themes';

    public $css = [
        'themes/login/css/style.css',
        'themes/login/css/font.css',
        'themes/login/css/normalize.min.css',
    ];
    public $js = [
        'themes/login/js/index.js',
        'themes/login/js/jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
?>