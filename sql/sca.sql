CREATE TABLE usuarios (
	id SERIAL PRIMARY KEY,
	nome varchar (50),
	username varchar (20) NOT NULL,
	password varchar (100) NOT NULL
);

CREATE TABLE categorias (
	id SERIAL PRIMARY KEY,
	titulo varchar (50) NOT NULL
);

CREATE TABLE clientes (
	id SERIAL PRIMARY KEY,
	nome varchar (50) NOT NULL
);

CREATE TABLE problemas (
	id SERIAL PRIMARY KEY,
	cliente_id integer NOT NULL,
	titulo varchar (50) NOT NULL,
	descricao text,
	categoria_id integer NOT NULL,
	data_hora timestamp NOT NULL,
	usuario_id integer
);

CREATE TABLE programadores (
	id SERIAL PRIMARY KEY,
	nome varchar (50) NOT NULL,
	valor_hora decimal (10,2) NOT NULL
);

CREATE TABLE topicos (
	id SERIAL PRIMARY KEY,
	problema_id integer NOT NULL,
	titulo varchar (50) NOT NULL,
  descricao text,
	programador_id integer NOT NULL,
  relato text,
	tempo integer NOT NULL,
	resolvido boolean NOT NULL
);

ALTER TABLE problemas ADD FOREIGN KEY (cliente_id) REFERENCES clientes(id);
ALTER TABLE problemas ADD FOREIGN KEY (categoria_id) REFERENCES categorias(id);
ALTER TABLE problemas ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id);

ALTER TABLE topicos ADD FOREIGN KEY (problema_id) REFERENCES problemas(id);
ALTER TABLE topicos ADD FOREIGN KEY (programador_id) REFERENCES programadores(id);

INSERT INTO usuarios VALUES (1,'Jean Carlos Farias','jean','12345');
INSERT INTO usuarios VALUES (2,'Administrador','admin','12345');

INSERT INTO categorias VALUES (1,'Desenvolvimento');
INSERT INTO categorias VALUES (2,'Suporte');

INSERT INTO clientes VALUES (1,'Papel & Caneta');
INSERT INTO clientes VALUES (2,'Mars Attack');

INSERT INTO problemas VALUES (1,1,'Sistema de Controle de Estoque','<p></p>',1,'2015-09-16 14:25:00',1);
INSERT INTO problemas VALUES (2,1,'Teste','<p></p>',1,'2015-09-16 14:25:00',1);

INSERT INTO programadores VALUES (1,'Jean','50.00');
INSERT INTO programadores VALUES (2,'Goku','50.00');

INSERT INTO topicos VALUES (1,1,'Backend em PHP','<p></p>',1,'2015-09-16 14:25:00',1,false);
INSERT INTO topicos VALUES (2,1,'FrontEnd em PHP e CSS','<p></p>',1,'2015-09-16 14:25:00',1,false);