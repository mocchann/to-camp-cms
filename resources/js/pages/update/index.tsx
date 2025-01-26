import '@mantine/core/styles.css';
import { createTheme, MantineProvider } from '@mantine/core';
import { Page } from './page';
import { createRoot } from 'react-dom/client';

const domNode = document.getElementById('update');

const theme = createTheme({
  fontFamily: 'Open Sans, sans-serif',
  primaryColor: 'blue',
});

if (domNode) {
  const root = createRoot(domNode);
  const campGroundJson = document.getElementById('update')?.dataset.campGround;
  const campGround = campGroundJson ? JSON.parse(campGroundJson) : [];

  root.render(
    <MantineProvider theme={theme}>
      <Page campGround={campGround} />
    </MantineProvider>,
  );
}
