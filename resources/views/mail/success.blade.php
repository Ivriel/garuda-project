<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F6FD;
            color: #333;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #0068FF;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
        }

        .highlight {
            background-color: #D4D1FE;
            padding: 5px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <h1>Transaction Successful</h1>
    <p>Dear <span class="highlight">{{ $transaction->name }}</span>,</p>
    <p>Your transaction (Code: <span class="highlight">{{ $transaction->code }}</span>) has been successful. Please find
        your boarding pass
        attached.</p>
    <p>Thank you for choosing us!</p>
</body>

</html>