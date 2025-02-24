import type { JSX } from 'react';
import { Page } from './page';

export const Register = (): JSX.Element => {
  const action = document.getElementById('root')?.dataset.action || '';
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';
  const errors = document.getElementById('root')?.dataset.errors || undefined;
  const sessionErrors =
    document.getElementById('root')?.dataset.sessionErrors || undefined;
  const authCheck = Boolean(
    document.getElementById('root')?.dataset.authCheck || false,
  );

  return (
    <Page
      action={action}
      csrfToken={csrfToken}
      errors={errors}
      sessionErrors={sessionErrors}
      authCheck={authCheck}
    />
  );
};
