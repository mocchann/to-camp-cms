import type { JSX } from 'react';

// type Props = {};

export const Header = (): JSX.Element => {
  return (
    <header className="flex items-center p-4">
      <h1 className="justify-start font-bold">TO-CAMP-CMS</h1>
      <div className="ml-auto flex space-x-4">
        <button type="button">Register</button>
        <button type="button">Login</button>
      </div>
    </header>
  );
};
