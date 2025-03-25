import type { JSX } from 'react';
import { Page } from './page';

export const Top = (): JSX.Element => {
  const campGroundsJson = document.getElementById('root')?.dataset.campGrounds;
  const campGrounds = campGroundsJson ? JSON.parse(campGroundsJson) : [];
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';
  const authCheck = Boolean(
    document.getElementById('root')?.dataset.authCheck || false,
  );
  const userName = document.getElementById('root')?.dataset.userName || '';
  const errors = document.getElementById('root')?.dataset.errors || undefined;

  return (
    <Page
      campGrounds={campGrounds}
      csrfToken={csrfToken}
      authCheck={authCheck}
      userName={userName}
      errors={errors}
    />
  );
};
