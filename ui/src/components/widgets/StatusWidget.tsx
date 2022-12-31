import React from 'react';
import BaseIcon from './BaseIcon';
/**
 * Props
 */
interface Props {
    icon: string;
    label: string;
}
/**
 * StatusWidget
 * @param param0
 * @returns
 */
function StatusWidget({ icon, label }: Props) {
    return (
        <div className="card bg-white p-2 shadow-md hover:shadow-lg cursor-pointer">
            <div className="card-body">
                <BaseIcon path={icon} size="3rem" className="mx-auto" />
                <div className="font-thin text-center">{label}</div>
            </div>
        </div>
    );
}

export default StatusWidget;
