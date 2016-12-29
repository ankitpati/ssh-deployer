#!/bin/bash

mysql -uroot -p < user.sql 2> /dev/null
mysql -utasktracker -ptasktracker < schema.sql 2> /dev/null
mysql -utasktracker -ptasktracker tasktracker
