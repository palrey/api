import React from 'react';
import BaseIcon from './BaseIcon';
/**
 * Props
 */
interface Props {
    icon: string;
    label: string;
    pulse?: boolean;
}
/**
 * StatusWidget
 * @param param0
 * @returns
 */
function StatusWidget({ icon, label, pulse }: Props) {
    return (
        <div className="card bg-white p-2 shadow-md hover:shadow-lg cursor-pointer">
            {pulse && (
                <div className="absolute top-4 right-4">
                    <span className="animate-ping absolute inline-flex h-4 w-4 rounded-full bg-sky-400 opacity-75"></span>
                    <span className=" inline-flex h-4 w-4 rounded-full bg-sky-400 opacity-75"></span>
                </div>
            )}
            <div className="card-body">
                <BaseIcon path={icon} size="3rem" className="mx-auto" />
                <div className="font-thin text-center">{label}</div>
            </div>
        </div>
    );
}

export default StatusWidget;
