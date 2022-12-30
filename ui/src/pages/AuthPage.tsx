import React from 'react';
import AuthLoginForm from '@/components/forms/auth/AuthLoginForm';

function AuthPage() {
    return (
        <div className="card bg-base-100 shadow-md shrink">
            <div className="card-body">
                <AuthLoginForm />
            </div>
        </div>
    );
}

export default AuthPage;
