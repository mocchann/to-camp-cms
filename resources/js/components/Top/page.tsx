import { useRef, type JSX } from 'react';
import { useHeadroom } from '@mantine/hooks';
import {
  AppShell,
  Button,
  Flex,
  Group,
  Image,
  rem,
  Table,
  Text,
  TextInput,
  Title,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { Link } from 'react-router-dom';
import type { CampGround } from '@/types/CampGround';
import { modals, ModalsProvider } from '@mantine/modals';
import { BiPlusMedical } from 'react-icons/bi';

type Props = {
  campGrounds: CampGround[];
  csrfToken: string;
};

export const Page = ({ campGrounds, csrfToken }: Props): JSX.Element => {
  const pinned = useHeadroom({ fixedAt: 120 });
  const deleteFormRef = useRef<HTMLFormElement | null>(null);

  const openDeleteModal = () =>
    modals.openConfirmModal({
      title: 'Delete CampGround',
      centered: true,
      children: (
        <Text size="sm">
          Are you sure you want to delete camp ground? This action is
          destructive and you will have to contact support to restore your data.
        </Text>
      ),
      labels: { confirm: 'Delete Camp Ground', cancel: "No don't delete it" },
      confirmProps: { color: 'red' },
      onCancel: () => console.log('Cancel'),
      onConfirm: () => {
        deleteFormRef.current?.submit();
      },
    });

  const rows = campGrounds?.map(
    (campGround): JSX.Element => (
      <Table.Tr key={campGround.name}>
        <Table.Td>
          <Image
            src={campGround.image}
            alt={campGround.name}
            w={100}
            h={100}
            fit="contain"
          />
        </Table.Td>
        <Table.Td>
          <Link to={`/update/${campGround.id}`}>{campGround.id}</Link>
        </Table.Td>
        <Table.Td>{campGround.name}</Table.Td>
        <Table.Td>{campGround.address}</Table.Td>
        <Table.Td>{campGround.price}</Table.Td>
        <Table.Td>{campGround.status}</Table.Td>
        <Table.Td>{campGround.location}</Table.Td>
        <Table.Td>{campGround.elevation}</Table.Td>
        <Table.Td>
          <Group justify="flex-end" my={12}>
            <form
              ref={deleteFormRef}
              action={`/delete/${campGround.id}`}
              method="POST"
            >
              <input type="hidden" name="_token" value={csrfToken} />
              <ModalsProvider>
                <Button color="red" onClick={openDeleteModal} type="button">
                  Delete
                </Button>
              </ModalsProvider>
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
          <Title order={2}>CampGround Index</Title>
          <Group justify="flex-end" my={32}>
            <Link to="/create">
              <Button type="button">
                <BiPlusMedical />
                Create
              </Button>
            </Link>
          </Group>
          <form action={'/'} method="GET">
            <TextInput
              name="name"
              placeholder="Search CampGround Name"
              key={form.key('name')}
              {...form.getInputProps('name')}
            />
          </form>
          <Table my={40}>
            <Table.Thead>
              <Table.Tr>
                <Table.Th>image</Table.Th>
                <Table.Th>ID</Table.Th>
                <Table.Th>name</Table.Th>
                <Table.Th>address</Table.Th>
                <Table.Th>price</Table.Th>
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
