<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="body-content">
        <?php if (Yii::$app->session->hasFlash('infoFlash')): ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= Yii::$app->session->getFlash('infoFlash') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('dangerFlash')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= Yii::$app->session->getFlash('dangerFlash') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" title="Log in to your account"
                        class="<?= Yii::$app->session->hasFlash('showLogin') ? 'active' : '' ?>">
                        <a href="#logIn" class="fg-white tabLink" aria-controls="logIn" role="tab" data-toggle="tab"><b>Log in</b></a>
                    </li>
                    <li role="presentation" title="Create an account if you don't have one yet to start enjoying <?= Yii::$app->name ?>"
                        class="<?= Yii::$app->session->hasFlash('showSignup') ? 'active' : '' ?>">
                        <a href="#signUp" class="fg-white tabLink" aria-controls="signUp" role="tab" data-toggle="tab"><b>Sign up</b></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" id="logIn" 
                        class="tab-pane site-login <?= Yii::$app->session->hasFlash('showLogin') ? 'active' : '' ?>">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <?php if (Yii::$app->session->hasFlash('loginFail')): ?>
                                    <div class="alert alert-danger">
                                        Log in failed!! Please try again.
                                    </div>
                                <?php endif; ?>
                                <?php $form = ActiveForm::begin(['action' => ['login']]); ?>
                                    <?= $form->field($loginForm, 'login', ['template' => 
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
                                            ->label(false)
                                            ->textInput(['autofocus' => true, 'placeholder' => 'Email or phone number']) 
                                    ?>
                                    <?= $form->field($loginForm, 'password', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-lock"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                                    <span class="input-group-btn">' . 
                                                        Html::a('<span class="glyphicon glyphicon-question-sign"></span>', ['/site/send-passwd-reset-mail'], 
                                                                ['class' => "btn btn-info", 'title' => "Forgot your password?",
                                                                'style' => 'text-decoration: none; font-weight: bold']) 
                                                        . '
                                                    </span>
                                               </div>
                                               {error}{hint}
                                            '
                                            ]) 
                                            ->label(false)
                                            ->passwordInput(['placeholder' => 'Password']) 
                                    ?>
                                    <div class="form-group clearfix">
                                        <?= Html::submitButton('Log in', ['class' => 'btn btn-info pull-right btn-lg', 'name' => 'login-button']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="signUp"
                        class="tab-pane signup <?= Yii::$app->session->hasFlash('showSignup') ? 'active' : '' ?>">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <?php if (Yii::$app->session->hasFlash('signupSuccess')): ?>
                                    <div class="alert alert-info">
                                        <?= Yii::$app->session->getFlash('signupSuccess') ?>
                                    </div>
                                <?php elseif (Yii::$app->session->hasFlash('signupFail')): ?>  
                                    <div class="alert alert-danger">
                                        <?= Yii::$app->session->getFlash('signupFail') ?>
                                    </div>
                                <?php endif; ?>
                                <?php $form = ActiveForm::begin(['action' => ['signup']]); ?>
                                    <?= $form->field($signupForm, 'userType', ['template' => 
                                        '{label}
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </button>
                                                </span>
                                                {input}
                                            </div>
                                           {error}{hint}
                                        '
                                        ])
                                        ->textInput(['autofocus' => true])
                                        ->label('Sign up as:')
                                        ->dropdownlist(['S'=>'Student', 'L'=>'Lecturer'], ['prompt'=>'Sign up as']); 
                                    ?>
                                    <?= $form->field($signupForm, 'userName', ['template' => 
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
                                        ->textInput(['placeholder' => 'Your name', 'maxlength' => true])
                                    ?>
                                    <?= $form->field($signupForm, 'email', ['template' => 
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
                                        ->textInput(['placeholder' => 'Your email address', 'maxlength' => true])
                                    ?>
                                    <?= $form->field($signupForm, 'password', ['template' => 
                                        '{label}
                                            <div class="input-group  input-group-lg">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-addon">
                                                        <span class="glyphicon glyphicon-lock"></span>
                                                    </button>
                                                </span>
                                                {input}
                                            </div>
                                            {error}{hint}
                                        '
                                        ]) 
                                        ->passwordInput(['placeholder' => 'Your password'])
                                        ->label('Create a password')
                                    ?>
                                    <?= $form->field($signupForm, 'confirmpassword', ['template' => 
                                        '{label}
                                            <div class="input-group  input-group-lg">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-addon">
                                                        <span class="glyphicon glyphicon-lock"></span>
                                                    </button>
                                                </span>
                                                {input}
                                            </div>
                                            {error}{hint}
                                        '
                                        ]) 
                                        ->passwordInput(['placeholder' => 'confirm the password'])
                                    ?>
                                    <?= $form->field($signupForm, 'verifyCode')
                                        ->label('Proof your humanity')
                                        ->widget(Captcha::className(), ['template' => 
                                            '<div class="row">
                                                <div class="col-md-3">
                                                    {image}
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group  input-group-lg">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info btn-addon">
                                                                <span class="glyphicon glyphicon-qrcode"></span>
                                                            </button>
                                                        </span>
                                                        {input}
                                                    </div>    
                                                    <span class="help-block" style="font-weight: bold; color: black">
                                                        Click image to change text
                                                    </span>
                                                </div>
                                            </div>',
                                            'options' => ['class' => "form-control", 'placeholder' => 'Enter the text in the image'],
                                        ]) 
                                    ?>
                                    <p class="lead">
                                        <b>By signing up, you agree to our 
                                        <?= Html::a('terms and conditions of service', ['terms'], ['title' => Yii::$app->name . "'s terms and conditions of service"]) ?></b>
                                    </p>
                                    <div class="form-group clearfix">
                                        <?= Html::submitButton('Sign up', ['class' => 'btn btn-info btn-lg pull-right']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1"><br />
                <div class="well well-sm shawsub1 fg-site" style="border: 2px solid white; border-radius: 20px">
                    <b>Stay connected and communicate directly with your classmates and lecturers.
                    "Social Media 4 education".
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
