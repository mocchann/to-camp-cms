import type { JSX } from 'react';
import {
  Anchor,
  AppShell,
  Button,
  Flex,
  Group,
  rem,
  TextInput,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { useHeadroom } from '@mantine/hooks';

export const Page = (): JSX.Element => {
  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      id: '',
      name: '',
      address: '',
      price: 0,
      image: '',
      status: '',
      location: '',
      elevation: 0,
    },
  });

  const pinned = useHeadroom({ fixedAt: 120 });

  return (
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
            label="Id"
            key={form.key('id')}
            {...form.getInputProps('id')}
          />
          <TextInput
            withAsterisk
            label="Name"
            key={form.key('name')}
            {...form.getInputProps('name')}
          />
          <TextInput
            withAsterisk
            label="Address"
            key={form.key('address')}
            {...form.getInputProps('address')}
          />
          <TextInput
            withAsterisk
            label="price"
            key={form.key('price')}
            {...form.getInputProps('price')}
          />
          <TextInput
            withAsterisk
            label="Image"
            key={form.key('image')}
            {...form.getInputProps('image')}
          />
          <TextInput
            withAsterisk
            label="Status"
            key={form.key('status')}
            {...form.getInputProps('status')}
          />
          <TextInput
            withAsterisk
            label="Location"
            key={form.key('location')}
            {...form.getInputProps('location')}
          />
          <TextInput
            withAsterisk
            label="Elevation"
            key={form.key('elevation')}
            {...form.getInputProps('elevation')}
          />

          <Group justify="flex-end" mt="md">
            <Button type="submit">Submit</Button>
          </Group>
        </form>
      </AppShell.Main>
    </AppShell>
  );
};
