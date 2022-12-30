import React from 'react';
import AuthLayout from '@/layouts/AuthLayout';
import { createBrowserRouter } from 'react-router-dom';
import { ROUTE_PATH } from './names';
import AuthPage from '@/pages/AuthPage';
import MainLayout from '@/layouts/MainLayout';
import HomePage from '@/pages/HomePage';

const router = createBrowserRouter([
    {
        path: ROUTE_PATH.HOME,

        element: <MainLayout />,
        children: [
            {
                path: '',
                element: <HomePage />
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
