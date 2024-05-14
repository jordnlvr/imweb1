<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;

            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            height: auto;
            margin-left: auto;
            margin-right: auto;
        }

        .content {
            text-align: center;
            margin-top: 20px;
        }

        .message {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888888;
        }

        p {
            color: #ffffff;
        }

        .footer p {
            color: #888888;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888888;
        }
    </style>
</head>

<body style="background:#000000;">

    <div class="container">
        <div class="logo text-center">
            <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" style="width:260px;" width="260">
        </div>

        <div class="content">
            <h2 class="message">Reset Password</h2>
            <p>Please use this one time verification code to reset your password for Payme.Limo account.
            </p>
            <div style="width:200px;font-family: 'Roboto', sans-serif; font-size: 30px; font-weight:400; color: #000000; line-height: 45px;height: 45px;background-color: #e4c9aa;display: inline-block;border-radius: 5px;">
                <?= ($otp ? $otp : ''); ?>
            </div>


        </div>

        <div class="footer">
            <p>If you have any questions or concerns, please contact Payme.Limo support team.</p>
        </div>
    </div>
</body>

</html>