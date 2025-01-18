import type { JSX } from 'react';
import { Header } from './components/header';

export const Page = (): JSX.Element => {
  return (
    <>
      <Header />
      <main className="container mx-auto py-10">
        <div className="rounded-md border">table</div>
      </main>
    </>
  );
};
