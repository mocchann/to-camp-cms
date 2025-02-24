import type { JSX } from 'react';
import { Page } from './page';

export const Update = (): JSX.Element => {
  const action = document.getElementById('root')?.dataset.action || '';
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';
  const errors = document.getElementById('root')?.dataset.errors || undefined;
  const campGroundJson = document.getElementById('root')?.dataset.campGround;
  const campGround = campGroundJson ? JSON.parse(campGroundJson) : [];
  const authCheck = Boolean(
    document.getElementById('root')?.dataset.authCheck || false,
  );

  return (
    <Page
      action={action}
      csrfToken={csrfToken}
      errors={errors}
      campGround={campGround}
      authCheck={authCheck}
    />
  );
};
