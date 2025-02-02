import type { JSX } from 'react';
import {
  Anchor,
  AppShell,
  Button,
  FileInput,
  Flex,
  Group,
  NumberInput,
  Radio,
  RadioGroup,
  rem,
  TextInput,
} from '@mantine/core';
import { useForm, zodResolver } from '@mantine/form';
import { useHeadroom } from '@mantine/hooks';
import { CampGroundSchema } from '@/schemas/campGroundSchema';
import { ulid } from 'ulid';

type Props = {
  action: string;
  csrfToken: string;
};

export const Page = ({ action, csrfToken }: Props): JSX.Element => {
  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
      id: ulid(),
      name: '',
      address: '',
      price: 0,
      image: null,
      status: '',
      location: '',
      elevation: 0,
    },
    validate: zodResolver(CampGroundSchema),
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
        <form action={action} method="post" encType="multipart/form-data">
          <input type="hidden" name="_token" value={csrfToken} />
          <input type="hidden" name="id" value={form.values.id} />
          <TextInput
            withAsterisk
            label="Name"
            name="name"
            key={form.key('name')}
            {...form.getInputProps('name')}
          />
          <TextInput
            withAsterisk
            label="Address"
            name="address"
            key={form.key('address')}
            {...form.getInputProps('address')}
          />
          <NumberInput
            withAsterisk
            label="price"
            name="price"
            key={form.key('price')}
            {...form.getInputProps('price')}
          />
          <FileInput
            withAsterisk
            accept="image/png,image/jpeg"
            label="Upload files"
            name="image"
            placeholder="Upload file"
            key={form.key('image')}
            {...form.getInputProps('image')}
          />
          <RadioGroup
            label="Status"
            name="status"
            description="Select Status"
            required
            {...form.getInputProps('status')}
          >
            <Radio value="draft" label="Draft" />
            <Radio value="published" label="Published" />
            <Radio value="archived" label="archived" />
          </RadioGroup>
          <RadioGroup
            label="Location"
            name="location"
            description="Select Location"
            required
            {...form.getInputProps('location')}
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
          />
          <Group justify="flex-end" mt="md">
            <Button type="submit">Submit</Button>
          </Group>
        </form>
      </AppShell.Main>
    </AppShell>
  );
};
