import type { JSX } from 'react';
import {
  AppShell,
  Button,
  FileInput,
  Group,
  Image,
  NumberInput,
  Radio,
  RadioGroup,
  rem,
  TextInput,
  Title,
} from '@mantine/core';
import { useForm } from '@mantine/form';
import { useHeadroom } from '@mantine/hooks';
import type { CampGround } from '@/types/CampGround';
import { Header } from '../Header';

type Props = {
  action: string;
  csrfToken: string;
  errors?: string;
  campGround: CampGround;
  authCheck: boolean;
  userName: string;
};

export const Page = ({
  action,
  csrfToken,
  errors,
  campGround,
  authCheck,
  userName,
}: Props): JSX.Element => {
  const errorMessages = errors ? JSON.parse(errors) : {};

  const form = useForm({
    initialValues: {
      id: campGround.id,
      name: campGround.name,
      address: campGround.address,
      price: campGround.price,
      image: campGround.image,
      status: campGround.status,
      location: campGround.location,
      elevation: campGround.elevation,
    },
  });

  const pinned = useHeadroom({ fixedAt: 120 });

  return (
    <AppShell
      header={{ height: 60, collapsed: !pinned, offset: false }}
      padding="md"
    >
      <Header authCheck={authCheck} userName={userName} csrfToken={csrfToken} />
      <AppShell.Main pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}>
        <Title order={2} my={8}>
          CampGround Update
        </Title>
        <form action={action} method="post" encType="multipart/form-data">
          <input type="hidden" name="_token" value={csrfToken} />
          <input type="hidden" name="id" value={form.values.id} />
          <TextInput
            withAsterisk
            label="Name"
            name="name"
            key={form.key('name')}
            {...form.getInputProps('name')}
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
          <NumberInput
            withAsterisk
            label="price"
            name="price"
            key={form.key('price')}
            {...form.getInputProps('price')}
            error={errorMessages.price?.join('\n') || undefined}
          />
          <Image
            src={campGround.image}
            alt={campGround.name}
            w={180}
            h={180}
            my={8}
            fit="contain"
            radius="md"
          />
          <FileInput
            withAsterisk
            accept="image/png,image/jpeg"
            label="Upload files"
            name="image"
            key={form.key('image')}
            {...form.getInputProps('image')}
            error={errorMessages.image?.join('\n') || undefined}
          />
          <input
            type="hidden"
            name="image_file_path"
            value={new URL(
              form.values.image,
              window.location.origin,
            ).pathname.replace(/^\/storage\//, '')}
          />
          <RadioGroup
            label="Status"
            name="status"
            description="Select Status"
            required
            {...form.getInputProps('status')}
            error={errorMessages.status?.join('\n') || undefined}
          >
            <Radio value="draft" label="Draft" />
            <Radio value="published" label="Published" />
            <Radio value="archived" label="Archived" />
          </RadioGroup>
          <RadioGroup
            label="Location"
            name="location"
            description="Select Location"
            required
            {...form.getInputProps('location')}
            error={errorMessages.location?.join('\n') || undefined}
          >
            <Radio value="sea" label="Sea" />
            <Radio value="mountain" label="Mountain" />
            <Radio value="river" label="River" />
            <Radio value="lake" label="Lake" />
            <Radio value="woods" label="Woods" />
            <Radio value="highland" label="Highland" />
          </RadioGroup>
          <NumberInput
            withAsterisk
            label="Elevation"
            name="elevation"
            key={form.key('elevation')}
            {...form.getInputProps('elevation')}
            error={errorMessages.elevation?.join('\n') || undefined}
          />
          <Group justify="flex-end" mt="md">
            <Button type="submit">Submit</Button>
          </Group>
        </form>
      </AppShell.Main>
    </AppShell>
  );
};
