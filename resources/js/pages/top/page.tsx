import type { JSX } from 'react';
import { useHeadroom } from '@mantine/hooks';
import { Anchor, AppShell, Button, Flex, rem, Table } from '@mantine/core';

export const Page = (): JSX.Element => {
  const pinned = useHeadroom({ fixedAt: 120 });
  const elements = [
    { position: 6, mass: 12.011, symbol: 'C', name: 'Carbon' },
    { position: 7, mass: 14.007, symbol: 'N', name: 'Nitrogen' },
    { position: 39, mass: 88.906, symbol: 'Y', name: 'Yttrium' },
    { position: 56, mass: 137.33, symbol: 'Ba', name: 'Barium' },
    { position: 58, mass: 140.12, symbol: 'Ce', name: 'Cerium' },
  ];
  const rows = elements.map((element) => (
    <Table.Tr key={element.name}>
      <Table.Td>{element.position}</Table.Td>
      <Table.Td>{element.name}</Table.Td>
      <Table.Td>{element.symbol}</Table.Td>
      <Table.Td>{element.mass}</Table.Td>
    </Table.Tr>
  ));

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
          <Table>
            <Table.Thead>
              <Table.Tr>
                <Table.Th>Element position</Table.Th>
                <Table.Th>Element name</Table.Th>
                <Table.Th>Symbol</Table.Th>
                <Table.Th>Atomic mass</Table.Th>
              </Table.Tr>
            </Table.Thead>
            <Table.Tbody>{rows}</Table.Tbody>
          </Table>
        </AppShell.Main>
      </AppShell>
    </>
  );
};
