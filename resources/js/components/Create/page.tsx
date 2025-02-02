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

export const Page = (): JSX.Element => {
  const form = useForm({
    mode: 'uncontrolled',
    initialValues: {
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
        <form onSubmit={form.onSubmit((values) => console.log(values))}>
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
          <NumberInput
            withAsterisk
            label="price"
            key={form.key('price')}
            {...form.getInputProps('price')}
          />
          <FileInput
            withAsterisk
            accept="image/png,image/jpeg"
            label="Upload files"
            placeholder="Upload file"
            key={form.key('image')}
            {...form.getInputProps('image')}
          />
          <RadioGroup
            label="Status"
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
