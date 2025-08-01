! function() {
    "use strict";
    $(document).ready(function() {
        $('.left-side-nav [data-toggle="tooltip"]').tooltip({ template: '<div class="tooltip left-side-nav-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' }), $("#left-nav-toggler").on("click", function(e) { e.preventDefault(), $("body").toggleClass("left-side-toggled"), $(".left-side-nav .nav-link-collapse").addClass("collapsed"), $(".left-side-nav .sidenav-second-level, .left-side-nav .sidenav-third-level").removeClass("show") }), $("#sidenavToggler").on("click", function(e) { e.preventDefault(), $("body").toggleClass("sidenav-toggled"), $(".navbar-sidenav .nav-link-collapse").addClass("collapsed"), $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show") }), $(".left-side-nav .nav-link-collapse").on("click", function(e) { e.preventDefault(), $("body").removeClass("left-side-toggled") }), $("body.fixed-nav .left-side-nav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll", function(e) {
            var t = e.originalEvent,
                a = t.wheelDelta || -t.detail;
            this.scrollTop += 30 * (a < 0 ? 1 : -1), e.preventDefault()
        }), $(".accordion > dd").hide().first().slideDown("easeOutExpo"), $(".accordion").each(function() { $(this).find("dt > a").first().addClass("active").parent().next().css({ display: "block" }) }), $(".accordion > dt > a").click(function() { return $(this).parent().next("dd"), $(this).parents(".accordion").find("dt > a").removeClass("active"), $(this).addClass("active"), $(this).parents(".accordion").find("dd").slideUp("easeInExpo"), $(this).parent().next().slideDown("easeOutExpo"), !1 });
        $(".toggle > dd").hide();
        $(".toggle > dt > a").click(function() {
                $(".toggle > dd").toggle()
            }),
            $('[data-toggle="tooltip"]').tooltip(),
            $('[data-toggle="popover"]').popover(), $(".chat-wrap").mCustomScrollbar({ autoHideScrollbar: !0, scrollInertia: 0 })
    })
}(jQuery);