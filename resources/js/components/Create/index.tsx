import type { JSX } from 'react';
import { Page } from './page';

export const Create = (): JSX.Element => {
  const action = document.getElementById('root')?.dataset.action || '';
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';

  return <Page action={action} csrfToken={csrfToken} />;
};
