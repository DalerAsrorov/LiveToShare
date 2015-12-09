$('#menu-toggle').hide();

$(".sidenav-icon").hover (
    function() {
        $(this).css("color", "lightgrey");
    }, function() {
        $(this).css("color", "#66b2ff");
    }
)

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$("#left-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

var counter = 0;
$("#side-button").click(function(e) {
    counter++;

    if(counter%2==0) {
        document.getElementById("menu-toggle").className = "glyphicon glyphicon-triangle-left";
    }
    else {
        document.getElementById("menu-toggle").className = "glyphicon glyphicon-triangle-left";
    }
});

$("#hide-sidebar").click(function(e) {
    e.preventDefault();
    $("#wrapper").hide();


});

$('.hide-sidebar').click(function(e) {
    e.preventDefault();
    $('#menu-toggle').show();

});