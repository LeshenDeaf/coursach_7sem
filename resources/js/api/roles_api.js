const Api = require('./api');

class RolesApi extends Api {
    constructor() {
        super('/api/roles/');
    }

    append () {
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
    }

    static fillListCallback (element) {
        return `<div class="li_role append_role" name="${element.id}">${element.id} - ${element.name} <br> ${element.description}</div>`
    }

    remove () {
        $(this).parents('.li_role').eq(0).remove();
    }
}

module.exports = RolesApi;

