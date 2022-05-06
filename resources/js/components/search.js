

$('.search .find').on('click', function (e) {
    e.preventDefault();

    const input = $(this).parent().parent().parent().find('input');



    console.log(input);
})
