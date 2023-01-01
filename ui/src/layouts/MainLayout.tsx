import React from 'react';
import {
    DrawerItem,
    ItemsContainer,
    LeftDrawer,
    ItemDivisor
} from '@/components/drawers';
import Navbar from '@/components/navs/Navbar';
import { Outlet } from 'react-router-dom';
import {
    mdiAccount,
    mdiBed,
    mdiCalendar,
    mdiHomeOutline,
    mdiViewDashboard
} from '@mdi/js';
import { useSelector } from '@/providers/redux';

function MainLayout() {
    /**
     * -----------------------------------------
     *	Init
     * -----------------------------------------
     */
    const { auth } = useSelector(state => state);
    /**
     * -----------------------------------------
     *	Render
     * -----------------------------------------
     */

    return (
        <LeftDrawer
            items={
                <ItemsContainer>
                    <DrawerItem
                        label={auth.user?.name}
                        header
                        className="mt-2"
                    />
                    <DrawerItem label="Inicio" icon={mdiViewDashboard} />
                    <ItemDivisor />
                    <DrawerItem label="Renta" header />
                    <DrawerItem label="Reservas" icon={mdiCalendar} />
                    <DrawerItem label="Rentas" icon={mdiHomeOutline} />
                    <DrawerItem label="Habitaciones" icon={mdiBed} />
                    <ItemDivisor />
                    <DrawerItem label="Ajustes" header />
                    <DrawerItem label="Mi Cuenta" icon={mdiAccount} />
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
