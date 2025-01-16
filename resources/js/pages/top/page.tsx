import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import type { JSX } from 'react';
import { Header } from './components/header';

// type Props = {};

export const Page = (): JSX.Element => {
  return (
    <>
      <Header />
      <main className="container mx-auto py-10">
        <div className="rounded-md border">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>id</TableHead>
                <TableHead>name</TableHead>
                <TableHead>address</TableHead>
                <TableHead>price</TableHead>
                <TableHead>image</TableHead>
                <TableHead>status</TableHead>
                <TableHead>location</TableHead>
                <TableHead>elevation</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow>
                <TableCell>1</TableCell>
                <TableCell>name</TableCell>
                <TableCell>address</TableCell>
                <TableCell>price</TableCell>
                <TableCell>image</TableCell>
                <TableCell>status</TableCell>
                <TableCell>location</TableCell>
                <TableCell>elevation</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>2</TableCell>
                <TableCell>name</TableCell>
                <TableCell>address</TableCell>
                <TableCell>price</TableCell>
                <TableCell>image</TableCell>
                <TableCell>status</TableCell>
                <TableCell>location</TableCell>
                <TableCell>elevation</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>3</TableCell>
                <TableCell>name</TableCell>
                <TableCell>address</TableCell>
                <TableCell>price</TableCell>
                <TableCell>image</TableCell>
                <TableCell>status</TableCell>
                <TableCell>location</TableCell>
                <TableCell>elevation</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </div>
      </main>
    </>
  );
};
