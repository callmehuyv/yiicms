<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Edit Category';
    $this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['category/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-category-create">

    <?php messageSystems() ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'category_name') ?>
    <?= $form->field($model, 'category_description')->textArea() ?>
    <?= $form->field($model, 'category_image')->fileInput() ?>

    <?= Html::img('@web/'.$model->category_image, ['width' => '100px', 'height' => '100px']) ?>
    <br><br>

    <div class="form-group">
        <?= Html::submitButton('Update Category', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
