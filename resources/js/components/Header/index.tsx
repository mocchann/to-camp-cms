import { Anchor, AppShell, Button, Flex, Menu } from '@mantine/core';
import type { JSX } from 'react';
import { Link } from 'react-router-dom';

type Props = {
  authCheck: boolean;
  userName?: string;
  csrfToken?: string;
};

export const Header = ({
  authCheck,
  userName,
  csrfToken,
}: Props): JSX.Element => {
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
                <form action="/logout" method="POST">
                  <input type="hidden" name="_token" value={csrfToken} />
                  <Menu.Item component="button" type="submit">
                    Logout
                  </Menu.Item>
                </form>
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
