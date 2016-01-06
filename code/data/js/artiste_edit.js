function switchPayment() {
  if ($("#fonction .payment-es input").is(':checked')) {
    $("#payment-IBAN").hide();
    $("#payment-Ordre").hide();
  } else if($("#fonction .payment-ch input").is(':checked')) {
    $("#payment-IBAN").hide();
    $("#payment-Ordre").show();
  } else if($("#fonction .payment-vi input").is(':checked')) {
    $("#payment-IBAN").show();
    $("#payment-Ordre").hide();
  }
}

function init() {
  $("#fonction input[name='payment']").on('change',function(e){
    switchPayment();
  });
  switchPayment();
}

init();
