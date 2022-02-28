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

    append () {
        console.log('method is not implemented');
    }

    remove () {
        console.log('method is not implemented');
    }
}

module.exports = Api;
