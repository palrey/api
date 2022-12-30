import React, { HtmlHTMLAttributes, PropsWithChildren } from 'react';
import { CONST } from '@/helpers';
import { IDrawerLink } from '@/types/components';

interface Prop extends PropsWithChildren<HtmlHTMLAttributes<HTMLDivElement>> {
    items?: IDrawerLink[];
}
/**
 * LeftDrawer
 * @param param0
 * @returns
 */
function LeftDrawer({ className, children, items }: Prop) {
    const drawerId = CONST.drawerLeft;
    return (
        <div className={`drawer${className ? ' ' + className : ''}`}>
            <input id={drawerId} type="checkbox" className="drawer-toggle" />
            <div className="drawer-content">{children}</div>
            <div className="drawer-side">
                <label htmlFor={drawerId} className="drawer-overlay">
                    overlay
                </label>
                <ul className="menu p-4 w-80 bg-base-100 text-base-content">
                    {items?.map((i, k) => (
                        <li key={k}>{i.label}</li>
                    ))}
                </ul>
            </div>
        </div>
    );
}

export default LeftDrawer;
