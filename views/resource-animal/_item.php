<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>body{background-image:url('<?=Url::to(['/themes/frontend/img/damask.jpg'])?>');}</style>
<div class="well">
    <a href="<?= Url::to(['resource-animal/view', 'id'=>$model->id]);?>">
        <h2 class="post-title">
            <?php echo $model->common_name; ?>
        </h2>
        <h3 class="post-subtitle">
            <?php echo $model->information ?>
        </h3>
    </a>
    <p class="post-meta"><?php echo 'โพสต์โดย ' . $model->updated_by . ' ล่าสุดเมื่อวันที่ '. $model->updated_date?></p>
</div>
