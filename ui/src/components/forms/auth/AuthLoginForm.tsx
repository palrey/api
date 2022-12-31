import React, { FormEvent, useState } from 'react';
import InputText from '../InputText';
import { $service } from '@/services';
import { IAuthLogin } from '@/services/users';
import BaseIcon from '@/components/widgets/BaseIcon';
import { mdiLoading } from '@mdi/js';

function AuthLoginForm() {
    const { user } = $service;
    const [form, setForm] = useState<IAuthLogin>({
        email: '',
        password: ''
    });
    const [error, setError] = useState<string[]>([]);
    const [loading, setLoading] = useState<boolean>(false);

    function showError(err: string) {
        setError(d => [...d, err]);

        const timer = setTimeout(() => {
            setError(d => d.slice(1, d.length));
            clearTimeout(timer);
        }, 2500);
    }

    /**
     * onSubmit
     * @param e FormEvent
     */
    async function onSubmit(e: FormEvent) {
        e.preventDefault();
        setLoading(true);
        try {
            await user.login(form);
        } catch (error) {
            showError('Las Credenciales son incorrectas');
        }
        setLoading(false);
    }

    return (
        <form className="space-y-2" onSubmit={onSubmit}>
            <InputText
                type="email"
                label="Email"
                idKey="auth-login-email"
                bordered
                value={form.email}
                required
                setValue={v =>
                    setForm(oldVal => ({ ...oldVal, email: v.toString() }))
                }
            />
            <InputText
                type="password"
                label="Contraseña"
                idKey="auth-login-password"
                bordered
                value={form.password}
                required
                setValue={v =>
                    setForm(oldVal => ({ ...oldVal, password: v.toString() }))
                }
            />
            <div className="pt-2">
                <button className="btn btn-primary w-full" type="submit">
                    {loading && (
                        <BaseIcon
                            path={mdiLoading}
                            className="animate-spin mx-2"
                            size="1rem"
                        />
                    )}
                    Iniciar
                </button>
            </div>

            {error && (
                <div className="toast">
                    {error.map((e, k) => (
                        <div className="alert alert-error" key={k}>
                            {e}
                        </div>
                    ))}
                </div>
            )}
        </form>
    );
}

export default AuthLoginForm;
