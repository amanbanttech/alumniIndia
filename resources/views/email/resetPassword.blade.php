<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$pageTitle ?? 'Alumni Connect'}}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>

<body style="background-color: #e4e4e494;">
    <table style="width: 50%;padding: 30px;
    margin: auto; background-color: #fff;">
        <thead style="width:100%;">
            <tr>
               <th style="border-bottom: 2px solid #3871c1;"><a href="{{url('/')}}"><img
                            src="{{url('frontend_assets/images/logo-clinica.png')}}" alt=""></a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h4 style="font-size: 28px;font-family: 'Roboto';color: #0a9bd2;font-weight: 700;margin: 15px 0;">
                        Alumni Connect: {{ucWords($name)}}!</h4>
                </td>
            <tr>

                <td style="font-size: 16px;font-family: 'Roboto';color: #111111;font-weight: normal;line-height: 24px;">
                    Recentemente solicitou a redefinição da palavra-passe da sua conta na Genome.
                    Por favor, clique no link abaixo para redefinir a sua palavra-passe:
                    
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>

            <tr>

                <td>
                    <a href="{{url('/admin/reset-password'.'/'.$token)}}" style="background: #3871c1;padding: 4px 18px;border-radius: 10px; margin:0px;font-size: 18px;color: #fff;letter-spacing: .8px;text-decoration:none">Click To Reset Password</a>

                </td>


            </tr>

        </tbody>
    </table>
</body>

</html>
