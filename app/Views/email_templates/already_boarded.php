<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Data Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        .no-data {
            margin: 50px;
            padding: 20px;
            border-radius: 5px;
        }

        .no-data h2 {
            color: #555;
        }

        .site-logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body style="background:#000000;">
    <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" alt="Site Logo" class="site-logo" style="width:200px">
    <div class="no-data">
        <h2 style="color:#ffffff;">The Merchant Onboarding link has expired. Please reach out to the admin to regenerate the link.Should you have any other questions, feel free to reach out to our support team by email at support@payme.limo or call us by phone at (818) 572-2525. Thank you!</h2>
        <!-- You can add additional content or links here as needed -->
    </div>
</body>

</html>