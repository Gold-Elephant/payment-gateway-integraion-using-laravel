<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Form</title>
</head>
<body>

  <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$resData->id}}"></script>

  <form action="{/hyperpay/finalize}" class="paymentWidgets" data-brands="VISA MASTER MADA"></form> 

</body>
</html>