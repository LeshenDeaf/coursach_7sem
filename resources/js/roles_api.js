class RolesApi {
    constructor() {
        this.url = '/api/roles/';
    }

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
    }

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
    }

    deleteRole () {
        $(this).parents('.li_role').eq(0).remove();
    }
}

module.exports = RolesApi;

