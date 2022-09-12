<?php

use frontend\assets\AppAssetLogin;

AppAssetLogin::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Lotto 88</title>
    <?php $this->head() ?>
</head>

<body>

<div class="form">
    <?= $content ?>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
