<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Issabel - {$PAGE_NAME}</title>


	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/bootstrap.css">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-core.css">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-theme.css">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-forms.css">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/custom.css">
	<link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/purple-login.css">

	<!--[if lt IE 9]><script src="{$WEBPATH}themes/{$THEMENAME}/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

    {$HEADER_LIBS_JQUERY}
    <script src="{$WEBPATH}themes/{$THEMENAME}/js/lottie.min.js"></script>
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';

$(document).ready(function() {
    var anim;
    var animData = {
        container: document.getElementById('animIssabel'),
        renderer: 'svg',
        loop: false,
        autoplay: true,
        rendererSettings: {
            progressiveLoad: false
        },
        path: '{$WEBPATH}themes/{$THEMENAME}/images/animIssabel.json'
    };
    anim = bodymovin.loadAnimation(animData);
    anim.setSpeed(1.5);
});
</script>

<div class="login-container">

	<div class="login-header login-caret" style="padding:50px 0 10px 0;">

		<div class="login-content">

			<!--img src="{$WEBPATH}themes/{$THEMENAME}/images/issabel_logo_mini.png" width="200" height="62" alt="Issabel logo" /-->
            <div id="animIssabel" style='width:200px; height:200px; margin:auto;'></div>

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

						<input type="text" class="form-control" name="input_user" id="input_user" placeholder="{$USERNAME}" autocomplete="off" />
					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>

						<input type="password" class="form-control" name="input_pass" placeholder="{$PASSWORD}" autocomplete="off" />
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

				<a href="http://www.issabel.org" style="text-decoration: none;" target='_blank'>Issabel</a> {$ISSABEL_LICENSED} <a href="http://www.opensource.org/licenses/gpl-license.php" style="text-decoration: none;" target='_blank'>GPL</a>. 2006 - {$currentyear}.</div>

			</div>

		</div>

	</div>

</div>


	<!-- Bottom Scripts -->
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/gsap/main-gsap.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/bootstrap.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/joinable.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/resizeable.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-api.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/jquery.validate.min.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-login.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-custom.js"></script>
	<script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-demo.js"></script>

</body>
</html>
