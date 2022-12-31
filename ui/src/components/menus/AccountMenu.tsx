import React from 'react';
import { mdiAccount, mdiLogout } from '@mdi/js';
import BaseIcon from '../widgets/BaseIcon';

function AccountMenu() {
    return (
        <div className="dropdown dropdown-end">
            <button className="btn btn-square btn-ghost">
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
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                    ></path>
                </svg>
            </button>
            <div className="dropdown-content">
                <ul className="menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <div>
                            <BaseIcon path={mdiAccount} size="1rem" />
                            <span>Mi Cuenta</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <BaseIcon path={mdiLogout} size="1rem" />
                            <span>Salir</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    );
}

export default AccountMenu;
