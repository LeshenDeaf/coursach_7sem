const Api = require('../api/api');

const api = new Api('/home/forum/address/search');

const redirectToAddress = response => {
    window.location.replace(
        '/home/forum/address/' + response.address_id
    );
}

$('.search .find').on('click', function (e) {
    e.preventDefault();

    const fd = new FormData();
    const input = $(this).parent().parent().parent().find('input');
    if (!input || !input.val().trim()) {
        return;
    }

    fd.append('address', input.val().trim());

    api.find(redirectToAddress, console.log, fd, false);
})
