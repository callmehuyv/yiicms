<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-category-create">
   
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">CREATE NEW CATEGORY</h3>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin() ?>
                        <?= $form->field($category, 'category_name') ?>
                        <?= $form->field($category, 'category_slug') ?>
                        <?= $form->field($category, 'category_description')->textArea(['rows' => '6']) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">All Category</h3>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin() ?>
                        <?= $form->field($category, 'category_name') ?>
                        <?= $form->field($category, 'category_slug') ?>
                        <?= $form->field($category, 'category_description')->textArea(['rows' => '6']) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
</div>
