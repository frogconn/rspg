<?php 
use yii\widgets\DetailView;
use yii\grid\GridView;

?>

<style>
table.detail-view th {
    width: 1%;
    white-space: nowrap;
}
</style>
<?php 
foreach ($model->partitions as $model): ?>
    <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fullname',
                'position',
                'telephone',
                'email',
            ],                           
            
        ]);
    ?>
<?php endforeach; ?>