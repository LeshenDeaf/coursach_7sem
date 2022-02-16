require('./bootstrap');

localCache = require('./local_cache');

RolesApi = require('./roles_api');

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

const rolesApi = new RolesApi();

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

const togglePopup = function () {
    $(this).parent().find('.popup').toggleClass('hidden');
}

const fillList = function (div, responseData, listName = 'Roles') {
    $(div).html(`<h1 class="header_text">${listName}</h1>`);

    responseData.forEach(element =>
        $(div).append(
            `<div class="li_role append_role" name="${element.id}">${element.id} - ${element.name} <br> ${element.description}</div>`
        )
    );
}


$(".add_role").on("click", function() {
    const parent = $(this).parent();

    rolesApi.getRoles(
        response => {
            fillList(
                parent.find('.popup .window'),
                response.data.filter(element =>
                    parent.find(`.li_role[name="${element.id}"]`).length === 0
                )
            )
        },
        alert
    );

    togglePopup.call(this);
});

$(".toggle_mobile").on('click', toggleMobileMenu)

$("#toggle_menu").on("click", toggleMenu);

$('body').on('click', function(event){
    if(!$(event.target).closest('.window').length
        && !$(event.target).is('.add_role')
    ){
        $(".popup").addClass("hidden");
        $('.popup .window').html('')
    }
});

$(document).on('click', '.delete_role', rolesApi.deleteRole);

$(document).on('click', '.append_role', rolesApi.appendRole)

$(() => hideAlert());
