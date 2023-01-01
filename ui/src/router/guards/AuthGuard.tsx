import React, { PropsWithChildren } from 'react';
import { Navigate } from 'react-router-dom';
import { useAuth } from '@/helpers/providers';
import { ROUTE_PATH } from '../names';

export const AuthGuard = ({ children }: PropsWithChildren) => {
    const { user } = useAuth();
    if (!user) {
        return <Navigate to={ROUTE_PATH.AUTH} />;
    }
    return <>{children}</>;
};
