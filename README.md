для начала надо скачать Ckeditor
php bin/console ckeditor:install

затем установить css и js
php bin/console assets:install web

создать пользователя админки
php bin/console fos:user:create admin email@email.ru 123456

дать созданному пользователю права администратора
php bin/console fos:user:promote admin ROLE_SUPER_ADMIN    

зарегистрировать тип данных в конфиге

doctrine:
    dbal:
        types:
            cloudinary_data:
                class: Victor\CloudinaryStorageBundle\DBAL\Type\CloudinaryFileType
        connections:
            default:
                ...
                ...
                ...
                mapping_types:
                    cloudinary_data: cloudinary_data

укзать в маппинге ентити тип данных cloudinary_data

AppBundle\Entity\Article:
    type: entity
    table: articles
    id:
        id:
            type: integer
            nullable: false
            options:
                unsigned: true
            id: true
            generator:
                strategy: IDENTITY
    fields:
        title:
            type: string
            nullable: false
            length: 128
            options:
                fixed: false
        image:
            type: cloudinary_data
            nullable: true
            options:
                fixed: false
