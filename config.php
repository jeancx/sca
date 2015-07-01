<?php

use lib\Config;

// Configurações do Banco de Dados POSTGRESQL
Config::write('db.host', 'localhost');
Config::write('db.port', '5432');
Config::write('db.basename', 'sca');
Config::write('db.user', 'postgres');
Config::write('db.password', 'root');

// Endereço Publico do Projeto
Config::write('path', 'http://localhost/SCA/public');

// Salt de Criptografia
Config::write('salt', 'Ep&JulgcTb)l(#Hta821m#teChPX6z(E');

