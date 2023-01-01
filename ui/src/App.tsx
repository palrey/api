import React from 'react';
import { RouterProvider } from 'react-router-dom';
import { Provider as StoreProvider } from 'react-redux';
import route from '@/router';
import store from '@/providers/redux/store';

function App() {
    return (
        <StoreProvider store={store}>
            <RouterProvider router={route}></RouterProvider>
        </StoreProvider>
    );
}

export default App;
