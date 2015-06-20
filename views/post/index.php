<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use yii\widgets\LinkPager;
    use app\models\Category;

    $this->title = 'List Post';
    $this->params['breadcrumbs'][] = ['label' => 'Post', 'url' => ['post/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-post-index">

<?php messageSystems() ?>
<?= Html::a('Create new Post', ['post/create'], ['class' => 'btn btn-success']) ?>

<?php
    if ($selected_category != null) {
        ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#selectCategory').val(<?= $selected_category ?>);
                });
            </script>
        <?php
    }
?>

<?= Html::a('View all Post', ['post/index'], ['class' => 'btn btn-info pull-right', 'style' => 'margin-left: 10px']) ?>

<div class="form-group" style="float: right; width: 330px; margin-left: 15px;">
    <div class="input-group">
        <div class="input-group-addon">by Name</div>
        <input placeholder="Search post by name..." class="form-control" value="<?php if(isset($_GET['name'])) { echo htmlentities(strip_tags($_GET['name'])); } ?>" id="filterByName">
        <div id="filterByNameClick" style="cursor: pointer" class="input-group-addon"><strong>Search</strong></div>
    </div>
</div>

<div class="form-group" style="float: right; width: 250px; margin-left: 15px;">
    <div class="input-group">
        <div class="input-group-addon">by Date</div>
        <input class="form-control" value="<?php if(isset($_GET['date'])) { echo date('d-m-Y', strtotime($_GET['date'])); } else { echo 'All'; } ?>" id="datepicker">
        <div id="filterByDateClick" style="cursor: pointer" class="input-group-addon"><strong>Search</strong></div>
    </div>
</div>

<div class="form-group" style="float: right; width: 250px;">
    <div class="input-group">
        <div class="input-group-addon">Filter by Category</div>
        <input id="currentUrl" type="hidden" value="<?php echo Url::toRoute('post/index') ?>">
        <select id="selectCategory" class="form-control">
            <option value="null">View All</option>
            <?php
                foreach($list_categories as $category) {
                    ?>
                        <option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
                    <?php
                }
            ?>
        </select>
    </div>
</div>

<?php
    if ($selected_category != null) {
        ?>
            <br><br>
            <h2>List Posts of category <?php echo Category::findOne($selected_category)->category_name ?></h2>
            <br>
        <?php
    }
?>
<table class="table">
    <tr>
        <th>Post Name</th>
        <th>Post Image</th>
        <th>Belong Category</th>
        <th>Updated At</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>

    <?php
        foreach ($posts as $post) {
            ?>
                <tr id="post_<?php echo $post->post_id ?>">
                    <td><?php echo $post->post_name ?></td>
                    <td>
                        <?php echo Html::img('@web/'.$post->post_image, ['width' => '100px', 'height' => '100px']) ?>
                    </td>
                    <td>
                        <?php echo $post->category->category_name ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y h:i:s', strtotime($post->updated_at)) ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y', strtotime($post->created_at)) ?>
                    </td>
                    <td>
                        <?php echo Html::a('Edit', ['post/edit', 'post' => $post->post_id], ['class' => 'btn btn-warning']) ?>
                        <a href="#" class="btn btn-danger deleteConfirm" data-id="<?php echo $post->post_id ?>" data-type="post" data-url="<?php echo Url::toRoute(['post/delete']) ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php
        }
    ?>
</table>

<?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
?>

</div>
