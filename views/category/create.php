<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Create Category';
    $this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['category/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-category-create">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'category_name') ?>
    <?= $form->field($model, 'category_description') ?>
    <?= $form->field($model, 'category_image')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Create Category', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
