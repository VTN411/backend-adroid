FROM php:8.1-apache

# Copy toàn bộ mã nguồn vào thư mục web root của Apache
COPY . /var/www/html/

# Phân quyền cho thư mục
RUN chmod -R 755 /var/www/html

EXPOSE 80
