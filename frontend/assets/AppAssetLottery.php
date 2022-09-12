<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class AppAssetLottery extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@web/themes';

    public $css = [
//        'themes/lottery/css/bootstrap.min.css',
        'themes/lottery/css/components-md.min.css',
        'themes/lottery/css/custom.css',
        'themes/lottery/css/green-haze.min.css',
        'themes/lottery/css/ladda-themeless.min.css',
        'themes/lottery/css/layout.min.css',
        'themes/lottery/css/margin-padding.min.css',
        'themes/lottery/css/pace-theme-flash.css',
        'themes/lottery/css/plugins-md.min.css',
        'themes/lottery/css/simple-line-icons.min.css',
        'themes/lottery/css/style.css',
        'themes/lottery/css/toastr.min.css',
        'themes/lottery/css/unslider.css',
        'themes/lottery/css/unslider-dots.css',
        'themes/lottery/css/font-awesome.min.css',
    ];
    public $js = [
        'themes/lottery/js/app.js',
//        'themes/lottery/js/bootstrap.min.js',
        'themes/lottery/js/bootstrap-hover-dropdown.min.js',
        'themes/lottery/js/bootstrap-maxlength.min.js',
        'themes/lottery/js/countUp.min.js',
        'themes/lottery/js/excanvas.min.js',
        'themes/lottery/js/home.js',
//        'themes/lottery/js/jquery.blockui.min.js',
//        'themes/lottery/js/jquery.cookie-1.4.1.min.js',
//        'themes/lottery/js/jquery.inputmask.bundle.min.js',
//        'themes/lottery/js/jquery.min.js',
        'themes/lottery/js/ladda.jquery.min.js',
        'themes/lottery/js/ladda.min.js',
        'themes/lottery/js/layout.js',
        'themes/lottery/js/pace.min.js',
        'themes/lottery/js/quick-sidebar.min.js',
        'themes/lottery/js/respond.min.js',
//        'themes/lottery/js/runtime-auth.js',
        'themes/lottery/js/spin.min.js',
        'themes/lottery/js/toastr.min.js',
        'themes/lottery/js/ui-toastr.min.js',
        'themes/lottery/js/unslider-min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

?>

