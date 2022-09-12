<?php

/* @var $this yii\web\View */

$this->title = $information->menu->name;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= $this->title ?></span>
        </div>
    </div>
    <div class="portlet-body">

        <div class="tab-content">
            <p><?= $information->detail ?></p>
            <div align="footer">
                <p align="right" style="font-size: 10px;">Update Date: <?= $information->updatedAt ?></p>
            </div>
        </div>
    </div>
</div>
