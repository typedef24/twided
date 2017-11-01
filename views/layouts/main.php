<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

Url::remember();    //remember current url

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Social media for education">
        <meta name="keywords" content="FSA, course, school, ub, ub forefox club, university, study groups, classrooms, student">
        <meta name="author" content="Ub firefox club">
        <link rel="icon" type="image/jpeg" href = "<?=  Url::to('@web/images/edu.jpeg') ?>">
        <?= Html::csrfMetaTags() ?>
        <title>
            <?= Html::encode($this->title) ?>
            <?= ($this->title != Yii::$app->name) ? ' @ ' . Yii::$app->name : '' ?>    
        </title>
        <?php $this->head() ?>
        <?php $this->registerJsFile('@web/js/site.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    </head>

    <?php
        if(Yii::$app->user->isGuest || 
            $this->context->action->id == 'contact' || 
            $this->context->action->id == 'about' || 
            $this->context->action->id == "help" ||
            $this->context->action->id == "terms" ||
            $this->context->action->id == "change-pass" ||
            $this->context->action->id == "edit-profile" ||
            $this->context->action->id == "error"){
            $background = 'portalBg';
            $footerColor = 'fg-white';
        }
        else{
            $background = 'homeBg';
            $footerColor = 'fg-site';
        }
    ?>

    <body id="<?= $background ?>">
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
                NavBar::begin([
                    'brandLabel' => Html::img('@web/images/edu.jpeg', ['style' => 'margin-right: 5px', 'class'=>'img-responsive img-rounded logo pull-left']) . "<span class='shawsub'>" . Yii::$app->name . "</span>",
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top bg-site'
                    ],
                ]);
            ?>
            <?php if(Yii::$app->user->isGuest): ?>
                <?= 
                    Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                            ['label' => 'Home', 'url' => ['/site/index']],
                            ['label' => 'Terms', 'url' => ['/site/terms']],
                            ['label' => 'About', 'url' => ['/site/about']],
                            ['label' => 'Contact', 'url' => ['/site/contact']],
                            ['label' => 'Help', 'url' => ['/site/help']],
                        ]
                    ]);
                ?>
            <?php else: ?>
                <?= Html::beginForm(Url::to(['site/search']), 'get', ['class' => 'navbar-form navbar-left', 'role' => "search"]); ?>  
                    <div class="input-group searchIn">
                        <input type="text" class="form-control" placeholder="Search <?= Yii::$app->name ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-search" style="font-size: small" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div><!-- /input-group -->                
                <?= Html::endForm(); ?>
                <?= 
                    Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                            Html::a('<span class="badge" style = "background-color: red; margin-top: -25px; margin-left: -15px">'. 5 .'</span>', 
                                    ['', '#' => 'showInvitations'], [
                                        'type' => 'button', 
                                        'data-toggle' => 'popover', 
                                        'data-placement' => "bottom",
                                        'data-container' => "body",
                                        'data-content' => 'And here\'s some amazing content. It\'s very engaging. Right?',
                                        'class'=>'navItem glyphicon glyphicon-envelope', 
                                        'id' => 'invits', 
                                        'title' => 'Your invitations', 
                                        'style' => 'margin-left: 15px;'
                                    ]),
                            Yii::$app->user->identity->userType == 'S' ? (
                                Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-top: -10px"></span>' . Html::img("@web/images/group.png", ['class' => 'logo']), 
                                    ['', '#' => 'createStudyGroup'], ['class'=>'navItem', 'id' => 'createGroup', 'title' => 'Create a study group', 'style' => 'margin-left: 15px;'])
                            ) : (
                                '<li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle navLink createMenu" style="padding-bottom: 0px; font-size: 1.5em; color: white" title = "Create a class or study group" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-top: -20px"></span>' .
                                        Html::img("@web/images/group.png", ['class' => 'logo'])
                                    . '</a>
                                    <ul class="dropdown-menu dropdown-menu-left createMenu">
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-plus" style="margin-right: 5px"></span>Class',
                                                    ['', '#' => 'createClass'], ['title' => 'Create a class', 'id' => 'createClass'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-plus" style="margin-right: 5px"></span>Study group',
                                                    ['', '#' => 'createStudyGroup'], ['title' => 'Create a study group', 'id' => 'createGroup'])
                                        . '</li>
                                        <li>
                                    </ul>
                                </li>'
                            ),
                            file_exists(Yii::$app->basePath . "/web/users/" . Yii::$app->user->identity->userUrl . "/profilePic/current") && 
                            is_file(Yii::$app->basePath . "/web/users/" . Yii::$app->user->identity->userUrl . "/profilePic/current") ? (
                                '<li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle navLink" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" 
                                        title="' . Yii::$app->user->identity->userName . '" style="padding-bottom: 0px;">' .
                                        Html::img("@web/users/" . Yii::$app->user->identity->userUrl . "/profilePic/current", ['class' => 'logo img-circle']) 
                                    . '</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-user" style="margin-right: 5px"></span>My profile',
                                                    ['user/index'], ['title' => 'My profile'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-edit" style="margin-right: 5px"></span>Edit profile',
                                                    ['user/edit-profile'], ['title' => 'Edit your profile'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-lock" style="margin-right: 5px"></span>Change password',
                                                    ['user/change-pass'], ['title' => 'Change your password'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-log-out" style="margin-right: 5px"></span>Sign out', 
                                                    ['site/logout'], [
                                                        'data' => [
                                                            'method' => 'post',
                                                        ],
                                            ])
                                        . '</li>
                                    </ul>
                                </li>'
                            ) : ( 
                                '<li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle navLink" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" 
                                        title="' . Yii::$app->user->identity->userName . '" style="padding-bottom: 0px;">' .
                                        Html::img("@web/images/current", ['class' => 'logo img-circle']) 
                                    . '</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-user" style="margin-right: 5px"></span>My profile',
                                                    ['user/index'], ['title' => 'My profile'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-edit" style="margin-right: 5px"></span>Edit profile',
                                                    ['user/edit-profile'], ['title' => 'Edit your profile'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-lock" style="margin-right: 5px"></span>Change password',
                                                    ['user/change-pass'], ['title' => 'Change your password'])
                                        . '</li>
                                        <li>' . 
                                            Html::a('<span class="glyphicon glyphicon-sm glyphicon-log-out" style="margin-right: 5px"></span>Sign out', 
                                                    ['site/logout'], [
                                                        'data' => [
                                                            'method' => 'post',
                                                        ],
                                            ])
                                        . '</li>
                                    </ul>
                                </li>'
                            ),  
                        ],
                    ])
                ?> 
            <?php endif; ?>       
            <?php    
                NavBar::end();
            ?>

            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div id="google_translate_element"></div>
                        <script type="text/javascript">
                            function googleTranslateElementInit() {
                              new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'fr,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
                            }
                        </script>
                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center lead <?= $footerColor ?>"><b>
                            <?= Html::a("<span>&copy; " . Yii::$app->name . " " . date('Y') . "</span>", Yii::$app->homeUrl, 
                                ['title' => Yii::$app->name, 'class' => $footerColor]) 
                            ?> |
                            <?= Html::a('Terms', ['site/terms'], 
                                ['title' => Yii::$app->name . "'s terms and conditions of service", 'class' => $footerColor]) 
                            ?> |
                            <?= Html::a('About', ['site/about'], 
                                ['title' => 'About us', 'class' => $footerColor]) 
                            ?> |
                            <?= Html::a('Contact', ['site/contact'], 
                                ['title' => 'Contact us', 'class' => $footerColor]) 
                            ?> |
                            <?= Html::a('Help', ['site/help'], 
                                ['title' => 'How to use ' . Yii::$app->name, 'class' => $footerColor]) 
                            ?></b>
                        </p>    
                    </div>
                    <div class="col-md-3">
                        <p class="lead <?= $footerColor ?>">
                            <b><?= Html::a('ABEBOH ', 'http://abeboh.org', ['target'=>'_blank', 'class' => $footerColor]) ?> - <i>powered</i></b>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
