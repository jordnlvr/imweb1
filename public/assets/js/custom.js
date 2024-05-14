function addOverlay() {
    $('<div id="overlayDocument"><img src="' + SITE_IMG + 'public/assets/images/loading.gif" /></div>').appendTo(document.body);
}
function removeOverlay() {
    $('#overlayDocument').remove();
}

function toggleExpandCollapseSidebar() {
    $(".l--aside").toggleClass("expanded");
    if ($(".l--aside").hasClass("expanded")) {


        
        $(".l--aside").addClass("is-collapsed");
        $(".sidebar__header").addClass("is-collapsed");
        $(".nav__link").addClass("is-collapsed");
        $(".l--main").addClass("is-collapsed");

        $(".l--main.is-collapsed").css({"width": "1707px"});
        
    } else {
        
        $(".toggle-btn").html("&#9654;");

        $(".l--aside").removeClass("is-collapsed");
        $(".sidebar__header").removeClass("is-collapsed");
        $(".nav__link").removeClass("is-collapsed");
        $(".l--main").removeClass("is-collapsed");

        $(".l--main").css({"width": ""});
 
    }
}

$(document).ready(function () {
   

    $('.header--mobile__btn').click(function () {        
        $(".l--aside").addClass("is-revealed");
    });

    $('.mobile_close_btn').click(function () {        
        $(".l--aside").removeClass("is-revealed");
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="modal"]').tooltip();
    
});




// Hide submenus
$('#body-row .collapse').collapse('hide');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function () {
    SidebarCollapse();
});
