import '@mantine/core/styles.css';
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
  const campGroundsJson = document.getElementById('top')?.dataset.campGrounds;
  const campGrounds = campGroundsJson ? JSON.parse(campGroundsJson) : [];

  root.render(
    <MantineProvider theme={theme}>
      <Page campGrounds={campGrounds} />
    </MantineProvider>,
  );
}
