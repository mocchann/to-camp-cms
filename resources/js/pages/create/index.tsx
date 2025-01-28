import { createTheme, MantineProvider } from '@mantine/core';
import { createRoot } from 'react-dom/client';
import { Page } from './page';

const domNode = document.getElementById('create');

const theme = createTheme({
  fontFamily: 'Open Sans, sans-serif',
  primaryColor: 'blue',
});

if (domNode) {
  const root = createRoot(domNode);

  root.render(
    <MantineProvider theme={theme}>
      <Page />
    </MantineProvider>,
  );
}
