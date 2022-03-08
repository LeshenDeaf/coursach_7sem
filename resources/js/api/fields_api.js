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
        return `<div><div class="wrap_header p-3 text-blue-600 rounded-lg hover:text-blue-800 hover:bg-blue-50">${header}</div><div class="wrap_body hidden">${body}</div></div>`;
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
        $(".popup .window").append(
            `<div class="li_field append_field" name="${response.id}">
            <div class="role_info">${response.label} - ${FieldsApi.getTypeLable(response.type)}</div>
            </div>`
        );
    }

    append() {
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

    static getTypeLable(type) {
        return FieldsApi.types[type];
    }

    static fillListCallback(element) {
        return `<div class="li_field append_field" name="${element.id}">${element.label}: ${FieldsApi.getTypeLable(element.type)}</div>`;
    }

    static get createForm() {
        return CreationForm.create;
    }

    static get error() {
        return alert;
    }

}

module.exports = FieldsApi;
