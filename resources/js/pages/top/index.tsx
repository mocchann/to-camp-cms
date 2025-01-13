import { Page } from './page';
import { createRoot } from 'react-dom/client';

const domNode = document.getElementById('top');

if (domNode) {
  const root = createRoot(domNode);
  root.render(<Page />);
}
