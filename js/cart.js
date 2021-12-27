$(() => {

    $("#redirect").on("click", ()=> {
        $(document).attr("location", "../php/shop.php")
    })
    $("#checkout").on("click", () => {
        $.ajax({
            url: "checkoutcart.php",
            type: "POST",
            success: function(){
                alert("Successfully checked out! redirecting...")
                $(document).attr("location", "../php/index.php")
            }
          });
        });
});