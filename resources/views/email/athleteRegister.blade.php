<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AlumniIndia - Welcome</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif !important;
            background-color: #f2fafc;
        }

        table,
        td,
        tr {
            vertical-align: top;
            border-collapse: collapse;
        }
        * {
            line-height: inherit;
        }
        .btn-primary {
            display: inline-block;
            background: #000;
            color: #ffffff !important;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 20px 0;
        }

        .btn-primary:hover {
            background: #000;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                max-width: 100% !important;
            }

            .content-padding {
                padding: 15px !important;
            }

            .header-logo {
                width: 100px !important;
            }

            .greeting {
                font-size: 18px !important;
            }

            .text-content {
                font-size: 15px !important;
            }

            .details-box {
                padding: 15px !important;
            }

            .section-title {
                font-size: 18px !important;
            }

            .btn-primary {
                padding: 12px 20px !important;
                font-size: 14px !important;
                display: block !important;
                width: 90% !important;
                margin: 15px auto !important;
            }

            .flex-header {
                display: block !important;
                text-align: center !important;
            }

            .flex-header>div {
                margin: 10px 0 !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #e3e3e3;">
    <table cellpadding="0" cellspacing="0" role="presentation"
        style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; background-color: #e3e3e3; width: 100%;"
        width="100%">
        <tbody>
            <tr>
                <td style="word-break: break-word; vertical-align: top; padding: 20px 10px;">
                    <!-- Header -->
                    <div class="email-container"
                        style="    background-color: #004592;min-width:320px;max-width:654px;margin:0 auto;border-radius:8px 8px 0 0; padding:12px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="flex-header"
                                                    style="display: flex; align-items: center; justify-content: space-between;">
                                                    <div style="width:100%; text-align:center;">
                                                        <a href="{{ route('frontend.index') }}" target="_blank">
                                                            <img class="header-logo"
                                                                src="https://staging.alumniindia.com/frontend_assets/images/logo-white.png"
                                                                alt="Alumni Logo" width="120">
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Main Content -->
                    <div class="email-container"
                        style="background-color: #fff; min-width: 320px; max-width: 680px; margin: 0 auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td class="content-padding" style="padding: 30px 25px;">
                                        <div style="text-align: left;">
                                            <p class="greeting"
                                                style="margin: 0 0 10px 0; font-family: 'Roboto', sans-serif; font-size:19px; color: #1c1c1c; font-weight: 600;">
                                                Dear {{ ucfirst($name) }},
                                            </p>
                                            <p class="text-content"
                                                style="font-family: 'Roboto', sans-serif;     font-size: 14px; color: #2c2c2c;
                                                 line-height: 26px; margin: 7px 0;">
                                               We are pleased to inform you that your athlete profile has been successfully added to the platform.
                                            <br>You can now access your athlete dashboard using the login credentials provided below:
                                            </p>
                                        </div>

                                        <!-- Account Details Box -->
                                        <div class="details-box" style="background: #e3e3e3;
    border: 1px solid #000;
    padding: 25px;
    margin: 25px 0;
    border-radius: 8px;">
                                  

                                            <table style="width: 100%; margin-bottom: 10px;">
                                                <tr>
                                                    <td
                                                        style="padding: 10px 0; font-size: 15px; color: 
                                                        #2c2c2c; border-bottom: 1px solid #e0e0e0;">
                                                        <strong style="color: #000;">Email:</strong>
                                                        <span style="float: right; color: #1c1c1c;">{{ $email }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 10px 0; font-size: 15px; color: #2c2c2c;">
                                                        <strong style="color: #000;">Phone:</strong>
                                                        <span style="float: right; color: #1c1c1c;">{{ $phone }}</span>
                                                    </td>
                                                </tr>
                                            </table>

                                            <!-- Start Shopping Button -->
                                            <div style="text-align: center; margin: 30px 0 10px 0;">
                                                <a href="{{ $loginUrl }}" class="btn-primary" style="    display: inline-block;
    background: #004592;
    color: #ffffff !important;
    padding: 10px 19px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    font-size: 14px;">
                                                   Click here to Login
                                                </a>
                                            </div>
                                        </div>

                                        <p style="    font-size: 14px;
    color: #2a2a2a;
    line-height: 26px;
    margin: 20px 0 0 0;">
                                            You can log in using your registered mobile number and OTP for quick and secure access.
                                            <br>
                                            Through your athlete dashboard, you will be able to manage your profile, update  information, and access platform features.
                                            <br><br>
                                            If you have any questions or need assistance, please feel free to contact our support team.
                                            <br>
                                            Welcome aboard, and we look forward to supporting your alumni network.
                                        </p>

                                        <div
                                            style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                                            <p style="font-size: 17px; color: #121212; font-weight: 500; margin: 0;">
                                                Team,</p>
                                            <p
                                                style="font-size: 18px; color:#004592; font-weight: 600; margin: 5px 0 0 0;">
                                                AlumniIndia 
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="email-container"
                        style="background-color: #004592; min-width: 320px; max-width: 680px;    margin-top: -22px; margin: 0 auto; border-radius: 0 0 8px 8px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td
                                        style="    padding: 0px;text-align:center;color:#fff;font-weight:400;font-size:13px;line-height:20px">
                                        <p style="color: #ffffff;font-size: 15px;font-weight:500;">
                                            © {{ date('Y') }} AlumniIndia. All rights reserved.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>