<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="well">
    <a href="<?= Url::to(['project-ecology/view', 'id'=>$model->id]);?>">
        <h2 class="post-title">
            <?php echo $model->name; ?>
        </h2>
        <h3 class="post-subtitle">
            <?php echo $model->summary ?>
        </h3>
    </a>
    <p class="post-meta"><?php echo 'โพสต์โดย ' . $model->updated_by . ' ล่าสุดเมื่อวันที่ '. $model->updated_date?></p>
</div>
