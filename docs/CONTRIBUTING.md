Contributing
-------------

Antes de contribuir com o c�digo para Request Manager, certifique-se de que ele esteja em conformidade com o padr�o de codifica��o PHPCS e que os testes de unidade Request Manager ainda sejam aprovados. A maneira mais f�cil de contribuir � trabalhar em um checkout do reposit�rio, ou em sua pr�pria bifurca��o, em vez de uma vers�o PEAR instalada. Se voc� fizer isso, poder� executar os seguintes comandos para verificar se tudo est� pronto para enviar:
cd RequestManager
php ./vendor/bin/phpcs

O qual n�o dever� mostrar nenhum erro padr�o de codifica��o:

    phpunit

Which should give you no failures or errors. You can ignore any skipped tests as these are for external tools.