const Api = require('./api');

class CreationForm {

    static get create() {
        return CreationForm.wrap(
            'Crete new field',
            CreationForm.makeForm()
        )
    }

    static makeForm() {
        return '<form>'
            + CreationForm.fieldCreationInput("Название поля", "field_name")
            + CreationForm.fieldCreationSelect()
            + CreationForm.fieldCreationSubmit()
            + '</form>';
    }

    static wrap(header, body) {
        return `<div><div class="wrap_header border select-none p-3 text-blue-600 rounded-lg hover:text-blue-800 hover:bg-blue-50">${header}</div><div class="wrap_body border border-blue-200 rounded-b-lg border-t-0 p-6 -my-2 mb-6 hidden">${body}</div></div>`;
    }

    static fieldCreationInput(label, name) {
        return `<div className="text-slate-600 p-3">
            <label className="flex">
                ${label}:
                <input
                    className="w-full text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none"
                    placeholder="Not filled"
                    name="${name}"
                    type="text"
                >
            </label>
        </div>`;
    }

    static fieldCreationSelect() {
        return `<div className="text-slate-600 p-3">
            <select name="type">
                <option value="3">Date</option>
                <option value="2">Counter value</option>
                <option value="1">Price </option>
            </select>
        </div>`;
    }

    static fieldCreationSubmit() {
        return '<button type="button" id="create_field" class="rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none">Ok</button>'
    }
}

class FieldsApi extends Api {
    static types = {
        1: 'Price',
        2: 'Counter',
        3: 'Data'
    }

    constructor() {
        super('/home/fields/');
    }

    store(formData) {
        return super.store(this.addToList, alert, formData);
    }

    addToList(response) {
        $(".popup .window").append(FieldsApi.fillListCallback(response));
    }

    append() {
        const that = this;

        const field = {
            id: $(that).attr('name'),
            text: $(that).html()
        };

        $(this).parents('.li_field').eq(0).remove();

        $("#fields").append(
            `<div class="li_field" name="${field.id}">
            <div class="field_info">${field.text}</div>
            <div class="delete_field"><span class="x_del">x</span></div>
            <input type="hidden" name="fields[]" value="${field.id}"
            </div>`
        );
    }

    remove() {
        $(this).parents('.li_field').eq(0).remove();
    }

    destroy(element) {
        const answersCount = $(element).attr('data');

        if (answersCount > 0) {
            const confirmed = confirm(`Are you sure?\nThis field is used ${$(element).attr('data')} times\nAll answers will be deleted with it without the possibility recovery`)

            if (!confirmed) {
                return;
            }
        }

        console.log(this.url);

        super.destroy(() => {$(element).parents('.li_field').eq(0).remove()}, alert, $(element).attr('name'))
    }

    static getTypeLable(type) {
        return FieldsApi.types[type];
    }

    static fillListCallback(element) {
        return `<div class="li_field flex_inline"><div class="append_field grow" name="${element.id}">
${element.label} <span class="text-gray-600">(${FieldsApi.getTypeLable(element.type)})</span>
</div>
<div class="text-gray-600 mr-2">(answered times: ${ element.answers_count })</div>
<div class="destroy_field text-red-600 rounded-lg px-3 py-1 border border-red-400 hover:bg-red-100 hover:text-red-900" data="${ element.answers_count }" name="${ element.id }">Delete</div>
</div>`;
    }

    static get createForm() {
        return CreationForm.create;
    }

    static get error() {
        return alert;
    }

}

module.exports = FieldsApi;
