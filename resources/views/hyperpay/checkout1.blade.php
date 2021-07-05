<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Album example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/notifications.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/album.css" rel="stylesheet">
    <link href="/custom.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navbar box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img style="width: 100px" src="/assets/img/hyper.png" alt="hyper-logo"/>
                </a>
            </div>
        </div>
    </header>
    <main class="album py-5 bg-light" role="main">
        <section class="text-center">
            <div class="container">
                <h1 style="margin-bottom: 50px;">Payments Method</h1>
                <form class="row" style="justify-content: space-between;">
                    <div class="row-md-2">
                        <input type="radio" name="method" id="visa" value="visa" data-brands="VISA MASTER"/>
                        <label class="item visa" for="visa"></label>
                    </div>
                    <div class="row-md-2">
                        <input type="radio" name="method" id="apple" value="apple" data-brands="APPLEPAY"/>
                        <label class="item apple" for="apple"></label>
                    </div>
                    <div class="row-md-2">
                        <input type="radio" name="method" id="google" value="google" data-brands="GOOGLEPAY"/>
                        <label class="item google" for="google"></label>
                    </div>
                    <div class="row-md-2">
                        <input type="radio" name="method" id="stc" value="stc" data-brands="STC_PAY"/>
                        <label class="item stc" for="stc"></label>
                    </div>
                    <div class="row-md-2">
                        <input type="radio" name="method" id="paypal" value="paypal" data-brands="PAYPAL_CONTINUE"/>
                        <label class="item paypal" for="paypal"></label>
                    </div>
                    <div class="row-md-2">
                        <input type="radio" name="method" id="mada" value="mada" data-brands="MADA"/>
                        <label class="item mada" for="mada"></label>
                    </div>
                    <input type="submit" id="submit">
                </form>
            </div>
        </section>
    </main>

    <footer class="text-muted">
        
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="APPLEPAY"></form> -->
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="GOOGLEPAY"></form> -->
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="PAYPAL_CONTINUE"></form> -->
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="STC_PAY"></form> -->
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="MADA"></form> -->
        <!-- <form action="/hyperpay/result" class="paymentWidgets" data-brands="VISA MASTER"></form> -->
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script id="checkout_script"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="/assets/js/vendor/popper.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
    <script src="/assets/js/vendor/holder.min.js"></script>
    <script src="/js/notifications.js"></script>

    <script>
        @if(session("message"))
        var message = '{{session("message")}}';
        if(message == "success")
        createNotification({
			closeOnClick: true,
			displayCloseButton: true,
			positionClass: "nfc-top-right",
			showDuration: 3000,
			theme: "success"
		})({
			title: "Notification",
			message: "Success"
		});
        else 
        createNotification({
			closeOnClick: true,
			displayCloseButton: true,
			positionClass: "nfc-top-right",
			showDuration: 3000,
			theme: "error"
		})({
			title: "Notification",
			message: "Failed"
		});
        
        @endif
        // var wpwlOptions = {
        //     style:"plain",
        //     inlineFlow : ["PAYPAL_CONTINUE"],
        //     googlePay: {
        //         gatewayMerchantId: "8a8294174b7ecb28014b9699220015ca",
        //         onPaymentDataChanged : function onPaymentDataChanged(intermediatePaymentData) {
        //         return new Promise(function(resolve, reject) {
        //             resolve({});
        //         });
        //         },
        //     }
        // }
        // wpwlOptions.createCheckout = function() {
        //     return $.post('https://test.oppwa.com' + "/v1/checkouts", {
        //                 "authentication.entityId":"8ac7a4c970bf1ef60170bf541bad00e8",
        //                 "authentication.password":"npHBAg7saQ",
        //                 "authentication.userId":"8ac7a4c970bf1ef60170bf4d8b340067",
        //                 "amount":"2.00",
        //                 "currency":"EUR",
        //                 "paymentType":"PA",
        //                 "testMode":"EXTERNAL"
        //     })
        //     .then(function(response) {
        //         // Assume that your server returned the response containing checkoutId
        //         //e.g
        //         return response.checkoutId;
        //     });
        //     // return 23;
        // }
    </script>
    
    <script>
        $("[name='method']").change(function() {
            var brands;
            brands = $(this).data('brands');
            console.log(brands);
            if(this.id == "visa" || this.id == "mada") {
                $.ajax({
                    url: "/hyperpay/getCheckoutID?method=" + this.id, 
                    success: function(res) {
                        $("footer").html('<form id="checkout_form" action="/hyperpay/result" class="paymentWidgets" data-brands="' + brands + '"></form>')
                        $("#checkout_script").remove();
                        var script= document.createElement('script');
                        script.id = "checkout_script";
                        script.src= "https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=" + res;
                        $("body").append(script);
                    }
                })
            } else {
                $("footer").html('<form id="checkout_form" action="/hyperpay/result" class="paymentWidgets" data-brands="' + brands + '"></form>')
                $("#checkout_script").remove();
                var script= document.createElement('script');
                script.id = "checkout_script";
                script.src= "https://test.oppwa.com/v1/paymentWidgets.js";
                $("body").append(script);
            }
        })
    </script>
</body>
</html>
