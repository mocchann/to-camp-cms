import { Anchor, AppShell, Button, Flex, rem } from '@mantine/core';
import { useHeadroom } from '@mantine/hooks';
import type { JSX } from 'react';

// type Props = {};

export const Header = (): JSX.Element => {
  const pinned = useHeadroom({ fixedAt: 120 });

  return (
    <>
      <AppShell
        header={{ height: 60, collapsed: !pinned, offset: false }}
        padding="md"
      >
        <AppShell.Header>
          <Flex justify="space-between" align="center" my={12} mx={12}>
            <Anchor>TO-CAMP-CMS</Anchor>
            <div>
              <Button>SignUp</Button>
              <Button ml={12}>Login</Button>
            </div>
          </Flex>
        </AppShell.Header>

        <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
          {/* Content */}
        </AppShell.Main>
      </AppShell>
    </>
  );
};
