$(() => {

    $("#redirect").on("click", ()=> {
        $(document).attr("location", "../php/shop.php")
    })
})