<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

Dear <?= $name ?>,<br />
We are so happy that you have decided to join your classmates and lecturers to communicate on <?= Yii::$app->name ?>. 
To activate your account and start enjoying the functionalities of the platform, 
click the link below. You will automatically be logged in after clicking it for the first time.<br />
<?= Html::a($activateUrl, $activateUrl) ?><br />Thanks and God bless you.