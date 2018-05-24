-- Cidadaos
INSERT INTO cidadaos (cpfcnpj, Type, nome, email, telefone1, telefone2, horas_servico, inscricao_prod_rural)
VALUES ('987.654.321-52', 1, 'João Pedro Fidelis', 'joao@gmail.com', '(49) 9956-65427', NULL, 2004, '124524867');
INSERT INTO cidadaos (cpfcnpj, Type, nome, email, telefone1, telefone2, horas_servico, inscricao_prod_rural)
VALUES ('123.456.789-12', 1,'Mateus Rodrigo Matias', 'mateus@mateus.com', '(49) 9963-85472', NULL, 54210, '485632981');

-- Users
INSERT INTO users (name, email, password, access, remember_token, cidadao_id, type_id) 
VALUES ('Mateus Rodrigo Matias', 'mateus@mateus.com', '123456', '1', '123456', '2', '2');
INSERT INTO users (name, email, password, access, remember_token, cidadao_id, type_id) 
VALUES ('João Pedro Fidelis', 'joao@joao.com', '654321', '1', '654321', '3', '2');

-- types Logradouros
INSERT INTO Type_logradouros (nome) VALUES ('Rua');
INSERT INTO Type_logradouros (nome) VALUES ('Avenida');
INSERT INTO Type_logradouros (nome) VALUES ('Linha');
INSERT INTO Type_logradouros (nome) VALUES ('Rodovia');

-- Enderecos
INSERT INTO enderecos (numero, cep, complemento, estado, cidade, bairro, logradouro, cidadao_id)
VALUES ('123', '89560-000', NULL, 'Santa Catarina', 'Videira', 'Aeroporto', 'Rua das Videiras', '2');
INSERT INTO enderecos (numero, cep, complemento, estado, cidade, bairro, logradouro, cidadao_id)
VALUES ('321', '89560-000', 'Ap 102', 'Santa Catarina', 'Videira', 'Carboni', 'Rua José Bouitex', '3');

-- Meios
INSERT INTO meios (nome) VALUES ('Presencial');
INSERT INTO meios (nome) VALUES ('Telefone');

-- Parametros
INSERT INTO `parametros` (`id`, `parametro`, `descricao`, `valor`) VALUES (NULL, 'email_secretario', 'Email do Secretario de Infraestrutura', 'admin@admin.com');
INSERT INTO `parametros` (`id`, `parametro`, `descricao`, `valor`) VALUES (NULL, 'max_horas_servico', 'Máximo de Horas de Serviço anual para Agricultores', '8');

-- Setores
INSERT INTO setors (nome) VALUES ('Agricultura');
INSERT INTO setors (nome) VALUES ('DSU');
INSERT INTO setors (nome) VALUES ('Obras');

-- Sequencia
INSERT INTO sequencias (sequencia, setor_id) VALUES ('0', '1');
INSERT INTO sequencias (sequencia, setor_id) VALUES ('0', '2');
INSERT INTO sequencias (sequencia, setor_id) VALUES ('0', '3');

-- Servicos
INSERT INTO cadastro_servicos(descricao) VALUES ('Arrumar buraco na rua');
INSERT INTO cadastro_servicos(descricao) VALUES ('Caçamba de brita');
INSERT INTO cadastro_servicos(descricao) VALUES ('Troca de luz do poste');
INSERT INTO cadastro_servicos(descricao) VALUES ('Terraplanagem');

-- Máquinas
INSERT INTO cadastro_maquinas(descricao, codigo_frota, valor) VALUES ('Retroescavadeira','123','42.35');
INSERT INTO cadastro_maquinas(descricao, codigo_frota, valor) VALUES ('Caminhão','321','21.37');

-- Operadores
INSERT INTO operadors(codigo_operador, cidadao_id) VALUES ('123',2);
INSERT INTO operadors(codigo_operador, cidadao_id) VALUES ('321',3);

-- Status
INSERT INTO statuses(descricao) VALUES ('Aberto');
INSERT INTO statuses(descricao) VALUES ('Aguardando assinatura');
INSERT INTO statuses(descricao) VALUES ('Assinado');
INSERT INTO statuses(descricao) VALUES ('Em execução');
INSERT INTO statuses(descricao) VALUES ('Cancelado');
INSERT INTO statuses(descricao) VALUES ('Executado');
INSERT INTO statuses(descricao) VALUES ('Aguardando agendamento');
INSERT INTO statuses(descricao) VALUES ('Agendado');
