<?php

use frontend\assets\AppAssetSingnup;

AppAssetSingnup::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lotto88</title>
    <?php $this->head() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web/singnup/ico/favicon.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?= Yii::getAlias('@web/singnup/ico/apple-touch-icon-144-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?= Yii::getAlias('@web/singnup/ico/apple-touch-icon-114-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?= Yii::getAlias('@web/singnup/ico/apple-touch-icon-72-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed"
          href="<?= Yii::getAlias('@web/singnup/ico/apple-touch-icon-57-precomposed.png') ?>">

</head>

<body class="page-md login" style="background-color: #2E4053;">
<div class="menu-toggler sidebar-toggler">
</div>


<div class="row">
    <?= $content ?>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
