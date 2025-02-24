import { Anchor, AppShell, Button, Flex, Menu, Text } from '@mantine/core';
import type { JSX } from 'react';
import { Link } from 'react-router-dom';

type Props = {
  authCheck: boolean;
  userName?: string;
};

export const Header = ({ authCheck, userName }: Props): JSX.Element => {
  return (
    <AppShell.Header>
      <Flex justify="space-between" align="center" my={12} mx={12}>
        <Anchor component={Link} to="/">
          TO-CAMP-CMS
        </Anchor>
        <div>
          {authCheck ? (
            <Menu shadow="md" width={200}>
              <Menu.Target>
                <Button>{userName}</Button>
              </Menu.Target>
              <Menu.Dropdown>
                <Menu.Label>Application</Menu.Label>
                <Menu.Item>Logout</Menu.Item>
                <Menu.Divider />
                <Menu.Label>Danger zone</Menu.Label>
                <Menu.Item color="red">Delete my account</Menu.Item>
              </Menu.Dropdown>
            </Menu>
          ) : (
            <>
              <Anchor component={Link} to="/register">
                <Button>SignUp</Button>
              </Anchor>
              <Anchor component={Link} to="/login">
                <Button ml={12}>Login</Button>
              </Anchor>
            </>
          )}
        </div>
      </Flex>
    </AppShell.Header>
  );
};
