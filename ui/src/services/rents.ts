import { AxiosInstance } from 'axios';
import { IAddress } from './types';

/**
 * Rent
 * @param api
 */
export function Rent(api: AxiosInstance) {
    const baseUrl = 'api/rents';
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

