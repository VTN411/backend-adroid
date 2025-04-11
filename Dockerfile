FROM php:8.1-apache
# Cài PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql
# Copy toàn bộ mã nguồn vào thư mục web root của Apache
COPY ApiFlutter/ /var/www/html/

# Phân quyền cho thư mục
RUN chmod -R 755 /var/www/html

EXPOSE 80
