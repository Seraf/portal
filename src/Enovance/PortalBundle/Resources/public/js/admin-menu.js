$(document).ready(function() {
    $('#a-sidebar').css("height", $('#admin').height());
    $('#a-content').css("height", $('#admin').height());
    // Store variables
 
    var accordion_head = $('.nav-stacked > li > span'),
    accordion_body = $('.nav-stacked li > .nav-stacked');
 
    // Open the first tab on load
    if($('li.current_ancestor').size() == 1)
        accordion_head.first().addClass('active').next().slideDown('normal');
    // Click function
    accordion_head.on('click', function(event) {
        // Disable header links
        event.preventDefault();
        // Show and hide the tabs on click
        if ($(this).attr('class') != 'active') {
            accordion_body.slideUp('normal');
            $(this).next().stop(true,true).slideToggle('normal');
            accordion_head.removeClass('active');
            $(this).addClass('active');
        }
    });
});
