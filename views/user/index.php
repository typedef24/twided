<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->user->identity->userName;
?>

<div class="row">
	<div class="col-md-4">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  	<div class="panel panel-site transparent">
		  		<a class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" 
                   aria-expanded="true" aria-controls="collapseOne" style = 'display: block; text-decoration: none' title = 'My classes'>
                    <h1 class="panel-title">
	                    <?= Html::img('@web/images/group.png', ["style" => "margin-right: 5px"]) ?>
	                    <b>My Classes</b>
	                </h1>    
                </a>
		    	<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		      		<div class="panel-body">
		        		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-site transparent">
			    <a class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" 
                   aria-expanded="true" aria-controls="collapseTwo" style = 'display: block; text-decoration: none' title = 'My study groups'>
                    <h1 class="panel-title">
	                    <?= Html::img('@web/images/group.png', ["style" => "margin-right: 5px"]) ?>
	                    <b>My Study Groups</b>
	                </h1>    
                </a>
			    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			      	<div class="panel-body">
			        	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      	</div>
			    </div>
		  	</div>
		  	<div class="panel panel-site transparent">
		  		<a class="panel-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" 
                   aria-expanded="true" aria-controls="collapseThree" style = 'display: block; text-decoration: none' title = 'Class/Group Members'>
                    <h1 class="panel-title">
	                    <?= Html::img('@web/images/group.png', ["style" => "margin-right: 5px"]) ?>
	                    <b>Class/Group Members</b>
	                </h1>    
                </a>
			    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
			      	<div class="panel-body">
			        	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      	</div>
			    </div>
		  	</div>
		</div>
		<div class="alert alert-info welcome collapse">
		    <b>Welcome <?= Yii::$app->user->identity->userName ?></b>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-site transparent chat">
			<a class="panel-heading" href="#collapseThree" style = 'display: block; text-decoration: none' title = 'Click to see details'>
                <div class="media">
				  	<div class="media-left">
					    <?= Html::img("@web/images/css-logo.png", ['class' => 'profilePic img-circle media-object']) ?>
				  	</div>
				  	<div class="media-body">
				    	<b><h3 class="media-heading">Human computer interaction</h3></b>
				    	Typedef24, Ewang Clarkson, Nges Brian, ...
				    	Click for more details
				  	</div>
				</div>   
            </a>
			<div class="panel-body" style="height: 60vh">
			    <p class="text-center text-danger">No messages!!</p>
			</div>
			<div class="panel-footer">
				<?= Html::beginForm(Url::to(['site/search']), 'get', ['class' => '', 'role' => "search"]); ?>  
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Type message">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit">
                                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div><!-- /input-group -->                
                <?= Html::endForm(); ?>
			</div>
		</div>

		<div class="panel panel-site transparent info collapse">
			<div class="panel-heading">
				<h1 class="panel-title text-center">
					<b><span class='glyphicon glyphicon-arrow-left pull-left back' style="font-size:2.0em; cursor: pointer" title="Go back to chat"></span>
					<span class="shawsubAbt">Class info</span></b>
				</h1>  
            </div>
			<div class="panel-body">
			    Panel content
			</div>
			<div class="panel-footer">
				Panel footer
			</div>
		</div>
	</div>
</div>