<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\captcha\Captcha;

$this->title = 'Contact us';
?>

<div class="site-contact">
    <div class="row" style="padding: 10px">
        <div class="col-md-12">
            <div class="row onback">
                <b><p class="text-center shawsubAbt"><?= $this->title ?></p></b>
            </div>  
            <div class="bg-success row onmiddle">
                <div class="col-md-10 col-md-offset-1 ontop">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1"><br />
                            <?php if (Yii::$app->session->hasFlash('contactSuccess')): ?>
                                <div class="alert alert-info">
                                    Thank you for contacting us. We will respond to you by mail as soon as possible.
                                </div>
                            <?php elseif (Yii::$app->session->hasFlash('contactFail')): ?>  
                                <div class="alert alert-danger">
                                    Sorry, a system error occurred while sending your message. Try again.
                                </div>  
                            <?php else: ?>
                                <b>
                                    <p class="lead fg-site"><b>
                                        If you have business inquiries or other questions, please fill out the following form to contact us.
                                        Thank you.</b>
                                    </p>
                                </b>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($contactForm, 'name', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-user"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                                </div>
                                                {error}{hint}
                                            '
                                            ])
                                            ->textInput(['autofocus' => true, 'placeholder' => 'Your name', 'maxlength' => true,
                                                'value' => Yii::$app->user->identity ? Yii::$app->user->identity->userName : '' ])
                                            ->label(false) 
                                        ?>
                                        <?= $form->field($contactForm, 'email', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-envelope"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                                </div>
                                                {error}{hint}
                                            '
                                            ])
                                            ->textInput(['placeholder' => 'Your email', 'maxlength' => true,
                                                'value' => Yii::$app->user->identity ? Yii::$app->user->identity->email : ''])
                                            ->label(false) 
                                        ?>
                                        <?= $form->field($contactForm, 'subject', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-font"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                                </div>
                                                {error}{hint}
                                            '
                                            ]) 
                                            ->textInput(['placeholder' => 'subject or title', 'maxlength' => true])
                                            ->label(false) 
                                        ?>
                                        <?= $form->field($contactForm, 'body')
                                            ->textArea(['rows' => 5, 'placeholder' => 'Message body', 'maxlength' => true]) 
                                            ->label(false) 
                                        ?>
                                        <?= $form->field($contactForm, 'verifyCode')
                                            ->label('Proof your humanity')
                                            ->widget(Captcha::className(), [
                                                'template' => '<div class="row"><div class="col-md-4">{image}</div><div class="col-md-8"><div class="input-group-lg">{input}</div><span class="help-block" style="font-weight: bold; color: black">Click image to change text</span></div></div>',
                                                'options' => ['class' => "form-control transparent", 'placeholder' => 'Enter the text in the image'],
                                            ]) 
                                        ?>
                                        <div class="form-group clearfix">
                                            <?= Html::submitButton('<span class="glyphicon glyphicon-send" aria-hidden="true" style="color: white"></span> Send', ['class' => 'btn btn-info btn-lg pull-right']) ?>
                                        </div><br />
                                    <?php ActiveForm::end(); ?>
                                </div>
                                <div class="col-md-6">
                                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1989.648382904865!2d9.297514975833893!3d4.161946674377226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNMKwMDknNDMuMCJOIDnCsDE3JzU1LjAiRQ!5e0!3m2!1sen!2scm!4v1474547888146" 
                                            width="100%" height="440" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    <div>
                                        <span class ="glyphicon glyphicon-earphone"></span> (+237) 676023729
                                    </div>
                                    <div>
                                       <span class ="glyphicon glyphicon-envelope"></span> abebohtech@gmail.com
                                    </div><br />
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
