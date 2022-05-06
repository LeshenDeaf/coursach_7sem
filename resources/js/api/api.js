class Api {
    constructor(url) {
        this.url = url;
    }

    get(sucCallback, errCallback) {
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

    find(sucCallback, errCallback, formData, useCache = true) {
        return $.ajax({
            url: this.url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false
        })
            .done(response => {
                if (useCache) {
                    localCache.add(this.url + JSON.stringify(formData), response);
                }
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => {
                    errCallback("Request failed: " + jqXHR.responseJSON.error)
                }
            )
    }

    store(sucCallback, errCallback, formData, useCache = true) {
        return $.ajax({
            url: this.url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false
        })
            .done(response => {
                if (useCache) {
                    localCache.add(this.url, response);
                }
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => {
                    errCallback("Request failed: " + jqXHR.responseJSON.error)
                }
            )
    }

    append() {
        console.error('method is not implemented');
    }

    remove() {
        console.error('method is not implemented');
    }

    destroy(sucCallback, errCallback, id) {
        return $.ajax({
            url: this.url + id,
            method: "DELETE"
        })
            .done(response => {
                localCache.seekAndDestroy(this.url, id);
                sucCallback(response);
            })
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            )
    }
}

module.exports = Api;
