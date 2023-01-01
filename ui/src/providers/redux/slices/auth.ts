import { useLocalStorage } from '@/helpers';
import type { IAuthResponse } from '@/services/users';
import { createSlice, PayloadAction } from '@reduxjs/toolkit';

const initialState: Partial<IAuthResponse> = {
    role: undefined,
    token: undefined,
    user: undefined
}

// eslint-disable-next-line react-hooks/rules-of-hooks
const Storage = useLocalStorage();

const authSlice = createSlice({
    name: 'auth',
    initialState,
    reducers: {
        /**
         * setUser
         * @param state
         * @param param1
         */
        setAuthResponse(state, { payload }: PayloadAction<IAuthResponse>) {
            Storage.set('auth', payload);
            return { ...state, ...payload };

        },
        /**
         * loadFromStorage
         * @param state
         */
        load(state) {
            const data = Storage.get<Partial<IAuthResponse>>('auth');
            if (data) {
                return { ...state, ...data }
            }
            return state;
        },
    },
});
export const AuthActions = authSlice.actions;
export default authSlice.reducer

