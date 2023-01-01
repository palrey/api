import { AxiosInstance } from 'axios';
import { CRUD } from './crudGenerator';
import { IAddress } from './types';

/**
 * Rent
 * @param api
 */
export function Rent(api: AxiosInstance) {
    const baseUrl = 'api/rents';
    const rent = CRUD<IRent, IRentCreate, IRentUpdate>(baseUrl, api, { paginated: true, withMedia: true });
    const room = CRUD<IRentRoom, IRentRoomCreate, IRentRoomUpdate>(`${baseUrl}/rooms`, api, { paginated: true, withMedia: true });

    return {
        rent, room
    }
}

/**
 * -----------------------------------------
 *	Types
 * -----------------------------------------
 */

/**
 * IRent
 */
export interface IRent {
    id: number;
    title: string;
    small_description: string;
    description: string;
    image: string;
    address: Partial<IAddress>;
}
/**
 * IRentCreate
 */
export interface IRentCreate extends Omit<IRent, 'id' | 'image'> {
    image?: File | File[];
}
/**
 * IRentUpdate
 */
export type IRentUpdate = Partial<IRentCreate>;
/**
 * IRentRoom
 */
export interface IRentRoom {
    id: number;
    title: string;
    description: string;
    price: number;
    image: string;
    features: Array<{ [key: string]: string }>;
    capacity: number;
    open: boolean;
    rent?: IRent;
}
/**
 * IRentRoomCreate
 */
export interface IRentRoomCreate extends Omit<IRentRoom, 'id' | 'rent'> {
    rent_id: number;
}
/**
 * IRentRoomUpdate
 */
export type IRentRoomUpdate = Partial<Omit<IRentRoomCreate, 'rent_id'>>;
