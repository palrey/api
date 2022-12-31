import { AxiosInstance } from 'axios';
import { User } from './users';
import { Rent } from './rents';
/**
 * MultiSystemService
 * @param axiosInstance
 * @returns
 */
const MultiSystemService = (axiosInstance: AxiosInstance) => ({
    rent: Rent(axiosInstance),
    user: User(axiosInstance),
})

export default MultiSystemService;
export { User, Rent };
