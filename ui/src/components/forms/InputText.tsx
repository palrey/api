import React, { DetailedHTMLProps, InputHTMLAttributes } from 'react';
import { joinClassName } from '@/helpers';
/**
 * Props
 */
interface Props
    extends DetailedHTMLProps<
        InputHTMLAttributes<HTMLInputElement>,
        HTMLInputElement
    > {
    label?: string;
    setValue?: (v: number | string) => void;
    idKey: string;
    bordered?: boolean;
}

function InputText({
    bordered,
    className,
    idKey,
    label,
    setValue,
    ...props
}: Props) {
    return (
        <div className="form-control">
            <label className="label" htmlFor={idKey}>
                <span className="label-text">{label}</span>
            </label>
            <input
                onChange={e =>
                    setValue ? setValue(e.target.value) : undefined
                }
                className={joinClassName([
                    'input',
                    className,
                    bordered ? 'input-bordered' : ''
                ])}
                id={idKey}
                {...props}
            />
        </div>
    );
}

export default InputText;
