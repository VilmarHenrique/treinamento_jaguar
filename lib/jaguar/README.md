## Utilizando Composer

https://getcomposer.org/

# Instalando

cd jaguar
php -r "readfile('https://getcomposer.org/installer');" | php

# Instalando depend�ncias que est�o definidadas no composer.json

./composer.phar install

# Para instalar novas depend�ncias pesquisar em: https://packagist.org/

./composer.phar require doctrine/orm
