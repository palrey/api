import React from 'react';
import { createBrowserRouter } from 'react-router-dom';
import { ROUTE_PATH } from './names';
import AuthLayout from '@/layouts/AuthLayout';
import AuthPage from '@/pages/AuthPage';
import MainLayout from '@/layouts/MainLayout';
import HomePage from '@/pages/HomePage';
import RentsPage from '@/pages/RentsPage';
import { AuthGuard } from './guards/AuthGuard';

const router = createBrowserRouter([
    {
        path: ROUTE_PATH.HOME,
        element: (
            <AuthGuard>
                <MainLayout />
            </AuthGuard>
        ),
        children: [
            {
                path: '',
                element: <HomePage />
            },
            {
                path: ROUTE_PATH.RENT_RENTS,
                element: <RentsPage />
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
