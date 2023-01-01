import { useDispatch, useSelector, AuthActions } from '@/providers/redux';
import React, { PropsWithChildren } from 'react';
import { Navigate } from 'react-router-dom';
import { ROUTE_PATH } from '../names';

export const AuthGuard = ({ children }: PropsWithChildren) => {
    const dispatch = useDispatch();
    dispatch(AuthActions.load());
    const { auth } = useSelector(state => state);
    if (!auth.token) {
        return <Navigate to={ROUTE_PATH.AUTH} />;
    }
    return <>{children}</>;
};
