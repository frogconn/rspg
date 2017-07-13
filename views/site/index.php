<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = '';
?>


<table>
	<?php foreach ($model as $project): ?>
		
	
	<tr>
		<td><?php echo $project->name; ?></td>
	</tr>
	<tr>
		<td>content</td>
	</tr>
	<?php endforeach ?>
</table>