import React, {
    createContext,
    useContext,
    useMemo,
    PropsWithChildren,
    useState
} from 'react';
import {
    IAuthLogin,
    IUser,
    IUserRole,
    IUserProfile,
    User,
    IAuthResponse
} from '@/helpers/services/users';
import { $api } from '@/helpers/services';
import { useLocalStorage } from '../useLocalStorage';
/**
 * IAuthContext
 */
interface IAuthContext {
    // Api Token
    api_token?: string;
    setApiToken: (p?: string) => void;
    // Profile
    profile?: IUserProfile;
    setProfile: (p?: IUserProfile) => void;
    // Role
    role?: IUserRole;
    setRole: (r?: IUserRole) => void;
    // User
    user?: IUser;
    setUser: (p?: IUser) => void;
    // Methods
    login: (p: IAuthLogin) => Promise<void>;
}
/**
 * AuthContext
 */
const AuthContext = createContext<IAuthContext>({
    setApiToken(p) {
        console.log(p);
    },
    setProfile(p) {
        console.log(p);
    },
    setRole(r) {
        console.log(r);
    },
    setUser(p) {
        console.log(p);
    },
    async login(p: IAuthLogin) {
        return console.log(p);
    }
});
/**
 * AuthProvider
 * @param param0
 * @returns
 */
export const AuthProvider = ({ children }: PropsWithChildren) => {
    const UserService = User($api);
    const LocalStorage = useLocalStorage();

    const [api_token, setApiToken] = useState<string>();
    const [user, setUser] = useState<IUser>();
    const [profile, setProfile] = useState<IUserProfile>();
    const [role, setRole] = useState<IUserRole>();
    /**
     * login
     * @param p
     */
    async function login(p: IAuthLogin) {
        const resp = await UserService.login(p);
        const { role, user, token } = resp.data;
        setApiToken(token);
        setRole(role);
        setUser(user);
        LocalStorage.set<IAuthResponse>('auth', resp.data);
    }

    const memo = useMemo<IAuthContext>(
        () => ({
            api_token,
            setApiToken,
            profile,
            setProfile,
            user,
            setUser,
            role,
            setRole,
            login
        }),
        [user, profile, role, api_token]
    );

    return <AuthContext.Provider value={memo}>{children}</AuthContext.Provider>;
};
/**
 * useAuth hook
 * @returns
 */
export const useAuth = () => {
    return useContext(AuthContext);
};
