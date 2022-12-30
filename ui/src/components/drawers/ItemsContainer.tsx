import React, { PropsWithChildren } from 'react';

type Props = PropsWithChildren;

function ItemsContainer({ children }: Props) {
    return (
        <ul className="menu w-80 bg-base-100 text-base-content">{children}</ul>
    );
}

export default ItemsContainer;
