import { Button } from '@/components/ui/button';
import type { JSX } from 'react';

// type Props = {};

export const Header = (): JSX.Element => {
  return (
    <header className="flex items-center my-8">
      <h1 className="justify-start">Header</h1>
      <Button>Register</Button>
      <Button>Login</Button>
    </header>
  );
};
