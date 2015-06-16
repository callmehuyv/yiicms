<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Main Post Info</h3>
                  </div>
                  <div class="panel-body">
                        <?= $form->field($category, 'category_name') ?>
                        <?= $form->field($category, 'category_slug') ?>
                        <?= $form->field($category, 'category_description')->textArea(['rows' => '6']) ?>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Other Post Info</h3>
                  </div>
                  <div class="panel-body">
                        Content Here
                  </div>
                </div>
            </div>
        </div>

    <?= $form->field($category, 'category_name') ?>

    <?= $form->field($category, 'category_description') ?>



    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
