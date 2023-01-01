/**
 * IAddress
 */
export interface IAddress {
    country: string;
    state: string;
    city: string;
    address: string;
    coordinates: ICoordinates;
}
/**
 * ICoordinates
 */
export interface ICoordinates {
    lat: number;
    lng: number
}
/**
 * IPaginated
 */
export interface IPaginated<T> {
    data: T
}
