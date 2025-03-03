import {
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
  authCheck: boolean;
};

export const Page = ({
  action,
  csrfToken,
  errors,
  authCheck,
}: Props): JSX.Element => {
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
      <Header authCheck={authCheck} />
      <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
        <Title order={2} my={8}>
          Login
        </Title>
        <form action={action} method="POST" encType="multipart/form-data">
          <input type="hidden" name="_token" value={csrfToken} />
          <TextInput
            withAsterisk
            required
            label="Email"
            name="email"
            key={form.key('email')}
            {...form.getInputProps('email')}
            error={errorMessages.name?.join('\n') || undefined}
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
