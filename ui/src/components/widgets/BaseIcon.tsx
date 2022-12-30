import React, { SVGProps } from 'react';

interface Props extends SVGProps<SVGSVGElement> {
    path: string;
    size?: string;
    round?: boolean;
}
/**
 * BaseIcon
 * @returns
 */
function BaseIcon({ path, size, className, round, ...props }: Props) {
    return (
        <svg
            className={className}
            width={size}
            height={size}
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth="1"
            stroke="currentColor"
            aria-hidden="true"
            {...props}
        >
            <path
                strokeLinecap={round ? 'round' : 'inherit'}
                strokeLinejoin={round ? 'round' : 'inherit'}
                d={path}
            />
        </svg>
    );
}

export default BaseIcon;
