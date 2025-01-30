import type { JSX } from 'react';
import { Page } from './page';

export const Top = (): JSX.Element => {
  const campGroundsJson = document.getElementById('top')?.dataset.campGrounds;
  const campGrounds = campGroundsJson ? JSON.parse(campGroundsJson) : [];

  return <Page campGrounds={campGrounds} />;
};
