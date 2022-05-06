const Api = require('./api');

const cache = require('../local_cache');

class AddressesApi extends Api {
    constructor() {
        super('/kladr-api');
    }

    get(succCallback, errCallback, address) {
        return $.ajax({
            url: this.url,
            method: "POST",
            data: 'query=' + address,
        })
            .done(succCallback)
            .fail(
                (jqXHR, textStatus) => errCallback("Request failed: " + textStatus)
            );
    }
}

const fillSuggestions = (response, input) => {
    response = JSON.parse(response);

    const parent = input.parents('div').eq(0);

    if (parent.find('.suggestions').length <= 0) {
        parent.append('<div class="suggestions"></div>')
    }

    const suggestions = parent.find('.suggestions');

    suggestions.html('');

    if (input.val() === response.suggestions[0].value
        && response.suggestions.length === 1
    ) {
        suggestions.remove();
        return;
    }

    for (const suggestion of response.suggestions) {
        suggestions.append(`<div class="suggestion">${suggestion.value}</div>`)
    }
}

export const addressesApi = new AddressesApi();

let timeout;

let oldAddress = '';

$(document).on('input', 'input[name="addresses[]"]', function () {
    const address = $(this).val().trim();
    const input = $(this);

    if (!address) {
        input.parents('div').eq(0).find('.suggestions').remove();
        return;
    }

    if (address === oldAddress && input.parents('div').eq(0).find('.suggestions').length > 0) {
        return;
    }

    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const cached = cache.get(addressesApi.url + address);
        if (cached) {
            fillSuggestions(cached, input)
        } else {
            addressesApi.get(response => {
                cache.set(addressesApi.url + address, response);
                return fillSuggestions(response, input);
            }, alert, address, true);
        }
        oldAddress = address;
    }, 400);
})

$(document).on('click', 'input[name="addresses[]"]', function () {
    const address = $(this).val().trim();
    const input = $(this);

    const suggestions = input.parents('div').eq(0).find('.suggestions');

    if (!input || !address) {
        if (suggestions.length > 0) {
            suggestions.remove();
        }
        return;
    }

    if (suggestions.length <= 0) {
        input.trigger('input');
    }
})

$(document).on('click', '.suggestion', function () {
    const input = $(this).parent().parent().find('input[name="addresses[]"]');

    if (input.length <= 0) {
        return;
    }

    const prevVal = input.val();

    input.val($(this).text());

    console.log(prevVal + ' ' + input.val())

    if (prevVal !== input.val()) {
        input.trigger('input');
    } else {
        input.parents('div').eq(0).find('.suggestions').remove();
    }
});

$(document).mouseup(function (e) {
    const container = $(".suggestions").parent().parent();

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.suggestions').remove();
    }
});
