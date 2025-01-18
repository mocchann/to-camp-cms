import { createTheme, MantineProvider } from '@mantine/core';
import { Page } from './page';
import { createRoot } from 'react-dom/client';

const domNode = document.getElementById('top');

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
