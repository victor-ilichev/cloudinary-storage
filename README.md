зарегистрируйте  dbal type  editor_data
config.yml
doctrine:
    dbal:
        mapping:
            editor_data: Pegas\EditorBundle\DBAL\Type\EditorData

добавьте тему для формы

form:
    theme:
        - @PegasEditorBundle:form:bootstrap3_theme.html.twig


 на страницу с формой подключите js и css
    editor.js
    editor.css

используйте EditorType::class для поля формы

WIDGETS:
    wearher
