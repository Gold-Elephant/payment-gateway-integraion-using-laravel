<!DOCTYPE html>
<html >
<head>
  <title>Payment Method</title>
  <!-- <script src="../assets/jquery.min.js"></script> -->
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/paymentMethod.css">

  <!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="container">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    Payment method
                </div>
                <div class="ibox-content">
                    <div class="panel-group payments-method" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <i class="fa fa-list text-success"></i>
                                </div>
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Fast Checkout</a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                      <form class="paymentWrap" method="POST" action="/hyperpay/fastCheck">
                                        <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                                          <label class="btn paymentMethod active">
                                            <div class="method paypal"></div>
                                            <input type="radio" name="options" value="paypal" checked> 
                                          </label>
                                          <label class="btn paymentMethod">
                                            <div class="method apple"></div>
                                            <input type="radio" name="options" value="apple"> 
                                          </label>
                                          <label class="btn paymentMethod">
                                            <div class="method google"></div>
                                            <input type="radio" name="options" value="google"> 
                                          </label>
                                          <label class="btn paymentMethod">
                                            <div class="method stc"></div>
                                            <input type="radio" name="options" value="stc"> 
                                          </label>
                                        </div> 
                                      </form>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <i class="fa fa-credit-card text-warning"></i>
                                </div>
                                <h5 class="panel-title">
                                    <a id="credit" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Credit Card</a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div id="form-row" class="row">
                                      <form action="https://a91e84bae970.ngrok.io/hyperpay/credit/result" class="paymentWidgets" data-brands="VISA MASTER MADA"></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script id="myscript" type="text/javascript"></script>
<script>
  $('#credit').click(function(){
    $.ajax({
      method: "POST",
      url: "/hyperpay/credit/payment",
      async: false,
      data: {
        _token: $("#_token").val(),
        price: 100
      },
      success(res){
        var resData = JSON.parse(res);
        console.log(resData.id);   
        $("#myscript").attr("src", 'https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=' + resData.id);
      }
    });
  });
//   $('.paypal').click(function(){
//     var wpwlOptions = {
//       inlineFlow : ["PAYPAL_CONTINUE"]
//     }
//     // wpwlOptions.createCheckout ();
//     paypal_pay (wpwlOptions);
//   });
//   $('.apple').click(function(){
//     console.log('apple');
//   });
//   $('.google').click(function(){
//     console.log('google');

//   });
//   $('.stc').click(function(){
//     console.log('stc');

//   });

  
</script>
</body>
