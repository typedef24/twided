<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name . " password reset link";

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<b>Hi</b>,<br />
We just learned that you forgot your 
<?= Yii::$app->name ?> account password but don't worry 
in just about 3 minutes you will be back and running. 
Click on the link below to reset your password.
The link can only be used once for security reasons.
At ABEBOH, your security is our life's job.
<br />
<?= Html::a($resetUrl, $resetUrl) ?>