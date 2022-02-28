const Api = require('./api');


class FieldsApi extends Api {
    constructor() {
        super('/api/fields/');
    }
}

module.exports = FieldsApi;
