import { AxiosInstance } from 'axios';
import { IPaginated } from './types';
/**
 * IConfig
 */
interface IConfig {
    paginated?: boolean;
    withMedia?: boolean;
}
/**
 * CRUD
 * @param baseUrl
 * @param api
 */
export function CRUD<Type, CreateType, UpdateType>(baseUrl: string, api: AxiosInstance, config: IConfig) {

    const headers = config.withMedia ? { 'Content-Type': 'multipart/form-data' } : undefined;

    if (config.paginated) {
        return {
            list: () => api.get<IPaginated<Type[]>>(baseUrl),
            create: (c: CreateType) => api.post<Type>(baseUrl, c, { headers }),
            show: (id: number) => api.get<Type>(`${baseUrl}/${id}`),
            update: (id: number, p: UpdateType) => api.patch<Type>(`${baseUrl}/${id}`, p, { headers }),
            remove: (id: number) => api.delete(`${baseUrl}/${id}`),
        }
    }
    return {
        list: () => api.get<Type[]>(baseUrl),
        create: (c: CreateType) => api.post<Type>(baseUrl, c, { headers }),
        show: (id: number) => api.get<Type>(`${baseUrl}/${id}`),
        update: (id: number, p: UpdateType) => api.patch<Type>(`${baseUrl}/${id}`, p, { headers }),
        remove: (id: number) => api.delete(`${baseUrl}/${id}`),
    }
}
