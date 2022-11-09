## Utilizando Composer

https://getcomposer.org/

# Instalando

cd jaguar
php -r "readfile('https://getcomposer.org/installer');" | php

# Instalando dependências que estão definidadas no composer.json

./composer.phar install

# Para instalar novas dependências pesquisar em: https://packagist.org/

./composer.phar require doctrine/orm
