import React, {
    createContext,
    useContext,
    useMemo,
    PropsWithChildren,
    useState
} from 'react';
import { IUserProfile } from '@/services/types';
/**
 * IAuthContext
 */
interface IAuthContext {
    profile: IUserProfile | null;
    setProfile: (p: IUserProfile | null) => void;
}
/**
 * AuthContext
 */
const AuthContext = createContext<IAuthContext>({
    profile: null,
    setProfile: (p: IUserProfile | null) => {
        console.log(p);
    }
});
/**
 * AuthProvider
 * @param param0
 * @returns
 */
export const AuthProvider = ({ children }: PropsWithChildren) => {
    const [user, setUser] = useState<IUserProfile | null>(null);

    const memo = useMemo<IAuthContext>(
        () => ({
            profile: user,
            setProfile: (p: IUserProfile | null) => {
                setUser(p);
            }
        }),
        [user]
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
