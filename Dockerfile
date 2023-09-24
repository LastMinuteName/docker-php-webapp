# Use the PHP image which has debian's Apache httpd
FROM php:7.2-apache

# Copy all of the files in the current directory into the html directory
COPY . /var/www/html/