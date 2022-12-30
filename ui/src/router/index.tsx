import React from 'react';
import AuthLayout from '@/layouts/AuthLayout';
import { createBrowserRouter } from 'react-router-dom';
import { ROUTE_PATH } from './names';
import AuthPage from '@/pages/AuthPage';
import MainLayout from '@/layouts/MainLayout';

const router = createBrowserRouter([
    {
        path: ROUTE_PATH.HOME,

        element: <MainLayout />,
        children: [
            {
                path: '',
                element: <AuthPage />
            }
        ]
    },
    {
        path: ROUTE_PATH.AUTH,
        element: <AuthLayout />,
        children: [
            {
                path: '',
                element: <AuthPage />
            }
        ]
    }
]);

export default router;
