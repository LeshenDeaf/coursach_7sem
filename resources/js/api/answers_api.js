const Api = require('./api');

class AnswersApi extends Api {
    constructor() {
        super('/home/answers/');
    }

    destroy(element) {
        const confirmed = confirm(`Are you sure?\n Answer will be deleted without the possibility of recovery`)

        if (!confirmed) {
            return;
        }

        super.destroy(() => {$(element).parents('tr').eq(0).remove()}, alert, $(element).val())
    }
}

module.exports = AnswersApi;

