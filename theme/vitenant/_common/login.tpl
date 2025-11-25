<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <title>{$PAGE_NAME} - VOIZ | VOIPIRAN</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/bootstrap.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-theme.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-forms.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/style.css">
        <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/custom.css">

        <!--[if lt IE 9]><script src="{$WEBPATH}themes/{$THEMENAME}/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        {$HEADER_LIBS_JQUERY}

        <!-- تغییرات: فقط وسط کردن کامل + شیشه‌ای + لوگو کوچک -->
        <style>
            /* پس‌زمینه: تصویر کوه و غروب */
            body.login-page {
                background: url('{$WEBPATH}themes/{$THEMENAME}/images/background.jpg') no-repeat center center fixed;
                background-size: cover;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                padding: 20px 20px 40px; /* فضای کافی برای فوتر */
                flex-direction: column; /* برای وسط کردن عمودی */
            }

            /* کانتینر اصلی: شامل لوگو + فرم + فوتر */
            .login-wrapper {
                width: 100%;
                max-width: 380px;
                display: flex;
                flex-direction: column;
                align-items: center; /* وسط افقی */
            }

            /* باکس شیشه‌ای فرم */
            #login {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 18px;
                padding: 36px 30px;
                width: 100%;
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            }

            /* لوگو: کوچک + وسط */
            .logovoiz {
                text-align: center;
                margin-bottom: 22px;
                width: 100%;
            }
            .logovoiz img {
                width: 110px;
                height: auto;
            }

            /* RTL برای متن */
            .form-control, input[type="submit"] {
                text-align: right;
                direction: rtl;
            }

            /* دکمه ورود: متن وسط */
            input[name="submit_login"] {
                display: block;
                width: 100%;
                text-align: center !important;
            }

            /* خطای لاگین */
            .form-login-error {
                background: rgba(254, 226, 226, 0.9);
                color: #991b1b;
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 18px;
                font-size: 0.9rem;
                display: none;
                backdrop-filter: blur(4px);
            }
            .form-login-error.show {
                display: block;
            }

            /* فوتر: وسط + فاصله از باکس */
            .fotter {
                text-align: center;
                margin-top: 32px; /* فاصله بیشتر از باکس */
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.9);
                width: 100%;
            }
            .fotter a {
                color: #e0f2ff;
                text-decoration: none;
            }
            .fotter a:hover {
                text-decoration: underline;
            }

            /* ریسپانسیو: در موبایل فوتر نزدیک‌تر نباشد */
            @media (max-width: 480px) {
                .fotter {
                    margin-top: 24px;
                }
            }
        </style>
    </head>
    <body class="page-body login-page login-form-fall" data-url="http://neon.dev">

        <!-- کانتینر اصلی: لوگو + فرم + فوتر -->
        <div class="login-wrapper">

            <!-- لوگو -->
            <div class="logovoiz">
                <a>
                    <img class="img-responsive" src="themes/{$THEMENAME}/images/voiz2.png" alt="VOIZ Logo" />
                </a>
            </div>

            <!-- فرم لاگین -->
            <div id="login">
                <div class="form-login-error" id="login-error">
                    <h3>ورود ناموفق</h3>
                    <p>نام کاربری یا رمز عبور اشتباه است.</p>
                </div>

                <form method="post" id="login-form">
                    <fieldset>
                        <p>
                            <input type="text" class="form-control" name="input_user" id="input_user" placeholder="نام کاربری" autocomplete="off" />
                        </p>
                        <p>
                            <input type="password" class="form-control" name="input_pass" placeholder="رمز عبور" autocomplete="off" />
                        </p>
                        <p>
                            <input name="submit_login" type="submit" value="ورود">
                        </p>
                    </fieldset>
                </form>
            </div>

            <!-- فوتر -->
            <div class="fotter">
                <div class="copyr">
                    <p>
                        Copyrights © 2017-2023 All Rights Reserved by <a href="http://www.voipiran.io">VOIPIRAN | ویپ ایران</a>
                    </p>  
                </div>
            </div>

        </div>

        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
            var baseurl = '';
        </script>

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

        <!-- نمایش خطا -->
        <script type="text/javascript">
            $(document).ready(function() {
                {if !empty($LOGIN_INCORRECT)}
                    $('#login-error').addClass('show');
                {/if}
            });
        </script>

    </body>
</html>