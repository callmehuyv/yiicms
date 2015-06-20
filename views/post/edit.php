<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Create Post';
    $this->params['breadcrumbs'][] = ['label' => 'Post', 'url' => ['post/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-post-create">
    
    <?php messageSystems() ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'post_name') ?>
    <?= $form->field($model, 'category_id')->dropDownList($list_categories) ?>
    <?= $form->field($model, 'post_content')->textArea() ?>
    <?= $form->field($model, 'post_image')->fileInput() ?>
    <?= Html::img('@web/'.$model->post_image, ['width' => '100px', 'height' => '100px']) ?>
    <br><br>

    <div class="form-group">
        <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
