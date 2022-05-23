import axios from "axios";

// const BASE_URL = 'https://lkm.esplus.ru/api/v1'
const BASE_URL = '/home/es_plus/'

export const BRANCH_CODE = "kirov";
export const DEVICE_TYPE = "web";

export const api = axios.create({
    withCredentials: true,
    baseURL: BASE_URL,
});

api.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${localStorage.getItem('es_access_token')}`;
    return config;
});
