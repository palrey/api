import React, { FormEvent } from 'react';
import InputText from '../InputText';

function AuthLoginForm() {
    async function onSubmit(e: FormEvent) {
        e.preventDefault();
        console.log('Submit');
    }

    return (
        <form className="space-y-2" onSubmit={onSubmit}>
            <InputText
                type="email"
                label="Email"
                idKey="auth-login-email"
                bordered
            />
            <InputText
                type="password"
                label="Contraseña"
                idKey="auth-login-password"
                bordered
            />
            <div className="mt-4">
                <button className="btn btn-primary" type="submit">
                    Iniciar
                </button>
            </div>
        </form>
    );
}

export default AuthLoginForm;
