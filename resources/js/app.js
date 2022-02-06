require('./bootstrap');

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

const localCache = {
    data: {},
    get (url) {
        return this.data[url];
    },
    set (url, value) {
        this.data[url] = value;
    },
    remove (url) {
        delete this.data[url];
    },
    exists (url) {
        return localCache.data.hasOwnProperty(url) && localCache.data[url] !== null;
    }
}

const RolesApi = {
    url: '/api/roles/',

    getRoles (callback, errCallback) {
        if (localCache.exists(this.url)) {
            return callback(localCache.get(this.url));
        }

        return $.ajax({
                url: this.url,
                method: "GET",
                datatype: "json",
            })
            .done(response => {
                localCache.set(this.url, response);
                callback(response);
            })
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            )
    },

    appendRole () {
        const that = this;

        const role = {
            id: $(that).attr('name'),
            text: $(that).html()
        };

        $(this).remove();

        $("#roles").append(
            `<div class="li_role" name="${role.id}">
            <div class="role_info">${role.text}</div>
            <div class="delete_role"><span class="x_del">x</span></div>
            <input type="hidden" name="roles[]" value="${role.id}"
            </div>`
        );


    },

    deleteRole () {
        $(this).parents('.li_role').eq(0).remove();
    }
}


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

    RolesApi.getRoles(
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

$(document).on('click', '.delete_role', RolesApi.deleteRole);

$(document).on('click', '.append_role', RolesApi.appendRole)

$(() => hideAlert());
