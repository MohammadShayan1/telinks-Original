$(document).ready(function () {
    var $grid = $('.portfolio-item').isotope({
        itemSelector: '.item',
        layoutMode: 'fitRows'
    });

    // Filter items on button click
    $('.portfolio-menu ul').on('click', 'li', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
        $('.portfolio-menu ul li').removeClass('active');
        $(this).addClass('active');
    });
});
