import { AxiosInstance } from 'axios';
import { IAddress } from './types';
/**
 * User
 * @param api
 * @returns
 */
export function User(api: AxiosInstance) {
    /**
     * baseUrl
     */
    const baseUrl = '/api/users';

    return {
        /**
         * login
         * @param p
         * @returns
         */
        login: (p: IAuthLogin) => api.post<IAuthResponse>(`${baseUrl}/auth/login`, p),
        /**
         * register
         * @param p
         * @returns
         */
        register: (p: IAuthRegister) => api.post<IAuthResponse>(`${baseUrl}/auth/register`, p),
        /**
         * profile
         * @returns
         */
        profile: () => api.get<IUserProfile>(`${baseUrl}/profile`),
        /**
         * setProfile
         * @param p
         * @returns
         */
        setProfile: (p: Omit<IUserProfile, 'email' | 'id'>) => api.post<IUserProfile>(`${baseUrl}/profile`, p),
    }
}

export interface IUser {
    id: number;
    name: string;
    email: string;
}

/**
 * IAuthLogin
 */
export interface IAuthLogin {
    email: string;
    password: string;
}
/**
 * IAuthRegister
 */
export interface IAuthRegister extends IAuthLogin {
    name: string;
    password_confirmation: string;
}
/**
 * IAuthResponse
 */
export interface IAuthResponse {
    user: IUser;
    token: string;
    role: IUserRole;
}
/**
 * IUserRole
 */
export type IUserRole = 'amdin' | 'vendor' | 'user';


/**
 * IUserProfile
 */
export interface IUserProfile {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    tel: string;
    address: Partial<IAddress>;
}

