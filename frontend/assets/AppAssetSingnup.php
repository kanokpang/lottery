<?php
namespace frontend\assets;
use yii\web\AssetBundle;
?>

<?php
class AppAssetSingnup extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@web/themes';

    public $css = [
        'themes/singnup/bootstrap/css/bootstrap.min.css',
        'themes/singnup/font-awesome/css/font-awesome.min.css',
        'themes/singnup/css/form-elements.css',
        'themes/singnup/css/style.css',
    ];
    public $js = [
        'themes/singnup/js/jquery.backstretch.min.js',
        'themes/singnup/js/retina-1.1.0.min.js',
        'themes/singnup/js/scripts.js',
        'themes/singnup/js/placeholder.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
?>