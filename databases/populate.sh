#!/bin/bash

mysql -uroot -p < user.sql 2> /dev/null
mysql -usshdeployer -psshdeployer < schema.sql 2> /dev/null
mysql -usshdeployer -psshdeployer sshdeployer
