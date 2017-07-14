<?php
use yii\helpers\Html;
?>
<div class="post-preview">
    <a href="view/">
        <h2 class="post-title">
            <?php echo $model->common_name; ?>
        </h2>
        <h3 class="post-subtitle">
            <?php 
                $model->information
            ?>
        </h3>
    </a>
    <p class="post-meta"><?php echo 'โพสต์โดย ' . $model->updated_by . ' ล่าสุดเมื่อวันที่ '. $model->updated_date?></p>
</div>
<hr>