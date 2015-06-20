<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="<?php echo Url::to('@web/js/jquery.min.js'); ?>"></script>
    <?php $this->head() ?>
    <script type="text/javascript" src="<?php echo Url::to('@web/js/tinymce/tinymce.min.js'); ?>"></script>
    <script type="text/javascript">
        tinymce.init({
            selector:'#category-category_description, #post-post_content',
            menubar : true,
            plugins: "code, image, visualblocks, fullscreen, advlist, anchor, autolink, contextmenu, directionality, link, media, preview, template",
            image_advtab: true,
            image_dimensions: true,
            image_description: true,
            theme: 'modern',
            convert_fonts_to_spans : true,
            theme_advanced_font_sizes: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            toolbar: [
                "image_button | undo redo | fontselect | fontsizeselect | styleselect | bold italic underline | link image | alignleft aligncenter alignright alignjustify | advlist, anchor, autolink, autosave, bbcode, contextmenu, directionality, fullpage, link, media, preview, template | fullscreen"
            ],
            extended_valid_elements : "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]"
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#selectCategory').change(function(){
                var id = $('#selectCategory').val();
                if (id != 'null') {
                    window.location.replace($('#currentUrl').val()+ '?category=' + id);
                } else {
                    window.location.replace($('#currentUrl').val());
                }
            });

            $('#filterByNameClick').click(function(){
                var id = $('#filterByName').val();
                if (id != 'null') {
                    window.location.replace($('#currentUrl').val()+ '?name=' + id);
                } else {
                    window.location.replace($('#currentUrl').val());
                }
            });

            $('#filterByDateClick').click(function(){
                var id = $('#datepicker').val();
                if (id != 'All') {
                    window.location.replace($('#currentUrl').val()+ '?date=' + id);
                } else {
                    window.location.replace($('#currentUrl').val());
                }
            });
        });

        function sleep(time){
            var dt = new Date();
            dt.setTime(dt.getTime() + time);
            while (new Date().getTime() < dt.getTime());
        }
        function messageSystems(content) {
            $(document).ready(function(){
                $('#messageSystems .modal-body').html(content)
                $('#messageSystems').modal('show');
            })
        }
        $(document).ready(function(){
            $(".deleteConfirm").confirm({
                text: "Are you sure you want to delete?",
                title: "Please Confirm",
                confirm: function(button) {
                    type = $(button).attr("data-type");
                    id = $(button).attr("data-id");
                    url = $(button).attr("data-url");
                    var data = {};
                    data[type] = id;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url,
                        data: data,
                        success: function(data) {
                            if (data['status'] == true) {
                                $(data['element']).fadeOut(1000, function() { $(this).remove(); });
                            } else {
                                messageSystems('Something Wrong! Please try again later');
                            }
                        },
                        error: function(data){
                            messageSystems('Something Wrong! Please try again later');
                        }
                    });
                },
                confirmButton: "Yes I am",
                cancelButton: "No",
                post: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-default",
                dialogClass: "modal-dialog"
            });
        })
    </script>
    <style type="text/css">
        #category-category_description, #post-post_content {
            min-height: 300px;
        }
    </style>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Yii CMS',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Category', 'url' => ['/category/index']],
                    ['label' => 'Post', 'url' => ['/post/index']],
                    // Yii::$app->user->isGuest ?
                    //     ['label' => 'Login', 'url' => ['/site/login']] :
                    //     ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    //         'url' => ['/site/logout'],
                    //         'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Yii CMS <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>


<div id="messageSystems" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Message From System</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok. I know</button>
      </div>
    </div>
  </div>
</div>

<?php $this->endBody() ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.bfh-datepicker .input-group-addon').html('Filter by Date');
    })
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>

</body>
</html>
<?php $this->endPage() ?>
