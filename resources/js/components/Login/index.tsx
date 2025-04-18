import type { JSX } from 'react';
import { Page } from './page';

export const Login = (): JSX.Element => {
  const action = document.getElementById('root')?.dataset.action || '';
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';
  const errors = document.getElementById('root')?.dataset.errors || undefined;
  const authCheck = Boolean(
    document.getElementById('root')?.dataset.authCheck || false,
  );
  const sessionErrors = document.getElementById('root')?.dataset.sessionErrors || undefined;

  return (
    <Page
      action={action}
      csrfToken={csrfToken}
      errors={errors}
      authCheck={authCheck}
      sessionErrors={sessionErrors}
    />
  );
};
