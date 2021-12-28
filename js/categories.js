function removeCategory(id){
    $.ajax({
        url: "removecategory.php",
        type: "POST",
        data: {
          id: id,
        },
        success: function(){
            location.reload();
        }
      });
}