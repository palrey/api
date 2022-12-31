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
	lng:number
}

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
