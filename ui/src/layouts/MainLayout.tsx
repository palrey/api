import React from 'react';
import {
    DrawerItem,
    ItemsContainer,
    LeftDrawer,
    ItemDivisor
} from '@/components/drawers';
import Navbar from '@/components/navs/Navbar';
import { Outlet } from 'react-router-dom';
import { mdiViewDashboard } from '@mdi/js';

function MainLayout() {
    return (
        <LeftDrawer
            items={
                <ItemsContainer>
                    <DrawerItem label="Hello" header className="mt-2" />
                    <DrawerItem label="Hello" icon={mdiViewDashboard} />
                    <DrawerItem label="Hello" icon={mdiViewDashboard} />
                    <ItemDivisor />
                    <DrawerItem label="Hello" header />
                    <DrawerItem label="Hello" icon={mdiViewDashboard} />
                </ItemsContainer>
            }
        >
            <Navbar title="Administracion" />
            <div className="mt-16 sm:mt-0">
                <Outlet />
            </div>
        </LeftDrawer>
    );
}

export default MainLayout;
