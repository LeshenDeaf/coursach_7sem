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
        delete this.data[url];
    },
    exists (url) {
        return localCache.data.hasOwnProperty(url) && localCache.data[url] !== null;
    }
}

module.exports = localCache;
