Contributing
-------------

Antes de contribuir com o código para Request Manager, certifique-se de que ele esteja em conformidade com o padrão de codificação PHPCS e que os testes de unidade Request Manager ainda sejam aprovados. A maneira mais fácil de contribuir é trabalhar em um checkout do repositório, ou em sua própria bifurcação, em vez de uma versão PEAR instalada. Se você fizer isso, poderá executar os seguintes comandos para verificar se tudo está pronto para enviar:
cd RequestManager
php ./vendor/bin/phpcs

O qual não deverá mostrar nenhum erro padrão de codificação:

    phpunit

Which should give you no failures or errors. You can ignore any skipped tests as these are for external tools.