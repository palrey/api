import React from 'react';
import { RouterProvider } from 'react-router-dom';
import { AuthProvider } from '@/helpers/providers';
import route from '@/router';

function App() {
    return (
        <AuthProvider>
            <RouterProvider router={route}></RouterProvider>
        </AuthProvider>
    );
}

export default App;
