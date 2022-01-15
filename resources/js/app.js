require('./bootstrap');

const toggleMenu = function () {
    $(this).parents(".relative")
        .find("#showable")
        .toggleClass("hidden");
}

const toggleMobileMenu = function () {
    $("#mobile_menu").toggleClass('hidden');
}

const hideAlert = function () {
    setTimeout(() => $('.alert').fadeOut(300,
        function () {
            $(this).slideUp(100, () => $(this).addClass('hidden'));
        }
    ), 3000);
}

$(".toggle_mobile").on('click', toggleMobileMenu)

$("#toggle_menu").on("click", toggleMenu);

$(() => hideAlert());
