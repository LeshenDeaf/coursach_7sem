const inputs = {
    dates: $('.input_date'),
    counter_values: $('.input_counter_value'),
    prices: $('.input_price')
}

const masks = {
    date: {
        mask: Date,
        min: new Date(1990, 0, 1),
        max: new Date(2040, 0, 1),
        lazy: false
    },
    counter_value: {
        mask: Number,
        min: 0,
        max: 1000000,
        thousandsSeparator: ' '
    },
    price: {
        mask: Number,
        min: -100000,
        max: 100000,
        thousandsSeparator: ' '
    }
}

const IMasks = {
    dates: inputs.dates.each(function () {
        IMask(this, masks.date)
    }),
    counter_values: inputs.counter_values.each(function () {
        IMask(this, masks.counter_value)
    }),
    prices: inputs.prices.each(function () {
        IMask(this, masks.price)
    }),
}
