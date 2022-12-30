import React from 'react';
import { Outlet } from 'react-router-dom';

const AuthLayout = () => {
    return (
        <div className="min-h-screen flex items-center justify-center">
            <div className="p-2">
                <Outlet />
            </div>
        </div>
    );
};

export default AuthLayout;
