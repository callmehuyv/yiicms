<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;

    $this->title = 'List Category';
    $this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['category/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-category-index">

<?php messageSystems() ?>

<?= Html::a('Create new Category', ['category/create'], ['class' => 'btn btn-success']) ?>
<br><br>

<table class="table">
    <tr>
        <th>Category Name</th>
        <th>Category Description</th>
        <th>Category Image</th>
        <th>Action</th>
    </tr>

    <?php
        foreach ($categories as $category) {
            ?>
                <tr id="category_<?php echo $category->category_id ?>">
                    <td><?php echo $category->category_name ?></td>
                    <td><?php echo $category->category_description ?></td>
                    <td>
                        <?php echo Html::img('@web/'.$category->category_image, ['width' => '100px', 'height' => '100px']) ?>
                    </td>
                    <td>
                        <?php echo Html::a('View Post', ['post/index', 'category' => $category->category_id], ['class' => 'btn btn-info']) ?>
                        <?php echo Html::a('Edit', ['category/edit', 'category' => $category->category_id], ['class' => 'btn btn-warning']) ?>
                        <a href="#" class="btn btn-danger deleteConfirm" data-id="<?php echo $category->category_id ?>" data-type="category" data-url="<?php echo Url::toRoute(['category/delete']) ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php
        }
    ?>
</table>

</div>
