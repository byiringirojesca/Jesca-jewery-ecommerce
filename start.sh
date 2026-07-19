#!/bin/bash

echo "Starting Laravel server..."
 php artisan serve  &

echo "Starting npm server.."
 npm run dev  &


echo "SITAJE Server running..."
echo "Local: http://127.0.0.1:8000"

wait
``