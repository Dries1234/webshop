function getProducts() {
    $category = $("#category").val();
    $search = $("#search").val();
    let response = $.ajax({
        url: "getProducts.php",
        type: "GET",
        dataType: "text",
        data: {"category": $category, "search": $search},
        success: function(data){
            $("#articles").fadeOut("slow", () => {
            $("#articles").html(data);
            $("#articles").fadeIn("slow")
        });
        }
    })
    return false;
    
}

$(() => {
    getProducts(); // on load show all of the articles
})