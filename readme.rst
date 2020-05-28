###################
Desafio - Recrutamento Smartstaff
###################

Coloque os arquivos dentro de uma pasta do seu servidor Apache. Ex.: C:\\xampp\\htdocs\\smartstaff\\

Se seu apache estiver usando outra porta (diferente da 80) atualize no arquivo application/config/config.php a constante $config['base_url']. Ex.: $config['base_url'] = 'http://localhost:8080/smartstaff/'
Eu mesmo, Bruno Nogueira, utilizo meu Apache diferente da porta padrão (:80). Ou seja, no arquivo 'application/config/config.php' utilizo '$config['base_url'] = 'http://localhost:8080/smartstaff/''. Caso vc utilize seu apache na porta padrão retire desta linha a configuração da porta ':8080'. Ficaria somente '$config['base_url'] = 'http://localhost/smartstaff/''

Se precisar acessar diretamente um numero de página desejado acesse http://localhost:8080/smartstaff/?numero_pagina=[pagina desdejada] (Ex.: http://localhost:8080/smartstaff/?numero_pagina=4)

###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
