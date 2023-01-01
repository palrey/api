import React, {
    ChangeEvent,
    DetailedHTMLProps,
    InputHTMLAttributes
} from 'react';
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
    handleChange?: (e: ChangeEvent<HTMLInputElement>) => void;
    bordered?: boolean;
}

function InputText({
    bordered,
    className,
    id,
    label,
    handleChange,
    ...props
}: Props) {
    return (
        <div className="form-control">
            <label className="label" htmlFor={id}>
                <span className="label-text">{label}</span>
            </label>
            <input
                onChange={e => (handleChange ? handleChange(e) : undefined)}
                className={joinClassName([
                    'input',
                    className,
                    bordered ? 'input-bordered' : ''
                ])}
                id={id}
                {...props}
            />
        </div>
    );
}

export default InputText;
