import axios, { AxiosRequestHeaders } from 'axios';
import MultiSystemService from './main';

const baseURL = window.location.hostname !== 'localhost' ? window.location.origin : 'http://localhost:8000';

const $api = axios.create({
    baseURL,
    withCredentials: true,
    timeout: 10000,
    timeoutErrorMessage: 'Error de conexion'
});


$api.interceptors.request.use(req => {

    /* Append content type header if its not present */
    if (!(req.headers as AxiosRequestHeaders)['Content-Type']) {
        (req.headers as AxiosRequestHeaders)['Content-Type'] =
            'application/json';
    }

    /* Check if authorization is set */
    if (!(req.headers as AxiosRequestHeaders)['Authorization']) {
        const token = 'token';
        if (token && token.length > 0) {
            (req.headers as AxiosRequestHeaders).Authorization =
                'Bearer ' + token;
        }
    }

    /* Check if app token is set */
    if (!(req.headers as AxiosRequestHeaders)['App-Token']) {
        const token = 'token';
        if (token && token.length > 0) {
            (req.headers as AxiosRequestHeaders)['App-Token'] =
                '1|$2y$10$NcxgWp9upENKsdk3TBrA5eRSqG3n1YGWKIQtrP6khG02gTRwU9ov2';
        }
    }

    return req;
});

const $service = MultiSystemService($api);

export { baseURL, $api, $service }
