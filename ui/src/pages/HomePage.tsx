import React, { useEffect, useState } from 'react';
import StatusWidget from '@/components/widgets/StatusWidget';
import {
    mdiAccount,
    mdiBed,
    mdiCalendar,
    mdiCalendarAccount,
    mdiHomeAlert,
    mdiHomeCity,
    mdiMemory,
    mdiMessage,
    mdiSticker
} from '@mdi/js';
/**
 * HomePage
 * @returns
 */
function HomePage() {
    const [progress, setProgress] = useState(0);

    useEffect(() => {
        const interval = setInterval(() => {
            if (progress < 100) setProgress(progress => progress + 10);
            else {
                clearInterval(interval);
            }
        }, 1000);
        return () => clearInterval(interval);
    }, [progress]);
    return (
        <div className="p-2">
            <div className="grid gap-2 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8">
                <StatusWidget icon={mdiMessage} pulse label="10 Mensajes" />
                <StatusWidget
                    icon={mdiHomeAlert}
                    pulse
                    label="Nuevas Reservas"
                />
                <StatusWidget icon={mdiCalendar} label="Calendario" />
                <StatusWidget icon={mdiSticker} label="Notas" />
            </div>

            <div className="divider m-2"></div>

            <div className="grid gap-2 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8">
                <StatusWidget icon={mdiHomeCity} label="15 Rentas" />
                <StatusWidget icon={mdiBed} label="15 Habitaciones" />
                <StatusWidget icon={mdiAccount} label="150 Clientes" />
                <StatusWidget icon={mdiCalendarAccount} label="1250 Reservas" />
            </div>
        </div>
    );
}

export default HomePage;
