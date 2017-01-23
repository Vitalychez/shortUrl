<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('https://code.jquery.com/jquery-2.2.0.min.js',  ['position' => yii\web\View::POS_HEAD]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<style>
		.centred {
			margin: 0 auto;
			float: none;
		}
	</style>

    <script>
        $(document).ready(function() {
            $('#Short').click(function() {
                var host = document.location.href;
                var url = $('#ShortUrl').val();
                if(!url) {
                    alert('Укажите ссылку');
                } else {
                    var data = {url: url};
                    $.ajax({
                        type: 'POST',
                        url: host + 'api/short-url',
                        data: data
                    }).success(function(data) {
                        $('.hidden').removeClass('hidden');
                        $('#ShortValue').val(host + data.data.url);
                    }).fail(function(data) {
                        alert(data.responseJSON.error);
                    });
                }
            });
        });
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
