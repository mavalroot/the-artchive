#!/bin/bash

heroku pg:reset --confirm the-artchive
PGUSER=artchive PGPASSWORD=artchive heroku pg:push artchive DATABASE_URL
