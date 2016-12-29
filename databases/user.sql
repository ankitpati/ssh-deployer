drop user if exists tasktracker@localhost;
create user tasktracker@localhost identified by "tasktracker";

grant usage on *.* to tasktracker@localhost;
grant all privileges on tasktracker.* to tasktracker@localhost;
