import '@mantine/core/styles.css';
import { createTheme, MantineProvider } from '@mantine/core';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import type { JSX } from 'react';
import { Top } from './components/Top';
import { Create } from './components/Create';
import { Update } from './components/Update';

const theme = createTheme({
  fontFamily: 'Open Sans, sans-serif',
  primaryColor: 'blue',
});

const Main = (): JSX.Element => (
  <MantineProvider theme={theme}>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Top />} />
        <Route path="/create" element={<Create />} />
        <Route path="/update" element={<Update />} />
      </Routes>
    </BrowserRouter>
  </MantineProvider>
);

const domNode = document.getElementById('root');
if (domNode) {
  const root = createRoot(domNode);

  root.render(<Main />);
}
