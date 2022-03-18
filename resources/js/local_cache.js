const localCache = {
    data: {},
    get (url) {
        return this.data[url];
    },
    set (url, value) {
        this.data[url] = value;
    },
    add (url, value) {
        if (this.data[url].data === null
            || this.data[url].data === undefined
            || !this.data[url].data
        ) {
            this.data[url].data = [];
        }

        this.data[url].data.push(value);
    },
    remove (url) {
        if (typeof this.data[url] !== 'undefined') {
            delete this.data[url];
        }
    },
    seekAndDestroy (url, id) {
        if (typeof this.data[url] === 'undefined') {
            return;
        }
        id = parseInt(id, 10);
        this.data[url].data = this.data[url].data.filter(element => element.id !== id);
    },
    exists (url) {
        return this.data.hasOwnProperty(url) && this.data[url] !== null;
    }
}

module.exports = localCache;
