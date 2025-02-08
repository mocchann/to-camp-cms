import type { JSX } from 'react';
import { Page } from './page';

export const Top = (): JSX.Element => {
  const campGroundsJson = document.getElementById('root')?.dataset.campGrounds;
  const campGrounds = campGroundsJson ? JSON.parse(campGroundsJson) : [];
  const csrfToken = document.getElementById('root')?.dataset.csrfToken || '';

  return <Page campGrounds={campGrounds} csrfToken={csrfToken} />;
};
