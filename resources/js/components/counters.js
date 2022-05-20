const Api = require('../api/api');

function pad2(n) {
    return (n < 10 ? '0' : '') + n;
}

const api = new Api('/counters/store');

const addCounterContainer = $('.add_counter');

const makeCounterCard = counter => `
<div class="counter">
    <div class="counter_field"><span class="counter_field_label">Регистрационный номер типа СИ:</span> <span class="counter_field_value">${counter.registration_type_number}</span></div>
    <div class="counter_field"><span class="counter_field_label">Модификация СИ:</span> <span class="counter_field_value">${counter.modification_name}</span></div>
    <div class="counter_field"><span class="counter_field_label">Заводской номер СИ:</span> <span class="counter_field_value">${counter.factory_number}</span></div>
    <div class="counter_field"><span class="counter_field_label">Год выпуска СИ:</span> <span class="counter_field_value">${counter.release_year ? counter.release_year : 'Не указан'}</span></div>
    <div class="counter_field"><span class="counter_field_label">Дата поверки СИ:</span> <span class="counter_field_value">${counter.verification_date}</span></div>
    <div class="counter_field"><span class="counter_field_label">Поверка действительна до:</span> <span class="counter_field_value">${counter.valid_until}</span></div>
    <div class="counter_field"><span class="counter_field_label">СИ пригодно:</span> <span class="counter_field_value">${counter.is_valid ? 'Да' : 'Нет'}</span></div>
</div>`;

const getInputs = button => ({
    address_id: $(button).parent().find('input[name="address_id"]'),
    register_type: $(button).parent().find('input[name="register_type"]'),
    factory_number: $(button).parent().find('input[name="factory_number"]')
})

const getButtonAndInputs = addressId => {
    const button = $(`input[name="address_id"][value="${addressId}"]`).parent().find('button');
    const inputs = getInputs(button)

    return { button, inputs };
};


const reformatDate = dateStr => {
    const date = new Date(dateStr);
    return `${pad2(date.getDate())}.${pad2(date.getMonth() + 1)}.${date.getFullYear()}`//year + '-' + month + '-' + ;
}

const makeCounterPupupItem = (counter, address_id) => {
    const data = {
        address_id,
        vri_id: counter.vri_id,
        register_type: counter['mi.mitnumber'],
        factory_number: counter['mi.number'],
        verification_date: reformatDate(counter.verification_date)
    };

    return `
<div class="li_counter flex_inline my-4 rounded-lg px-4 py-2 hover:bg-gray-100">
    <div class="choose_counter grow">
        <div class="data hidden">${JSON.stringify(data)}</div>
        <div>
            <span class="text-gray-600">Регистрационный номер типа СИ:</span> ${data.register_type}
        </div>
        <div>
            <span class="text-gray-600">Заводской номер/ Буквенно-цифровое обозначение:</span> ${data.factory_number}
        </div>
        <div>
            <span class="text-gray-600">Дата поверки:</span> ${data.verification_date}
        </div>
    </div>
</div>
`
};

const addToList = (button, inputs) => {
    return response => {
        if (response.error && response.counters) {
            console.log(response.counters);
            const popWindow = $('.popup .window');
            const addressId = $(button).parent().find('input[name="address_id"]').val();

            for (const counter of response.counters) {
                popWindow.append(makeCounterPupupItem(counter, addressId));
            }

            popWindow.append(`<input type="hidden" name="address_id" value="${addressId}">`);
            $('.popup').toggleClass('hidden');

            return;
        }

        button = $(button);
        const countersContainer = button.parent().parent().find('.counters');

        countersContainer.append(makeCounterCard(response));

        countersContainer.find('.no_counters').remove();

        for (const input in inputs) {
            if (inputs[input].attr('type') !== 'hidden') {
                inputs[input].val('');
            }
        }
    }
}

const storeChosen = async function () {
    console.log($(this));
    const data = JSON.parse($(this).find('.data').html());

    const fd = new FormData();

    for (const name in data) {
        fd.append(name, data[name]);
    }

    const { button, inputs } = getButtonAndInputs(data.address_id);

    await api.store(addToList(button, inputs), console.log, fd, false);
    $(".popup").addClass("hidden");
    $('.popup .window').html('')
}

const store = async function () {
    const button = this;
    const inputs = getInputs(button);

    const fd = new FormData();

    for (const input in inputs) {
        fd.append(input, inputs[input].val());
    }

    $(button).find('i').removeClass('hidden');
    await api.store(addToList(button, inputs), console.log, fd, false);
    $(button).find('i').toggleClass('hidden');
}

addCounterContainer.find('button').on('click', store)

$(document).on('click', '.choose_counter', storeChosen)
