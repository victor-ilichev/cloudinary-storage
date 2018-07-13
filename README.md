для начала надо скачать Ckeditor
php bin/console ckeditor:install

затем установить css и js
php bin/console assets:install web

создать пользователя админки
php bin/console fos:user:create admin email@email.ru 123456

дать созданному пользователю права администратора
php bin/console fos:user:promote admin ROLE_SUPER_ADMIN    
