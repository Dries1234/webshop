$(() => {
  $("#redirect").on("click", () => {
    $(document).attr("location", "../php/shop.php");
  });
  $("#checkout").on("click", () => {
    $.ajax({
      url: "checkoutcart.php",
      type: "POST",
      dataType: "json",
      statusCode: {
        418: function (responseObject) {
            console.log(responseObject);
          alert(`${responseObject.responseJSON.product} does not have enough stock!`);

        },
        200: function(){
          alert("Successfully checked out! redirecting...");
          $(document).attr("location", "../php/index.php");
        },
      },
    });
  });
});
