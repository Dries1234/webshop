$(() => {
    $("#btn-users").on("click", () => {
        $(document).attr("location", "users.php")
    })
    $("#btn-products").on("click", () => {
        console.log("hi");
        $(document).attr("location", "products.php")
    })
    $("#btn-categories").on("click", () => {
        $(document).attr("location", "categories.php")
    })
})