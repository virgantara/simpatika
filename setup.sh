#!/bin/bash

if [ ! -f config/db.php ]; then
	cp config/db.php.example config/db.php
fi

if [ ! -f config/params-local.php ]; then
	cp config/params-local.php.example config/params-local.php
fi