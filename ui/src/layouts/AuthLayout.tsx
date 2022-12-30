import React from 'react';
import Navbar from '@/components/navs/Navbar';
import LeftDrawer from '@/components/drawers/LeftDrawer';

const AuthLayout = () => {
    return (
        <LeftDrawer>
            <Navbar />
        </LeftDrawer>
    );
};

export default AuthLayout;
