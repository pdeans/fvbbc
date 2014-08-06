<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body style="background:#e5e5e5;">
        <div style="width:600px;margin:15px auto;">
            <div style="display:inline;padding-right:10px;">
                <img src="{{ asset('static/img/email-logo.png') }}" alt="FVBBC Logo">
                <h3 style="display:inline;padding-left:190px;font-size:30px;font-family:'Korolev-Bold','HelveticaNeue-CondensedBold','ArialNarrow-Bold','Helvetica Neue',Helvetica,Arial,sans-serif;color:#222;">FVBBC Admin</h3>
            </div>
            <div style="margin-top:15px;margin-bottom:15px;padding:15px;border:1px solid #c5c5c5;background:#fff;color:#333;">
                <p>Hello {{ $username }},</p><br>
                <p>
                    Welcome to the &#35;FVBBC Family!<br><br>
                    Please activate your account using the follow link:
                </p>
                <p>
                    {{ $link }}
                </p>
            </div>
            <p style="padding:20px;text-align:center;color:#222;">
                &copy; 2014 FVBBC
            </p>
        </div>
    </body>
</html>
