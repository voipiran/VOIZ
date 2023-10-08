<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <title>{$PAGE_NAME} - VOIZ | VOIPIRAN
        </title>


        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/bootstrap.css">
        {*        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-core.css">
        *}       
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-theme.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-forms.css">
        {*        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/custom.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/purple-login.css">*}
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/style.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/custom.css">

        <!--[if lt IE 9]><script src="{$WEBPATH}themes/{$THEMENAME}/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        {$HEADER_LIBS_JQUERY}
    </head>
    <body class="page-body login-page login-form-fall" data-url="http://neon.dev">

        <div class="logovoiz">
            <a>
                <img class="img-responsive" src="themes/{$THEMENAME}/images/voiz2.png" />
            </a>
        </div>

        <!-- This is needed when you send requests via Ajax --><script type="text/javascript">
            var baseurl = '';
        </script>
        <div id="login">
            <div class="form-login-error">
                <h3>Invalid login</h3>
                <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
            </div>
            {* <h1><strong>Welcome.</strong> Please login.</h1>
            *}

            <form method="post">

                <fieldset>

                    <p>
                        <input type="text" class="form-control" name="input_user" id="input_user" placeholder="نام کاربری" autocomplete="off" />
                    </p> <!-- JS because of IE support; better: placeholder="Username" -->

                    <p>
                        <input type="password" class="form-control" name="input_pass" placeholder="رمز عبور" autocomplete="off" />

                    </p> <!-- JS because of IE support; better: placeholder="Password" -->

                    {*<p><a href="#">Forgot Password?</a></p>*}

                    {*  <button type="submit" class="btn btn-primary btn-block btn-login" name="submit_login">
                    {$SUBMIT}
                    </button>*}

                    <p><input name="submit_login" type="submit" value="ورود"></p>

                </fieldset>

            </form>



        </div> 
        {*<div class="login-container">
        
        <div class="login-header login-caret">

        <div class="login-content">

        <img src="{$WEBPATH}themes/{$THEMENAME}/images/issabel_logo_mini.png" width="200" height="62" alt="Issabel logo" />

        <p class="description"></p>

        <!-- progress bar indicator -->
        <div class="login-progressbar-indicator">
        <h3>43%</h3>
        <span>logging in...</span>
        </div>
        </div>

        </div>

        <div class="login-progressbar">
        <div></div>
        </div>

        <div class="login-form">

        <div class="login-content">


{if !empty({$LOGIN_INCORRECT})}
			<div class="form-login-error"><h3>{$LOGIN_INCORRECT}</h3></div>
			<script>$('.form-login-error').show();</script>
{/if}

        <form method="post">

        <div class="form-group">

        <div class="input-group">
        <div class="input-group-addon">
        <i class="entypo-user"></i>
        </div>

        <input type="text" class="form-control" name="input_user" id="input_user" placeholder="Username" autocomplete="off" />
        </div>

        </div>

        <div class="form-group">

        <div class="input-group">
        <div class="input-group-addon">
        <i class="entypo-key"></i>
        </div>

        <input type="password" class="form-control" name="input_pass" placeholder="Password" autocomplete="off" />
        </div>

        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-login" name="submit_login">
        <i class="entypo-login"></i>
        {$SUBMIT}
        </button>
        </div>

        </form>


        <div class="login-bottom-links">

        <a href="http://www.voipiran.io" style="text-decoration: none;" target='_blank'>VOIZ | VOIPIRAN</a> is licensed under <a href="http://www.opensource.org/licenses/gpl-license.php" style="text-decoration: none;" target='_blank'>GPL</a>. 2006 - {$currentyear}.</div>

        </div>

        </div>


        </div>*}

        <div class="fotter">
            <div class="copyr">
                <p>
                    Copyrights © 2017-2023 All Rights Reserved by <a href="http://www.voipiran.io">VOIPIRAN | ویپ ایران</a>
                </p>  
            </div>
        </div>

	<!-- Bottom Scripts -->
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/gsap/main-gsap.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/bootstrap.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/joinable.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/resizeable.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/neon-api.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/jquery.validate.min.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/neon-login.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/neon-custom.js"></script>
	<script type='text/javascript' src="{$WEBPATH}themes/{$THEMENAME}/js/neon-demo.js"></script>

    </body>
</html>
