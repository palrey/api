import React from 'react';
import { CONST } from '@/helpers';
import AccountMenu from '../menus/AccountMenu';

interface Props {
    title: string;
}
/**
 *
 * @returns
 */
function Navbar({ title }: Props) {
    const drawerId = CONST.drawerLeft;

    return (
        <>
            {/* Mobile */}
            <div className="navbar bg-base-100 sm:hidden fixed z-30">
                <div className="flex-none">
                    <label
                        className="btn btn-square btn-ghost"
                        htmlFor={drawerId}
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            className="inline-block w-5 h-5 stroke-current"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                        </svg>
                    </label>
                </div>
                <div className="flex-1">
                    <div className="btn btn-ghost normal-case text-xl">
                        {title}
                    </div>
                </div>
                <div className="flex-none">
                    <AccountMenu />
                </div>
            </div>
            {/* End Mobile */}
            {/* start Desktop */}
            <div className="navbar bg-base-100 hidden sm:block">
                <div className="flex-1">
                    <div className="btn btn-ghost normal-case text-xl">
                        {title}
                    </div>
                </div>
                <div className="flex-none">
                    <ul className="menu menu-horizontal px-1">
                        <li>
                            <div>Item 1</div>
                        </li>
                        <li>
                            <div>
                                Parent
                                <svg
                                    className="fill-current"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                                </svg>
                            </div>
                            <ul className="p-2 bg-base-100">
                                <li>
                                    <div>Submenu 1</div>
                                </li>
                                <li>
                                    <div>Submenu 2</div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div>Item 3</div>
                        </li>
                    </ul>
                </div>
            </div>
            {/* end Desktop */}
        </>
    );
}

export default Navbar;
