import {
  Alert,
  AppShell,
  Button,
  Group,
  PasswordInput,
  rem,
  TextInput,
  Title,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { useHeadroom } from '@mantine/hooks';
import type { JSX } from 'react';
import { Header } from '../Header';

type Props = {
  action: string;
  csrfToken: string;
  errors?: string | null;
  sessionErrors?: string | null;
  authCheck: boolean;
};

export const Page = ({
  action,
  csrfToken,
  errors,
  sessionErrors,
  authCheck,
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
      <Header authCheck={authCheck} />
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
