require('./bootstrap');

localCache = require('./local_cache');

RolesApi = require('./api/roles_api');
FieldsApi = require('./api/fields_api');

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

const listProperties = (headerText, suffix) => {
    return {
        headerText: headerText,
        suffix: suffix
    }
}

const divData = (div, headerText, elements) => {
    return {
        div: div,
        headerText: headerText,
        elements: elements
    }
}

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


const fillList = function (divData,
                           divCreatorCallback
) {
    $(divData.div).html(`<h1 class="header_text">${divData.headerText}</h1>`);

    divData.elements.forEach(element =>
        $(divData.div).append(divCreatorCallback(element))
    );
}


$(".add_role").on("click", function() {
    const parent = $(this).parent();

    rolesApi.get(
        response => {
            fillList(
                divData(
                    parent.find('.popup .window'),
                    'Available roles',
                    response.data.filter(element =>
                        parent.find(`.li_role[name="${element.id}"]`).length === 0
                    )
                ),
                RolesApi.fillListCallback
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

$(document).on('click', '.delete_role', rolesApi.remove);

$(document).on('click', '.append_role', rolesApi.append)

$(() => hideAlert());
