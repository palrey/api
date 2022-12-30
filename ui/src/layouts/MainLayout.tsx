import React from 'react';
import LeftDrawer from '@/components/drawers/LeftDrawer';
import Navbar from '@/components/navs/Navbar';

function MainLayout() {
    return (
        <LeftDrawer>
            <Navbar />
        </LeftDrawer>
    );
}

export default MainLayout;
