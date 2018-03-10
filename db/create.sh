#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE artchive_test;"
    psql -U postgres -c "CREATE USER artchive PASSWORD 'artchive' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists artchive
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists artchive_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists artchive
    sudo -u postgres psql -c "CREATE USER artchive PASSWORD 'artchive' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O artchive artchive
    sudo -u postgres createdb -O artchive artchive_test
    LINE="localhost:5432:*:artchive:artchive"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
