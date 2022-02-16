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

module.exports = localCache;
