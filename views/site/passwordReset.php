<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\editProfile */
/* @var $form ActiveForm */

$this->title = 'Password reset';
?>

<div class="passwordReset">
    <div class="row" style="padding: 10px">
        <div class="col-md-8 col-md-offset-2">
            <div class="row onback">
                <b><p class="text-center shawsubAbt"><?= $this->title ?></p></b>
            </div>    
            <div class="bg-success row onmiddle">
                <div class="col-md-10 col-md-offset-1 ontop">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1"><br />
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
                            
                            <?php $form = ActiveForm::begin(['action' => ['site/password-reset']]); ?> 
                                <?= $form->field($passwordResetForm, 'email', ['template' => 
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
                                            ->label(false)
                                            ->textInput(['placeholder' => 'Your email', 'autofocus' => true])
                                ?>
                                <?= $form->field($passwordResetForm, 'secreteQtn', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-question-sign"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                               </div>
                                               {error}{hint}
                                            '
                                            ]) 
                                            ->label(false)
                                            ->textInput(['placeholder' => 'Your secrete question'])
                                            ->dropdownlist(['1'=>'Your first girl/boy friend', 
                                                    '2'=>'Your best course ever',
                                                    '3'=>'Your worse course ever',
                                                    '4'=>'Your best lecturer ever',
                                                    '5'=>'Your worse lecturer ever',
                                                    '6'=>'Your best friend ever',
                                                    '7'=>'Your worse experience in one word',
                                                ], 
                                                ['prompt'=>'Select your secrete question'])
                                ?>
                                <?= $form->field($passwordResetForm, 'secreteAns', ['template' => 
                                            '{label}
                                                <div class="input-group  input-group-lg">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-addon">
                                                            <span class="glyphicon glyphicon-info-sign"></span>
                                                        </button>
                                                    </span>
                                                    {input}
                                                    <span class="input-group-btn">
                                                        <button type="button" data-toggle="modal" data-target="#passwdReset" class="btn btn-info" style="font-weight: bold" title = "Forgot your secrete answer?">
                                                            <span class="glyphicon glyphicon-question-sign"></span>
                                                        </button>
                                                    </span>
                                               </div>
                                               {error}{hint}
                                            '
                                            ]) 
                                            ->label(false)
                                            ->textInput(['placeholder' => 'Secrete answer'])
                                ?>
                                <?= $form->field($passwordResetForm, 'newPass', ['template' => 
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
                                            ->label(false)
                                            ->passwordInput(['placeholder' => 'New password'])
                                ?>
                                <?= $form->field($passwordResetForm, 'confirmNewPass', ['template' => 
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
                                            ->label(false)
                                            ->passwordInput(['placeholder' => 'Confirm new password']) 
                                ?>
                                <div class="form-group clearfix">
                                    <?= Html::submitButton('Reset password', ['class' => 'btn btn-info btn-lg pull-right ']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>

                            <div class="modal fade" id="passwdReset" tabindex="-1" role="dialog" aria-labelledby="Forgot secrete answer">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-rounded">
                                        <div class="modal-header bg-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-center" id="myModalLabel">Password reset by email</h4>
                                        </div>
                                        <?php $form = ActiveForm::begin(['action' => ['send-passwd-reset-mail']]); ?> 
                                            <div class="modal-body">
                                                <?= $form->field($passwordResetLinkForm, 'email', ['template' => 
                                                            '{label}
                                                                <div class="input-group input-group-lg">
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
                                                            ->label("Enter your email to recieve a password reset link. Email must be registered on " . Yii::$app->name)
                                                            ->textInput(['placeholder' => "Your email on " . Yii::$app->name])
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- button type="button" class="btn btn-default btn-round btn-lg" data-dismiss="modal">Close</button -->
                                                <?= Html::submitButton('Send link', ['class' => 'btn btn-info btn-lg']) ?>
                                            </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div><!-- passwordReset -->