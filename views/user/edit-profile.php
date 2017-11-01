<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Countries;

$this->title = "Edit your profile";
?>

<div class="row" style="padding: 10px">
	<div class="col-md-10 col-md-offset-1">
		<div class="row onback">
			<b><p class="text-center shawsubAbt"><?= $this->title ?></p></b>
		</div>	
		<div class="bg-success row onmiddle">
			<div class="col-md-10 col-md-offset-1 ontop">
				<div class="row">
					<div class="col-md-10 col-md-offset-1"><br />
		                <?php if (Yii::$app->session->hasFlash('editSuccess')): ?>
	                                <div class="alert alert-info alert-dismissible" role="alert">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                        <span aria-hidden="true">&times;</span>
	                                    </button>
	                                    Profile successfully updated!
	                                </div>
	                        <?php endif; ?>
	                        <?php if (Yii::$app->session->hasFlash('exist')): ?>
	                                <div class="alert alert-danger alert-dismissible" role="alert">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                        <span aria-hidden="true">&times;</span>
	                                    </button>
	                                    <?= Yii::$app->session->getFlash('exist') ?>
	                                </div>
	                        <?php endif; ?>
	                        <?php if (Yii::$app->session->hasFlash('editFail')): ?>
	                                <div class="alert alert-danger alert-dismissible" role="alert">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                        <span aria-hidden="true">&times;</span>
	                                    </button>
	                                    Sorry, your profile could not be updated due to a system error.<br />Try again
	                                </div>
	                        <?php endif; ?>
			                <?php $form = ActiveForm::begin(); ?>
						        <?= $form->field($editProfileForm, 'userName', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . Yii::$app->user->identity->userName . '</span></b>
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
						        	->textInput(['autofocus' => true, 'value' => Yii::$app->user->identity->userName, 'placeholder' => 'Your name', 'maxlength' => true]) 
						        ?>
						        <?= $form->field($editProfileForm, 'email', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . Yii::$app->user->identity->email . '</span></b>
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
						        	->textInput(['value' => Yii::$app->user->identity->email, 'placeholder' => 'Your email', 'maxlength' => true]) 
						        ?>
						        <?php
						        	//gettx user's country
						        	$country = Countries::findOne(Yii::$app->user->identity->country);
						        ?>
						        <?= $form->field($editProfileForm, 'country', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . $country->country_name . '</span></b>
                                       <div class="input-group  input-group-lg">
                                          <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-addon">
                                                <span class="glyphicon glyphicon-globe"></span>
                                            </button>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '
                                    ]) 
						        	->dropdownList(
	                                    Countries::find()->select(['country_name', 'id'])->indexBy('id')->column(),
	                                    ['value' => Yii::$app->user->identity->country]
	                                )
                                ?>
						        <?= $form->field($editProfileForm, 'phoneNumber', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . Yii::$app->user->identity->phoneNumber . '</span></b>
                                       <div class="input-group  input-group-lg">
                                          <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-addon">
                                                <span class="glyphicon glyphicon-earphone"></span>
                                            </button>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '
                                    ])
                                    ->textInput(['value' => Yii::$app->user->identity->phoneNumber, 'placeholder' => 'Your phone number', 'maxlength' => true])  
						        ?>
						        <?= $form->field($editProfileForm, 'secreteQtn', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . Yii::$app->user->identity->secreteQtn . '</span></b>
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
						        	->dropdownlist(['1' => 'Your best course ever', '2' => 'Your worst course ever',
	                                    '3' => 'Your best friend ever', '4' => 'Your best lecturer',
	                                    '5'=>'Your worst lecturer', '6'=>'Your worst experience in one word'], 
	                                    ['value' => Yii::$app->user->identity->secreteQtn]
	                                )  
						        ?>
						        <?= $form->field($editProfileForm, 'secreteAns', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">' . Yii::$app->user->identity->secreteAns . '</span></b>
                                       <div class="input-group  input-group-lg">
                                          <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-addon">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '
                                    ])
                                    ->textInput(['value' => Yii::$app->user->identity->secreteAns, 'placeholder' => 'Secrete answer', 'maxlength' => true])  
						        ?>
						        <?= $form->field($editProfileForm, 'userUrl', ['template' => 
                                    '{label}:  <b><span class="fg-site" style="font-size: 1.5em">http://www.twided.com/' . Yii::$app->user->identity->userUrl . '</span></b>
                                       <div class="input-group  input-group-lg">
                                          <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-addon">
                                                http://www.twided.com/
                                            </button>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '
                                    ])
                                    ->textInput(['value' => Yii::$app->user->identity->userUrl, 'placeholder' => 'Profile url', 'maxlength' => true])  
						        ?>
						        <?= $form->field($editProfileForm, 'profilePic') 
						        	->fileInput(['accept' => 'image/*'])	
						        ?>
						        <div class="form-group clearfix">
						            <?= Html::submitButton('Save changes', ['class' => 'btn btn-info btn-lg pull-right']) ?>
						        </div>
					    	<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		