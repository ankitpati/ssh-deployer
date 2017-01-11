drop user if exists sshdeployer@localhost;
create user sshdeployer@localhost identified by "sshdeployer";

grant usage on *.* to sshdeployer@localhost;
grant all privileges on sshdeployer.* to sshdeployer@localhost;
