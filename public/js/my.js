$(document).ready(function () {
    var listItems = $('.navbar ul li');

    $.each(listItems, function (key, litem) {
        var aElement = $(this).children(litem)[0];

        if(aElement == document.URL) {
            $(litem).addClass('active');
        }
    });
});