import type { JSX } from 'react';
import { useHeadroom } from '@mantine/hooks';
import {
  AppShell,
  Button,
  Flex,
  Group,
  rem,
  Table,
  TextInput,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { Link } from 'react-router-dom';
import type { CampGround } from '@/types/CampGround';

type Props = {
  campGrounds: CampGround[];
  csrfToken: string;
};

export const Page = ({ campGrounds, csrfToken }: Props): JSX.Element => {
  const pinned = useHeadroom({ fixedAt: 120 });

  const rows = campGrounds?.map(
    (campGround): JSX.Element => (
      <Table.Tr key={campGround.name}>
        <Table.Td>{campGround.id}</Table.Td>
        <Table.Td>{campGround.name}</Table.Td>
        <Table.Td>{campGround.address}</Table.Td>
        <Table.Td>{campGround.price}</Table.Td>
        <Table.Td>
          <img
            src={campGround.image}
            alt={campGround.image}
            width={30}
            height={30}
          />
        </Table.Td>
        <Table.Td>{campGround.status}</Table.Td>
        <Table.Td>{campGround.location}</Table.Td>
        <Table.Td>{campGround.elevation}</Table.Td>
        <Table.Td>
          <Group justify="flex-end" my={12}>
            <form action={`/delete/${campGround.id}`} method="post">
              <input type="hidden" name="_token" value={csrfToken} />
              <Button color="red" type="submit">
                Delete
              </Button>
            </form>
          </Group>
        </Table.Td>
      </Table.Tr>
    ),
  );

  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      name: '',
      termsOfService: false,
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
            <Link to="/">TO-CAMP-CMS</Link>
            <div>
              <Button>SignUp</Button>
              <Button ml={12}>Login</Button>
            </div>
          </Flex>
        </AppShell.Header>
        <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
          <form onSubmit={form.onSubmit((values) => console.log(values))}>
            <TextInput
              label="Search"
              placeholder="Search CampGround Name"
              key={form.key('name')}
              {...form.getInputProps('name')}
            />
          </form>
          <Group justify="flex-end" my={12}>
            <Link to="/create">
              <Button type="button">Create</Button>
            </Link>
          </Group>
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
