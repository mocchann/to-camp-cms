import { Button } from '@/components/ui/button';
import type { JSX } from 'react';

// type Props = {};

export const Header = (): JSX.Element => {
  return (
    <header className="flex items-center p-4">
      <h1 className="justify-start font-bold">TO-CAMP-CMS</h1>
      <div className="ml-auto flex space-x-4">
        <Button>Register</Button>
        <Button>Login</Button>
      </div>
    </header>
  );
};
