import React, { HtmlHTMLAttributes, PropsWithChildren } from 'react';
import { CONST } from '@/helpers';

interface Prop extends PropsWithChildren<HtmlHTMLAttributes<HTMLDivElement>> {
    items?: React.ReactNode;
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
                {items}
            </div>
        </div>
    );
}

export default LeftDrawer;
