import React from 'react';
import LeftDrawer from '@/components/drawers/LeftDrawer';
import Navbar from '@/components/navs/Navbar';
import { Outlet } from 'react-router-dom';

function MainLayout() {
    return (
        <LeftDrawer>
            <Navbar />
            <Outlet />
        </LeftDrawer>
    );
}

export default MainLayout;
