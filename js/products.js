function removeProduct(id){
    $.ajax({
        url: "removeproduct.php",
        type: "POST",
        data: {
          id: id,
        },
        success: function(){
            location.reload();
        }
      });
}