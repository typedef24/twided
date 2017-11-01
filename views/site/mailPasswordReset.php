<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\editProfile */
/* @var $form ActiveForm */

$this->title = 'Password reset';
?>

<div class="row" style="padding: 10px">
    <div class="col-md-8 col-md-offset-2">
        <div class="row onback">
            <b><p class="text-center shawsubAbt"><?= $this->title ?></p></b>
        </div>        
        <div class="bg-success row onmiddle">
            <div class="col-md-10 col-md-offset-1 ontop">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1"><br />
                        <?php if (Yii::$app->session->hasFlash('dangerFlash')): ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?= Yii::$app->session->getFlash('dangerFlash') ?>
                                </div>
                        <?php endif; ?>

                        <?php $form = ActiveForm::begin(['action' => ['mail-password-reset-form-handler']]); ?> 
                            <?= $form->field($mailPasswordResetForm, 'newPass', ['template' => 
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
                                        ->passwordInput(['placeholder' => 'New password', 'autofocus' => true])
                            ?>
                            <?= $form->field($mailPasswordResetForm, 'confirmNewPass', ['template' => 
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
                            <?= $form->field($mailPasswordResetForm, 'email') 
                                        ->label(false)
                                        ->hiddenInput(['value' => $email])
                            ?>
                            <div class="form-group clearfix">
                                <?= Html::submitButton('Reset password', ['class' => 'btn btn-info btn-lg pull-right ']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>