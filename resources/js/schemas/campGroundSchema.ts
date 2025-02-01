import { z } from 'zod';

const MIME_TYPES = ['image/jpeg', 'image/png', 'image/jpg'];
const STATUSES = ['draft', 'published', 'archived'] as const;
const LOCATIONS = [
  'sea',
  'mountain',
  'river',
  'lake',
  'woods',
  'highland',
] as const;

export const CampGroundSchema = z.object({
  name: z.string().nonempty({ message: 'Name is required' }),
  address: z.string().nonempty({ message: 'Address is required' }),
  price: z.number().nonnegative(),
  image: z
    .custom<FileList>()
    .refine((file) => file.length === 0, { message: 'Image is required' })
    .transform((file) => file[0])
    .refine((file) => MIME_TYPES.includes(file.type), {
      message: 'Invalid file type. Only jpeg, jpg, png are allowed',
    }),
  status: z.enum(STATUSES),
  location: z.enum(LOCATIONS),
  elevation: z.number(),
});
