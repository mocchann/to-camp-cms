import type { JSX } from 'react';

type CampGround = {
  id: string;
  name: string;
  address: string;
  price: number;
  image: string;
  status: string;
  location: string;
  elevation: number;
};

type Props = {
  campGround: CampGround;
};

export const Page = ({ campGround }: Props): JSX.Element => {
  return <>update page</>;
};
