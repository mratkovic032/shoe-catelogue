$(document).ready(function() {
    
    $('[data-toggle="tooltip"]').tooltip();

    $(".card").click(function() {
        window.location = $(this).find("a").attr("href"); 
        return false;
    });    
});