class Api {
    constructor (url) {
        this.url = url;
    }

    get (sucCallback, errCallback) {
        if (localCache.exists(this.url)) {
            return sucCallback(localCache.get(this.url));
        }

        return $.ajax({
            url: this.url,
            method: "GET",
            datatype: "json",
        })
            .done(response => {
                localCache.set(this.url, response);
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            )
    }

    store (sucCallback, errCallback, formData) {
        return $.ajax({
            url: this.url,
            method: "POST",
            data: formData
        })
            .done(response => {
                localCache.add(this.url, response);
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            )
    }

    append () {
        console.error('method is not implemented');
    }

    remove () {
        console.error('method is not implemented');
    }

    destroy (sucCallback, errCallback, id) {
        console.log(this.url);
        return $.ajax({
            url: this.url + id,
            method: "DELETE"
        })
            .done(response => {
                localCache.remove(this.url, id);
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            )
    }
}

module.exports = Api;
