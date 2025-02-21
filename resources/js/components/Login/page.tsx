import {
  Anchor,
  AppShell,
  Button,
  Flex,
  Group,
  rem,
  TextInput,
  Title,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { useHeadroom } from '@mantine/hooks';
import type { JSX } from 'react';
import { Link } from 'react-router-dom';

type Props = {
  action: string;
  csrfToken: string;
  errors?: string | null;
};

export const Page = ({ action, csrfToken, errors }: Props): JSX.Element => {
  const errorMessages = errors ? JSON.parse(errors) : {};

  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      email: '',
      password: '',
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
          <Anchor component={Link} to="/">
            TO-CAMP-CMS
          </Anchor>
          <div>
            <Button>SignUp</Button>
            <Button ml={12}>Login</Button>
          </div>
        </Flex>
      </AppShell.Header>
      <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
        <Title order={2} my={8}>
          Login
        </Title>
        <form action={action} method="POST" encType="multipart/form-data">
          <input type="hidden" name="_token" value={csrfToken} />
          <TextInput
            withAsterisk
            label="Email"
            name="email"
            key={form.key('email')}
            {...form.getInputProps('email')}
            error={errorMessages.name?.join('\n') || undefined}
          />
          <TextInput
            withAsterisk
            label="Address"
            name="address"
            key={form.key('address')}
            {...form.getInputProps('address')}
            error={errorMessages.address?.join('\n') || undefined}
          />
          <Group justify="flex-end" mt="md">
            <Button type="submit">Submit</Button>
          </Group>
        </form>
      </AppShell.Main>
    </AppShell>
  );
};
