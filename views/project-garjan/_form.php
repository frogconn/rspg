<?php

use app\models\Researcher;
use app\models\ProjectType;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;

use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\examples\models\ExampleModel;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectGarjan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-garjan-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation'      => true,
        'enableClientValidation'    => false,
        'validateOnChange'          => false,
        'validateOnSubmit'          => true,
        'validateOnBlur'            => false,
        ]); 
    ?>

    <div class="box-body">

    <?= $form->field($type, 'sub_topic')->dropdownList(ArrayHelper::map(
            ProjectType::find()->where(['topic' => 'ยางนา'])->groupBy('sub_topic')
            ->orderBy('id ASC')->all(), 'sub_topic', 'sub_topic'),
            [
                'id'=>'ddl-sub_topic',
                'options'=>[
                    $type -> id => ['Selected' => 'selected']],
                'prompt'=>'เลือกกรอบกิจกรรม'
            ]
        ); 
    ?>

    <?= $form->field($type, 'type')->widget(DepDrop::classname(), [
            'data'=> $type_list,
            'pluginOptions'=>[
                'depends'=>['ddl-sub_topic'],
                'placeholder'=>'เลือกด้าน',
                'url'=>Url::to(['/project-garjan/get-type'])
            ]
        ]); 
    ?>

    <?php echo $form->field($project, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
            'yearStart' => 2549,
            'yearStartType' => 'fix',
            'yearEnd' => 544,
        ]);
    ?>

    <?= $form->field($project, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($project, 'personal_code')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Researcher::find()->all(), 'personal_code', 'fullname_th'),
            'language' => 'th',
            'options' => ['placeholder' => 'เลือกหัวหน้าโครงการ', 'id'=>'ddl-header'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($faculty, 'name')->widget(DepDrop::classname(), [
            'data'=> $faculty_list,
            'options'=>['id'=>'ddl-faculty'],
            'pluginOptions'=>[
                'depends'=>['ddl-header'],
                'placeholder'=>'เลือกคณะ',
                'url'=>Url::to(['/project-garjan/get-faculty'])
            ]
        ]); 
    ?>

    <?= $form->field($project, 'schedule')->widget(MultipleInput::className(), [
            'columns' => [
            //column 1
                [
                    'name'  => 'fullname',
                    'title' => 'ชื่อ-นามสกุล',
                    'enableError' => true,
                    'options' => [
                    'class' => 'input-priority'
                    ]
                ],
            //column 2
                [
                    'name'  => 'position',
                    'title' => 'ตำแหน่ง(ทางราชการ)',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
            //column 3
                [
                    'name'  => 'telephone',
                    'title' => 'หมายเลขโทรศัพท์',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
            //column 4
                [
                    'name'  => 'email',
                    'title' => 'E-mail',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ]
            ],
            'addButtonOptions' => [
                'class' => 'btn btn-success'
            ]
        ]);
    ?>

    <?= $form->field($project, 'budget')->textInput() ?>

    <?= $form->field($project, 'summary')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($project, 'start')->widget('trntv\yii\datetime\DateTimeWidget', [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'th-th',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>

    <?php echo $form->field($project, 'stop')->widget('trntv\yii\datetime\DateTimeWidget', [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'th-th',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>

    <?php
       echo app\widgets\Upload::widget(['model' => $project,'required' => false]);
	?>

	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	            <?= Html::submitButton($project->isNewRecord ? 'สร้าง' : 'แก้ไขข้อมูล', ['class' => $project->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                <?= Html::a('ยกเลิก',[ 'project-garjan/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    document.getElementById('ddl-faculty').value="<?php echo $faculty->id; ?>";
    document.getElementById('projecttype-type').value="<?php echo $type->id; ?>";
</script>

<?php
    $script = <<< JS
    // here you right all your javascript stuff
    $('#ddl-header').change(function(){
        /*var personal_code = $(this).val();
        $.get('get-faculty', { personal_code : personal_code }, function(data){
            var data = $.parseJSON(data);
            alert(data);
            $('#researcherfaculty-name').attr('value', data.name);
        });*/
        $("#ddl-faculty").depdrop({
            depends: ['ddl-header'],
            url: '/project-garjan/get-faculty'
        });
    }).change();
JS;
$this->registerJs($script);
?>