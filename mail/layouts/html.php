<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <style type="text/css">
        .shawsub{
            font-family: URW Chancery L, verdana sarif;
            font-size:2.0em;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
        <div style="border-radius: 5px; border: 1px solid #d3d4d6">
            <div class="shawsub" style="text-align: center; background-color: #5bc0de; padding: 15px 20px">
                <?= Html::encode($this->title) ?>    
            </div>
            <div style="padding: 15px 20px">
                <?= $content ?>
            </div>
            <div class="shawsub" style="text-align: center; padding: 15px 20px; background-color: #f5f5f5; border-top: 1px solid #ddd;">
                With kind regards, The <?= Yii::$app->name ?> team
            </div>
        </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
