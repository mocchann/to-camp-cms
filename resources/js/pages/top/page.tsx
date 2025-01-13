import { Table } from '@/components/ui/table';
import type { JSX } from 'react';
import { Header } from './components/header';
import { Footer } from './components/footer';

// type Props = {};

export const Page = (): JSX.Element => {
  return (
    <>
      <Header />
      <main>
        <Table />
      </main>
      <Footer />
    </>
  );
};
