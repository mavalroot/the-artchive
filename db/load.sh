#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U artchive -d artchive < $BASE_DIR/artchive.sql
    psql -h localhost -U artchive -d artchive < $BASE_DIR/artchive-datos.sql
fi
psql -h localhost -U artchive -d artchive_test < $BASE_DIR/artchive.sql
psql -h localhost -U artchive -d artchive_test < $BASE_DIR/artchive-datos.sql
