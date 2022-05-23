import {AuthService} from "../../services/ESPlus/AuthService";

const formContainer = $('.auth_esplus');

const inputs = {
    login: formContainer.find('input[name="login"]'),
    password: formContainer.find('input[name="password"]'),
}

const authenticate = async (e) => {
    e.preventDefault();

    const [login, password] = [inputs.login.val().trim(), inputs.password.val().trim()];

    if (!login || !password) {
        console.log('Login and password must be provided!')
    }

    const res = await AuthService.login(login, password);
    localStorage.setItem('es_access_token', res.data.access_token);
}

formContainer.find('.es_auth_btn').on('click', authenticate)
