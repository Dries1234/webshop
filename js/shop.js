function getProducts() {
  let category = $("#category").val();
  let search = $("#search").val();
  let response = $.ajax({
    url: "getProducts.php",
    type: "GET",
    dataType: "text",
    data: {
      category: category,
      search: search,
    },
    success: function (data) {
      $("#articles").fadeOut("fast", () => {
        $("#articles").html(data);
        $("#articles").fadeIn("fast", function () {
          $(document).trigger("productsLoaded");
        });
      });
    },
  });
  return false;
}
$(document).on("productsLoaded", function (e1) {
  $(".add-cart").on("click", function (e2) {
    let card = $(this).parents().get(1);
    let id = $(card).attr("data-product");
    // POST request to add the product to the cart in this session
    $.ajax({
      url: "addToCart.php",
      type: "POST",
      data: {
        id: id,
      },
    });
    alert("Added a product to your cart!");
  });
});

$(() => {
  getProducts(); // on load show all of the articles
});
