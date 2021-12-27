function removeUser(email){
    $.ajax({
        url: "removeUser.php",
        type: "POST",
        data: {
          email: email,
        },
        success: function(){
            location.reload();
        }
      });
}

function switchAdmin(email){
    $.ajax({
        url: "switchAdmin.php",
        type: "POST",
        data: {
          email: email,
        },
        success: function(){
            alert("Operation successful!");
            location.reload();
        }
      });
}