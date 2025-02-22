import {
  Alert,
  Anchor,
  AppShell,
  Button,
  Flex,
  Group,
  PasswordInput,
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
  sessionErrors?: string | null;
};

export const Page = ({
  action,
  csrfToken,
  errors,
  sessionErrors,
}: Props): JSX.Element => {
  const errorMessages = errors ? JSON.parse(errors) : {};
  const sessionErrorMessages = sessionErrors ? JSON.parse(sessionErrors) : {};

  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      id: crypto.getRandomValues(new Uint32Array(1))[0],
      name: '',
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
            <Anchor component={Link} to="/register">
              <Button>SignUp</Button>
            </Anchor>
            <Anchor component={Link} to="/login">
              <Button ml={12}>Login</Button>
            </Anchor>
          </div>
        </Flex>
      </AppShell.Header>
      <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
        <Title order={2} my={8}>
          Register
        </Title>
        {sessionErrorMessages !== null &&
          Object.keys(sessionErrorMessages).length > 0 && (
            <Alert title="Error" color="red" mb="md">
              {Object.values(sessionErrorMessages)}
            </Alert>
          )}
        <form action={action} method="POST" encType="multipart/form-data">
          <input type="hidden" name="_token" value={csrfToken} />
          <input type="hidden" name="id" value={form.values.id} />
          <TextInput
            withAsterisk
            required
            label="name"
            name="name"
            key={form.key('name')}
            {...form.getInputProps('name')}
            error={errorMessages.name?.join('\n') || undefined}
          />
          <TextInput
            withAsterisk
            required
            label="Email"
            name="email"
            key={form.key('email')}
            {...form.getInputProps('email')}
            error={errorMessages.email?.join('\n') || undefined}
          />
          <PasswordInput
            withAsterisk
            required
            label="Password"
            name="password"
            error={errorMessages.password?.join('\n') || undefined}
          />
          <Group justify="flex-end" mt="md">
            <Button type="submit">Submit</Button>
          </Group>
        </form>
      </AppShell.Main>
    </AppShell>
  );
};
