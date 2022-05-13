const Api = require('../api/api');

const api = new Api('/counters/store');

const addCounterContainer = $('.add_counter');

const makeCounterCard = counter => {
    return `<div class="counter">
<div class="counter_field"><span class="counter_field_label">Регистрационный номер типа СИ:</span> <span class="counter_field_value">${counter.registration_type_number}</span></div>
<div class="counter_field"><span class="counter_field_label">Модификация СИ:</span> <span class="counter_field_value">${counter.modification_name}</span></div>
<div class="counter_field"><span class="counter_field_label">Заводской номер СИ:</span> <span class="counter_field_value">${counter.factory_number}</span></div>
<div class="counter_field"><span class="counter_field_label">Год выпуска СИ:</span> <span class="counter_field_value">${counter.release_year ? counter.release_year : 'Не указан'}</span></div>
<div class="counter_field"><span class="counter_field_label">Дата поверки СИ:</span> <span class="counter_field_value">${counter.verification_date}</span></div>
<div class="counter_field"><span class="counter_field_label">Поверка действительна до:</span> <span class="counter_field_value">${counter.valid_until}</span></div>
<div class="counter_field"><span class="counter_field_label">СИ пригодно:</span> <span class="counter_field_value">${counter.is_valid ? 'Да' : 'Нет'}</span></div>
</div>`;
}

const addToList = (button, inputs) => {
    return response => {
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

const store = async function () {
    const button = this;
    const inputs = {
        address_id: addCounterContainer.find('input[name="address_id"]'),
        register_type: addCounterContainer.find('input[name="register_type"]'),
        factory_number: addCounterContainer.find('input[name="factory_number"]')
    }

    const fd = new FormData();

    for (const input in inputs) {
        fd.append(input, inputs[input].val());
    }

    $(button).find('i').removeClass('hidden');
    await api.store(addToList(button, inputs), console.log, fd, false);
    $(button).find('i').toggleClass('hidden');
}

addCounterContainer.find('button').on('click', store)
