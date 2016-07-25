Repositório para o código-fonte
=================================

Propel Reverse
--------------
    
    [APPLICATION_PATH]\module\Model\model>
    ../../../vendor/bin/propel reverse "mysql:host=localhost;dbname=espacopalavra;user=espacopalavrause;password=espacopalavrapwd"
    

Propel Build
--------------

    [APPLICATION_PATH]\module\Model\model>
    ../../../vendor/bin/propel model:build
	
Server Installation
--------------

	Instalar composer conforme instruções no site: https://getcomposer.org/download/
	Alterar DocumentRoot do apache para apontar para ./public
	
    $ php composer.phar install
	$ sudo apt-get update
	$ sudo apt-get install php5-intl
	$ sudo service apache2 restart
	$ chmod 777 ./data/logs ./data/sessions
	
	Ir para o PhpMyAdmin (http://your-instance-url/phpmyadmin)
	Logar com usuário root sem senha
	Alterar senha do root
	Criar banco de dados espacopalavra
	Criar usuário e senha com todas as permissões para o banco de dados espacopalavra
	Renomear arquivo local.php.dist para local.php dentro de ./module/Model/model/generated-conf e alterar dados de acesso ao banco de dados
	Importar o arquivo ./module/Model/model/generated-sql/espacopalavra.sql no PhpMyAdmin
	