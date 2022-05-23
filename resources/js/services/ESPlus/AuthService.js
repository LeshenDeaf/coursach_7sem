// import axios from "axios";
import { api, BRANCH_CODE, DEVICE_TYPE } from '../../http/esplus/index';

export class AuthService {
    static apiLinks = {
        login: `/auth/login`,
        refresh: `/auth/refresh`,
        me: '/me'
    }

    static authDefaultData = {
        branch_code: BRANCH_CODE,
        device_type: DEVICE_TYPE
    }

    static async login(login, password) {
        if (!login || !password) {
            console.error('No login or password provided')
            return;
        }

        return api.post(
            AuthService.apiLinks.login,
            {
                ...AuthService.authDefaultData,
                login,
                password
            }
        );
    }

    static async me() {
        return api.post(AuthService.apiLinks.me);
    }
}

