<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Change your password";
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
		          <?php if (Yii::$app->session->hasFlash('successful')): ?>
		              <div class="alert alert-info">
		                  Password successfully changed!
		              </div>
		          <?php endif; ?>
              <?php if (Yii::$app->session->hasFlash('incorrectCurPass')): ?>
                  <div class="alert alert-danger">
                      Incorrect current password!
                  </div>
              <?php endif; ?>
			            <?php $form = ActiveForm::begin(); ?>
			                	<?= $form->field($changePasswordForm, 'currentPassword', ['template' => 
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
			                		->passwordInput(['placeholder' => 'Current password', 'autofocus' => true])
						        ?>
						        <?= $form->field($changePasswordForm, 'newPassword', ['template' => 
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
						        	->passwordInput(['placeholder' => 'New password'])
						        ?>
						        <?= $form->field($changePasswordForm, 'confirmNewPassword', ['template' => 
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
						        	->passwordInput(['placeholder' => 'Confirm new password'])
						        ?>
						        <div class="form-group clearfix">
						            <?= Html::submitButton('Change password', ['class' => 'btn btn-info btn-lg pull-right']) ?>
						        </div>
					    <?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		