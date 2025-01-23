import type { JSX } from 'react';
import { useHeadroom } from '@mantine/hooks';
import {
  Anchor,
  AppShell,
  Button,
  Flex,
  Group,
  rem,
  Table,
  TextInput,
} from '@mantine/core';
import { useForm } from '@mantine/form';

export const Page = (): JSX.Element => {
  const pinned = useHeadroom({ fixedAt: 120 });
  const elements = [
    {
      id: 6,
      name: 'agl',
      address: 'street1',
      price: 1234,
      image: 'example.png',
      status: 'open',
      location: 'tokyo',
      elevation: 123,
    },
    {
      id: 7,
      name: 'ane',
      address: 'street2',
      price: 5678,
      image: 'example.png',
      status: 'open',
      location: 'tokyo',
      elevation: 123,
    },
  ];
  const rows = elements.map(
    (element): JSX.Element => (
      <Table.Tr key={element.name}>
        <Table.Td>{element.id}</Table.Td>
        <Table.Td>{element.name}</Table.Td>
        <Table.Td>{element.address}</Table.Td>
        <Table.Td>{element.price}</Table.Td>
        <Table.Td>{element.image}</Table.Td>
        <Table.Td>{element.status}</Table.Td>
        <Table.Td>{element.location}</Table.Td>
        <Table.Td>{element.elevation}</Table.Td>
      </Table.Tr>
    ),
  );
  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      name: '',
      termsOfService: false,
    },

    validate: {
      name: (value) => value === '' && 'This field is required',
    },
  });

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
          <form onSubmit={form.onSubmit((values) => console.log(values))}>
            <TextInput
              withAsterisk
              label="Name"
              placeholder="Search CampGround"
              key={form.key('name')}
              {...form.getInputProps('name')}
            />
            <Group justify="flex-end" mt="md">
              <Button type="submit">Submit</Button>
            </Group>
          </form>
          <Table>
            <Table.Thead>
              <Table.Tr>
                <Table.Th>ID</Table.Th>
                <Table.Th>name</Table.Th>
                <Table.Th>address</Table.Th>
                <Table.Th>price</Table.Th>
                <Table.Th>image</Table.Th>
                <Table.Th>status</Table.Th>
                <Table.Th>location</Table.Th>
                <Table.Th>elevation</Table.Th>
              </Table.Tr>
            </Table.Thead>
            <Table.Tbody>{rows}</Table.Tbody>
          </Table>
        </AppShell.Main>
      </AppShell>
    </>
  );
};
