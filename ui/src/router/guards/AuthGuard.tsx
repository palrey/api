import React, { PropsWithChildren } from 'react';
import { Navigate } from 'react-router-dom';
import { useAuth } from '@/helpers';
import { ROUTE_PATH } from '../names';

export const AuthGuard = ({ children }: PropsWithChildren) => {
    const { profile } = useAuth();
    if (!profile) {
        return <Navigate to={ROUTE_PATH.AUTH} />;
    }
    return <>{children}</>;
};
