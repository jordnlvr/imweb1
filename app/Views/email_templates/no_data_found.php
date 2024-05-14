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
            color: #ffffff;
            border-radius: 5px;
        }

        .no-data h2 {
            color: #ffffff;
        }

        .site-logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body style="background:#000000;">
    <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" alt="Site Logo" class="site-logo" style="width:260px;" width="260">
    <div class="no-data">
        <h2>No Data Found</h2>
        <p>Sorry, but there is no data available at the moment.</p>
        <!-- You can add additional content or links here as needed -->
    </div>
</body>

</html>