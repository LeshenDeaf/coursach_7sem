require('./bootstrap');

localCache = require('./local_cache');

RolesApi = require('./api/roles_api');
FieldsApi = require('./api/fields_api');
AnswersApi = require('./api/answers_api');
const addressesApi = require('./api/addresses_api');
const commentsApi = require('./api/comments_api');

require('./components/search');
require('./components/notifications');
require('./components/counters');

require('./components/esplus/auth');
require('./components/esplus/index');

Masks = require('./masks');

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
const fieldsApi = new FieldsApi();
const answersApi = new AnswersApi();

const toggleMenu = function () {
    $(this).parents(".relative")
        .find("#showable")
        .toggleClass("hidden");
}

const toggleMobileMenu = function () {
    $("#mobile_menu").toggleClass('hidden');
}

const hideAlert = () => setTimeout(
    () => $('.alert').fadeOut(
        300,
        function () {
            $(this).slideUp(100, () => $(this).addClass('hidden'));
        }
    ),
    3000
);

const togglePopup = function () {
    $(this).parent()
        .find('.popup')
        .toggleClass('hidden');
}

const fillList = function (divData,
                           divCreatorCallback
) {
    $(divData.div).html(`<h1 class="header_text">${divData.headerText}</h1>`);

    divData.elements.forEach(element =>
        $(divData.div).append(divCreatorCallback(element))
    );
}


const fillFieldList = function (divData,
                                divCreatorCallback
) {
    $(divData.div).html(`<h1 class="header_text">${divData.headerText}</h1>`);

    $(divData.div).append(FieldsApi.createForm);

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
})

$('.add_field').on('click', function () {
    const parent = $(this).parent();

    fieldsApi.get(
        response => {
            fillFieldList(
                divData(
                    parent.find('.popup .window'),
                    'Available fields',
                    response.data.filter(element =>
                        parent.find(`.li_field[name="${element.id}"]`).length === 0
                    )
                ),
                FieldsApi.fillListCallback
            )
        },
        alert
    );

    togglePopup.call(this);
})

$(".toggle_mobile").on('click', toggleMobileMenu)

$("#toggle_menu").on("click", toggleMenu);

$('body').on('click', "#create_field", function (e) {
    e.preventDefault();

    fieldsApi.store($(this).parents('form').eq(0).serialize());

    $(this).parents('form').eq(0).find('input[name="field_name"]').val('');
})

$('body').on('click', '.wrap_header', function () {
    $(this).toggleClass('active');
    $(this).parent().find('.wrap_body').toggleClass('hidden');
    const wrapper = $(this).parents('.wrap');

    if (wrapper.length > 0) {
        wrapper.toggleClass('border-blue-300');
    }
})

$('body').on('click', function(event){
    if (!$(event.target).closest('.window').length
        && !$(event.target).is('.add_role')
        && !$(event.target).is('.add_field')
    ) {
        $(".popup").addClass("hidden");
        $('.popup .window').html('')
    }
});

$(document).on('click', '.append_role', rolesApi.append);
$(document).on('click', '.delete_role', rolesApi.remove);

$(document).on('click', '.append_field', fieldsApi.append);
$(document).on('click', '.delete_field', fieldsApi.remove);
$(document).on('click', '.destroy_field', function () {fieldsApi.destroy(this)});

$(document).on('click', '.destroy_answer', function () {answersApi.destroy(this)});

$(() => hideAlert());
