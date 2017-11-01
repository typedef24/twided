<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">
    <div class="row" style="padding: 10px">
        <div class="col-md-10 col-md-offset-1">
            <div class="row onback" style="background-color: #f2dede;">
                <b><p class="text-center shawsubAbt" style="color: red;"><?= $this->title ?></p></b>
            </div>  
            <div class="bg-success row onmiddle">
                <div class="col-md-10 col-md-offset-1 ontop">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h3 class="errormessage" >
                                <?= nl2br(Html::encode($message)) ?>
                            </h3>
                            <p class="lead">
                              The above error occurred while the Web server was processing your request.
                              Please 
                              <?= Html::a('Contact Us', ['site/contact']) ?>
                              if you think this is a server error. Thank you.
                            </p>
                            <div class = "row">
                              <div class="col-md-4 col-md-offset-4 clearfix"> 
                                <?= Html::a("<span class='glyphicon glyphicon-arrow-left' style='font-size: 1.5em'></span> <span style='font-size: 1.5em'>Back</span>", 
                                      Url::previous(), 
                                      ['class' => 'btn btn-info btn-lg btn-block']) 
                                ?>
                              </div>
                            </div>
                            <br /> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
