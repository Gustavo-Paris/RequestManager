Contributing
-------------

Before contributing code to Request Manager, make sure that it conforms to the PHPCS coding standard and that the Request Manager unit tests still pass. The easiest way to contribute is to work on a repository checkout, or your own fork, rather than an installed PEAR version. If you do, you can run the following commands to verify that everything is ready to send:

```bash
  cd RequestManager
  php ./vendor/bin/phpcs
```

Which shouldn't show any coding standard errors:

```bash
  phpunit
```

Which should give you no failures or errors. You can ignore any skipped tests as these are for external tools.