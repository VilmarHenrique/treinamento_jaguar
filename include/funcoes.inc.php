<?php
   define("ANO_FERIADO_FIXO", 1990);
  // --------------------
  // P/ USAR NA GERACAO DE RELATORIOS!!

  // callbacks
  $rel_arr_format_number = array("Format_Number", array(2, "sys", "pt_BR"));
  $rel_arr_format_date   = array("Format_Date",   array("sys", "pt_BR"));
  // --------------------

  $op_id_pis = 
    array(array("value" => "1", "description" => "Normal"),
          array("value" => "4", "description" => "Aliquota Zero Monofásica"), 
          array("value" => "6", "description" => "Aliquota Zero"),
          array("value" => "7", "description" => "Isenta"),
          array("value" => "8", "description" => "Sem Incidência"));

  $op_id_fechamento = array(array("value" => 0, "description" => "Não"),
                            array("value" => 1, "description" => "Sim - Dinheiro"),
                            array("value" => 2, "description" => "Sim - Cheque"));

  $op_vendas_gerais_id_agrupamento = 
    array(array("value" =>  "1", "description" => "Data - Diário"),
          array("value" =>  "2", "description" => "Data - Semanal"),
          array("value" =>  "3", "description" => "Data - Mensal"),
          array("value" =>  "8", "description" => "Data - Bimestral"),
          array("value" =>  "9", "description" => "Data - Trimestral"),
          array("value" => "10", "description" => "Data - Quadrimestral"),
          array("value" => "11", "description" => "Data - Semestral"),
          array("value" =>  "4", "description" => "Data - Anual"),
          array("value" =>  "5", "description" => "Vendedor"),
          array("value" =>  "6", "description" => "Grupo de Produto"),
          array("value" => "12", "description" => "Grupo de Fornecedor"),
          array("value" =>  "7", "description" => "Produto"));

  $op_vendas_gerais_id_tipo = 
  array(array("value" =>  "3", "description" => "Financeiro"),
        array("value" =>  "2", "description" => "Positivação Cliente"),
        array("value" => "12", "description" => "Positivação Pedido/Nota Fiscal"),
        array("value" =>  "1", "description" => "Volume (Cx) *"),
        array("value" =>  "0", "description" => "Volume (Kg)"),
        array("value" =>  "4", "description" => "Fin / Vol (Cx)"),
        array("value" =>  "5", "description" => "Fin / Vol (Kg)"),
        array("value" =>  "6", "description" => "Fin / Pos"),
        array("value" =>  "7", "description" => "Vol (Cx) / Vol (Kg)"),
        array("value" =>  "8", "description" => "Vol (Cx) / Pos"),
        array("value" =>  "9", "description" => "Vol (Kg) / Pos"),
        array("value" => "11", "description" => "Fin / Vol (Cx) / Pos"),
        array("value" => "10", "description" => "Fin / Vol (Cx) / Vol (Kg) / Pos"));

  $op_id_motivo_demissao = 
    array(array("value" => "1", "description" => "Solicitação do Funcionário"),
          array("value" => "2", "description" => "Empresa"),
          array("value" => "3", "description" => "Redução"));
  
  $op_id_cota_compra = 
    array(array("value" => "1", "description" => "SU"),
          array("value" => "2", "description" => "Peso Líquido"));
   
  $op_id_tipo_caixa_financeiro =
    array(array("value" => "-1", "description" => "Débito"),
          array("value" => "1",  "description" => "Crédito"));

  $op_id_tipo_carreta = 
    array(array("value" => "1", "description" => "Carreta Não Paletizada"),
          array("value" => "2", "description" => "Carreta Paletizada"),
          array("value" => "3", "description" => "Meia Carreta não Paletizada"),
          array("value" => "4", "description" => "Meia Carreta Paletizada"),
          array("value" => "5", "description" => "Fracionado"));
  
  $op_id_unidade_compra = 
    array(array("value" => "1", "description" => "Unidade"),
          array("value" => "2", "description" => "Caixa"),
          array("value" => "3", "description" => "Camada"),
          array("value" => "4", "description" => "Palete"));
          
  $op_id_tipo_envolvimento_processo = 
    array(array("value" => "1", "description" => "Autor           "),
          array("value" => "2", "description" => "Réu             "),
          array("value" => "3", "description" => "Procurador Autor"),
          array("value" => "4", "description" => "Procurador Réu  ")
          );

  $op_id_acesso_externo = 
    array(array("value" => "0", "description" => "Bloqueado"),
          array("value" => "1", "description" => "Liberado"));

  $op_id_forma_pagamento = 
    array(array("value" => "1", "description" => "Dinheiro"),
          array("value" => "2", "description" => "Prêmios"),
          array("value" => "3", "description" => "Folha Pagamento"),
          array("value" => "4", "description" => "Crédito em Cartão"),
          array("value" => "5", "description" => "Dolarniz"));
  
  $op_id_classificacao_rat = 
    array(array("value" => "1", "description" => "Típico no local de trabalho e função desempenhada"),
          array("value" => "2", "description" => "Atípico no local de trabalho e função desempenhada"),
          array("value" => "3", "description" => "De translado Trabalho - Residência"),
          array("value" => "4", "description" => "De Translado Residência - Trabalho"));
 
  $op_id_tipo_cat = 
    array(array("value" => "1", "description" => "Início"),
          array("value" => "2", "description" => "Reabertura"),
          array("value" => "3", "description" => "Comunicação de Óbito"));

  $op_id_tipo_acidente_trabalho = 
    array(array("value" => "1", "description" => "CAT"),
          array("value" => "2", "description" => "RAT"));

  $op_id_base_prazo = 
    array(array("value" => "0", "description" => "Faturamento"),
          array("value" => "1", "description" => "Pedido"),
          array("value" => "2", "description" => "Entrega"));

  $op_id_tipo_recebimento_caixa = 
    array(array("value" => "1", "description" => "À Vista"),
          array("value" => "2", "description" => "À Prazo"));
  
  $op_id_arredondamento = 
    array(array("value" => "1", "description" => "Nenhum"),
          array("value" => "2", "description" => "Camada"),
          array("value" => "3", "description" => "Palete"));

  $op_id_categoria_cnh = 
    array(array("value" => "1",  "description" => "Provisória"),
          array("value" => "2",  "description" => "A"),
          array("value" => "3",  "description" => "B"),
          array("value" => "4",  "description" => "C"),
          array("value" => "5",  "description" => "D"),
          array("value" => "6",  "description" => "E"),
          array("value" => "7",  "description" => "AB"),
          array("value" => "8",  "description" => "AC"),
          array("value" => "9",  "description" => "AD"),
          array("value" => "10", "description" => "AE"));

  $op_id_markup =
    array(array("value" => "4", "description" => "Sem descontos aplicado"),
          array("value" => "0", "description" => "DG aplicado junto c/ impostos"),
          array("value" => "1", "description" => "DG aplicado depois impostos"),
          array("value" => "3", "description" => "DG + DF aplicado depois dos impostos"),
          array("value" => "2", "description" => "VI do DG aplicado depois impostos"),
          array("value" => "5", "description" => "VI do DG aplicado c/ impostos"));

  $op_id_notifica_titulo_excluido = 
    array(array("value" => "0", "description" => "Nunca"),
          array("value" => "1", "description" => "Somente Manutenção"),
          array("value" => "2", "description" => "Sempre"));

  $op_id_calculo_comissao = 
    array(array("value" => "0", "description" => "Nenhum"),
          array("value" => "1", "description" => "Classe vendedor / Produto"),
          array("value" => "2", "description" => "Produto / Classe vendedor"));

  $op_id_prazo = 
    array(array("value" => "0", "description" => "Da emissão NF"),
          array("value" => "1", "description" => "Da data pedido"),
          array("value" => "2", "description" => "Da data saída carga"));
  
  $op_id_sexo = 
    array(array("value" => "1", "description" => "Masculino"),
          array("value" => "2", "description" => "Feminino"));
           
  $op_id_copia_email = array(array("value" => "0", "description" => "Sem cópia remetente"),
                             array("value" => "1", "description" => "Com cópia remetente"));

  $op_id_ativo = array(array("value" => "",  "description" => ""),
                       array("value" => "0", "description" => "Não"),
                       array("value" => "1", "description" => "Sim")
                      );

  $op_id_calculo_frete_comissao = array(array("value" => "",  "description" => ""),
                                        array("value" => "0", "description" => "Não Calcular"),
                                        array("value" => "1", "description" => "Pagar"),
                                        array("value" => "2", "description" => "Descontar")
                                       );

   /*quando alterar esta op verificar se não deve alterar a função verifica_destino_mensagem*/
  $op_id_destino_mensagem = 
    array(array("value" =>  "0", "description" => "Nenhum"),
          array("value" =>  "1", "description" => "Faturamento"),
          array("value" =>  "2", "description" => "Motorista"),
          array("value" =>  "3", "description" => "Cobrança"),
          array("value" =>  "4", "description" => "Nota Fiscal"),
          array("value" => "13", "description" => "Nota Fiscal (Mensagem)"),
          array("value" => "14", "description" => "Nota Fiscal (Produto)"),
          array("value" =>  "5", "description" => "Vendedor"),
          array("value" => "10", "description" => "Supervisor"),
          array("value" => "11", "description" => "Gerente"),
          array("value" =>  "6", "description" => "Supervisor / Vendedor"),
          array("value" =>  "9", "description" => "Ger. / Sup. / Vend."),
          array("value" =>  "7", "description" => "Armazém"),
          array("value" =>  "8", "description" => "CAE"),
          array("value" => "12", "description" => "Merchandising"),
          array("value" => "15", "description" => "Ordem de Compra - NF-e"));

  //semana para pedido_nao_atualizado
  $op_id_semana_pna =
    array(array("value" => "1", "description" => "A"),
          array("value" => "2", "description" => "B"),
          array("value" => "3", "description" => "C"),
          array("value" => "4", "description" => "D"),
          array("value" => "5", "description" => "E"),
          array("value" => "6", "description" => "F"));

  $op_id_tipo_desconto = 
    array(array("value" => "1", "description" => "Compra"),
          array("value" => "2", "description" => "Venda"));
  
  $op_id_lote_titulo = 
    array(array("value" => "0", "description" => "Não Enviado"),
          array("value" => "1", "description" => "Enviado"));


  $op_id_tipo_plano_conta = 
    array(array("value" => "1", "description" => "Crédito"),
          array("value" => "2", "description" => "Débito"));

  $op_id_estrutura_plano_conta = 
    array(array("value" => "1", "description" => "Analítica"),
          array("value" => "2", "description" => "Sintética"));

  $op_id_tipo_vendedor =
    array(array("value" => "0", "description" => "Venda"),
          array("value" => "1", "description" => "Pronta Entrega"));
  
  $op_id_entrega_titulo = 
    array(array("value" => "0", "description" => "No prazo"),
          array("value" => "1", "description" => "Em atraso"));
    
  $op_relatorio_vendedor = array( "0" => array("value" => "cidade"       , "description" => "Cidade"), 
                                  "1" => array("value" => "endereco"     , "description" => "Endereço"), 
                                  "2" => array("value" => "telefone"     , "description" => "Telefone"), 
                                  "3" => array("value" => "email"        , "description" => "Email"),
                                  "4" => array("value" => "grupo"        , "description" => "Grupos"),
                                  "5" => array("value" => "cpf_cnpj"     , "description" => "CPF/CNPJ"),
                                  "6" => array("value" => "rg"           , "description" => "RG"),
                                  "7" => array("value" => "bairro"       , "description" => "Bairro"),
                                  "8" => array("value" => "cep"          , "description" => "CEP"),
                                  "9" => array("value" => "email_palm"   , "description" => "Email Palm"));
  
  $op_vazio = 
    array(array("value" => "", "description" => ""));
  
  $op_id_arquivo_exportacao_jb =
    array(array("value" => "1", "description" => "Saída - NF"));

  $op_id_tipo_frete =
    array(array("value" => "1", "description" => "Local Fixo"),
          array("value" => "2", "description" => "Local Km"),
          array("value" => "3", "description" => "Transbordo Fixo"),
          array("value" => "4", "description" => "Transbordo Km"));

  $op_id_pesquisa_mercado =
    array(array("value" => "0", "description" => "Não"),
          array("value" => "1", "description" => "Broker"),
          array("value" => "2", "description" => "Distribuidora"));

  $op_id_base_desconto = 
    array(array("value" => "1", "description" => "Vl. Total Produto - (DF + DG)"),
          array("value" => "2", "description" => "Vl. Total Produto - (DF + DG + DN)"));

  $op_id_tipo_mensagem = 
    array(array("value" => "1", "description" => "Confirmação"),
          array("value" => "2", "description" => "Informação"));

  $op_id_atualizacao = 
    array(array("value" => "1", "description" => "Negociada"),
          array("value" => "2", "description" => "Diária"),
          array("value" => "3", "description" => "Mensal"));
  
  $op_id_atualizacao_grupo = 
    array(array("value" => "0", "description" => "Não"),
          array("value" => "1", "description" => "Individual"),
          array("value" => "2", "description" => "Geral"));

  $op_id_setor = 
    array(array("value" => "1", "description" => "Comercial"),
          array("value" => "2", "description" => "Faturamento"),
          array("value" => "3", "description" => "Logística"),
          array("value" => "4", "description" => "Outros"));

  $op_id_responsavel_pedido_situacao =
    array(array("value" => "1", "description" => "Financeiro"),
          array("value" => "2", "description" => "Faturamento"),
          array("value" => "3", "description" => "Comercial"),
          array("value" => "4", "description" => "Cadastro"));
  
  $op_id_responsavel = 
    array(array("value" => "1", "description" => "Vendedor"),
          array("value" => "2", "description" => "Motorista"),
          array("value" => "3", "description" => "Cliente"),
          array("value" => "4", "description" => "Faturamento"),
          array("value" => "5", "description" => "Financeiro"),
          array("value" => "6", "description" => "Logística"),
          array("value" => "7", "description" => "CAE"),
          array("value" => "8", "description" => "CAV"),
          array("value" => "9", "description" => "Fornecedor"));
  
  $op_id_responsavel_inadimplente = 
    array(array("value" => "1",  "description" => "Motorista"),
          array("value" => "2",  "description" => "CAE"),
          array("value" => "3",  "description" => "Vendedor"),
          array("value" => "4",  "description" => "Supervisor"),
          array("value" => "5",  "description" => "Gerente"),
          array("value" => "6",  "description" => "Analista de Crédito"),
          array("value" => "7",  "description" => "Financeiro"),
          array("value" => "8",  "description" => "Cliente"),
          array("value" => "9",  "description" => "Banco"),
          array("value" => "10", "description" => "Correios"));

  $op_id_consumo =
    array(array("value" => 1, "description" => "Avar./Venc."),
          array("value" => 3, "description" => "Bom p/ Con."));
  
  $op_id_sim_nao = 
    array(array("value" => "0", "description" => "Não"),
          array("value" => "1", "description" => "Sim"));

  $op_id_sim_nao_sn = 
    array(array("value" => "0", "description" => "N"),
          array("value" => "1", "description" => "S"));

  $op_id_logo_filial = 
    array(array("value" => "1", "description" => "Matriz"),
          array("value" => "2", "description" => "Filial"));
  
  $op_id_origem_ligacao = 
    array(array("value" => "1", "description" => "Interno"),
          array("value" => "2", "description" => "Cliente"));
  
  $op_id_sim_nao_is = 
    array(array("value" => "NULL",     "description" => "Não"),
          array("value" => "NOT NULL", "description" => "Sim"));

  $op_id_permite =
    array(array("value" => "0", "description" => "Não Permite"),
          array("value" => "1", "description" => "Permite"));

  $op_id_fracionamento_produto =
    array(array("value" => "1", "description" => "Normal"),
          array("value" => "2", "description" => "Caixa Fechada"),
          array("value" => "3", "description" => "Corte"));
 
  $op_id_obrigatorio = 
    array(array("value" => 0, "description" => "Não Obrigatório"),
          array("value" => 1, "description" => "Obrigatório"));

  $op_id_seta = 
    array(array("value" => "0", "description" => "Lançado"),
          array("value" => "1", "description" => "Padrão Cliente"));

  $op_id_modelo_contrato = 
    array(array("value" => "", "description" => ""),
          array("value" =>  1, "description" => "Padrão"),
          array("value" =>  2, "description" => "Funcionário"),
          array("value" =>  3, "description" => "Red Bull"),
          array("value" =>  4, "description" => "Familiar"));
 
  $op_id_entrada_saida = 
    array(array("value" => 1, "description" => "Entrada"),
          array("value" => 2, "description" => "Saída"));

  $op_id_documento = 
    array(array("value" => 1, "description" => "Próprio"),
          array("value" => 2, "description" => "Terceiro"));

  $op_id_tipo_telefone = 
    array(array("value" => "1", "description" => "Residencial"),
          array("value" => "2", "description" => "Comercial"),
          array("value" => "3", "description" => "Celular"),
          array("value" => "4", "description" => "Fax"));

  $op_id_tipo_endereco =
    array(array("value" => "1", "description" => "Residencial"),
          array("value" => "2", "description" => "Comercial"),
          array("value" => "3", "description" => "Entraga"),
          array("value" => "4", "description" => "Cobrança"),
          array("value" => "5", "description" => "Correspondência"));

  $op_id_dia_semana = 
    array(array("value" => "11", "description" => "Segunda à Sexta"),
          array("value" => "12", "description" => "Sábado"),
          array("value" => "0",  "description" => "Domingo"),
          array("value" => "1",  "description" => "Segunda"),
          array("value" => "2",  "description" => "Terça"),
          array("value" => "3",  "description" => "Quarta"),
          array("value" => "4",  "description" => "Quinta"),
          array("value" => "5",  "description" => "Sexta"),
          array("value" => "6",  "description" => "Sábado"),
          array("value" => "21",  "description" => "Horista"),
          array("value" => "22",  "description" => "Alinea A art. 62 CLT"));
          

  $op_id_sigla_unidade =
    array(array("value" => 1,  "description" => "Bd"),
          array("value" => 2,  "description" => "Cj"),
          array("value" => 3,  "description" => "Cx"),
          array("value" => 4,  "description" => "Di"),
          array("value" => 5,  "description" => "Dz"),
          array("value" => 6,  "description" => "Fd"),
          array("value" => 15, "description" => "Gr"),
          array("value" => 7,  "description" => "Kg"),
          array("value" => 8,  "description" => "Lt"),
          array("value" => 13, "description" => "Mt"),
          array("value" => 9,  "description" => "Pc"),
          array("value" => 10, "description" => "Pt"),
          array("value" => 14, "description" => "Sc"),
          array("value" => 11, "description" => "Un"),
          array("value" => 12, "description" => "Vd"));

  $op_id_estado_civil = 
    array(array("value" => 1,  "description" => "Solteiro"), 
          array("value" => 2,  "description" => "Casado"),
          array("value" => 3,  "description" => "Divorciado"),
          array("value" => 4,  "description" => "Separado"),
          array("value" => 5,  "description" => "Viúvo"),
          array("value" => 6,  "description" => "Outro"));

  $op_id_origem_conferencia = 
    array(array("value" => "0", "description" => "Coletor"),
          array("value" => "1", "description" => "Manual"));

  $op_id_origem_movimento =
    array(array("value" => "0", "description" => "Movimento"),
          array("value" => "1", "description" => "Cheque"),
          array("value" => "2", "description" => "Juro"));

  $op_id_envio =
    array(array("value" => "0", "description" => "Manual"),
          array("value" => "1", "description" => "Automático"));

  $op_id_dia_semana_rota = array(array("value" => "0", "description" => "Domingo"),
                                 array("value" => "1", "description" => "Segunda-Feira"),
                                 array("value" => "2", "description" => "Terça-Feira"),
                                 array("value" => "3", "description" => "Quarta-Feira"),
                                 array("value" => "4", "description" => "Quinta-Feira"),
                                 array("value" => "5", "description" => "Sexta-Feira"),
                                 array("value" => "6", "description" => "Sábado"));

  $op_id_tipo_conta =
    array(array("value" => "1", "description" => "Conta Corrente"),
          array("value" => "2", "description" => "Poupança"));

  $op_id_tipo_dependente =
    array(array("value" => "1", "description" => "Filho(a)"),
          array("value" => "2", "description" => "Esposo(a)"),
          array("value" => "3", "description" => "Acompanhante"),
          array("value" => "4", "description" => "Enteado(a)"),
          array("value" => "5", "description" => "Filho(a) Adotivo"));

  $op_id_grau_instrucao =
    array(array("value" => "1",  "description" => "Primeiro Grau Incompleto"),
          array("value" => "2",  "description" => "Primeiro Grau Completo"),
          array("value" => "3",  "description" => "Segundo Grau Incompleto"),
          array("value" => "4",  "description" => "Segundo Grau Completo"),
          array("value" => "5",  "description" => "Terceiro Grau Incompleto"),
          array("value" => "6",  "description" => "Terceiro Grau Completo"));

  $op_id_pagamento =
    array(array("value" => "0",  "description" => "Hora"),
          array("value" => "1",  "description" => "Dia"),
          array("value" => "2",  "description" => "Semanal"),
          array("value" => "3",  "description" => "Quinzenal"),
          array("value" => "4",  "description" => "Mensal"));

  $op_id_assistencia = 
    array(array("value" => "1",  "description" => "Semanal"),
          array("value" => "2",  "description" => "Quinzenal"),
          array("value" => "3",  "description" => "Mensal"));
  
  $op_id_apuracao_msl = 
    array(array("value" => "1",  "description" => "Mensal"),
          array("value" => "2",  "description" => "Bimestral"));
          
  $op_id_sintegra = 
    array(array("value" => "0",  "description" => "Não habilitado"),
          array("value" => "1",  "description" => "Habilitado"));

  $op_id_situacao_nf =
    array(array("value" => "0",  "description" =>  "Retorno Total"),
          array("value" => "1",  "description" =>  "Retorno Parcial"),
          array("value" => "2",  "description" =>  "Entrega Realizada"),
          array("value" => "3",  "description" =>  "NF Re-Entregue"),
          array("value" => "4",  "description" =>  "NF Re-Faturada"));

  $op_id_situacao_nf_abrev =
    array(array("value" => "0",  "description" =>  "Ret. Total"),
          array("value" => "1",  "description" =>  "Ret. Parcial"),
          array("value" => "2",  "description" =>  "Ent. Realizada"),
          array("value" => "3",  "description" =>  "NF Re-Entregue"),
          array("value" => "4",  "description" =>  "NF Re-Faturada"));
  
  $op_id_situacao_venda = 
    array(array("value" => "0", "description" => "Bloqueada Venda"),
          array("value" => "1", "description" => "Liberada Venda"));

  $op_id_utilizacao_venda = 
    array(array("value" => "1", "description" => "Vendas"),
          array("value" => "2", "description" => "Devolução"),
          array("value" => "3", "description" => "Ambos"));

  $op_id_tipo_codigo_barra = 
    array(array("value" => "1", "description" => "Ean 13"),
          array("value" => "2", "description" => "Dun 14"),
          array("value" => "3", "description" => "Código Fornecedor"),
          array("value" => "4", "description" => "Código Interno"),
          array("value" => "5", "description" => "Display"));
  
  $op_id_semana =   
    array(array("value" => "1", "description" => "Semana 1"),
          array("value" => "2", "description" => "Semana 2"),
          array("value" => "3", "description" => "Semana 3"),
          array("value" => "4", "description" => "Semana 4"));
  
  $op_id_periodicidade =   
    array(array("value" => "0", "description" => "Nenhum"),
          array("value" => "1", "description" => "Cada 1 Semana"),
          array("value" => "2", "description" => "Cada 2 Semanas"),
          array("value" => "3", "description" => "Cada 3 Semanas"),
          array("value" => "4", "description" => "Cada 4 Semanas"),
          array("value" => "5", "description" => "Dia do Mês"),
          array("value" => "6", "description" => "Dia e Mês do Ano"));

  $op_id_abc = 
    array(array("value" => "1",  "description" => "A"),
          array("value" => "2",  "description" => "B"),
          array("value" => "3",  "description" => "C"));

  $op_id_def =
    array(array("value" => "4", "description" => "D"),
          array("value" => "5", "description" => "E"),
          array("value" => "6", "description" => "F"));

  $op_id_semana_letra = array_merge($op_id_abc, $op_id_def);

  $op_id_motivo_liberacao =
    array(array("value" => "1",  "description" => "Liberação Pendência"),
          array("value" => "2",  "description" => "Cancelamento"));

  $op_id_situacao =
    array(array("value" => "0",  "description" => "Cancelado"),
          array("value" => "1",  "description" => "Pendente"),
          array("value" => "2",  "description" => "Normal"));

  $op_id_situacao_titulo =
    array(array("value" => "1",  "description" => "Quitado"),
          array("value" => "2",  "description" => "Não Quitado"));

  $op_id_veiculo =
    array(array("value" => "1",  "description" => "Moto"),
          array("value" => "2",  "description" => "Carro"));

  $op_id_tipo_veiculo = 
    array(array("value" => "1",  "description" => "Carreta"),
          array("value" => "2",  "description" => "Truck"),
          array("value" => "3",  "description" => "Tonelada"));
  
  $op_id_tipo_rodado = 
    array(array("value" => "1",  "description" => "Truck"),
          array("value" => "2",  "description" => "Toco"),
          array("value" => "3",  "description" => "Cavalo Mecânico"),
          array("value" => "4",  "description" => "VAN"),
          array("value" => "5",  "description" => "Utilitário"),
          array("value" => "6",  "description" => "Outros"));
  
  $op_id_tipo_carroceria = 
    array(array("value" => "0",  "description" => "Não Aplicável"),
          array("value" => "1",  "description" => "Aberta"),
          array("value" => "2",  "description" => "Fechada/Baú"),
          array("value" => "3",  "description" => "Granelera"),
          array("value" => "4",  "description" => "Porta Container"),
          array("value" => "5",  "description" => "Sider"));
  
  $op_id_tipo_recebimento = 
    array(array("value" => "1", "description" => "Recebido"),
          array("value" => "2", "description" => "À Receber"));
  
  $op_id_tipo_relatorio = 
    array(array("value" => "1", "description" => "Sintético"),
          array("value" => "2", "description" => "Analítico"));
  
  $op_id_situacao_compromisso = 
    array(array("value" => "0", "description" => "Cancelado"),
          array("value" => "1", "description" => "Pendente"),
          array("value" => "2", "description" => "Finalizado"));

  $op_id_gerar = 
    array(array("value" => "0", "description" => "Não Gerar"),
          array("value" => "1", "description" => "Gerar"));

  $op_id_tipo_pessoa = 
    array(array("value" => "", "description" => "Todos"),
          array("value" => "2", "description" => "Cliente"),
          array("value" => "3", "description" => "Fornecedor"),
          array("value" => "4", "description" => "Fornecedor Diverso"),
          array("value" => "5", "description" => "Funcionário Ativo"),
          array("value" => "6", "description" => "Funcionário Inativo"),
          array("value" => "7", "description" => "Transportadora"),
          array("value" => "8", "description" => "Vendedor"));
          
  $op_id_tipo_beneficio = 
    array(array("value" => "0", "description" => "Valor"),
          array("value" => "1", "description" => "Hora"),
          array("value" => "2", "description" => "Dia"),
          array("value" => "3", "description" => "Unidade"));

  $op_id_dados_investimento = 
    array(array("value" => "0", "description" => "Valor %"),
          array("value" => "1", "description" => "Valor R$"));

  $op_id_ipi =
    array(array("value" => "0", "description" => "Isento"),
          array("value" => "1", "description" => "Não Isento"));
  
  $op_id_tipo_atividade =
    array(array("value" => "1", "description" => "Atacado"),
          array("value" => "2", "description" => "Varejo"),
          array("value" => "3", "description" => "Outros"));

  $op_id_tipo_vi =
    array(array("value" => "1", "description" => "DF"),
          array("value" => "2", "description" => "DG"),
          array("value" => "3", "description" => "VT"));

  $op_id_formata_confianca =
    array(array("value" => "1", "description" => "A"),
          array("value" => "2", "description" => "B"),
          array("value" => "3", "description" => "C"),
          array("value" => "4", "description" => "D"),
          array("value" => "5", "description" => "E"),
          array("value" => "6", "description" => "F"));

  $op_id_formata_anuencia =
    array(array("value" => "0", "description" => "Não Gera"),
          array("value" => "1", "description" => "Manual"),
          array("value" => "2", "description" => "Automática"));
      
  $op_id_base_pagamento_transportadora =
    array(array("value" => "1", "description" => "NF Carregada"),
          array("value" => "2", "description" => "NF Entregue"));
      
  $op_id_frota_transportadora =
    array(array("value" => "0", "description" => "Terceiro"),
          array("value" => "1", "description" => "Frota"));
  
  $op_id_situacao_cpf =
    array(array("value" => "0", "description" => "Bloqueado"),
          array("value" => "1", "description" => "Liberado"));

  $op_id_frete_responsabilidade =
    array(array("value" => 1, "description" => "Emitente"),
          array("value" => 2, "description" => "Destinatário"));

  $op_id_situacao_processo_juridico = 
    array(array("value" => "1",  "description" => "Ativo"),
          array("value" => "2",  "description" => "Arquivado"),
          array("value" => "3",  "description" => "Baixado"));

  $op_id_situacao_cliente_tele_venda =
    array(array("value" => "0",  "description" => "Aguardando Contato"),
          array("value" => "1",  "description" => "Em Negociacao"),
          array("value" => "2",  "description" => "Venda Efetuada"),
          array("value" => "3",  "description" => "Venda não Efetuada"));                       

  $op_id_filial =  //VER TIPOS DE ARQUIVO
    array(array("value" => "0", "description" => "Tipo arquivo..."),
          array("value" => "1", "description" => "Tipo arquivo 2"));

  $op_id_geracao_pedido_atualizacao_carga_entrada =
    array(array("value" => "0", "description" => "Não - Gerar"),
          array("value" => "1", "description" => "Sim - Gerar somente de itens não recebidos"),
          array("value" => "2", "description" => "Sim - Gerar do saldo não recebido"));

  $op_id_notifica_vendedor = 
    array(array("value" => "1", "description" => "Envia Recado ou Email"),
          array("value" => "2", "description" => "Envia Recado + Email"),
          array("value" => "3", "description" => "Envia Somente Recado"),
          array("value" => "4", "description" => "Envia Somente Email"));

  $op_id_pedido_broker_produto_separacao = 
    array(array("value" => "0", "description" => "Normal"),
          array("value" => "1", "description" => "Produto Especial"),
          array("value" => "2", "description" => "Produto Único no Pedido"));

  $op_id_utilizacao_descontos = 
    array(array("value" => "0", "description" => "Nenhum"),
          array("value" => "1", "description" => "DG/DF"),
          array("value" => "2", "description" => "DG"),
          array("value" => "3", "description" => "DF"));

  $op_id_modelo_etiquetas = array(array("value" => 1, "description" => "Padrão"),
                                  array("value" => 2, "description" => "A4"));

  $op_id_atividade = 
    array(array("value" => "1", "description" => "Distribuidor/Atacadista"),
          array("value" => "2", "description" => "Operador Logístico"));
 

  $op_id_modelo_nf = 
    array(array("value" => "1", "description" => "80 colunas"),
          array("value" => "2", "description" => "120 colunas"));

  $op_id_modelo_nf_pe = 
    array(array("value" => "1", "description" => "80 colunas"),
          array("value" => "2", "description" => "120 colunas"));

  $op_id_tipo_acrescimo = 
    array(array("value" => "1", "description" => "Grupo"),
          array("value" => "2", "description" => "Subgrupo"),
          array("value" => "3", "description" => "Produto"));

  $op_id_acrescimo_fixo = 
    array(array("value" => "0", "description" => "Integral"),
          array("value" => "1", "description" => "Diferença de Prazo"));

  $op_id_objetivo_quantidade =
    array(array("value" => "0",  "description" => "Nenhum"),
          array("value" => "1",  "description" => "Volume/Positivação"),
          array("value" => "2",  "description" => "Somente Volume"),
          array("value" => "3",  "description" => "Somente Positivação"));
  
  $op_id_situacao_produto =
    array(array("value" => "0",  "description" => "Suspenso"),
          array("value" => "1",  "description" => "Liberado"));  
  
  $op_id_tipo_rota =
    array(array("value" => "1",  "description" => "Coaching"),
          array("value" => "2",  "description" => "Visita a Clientes"),
          array("value" => "3",  "description" => "Outros"));
  
  $op_id_rotina_visita = 
    array("1" => "PLANEJAMENTO DE VENDAS",
          "2" => "CONHECER E SER CONHECIDO",
          "3" => "VERIFICAR MATERIAL MERCHANDISING",
          "4" => "ABASTECE E TRABALHA A EXPOS. PROD.",
          "5" => "VERIFICAR ESTOQUE E FAZER RODÍZIO",
          "6" => "GARANTIR O PRICE POINT",
          "7" => "TORNAR PERCEPTÍVEL O SERV. PRESTADO",
          "8" => "INICIATIVA DA VENDA",
          "9" => "OBEDECER O MÉTODO DE TRABALHO");
  
  $op_dados_coaching = array("id_guia_merchandising" => "Vendedor possui o kit contendo além de outros, o Guia de Merchandising?",
                             "id_roteiro_palm"       => "Vendedor segue o roteiro de visitas no Palm?",
                             "id_campanha_trade"     => "Vendedor ofereceu Lançamentos do período e campanhas de Trade?");
  
  $op_id_tarefas_coaching = 
    array("1" => "PDVs visitados estão Roteirizados adequadamente",
          "2" => "Tirou pedido",
          "3" => "Adesivo de PDV",
          "4" => "Ofereceu ação de Trade",
          "5" => "Material Merchandising bem instalado");
  
  $op_id_manifesto_destinatario =
    array(array("value" => "0", "description" => "Sem Manifestação do Destinatário"),
          array("value" => "1", "description" => "Confirmada Operação"),
          array("value" => "2", "description" => "Desconhecida"),
          array("value" => "3", "description" => "Operação não Realizada"),
          array("value" => "4", "description" => "Ciência"));
  
  $op_id_tipo_pgto_descarga = 
    array(array("value" => "1", "description" => "Carreta"),
          array("value" => "2", "description" => "Truck"),
          array("value" => "3", "description" => "Tonelada"),
          array("value" => "4", "description" => "Pallet"));
  
  $op_id_rotina_visita_promotor = 
    array("1" => "RELACIONAMENTO COM O CLIENTE",
          "2" => "LEVANT. NECESSIDADES DE ABASTECIMENTO",
          "3" => "VERIF. DATAS VALIDADE ÁREA VENDAS E ESTOQUES",
          "4" => "GARANTE ABAST. LOJA (CHECK OUTS, PBS, CHOC., BISC. E SOBREMESAS)",
          "5" => "GARANTE MELHORES ESPAÇOS E PLANOGRAMAS INDICADOS P/ AS CATEGORIAS",
          "6" => "CONQUISTA NOVOS ESPAÇOS NO PDV: PONTOS EXTRAS E CROSS MERCHANDISING",
          "7" => "GARANTE A PRECIFICAÇÃO DE TODOS OS PRODUTOS EXPOSTOS NA LOJA",
          "8" => "GARANTE A LIMPEZA, CONSERV., MELHOR LOCALIZ. E ABAST. DOS MATERIAIS DE MERCHANDISING",
          "9" => "MONITORA RUPTURAS, VCTOS. E AÇÕES DA CONCORRÊNCIA, INFORMANDO AO COORD. GESTÃO DE LOJA",
         "10" => "TORNA SEU TRABALHO PERCEPTÍVEL");
  
  $op_dados_coaching_promotor = array("Possui o Guia de Merchandising",
                                      "Portfólio de Produtos e Mix Mínimo Obrigatório",
                                      "Principal concorrente de cada família de produtos",
                                      "Prazo de validade",
                                      "Planograma",
                                      "Roteiro de Visitas",
                                      "Ações Promocionais");
  
  $op_id_formato =
    array(array("value" => 1, "description" => "PDF"),
          array("value" => 2, "description" => "XLS"));
 
  $op_id_lote = 
    array(array("value" => 0, "description" => "Todos os lotes"),
          array("value" => 1, "description" => "Lotes Abertos"));

  $op_id_manifesto_nfe = 
    array(array("value" => "210200", "description" => "Confirmação da Operação"),
          array("value" => "210210", "description" => "Ciência da Operação"),
          array("value" => "210220", "description" => "Desconhecimento da Operação"),
          array("value" => "210240", "description" => "Operação não Realizada"));
  
  $op_id_operadora =
    array(
        array("value" => 1, "description" => "VIVO"));
  
  $op_id_tipo_cobranca_tarifa = 
    array(
        array("value" => 1, "description" => "Por Tempo (Minutos)"),
        array("value" => 2, "description" => "Por Serviço"));

  $op_id_pagamento_servico_telefonico = 
    array(
        array("value" => 1, "description" => "Empresa"),
        array("value" => 2, "description" => "Usuário"));
  
  $op_id_pagamento_rede =
    array(
        array("value" => "",  "description" => ""),
        array("value" => "0", "description" => "Não Bloqueia Pedido"),
        array("value" => "1", "description" => "Bloqueia Pedido"));
  
  $op_id_beneficio_despesa = 
    array(
        array("value" => 1, "description" => "Benefício"),
        array("value" => 2, "description" => "Despesa"));
  
  $op_id_broker_distribuidora = 
    array(
        array("value" => 1, "description" => "Broker"),
        array("value" => 2, "description" => "Distribuidora"));
  
  $op_id_tamanho =
    array(
      array("value" => 1, "description" => "PP"),
      array("value" => 2, "description" => "P"),
      array("value" => 3, "description" => "M"),
      array("value" => 4, "description" => "G"),
      array("value" => 5, "description" => "GG"));
  
  $op_id_mes = array(array("value" =>  "1", "description" => "Janeiro"),
                     array("value" =>  "2", "description" => "Fevereiro"),
                     array("value" =>  "3", "description" => "Março"),
                     array("value" =>  "4", "description" => "Abril"),
                     array("value" =>  "5", "description" => "Maio"),
                     array("value" =>  "6", "description" => "Junho"),
                     array("value" =>  "7", "description" => "Julho"),
                     array("value" =>  "8", "description" => "Agosto"),
                     array("value" =>  "9", "description" => "Setembro"),
                     array("value" => "10", "description" => "Outubro"),
                     array("value" => "11", "description" => "Novembro"),
                     array("value" => "12", "description" => "Dezembro"));
  
  $op_id_lcto_nao_importado = array(
    array("value" => 1, "description" => "Pagamento"),
    array("value" => 2, "description" => "Envio Cartório"),
  );
  
  $op_id_aplicacao_negociacao = array(
    array("value" => 1, "description" => "Grupo de Produto"),
    array("value" => 2, "description" => "Produto"),
    array("value" => 3, "description" => "Produto Pedido")
  );
  
  $op_id_tipo_pgto_nf = array(
    array("value" =>  1, "description" => "01 - Dinheiro"),
    array("value" =>  2, "description" => "02 - Cheque"),
    array("value" =>  3, "description" => "03 - Cartão de Crédito"),
    array("value" =>  4, "description" => "04 - Cartão de Débito"),
    array("value" =>  5, "description" => "05 - Crédito Loja"),
    array("value" => 10, "description" => "10 - Vale Alimentação"),
    array("value" => 11, "description" => "11 - Vale Refeição"),
    array("value" => 12, "description" => "12 - Vale Presente"),
    array("value" => 13, "description" => "13 - Vale Combustível"),
    array("value" => 14, "description" => "14 - Duplicata Mercantil"),
    array("value" => 15, "description" => "15 - Boleto Bancário"),
    array("value" => 16, "description" => "16 - Depósito Bancário"),
    array("value" => 17, "description" => "17 - Pagamento Instantâneo (PIX)"),
    array("value" => 18, "description" => "18 - Transferência bancária, Carteira Digital"),
    array("value" => 19, "description" => "19 - Programa de fidelidade, Cashback, Crédito Virtual"),
    array("value" => 90, "description" => "90 - Sem pagamento"),
    array("value" => 99, "description" => "99 - Outros")
  );
  
  $op_id_tipo_pgto_impressao = array(
    array("value" => 0, "description" => "Nenhum"),
    array("value" => 1, "description" => "Geração NF"),
    array("value" => 2, "description" => "Atualização Carga"),
    array("value" => 3, "description" => "Banco")
  );
  
  $op_id_tipo_pgto_recebimento = array(
    array("value" => 1, "description" => "Recebido / Pago"),
    array("value" => 2, "description" => "À Receber / À Pagar"),
  );
  
  $op_id_tipo_pallet = array(
    array("value" => 1, "description" => "Completo"),
    array("value" => 2, "description" => "Fracionado")
  );
  
  $op_id_bandeira = array(array("value" => 1, "description" => "VISA"));
  
  $op_id_ambiente = array(array("value" => 1, "description" => "Produção"),
                          array("value" => 2, "description" => "Homologação"));
  
  $op_id_modelo_fiscal =
    array(
          array("value" =>  4,  "description" => "Modelo 13 - Bilhete Passagem Rod"),
          array("value" =>  2,  "description" => "Modelo 0D - Cupom Fiscal"),
          array("value" =>  5,  "description" => "Modelo 08 - CTRC"),
          array("value" => 11,  "description" => "Modelo 01 - NF (ICMS destacado)"),
          array("value" =>  1,  "description" => "Modelo 02 - NF Consumidor"),
          array("value" => 18,  "description" => "Modelo 04 - NF Produtor"),
          array("value" =>  3,  "description" => "Modelo 55 - NF Eletrônica"),
          array("value" => 181, "description" => "Modelo 55 - NF Eletrônica Avulsa"),
          array("value" => 186, "description" => "Modelo 65 - NFC Eletrônica"),
          array("value" => 19,  "description" => "Modelo 57 - CT-e"),
          array("value" => 12,  "description" => "Modelo 06 - NF Energia Elétrica"),
          array("value" => 17,  "description" => "Modelo 21 - NF Comunicação"),
          array("value" => 13,  "description" => "Modelo 22 - NF Telecomunicação"),
          array("value" => 14,  "description" => "NF Prestação Serviço"),
          array("value" => 15,  "description" => "Recibo"),
          array("value" => 16,  "description" => "Guia"));
  
  $op_id_contrato_frete = array(
      array("value" => 1, "description" => "Contrato"),
      array("value" => 2, "description" => "Aditamento")
  );
  
  $op_id_tipo_veiculo_frete = array(
      array("value" => 1, "description" => "Leve"),
      array("value" => 2, "description" => "VAN")
  );
  
  $op_id_status_armazem_posicao = array(
    array("value" => "0", "description" => "Bloqueado"),
    array("value" => "1", "description" => "Liberado"),
    array("value" => "2", "description" => "Inativo"));
  
  $op_id_tipo_vasilhame =
    array(array("value" => "0", "description" => "Sacola Plástica"),
          array("value" => "1", "description" => "Caixa Papelão"),
          array("value" => "2", "description" => "Caixa Plástica"),
          array("value" => "3", "description" => "Gaiola de Separação"),
          array("value" => "4", "description" => "Palete"),
          array("value" => "5", "description" => "Isopor"));
  
  $op_id_modelo_separacao = array(
    array("value" => 1, "description" => "Manual (Conferência Geral)"),
    array("value" => 2, "description" => "Gaiola de separação (Caixas e Unidades)"),
    array("value" => 3, "description" => "Gaiola de separação + Flow Rack")
  );
  
  $op_id_tipo_separacao = array(
    array("value" => 1, "description" => "Carga"),
    array("value" => 2, "description" => "Cidade"),
    array("value" => 3, "description" => "Cliente")
  );
  
  $op_id_tipo_armazem = array(
    array("value" => "0", "description" => "Normal"),
    array("value" => "1", "description" => "Flow Rack")
  );
  
  $op_id_ordem_invertida = array(
    array("value" => "-1", "description" => "Sim"),
    array("value" => "1",  "description" => "Não")
  );
  
  $op_id_status_antecipacao_pgto_nf = array(
    array("value" => "NULL",     "description" => "Aguardando NF"),
    array("value" => "NOT NULL", "description" => "NF Recebida")
  );
  
  $op_id_montagem_produto = array(
    array("value" => 1, "description" => "Indústria"),
    array("value" => 2, "description" => "Empresa")
  );
  
  $op_id_validade_palete = array(
    array("value" => 1, "description" => "Padrão"),
    array("value" => 2, "description" => "Fabricação")
  );
  
  $op_id_ocorrencia_titulo = array(
    array("value" => 1, "description" => "Baixa"),
    array("value" => 2, "description" => "Cartório"),
  );
  
  $op_id_periodicidade_serasa = array(
    array("value" => "D", "description" => "Diário"),
    array("value" => "S", "description" => "Semanal"),  
  );
  
  $op_id_entrega_produto = array(
    array("value" => 1, "description" => "Distribuidora"),
    array("value" => 2, "description" => "Indústria")
  );
  
  $op_id_premio_vendedor = array(
    array("value" => 1, "description" => "Prêmio 1"),
    array("value" => 2, "description" => "Prêmio 2"),
    array("value" => 3, "description" => "Prêmio 3"),
    array("value" => 4, "description" => "Prêmio 4"),
    array("value" => 5, "description" => "Prêmio 5")
  );
  
  $op_id_mostra_nao_encerrado = array(array("value" => "0", "description" => "Aguardando Contato"),
                                      array("value" => "1", "description" => "Em Negociação"),
                                      array("value" => "2", "description" => "Venda Efetuada"),
                                      array("value" => "3", "description" => "Venda não Efetuada"));
  
  $op_id_armazenagem_palete = array(
    array("value" => 0, "description" => "Trânsito"),
    array("value" => 1, "description" => "Aéreo")
  );
  
  ################### INICIO DAS FUNCTIONS #################

  function Format_TimeStamp($date, $format_from = "pt_BR", $format_to = "sys", $sizeYear=4, $id_mostra_hora=true)
  {
    $time = substr($date, 10, 6);
    $date = Format_Date(substr($date, 0, 10), $format_from, $format_to, $sizeYear);

    if ($id_mostra_hora)
      return $date. " " . $time;
    else
      return $date;
  }

  function obtem_historico_caixa_conta_corrente()
  {
    global $conn;

    $sql = "SELECT cd_historico AS value, nm_historico AS description
              FROM historico_caixa
             WHERE id_conta_corrente_pessoa = 1
             ORDER BY nm_historico ";
    if ($rs = $conn->Select($sql))
      return $rs->GetArray(true);
    else
      conn_mostra_erro();

    return false;
  }

  function tip_acidente_trabalho_cat()
  {
    return adicionaTip("f_tip_acidente_trabalho_cat", "Atenção",
           "Para gerar o relatório é necessário que o acidentado possua endereço e salário cadastrado no sistema.");
  }

  function tip_estoque_minimo_maximo()
  {
    global $man, $html, $form, $table; 

    return adicionaTip("f_tip_estoque_minimo_maximo", "Situação Estoque (Lógico)",
   "- Menor que 1 então FALTA<br>".
   "- Menor que 10% do estoque mínimo então SALDO<br>".
   "- Menor que estoque mínimo então BAIXO<br>".
   "- Maior que estoque máximo então ALTO<br>".
   "- Maior que estoque mínimo e menor que estoque máximo então NORMAL");
  }

  function valida_div($valor)
  {
    if (str_value($valor) && ($valor != 0))
      return $valor;
    else
      return 1;
  }

  /*label => valor*/
  function testa_var_parametro_geral($arr, $titulo, $id_link_fechar_janela = true)
  {
    $arr_nao_setada = array();
    foreach ($arr AS $label=>$valor)
    {
      if (!str_value($valor))
        $arr_nao_setada[] = $label;
    }
    
    if (!count($arr_nao_setada))
      return;
    
    $str = "Atenção: É necessário preencher em <a href=\"man_parametro_geral.php\" target=\"nova\">Parametro Geral</a> o(s) seguinte(s) campo(s):<br>";
    foreach($arr_nao_setada AS $label)
      $str .= "<br>{$label}<br>";
      
    $str = substr($str, 0, -2);
    $html = new JHtml($titulo);
    $html->AddHtml("<h4>$str.</h4>");
    
    if ($id_link_fechar_janela)
      $html->AddHtml("<br><br><a href=\"#\" onClick=\"window.close();\">Fechar Janela</a>");
    
    echo $html->GetHtml();
    exit();
  }
  
  function valida_barra($str)
  {
    $str_alterada = trim($str);
    if ($str_alterada[0] == "/")
      return "";
    else
      return $str;
  }
/*
  função usada para pegar os índices numéricos e devolver para os Callbacks de grids
  $array = array associativo
  $campo = nome do índice na qual deseja-se o índice numérico no array
*/
  function get_index_of($array, $campo)
  {
    $i = 0;

    foreach($array AS $key => $value)
    {
      if ($key == $campo)
        return $i;
      $i++;
    }

    return -1;
  }
 
  function abrevia_options($op_id, $max)
  {
    $result = array();
    if ($op_id)
    {
      foreach($op_id as $item )
        $result[] = array('value' => $item['value'], 'description' => substr($item['description'], 0, $max));
    }

    return $result;
  }

  //------------------------------------------------------------------
  // usada para concatenar emails usando ',' como separador e
  // não concatena emails duplicados
  // OBS.: o nome da var $email_to nao pode ser utilizada no processo
  // senão irá ocorrer erro

  function concatena_email($var_name, $email)
  {
    if ((strlen($var_name)) && (strlen($email)))
    {
      $email_to = $var_name;

      global $$email_to;

      $id_concatena = true;

      $arr_email = explode(", ", $$email_to);

      foreach ($arr_email as $value)
      {
        if ($email == $value)
          $id_concatena = false;
      }

      if (($id_concatena) || (sizeof($arr_email) == 0))
      {
        if (strlen($$email_to))
          $$email_to .= ", ";

        $$email_to .= $email;
      }
    }
  }

  function busca_email_usuario($cd_usuario, $ds_email_parametro = "ds_email_administrador")
  {
    global $conn;

    if (strlen($cd_usuario))
    {
      $sql = "SELECT e.ds_email FROM email e WHERE e.cd_pessoa = $cd_usuario ORDER BY id_principal DESC LIMIT 1 ";
      if ($rs = $conn->Select($sql))
        $ds_email = $rs->GetField(0);
      else
        conn_mostra_erro();
    }

    if (!strlen($ds_email) && strlen($ds_email_parametro))
    {
      $sql = "SELECT $ds_email_parametro FROM parametro_geral_notificacao";
      if ($rs = $conn->Select($sql))
        $ds_email = $rs->GetField(0);
      else
        conn_mostra_erro();
    }

    return $ds_email;
  }

  /**
    * Opcionalmente pode utilizar um contador externo
    * Quando tem dois SQLs que usam o get_where primeiro deve-se resetar o contador 
   */
  function get_where($cont_extern=false, $id_reseta = false)
  {
    static $count = 0;

    if ($id_reseta)
    {
      $count = 0;
      return;
    }

    if ($cont_extern !== false)
      return ($cont_extern > 0 )?" AND ":" WHERE ";
    else
      return ($count++ > 0 )?" AND ":" WHERE ";
  }

  //$ds_tabela com o nome da tabela e o alias caso precise
  function restricao_join($ds_tabela, $ds_campo_1, $id_condicao, $ds_campo_2, $vl_campo)
  {
    if (strlen($vl_campo))
      return " JOIN $ds_tabela ON $ds_campo_1 $id_condicao $ds_campo_2 ";
    else
      return "";
  }
  
  function restricao_where($id_teste, $ds_campo, $id_condicao, $vl_campo, $aspas="", $parenteses=false, $callback = "", $param_callback = array())
  {
    if (strlen($vl_campo))
    {
      if ($id_teste == "get_where")
        $id_teste = get_where();
      
      if (str_value($callback))
        $vl_campo = call_user_func_array($callback, array_merge(array($vl_campo), $param_callback));

      $sql = " $id_teste $ds_campo $id_condicao "; 

      if ($parenteses)
        $sql .= "($aspas"."$vl_campo"."$aspas) ";
      else
        $sql .= "$aspas"."$vl_campo"."$aspas ";

      return $sql;
    }
    else
      return "";
  }

  function converte_op_sql_case($op_id, $campo_sql)
  {
    $t_sql = "(CASE ";

    foreach ($op_id AS $chave => $valor)
    {
      if (strlen($valor["description"]))
        $t_sql .= "WHEN $campo_sql = " . $valor["value"] . " THEN '" . $valor["description"] . "' ";
    }

    return $t_sql . "END) ";
  }

  $sql_id_sigla_unidade       = converte_op_sql_case($op_id_sigla_unidade,      "pu.id_sigla_unidade");
  $sql_id_periodicidade       = converte_op_sql_case($op_id_periodicidade,      "pv.id_periodicidade");
  $sql_id_responsavel         = converte_op_sql_case($op_id_responsavel,        "o.id_responsavel");
  $sql_id_situacao            = converte_op_sql_case($op_id_situacao,           "cl.id_situacao");
  $sql_id_situacao_nf         = converte_op_sql_case($op_id_situacao_nf,        "o.id_situacao_nf");
  $sql_id_situacao_nf_abrev   = converte_op_sql_case($op_id_situacao_nf_abrev,  "o.id_situacao_nf");
  $sql_id_tipo_vi             = converte_op_sql_case($op_id_tipo_vi,            "n.id_tipo");
  $sql_id_origem_movimento    = converte_op_sql_case($op_id_origem_movimento,   "m.id_origem");
 
  function formata_id_op($op_id, $val, $substr = null)
  {
    foreach ($op_id AS $chave=>$valor)
      if ($valor["value"] == $val) 
        return (str_value($substr) ? substr($valor["description"], 0, $substr) : $valor["description"]);

    return false;
  }

  function formata_id_fechamento($val)
  {
    global $op_id_fechamento;
    return formata_id_op($op_id_fechamento, $val);
  }
  
  function formata_id_tipo_carreta($val)
  {
    global $op_id_tipo_carreta;
    return formata_id_op($op_id_tipo_carreta, $val);
  }

  function formata_id_unidade_compra($val)
  {
    global $op_id_unidade_compra;
    return formata_id_op($op_id_unidade_compra, $val);
  }

  function formata_id_tipo_caixa_financeiro($val)
  {
    global $op_id_tipo_caixa_financeiro;
    return formata_id_op($op_id_tipo_caixa_financeiro, $val);
  }

  function formata_op_id_tipo_envolvimento_processo($val)
  {
    global $op_id_tipo_envolvimento_processo;
    return formata_id_op($op_id_tipo_envolvimento_processo, $val);
  }

  function formata_op_id_situacao_processo_juridico($val)
  {
    global $op_id_situacao_processo_juridico;
    return formata_id_op($op_id_situacao_processo_juridico, $val);
  }

 
  function formata_id_base_prazo($val)
  {
    global $op_id_base_prazo;
    return formata_id_op($op_id_base_prazo, $val);
  }

  function formata_id_tipo_recebimento_caixa($val)
  {
    global $op_id_tipo_recebimento_caixa;
    return formata_id_op($op_id_tipo_recebimento_caixa, $val);
  }
  
  function formata_id_classificacao_rat($val)
  {
    global $op_id_classificacao_rat;
    return formata_id_op($op_id_classificacao_rat, $val);
  }
  
  function formata_id_classificacao_rat_abr($val, $tam)
  {
    global $op_id_classificacao_rat;
    return formata_id_op(abrevia_options($op_id_classificacao_rat, $tam), $val);
  }
  
  function formata_id_tipo_cat($val)
  {
    global $op_id_tipo_cat;
    return formata_id_op($op_id_tipo_cat, $val);
  }

  function formata_id_categoria_cnh($val)
  {
    global $op_id_categoria_cnh;
    return formata_id_op($op_id_categoria_cnh, $val);
  }
  
  function formata_id_semana_pna($val)
  {
    global $op_id_semana_pna;
    return formata_id_op($op_id_semana_pna, $val);
  }

  function formata_id_frete_responsabilidade($val)
  {
    global $op_id_frete_responsabilidade;
    return formata_id_op($op_id_frete_responsabilidade, $val);
  }

  function formata_id_tipo_plano_conta($val)
  {
    global $op_id_tipo_plano_conta;
    return formata_id_op($op_id_tipo_plano_conta, $val);
  }

  function formata_id_estrutura_plano_conta($val)
  {
    global $op_id_estrutura_plano_conta;
    return formata_id_op($op_id_estrutura_plano_conta, $val);
  }

  function formata_id_pesquisa_mercado($val)
  {
    global $op_id_pesquisa_mercado;
    return formata_id_op($op_id_pesquisa_mercado, $val);
  } 
  
  function formata_id_calculo_frete_comissao($val)
  {
    global $op_id_calculo_frete_comissao;
    return formata_id_op($op_id_calculo_frete_comissao, $val);
  } 
 
  function formata_id_situacao_cpf($val)
  {
    global $op_id_situacao_cpf;
    return formata_id_op($op_id_situacao_cpf, $val);
  } 
  
  function formata_id_destino_mensagem($val)
  {
    global $op_id_destino_mensagem;
    return formata_id_op($op_id_destino_mensagem, $val);
  } 
  
  function formata_id_entrega_titulo($val, $max = false)
  {
    global $op_id_entrega_titulo;

    if ($max)
      return substr(formata_id_op($op_id_entrega_titulo, $val), 0, $max);
    else
      return formata_id_op($op_id_entrega_titulo, $val);
  } 
  
  function formata_id_dia_semana_rota($val)
  {
    global $op_id_dia_semana_rota;
    return formata_id_op($op_id_dia_semana_rota, $val);
  } 
  
  function formata_id_tipo_frete($val)
  {
    global $op_id_tipo_frete;
    return formata_id_op($op_id_tipo_frete, $val);
  } 
  
  function formata_id_origem_conferencia($val)
  {
    global $op_id_origem_conferencia;
    return formata_id_op($op_id_origem_conferencia, $val);
  } 

  function formata_id_origem_movimento($val)
  {
    global $op_id_origem_movimento;
    return formata_id_op($op_id_origem_movimento, $val);
  }

  function formata_id_envio($val)
  {
    global $op_id_envio;
    return formata_id_op($op_id_envio, $val);
  }

  function formata_id_tipo_desconto($val)
  {
    global $op_id_tipo_desconto;
    return formata_id_op($op_id_tipo_desconto, $val);
  } 
  
  function formata_id_tipo_vendedor($val)
  {
    global $op_id_tipo_vendedor;
    return formata_id_op($op_id_tipo_vendedor, $val);
  } 

  function formata_id_ipi($val)
  {
    global $op_id_ipi;
    return formata_id_op($op_id_ipi, $val);
  } 

  function formata_id_tipo_vi($val)
  {
    global $op_id_tipo_vi;
    return formata_id_op($op_id_tipo_vi, $val);
  }

  function formata_id_formata_confianca($val)
  {
    global $op_id_formata_confianca;
    return formata_id_op($op_id_formata_confianca, $val);
  }

  function formata_id_anuencia($val)
  {
    global $op_id_formata_anuencia;
    return formata_id_op($op_id_formata_anuencia, $val);
  }

  function formata_id_base_pagamento_transportadora($val)
  {
    global $op_id_base_pagamento_transportadora;
    return formata_id_op($op_id_base_pagamento_transportadora, $val);
  }

  function formata_id_frota_transportadora($val)
  {
    global $op_id_frota_transportadora;
    return formata_id_op($op_id_frota_transportadora, $val);
  }

  function formata_id_tipo_atividade($val)
  {
    global $op_id_tipo_atividade;
    return formata_id_op($op_id_tipo_atividade, $val);
  }

  function formata_id_tipo_acrescimo($val)
  {
    global $op_id_tipo_acrescimo;
    return formata_id_op($op_id_tipo_acrescimo, $val);
  }
  
  function formata_id_tipo_mensagem($val)
  {
    global $op_id_tipo_mensagem;
    return formata_id_op($op_id_tipo_mensagem, $val);
  }

  function formata_id_atualizacao($val)
  {
    global $op_id_atualizacao;
    return formata_id_op($op_id_atualizacao, $val);
  }

  function formata_id_atualizacao_grupo($val)
  {
    global $op_id_atualizacao_grupo;
    return formata_id_op($op_id_atualizacao_grupo, $val);
  }
  
  function formata_id_obrigatorio($val)
  {
    global $op_id_obrigatorio;
    return formata_id_op($op_id_obrigatorio, $val);
  }
  
  function formata_id_situacao_compromisso($id, $id_color = true, $substr = null)
  {
    global $op_id_situacao_compromisso;

    $id_res = formata_id_op($op_id_situacao_compromisso, $id, $substr);
    
    if ($id_color)
      return formata_valor_cor_id_situacao($id_res, $id);
    else
      return $id_res;
 
    
  }

  function formata_id_dia_semana($val)
  {
    global $op_id_dia_semana;
    return formata_id_op($op_id_dia_semana, $val);
  }

  function formata_id_estado_civil($val)
  {
    global $op_id_estado_civil;
    return formata_id_op($op_id_estado_civil, $val);
  }

  function formata_id_sexo($val)
  {
    global $op_id_sexo;
    return formata_id_op($op_id_sexo, $val);
  }

  function formata_id_tipo_telefone($val)
  {
    global $op_id_tipo_telefone;
    return formata_id_op($op_id_tipo_telefone, $val);
  }

  function formata_id_permite($val)
  {
    global $op_id_permite;
    return formata_id_op($op_id_permite, $val);
  }

  function formata_id_sim_nao($val)
  {
    global $op_id_sim_nao;
    return formata_id_op($op_id_sim_nao, $val);
  }

  function formata_id_semana_letra($val)
  {
    global $op_id_semana_letra;
    return formata_id_op($op_id_semana_letra, $val);
  }

  function formata_id_documento($val)
  {
    global $op_id_documento;
    return formata_id_op($op_id_documento, $val);
  }

  function formata_id_acesso_externo($val)
  {
    global $op_id_acesso_externo;
    return formata_id_op($op_id_acesso_externo, $val);
  }

  function formata_id_seta($val)
  {
    global $op_id_seta;
    return formata_id_op($op_id_seta, $val);
  }

  function formata_id_entrada_saida($val)
  {
    global $op_id_entrada_saida;
    return formata_id_op($op_id_entrada_saida, $val);
  }

  function formata_id_tipo_endereco($val)
  { 
    global $op_id_tipo_endereco;
    return formata_id_op($op_id_tipo_endereco, $val);
  }


  function formata_id_tipo_conta($val)
  {
    global $op_id_tipo_conta;
    return formata_id_op($op_id_tipo_conta, $val);
  }


  function formata_id_tipo_dependente($val)
  {
    global $op_id_tipo_dependente;
    return formata_id_op($op_id_tipo_dependente, $val);
  }


  function formata_id_grau_instrucao($val)
  {
    global $op_id_grau_instrucao;
    return formata_id_op($op_id_grau_instrucao, $val);
  }


  function formata_id_pagamento($val)
  {
    global $op_id_pagamento;
    return formata_id_op($op_id_pagamento, $val);
  }

  function formata_id_assistencia($val)
  {
    global $op_id_assistencia;
    return formata_id_op($op_id_assistencia, $val);
  }

  function formata_id_sintegra($val)
  {
    global $op_id_sintegra;
    return formata_id_op($op_id_sintegra, $val);
  }

  function formata_id_modelo_contrato($val)
  {
    global $op_id_modelo_contrato;
    return formata_id_op($op_id_modelo_contrato, $val);
  }

  function formata_id_sigla_unidade($val)
  {
    global $op_id_sigla_unidade;

    return formata_id_op($op_id_sigla_unidade, $val);
  }


  function formata_id_consumo($val)
  {
    global $op_id_consumo;
    return formata_id_op($op_id_consumo, $val);
  }


  // ocorrencia
  function formata_id_situacao_nf($val)
  {
    global $op_id_situacao_nf;
    return formata_id_op($op_id_situacao_nf, $val);
  }

  //situacao_venda
  function formata_id_situacao_venda($val)
  {
    global $op_id_situacao_venda;
    return formata_id_op($op_id_situacao_venda, $val);
  } 

  //utilizacao_venda
  function formata_id_utilizacao_venda($val)
  {
    global $op_id_utilizacao_venda;
    return formata_id_op($op_id_utilizacao_venda, $val);
  } 

  //id_tipo_codigo_barra
  function formata_id_tipo_codigo_barra($val)
  {
    global $op_id_tipo_codigo_barra;
    return formata_id_op($op_id_tipo_codigo_barra, $val);
  }

  //id_semana
  function formata_id_semana($val)
  {
    global $op_id_semana;
    return formata_id_op($op_id_semana, $val);
  }

  //id_periodicidade
  function formata_id_periodicidade($val)
  {
    global $op_id_periodicidade;
    return formata_id_op($op_id_periodicidade, $val);
  }

  //id_abc
  function formata_id_abc($val)
  {
    global $op_id_abc;
    return formata_id_op($op_id_abc, $val);
  }

  // ocorrencia
  function formata_id_responsavel($val)
  {
    global $op_id_responsavel;
    return formata_id_op($op_id_responsavel, $val);
  }

  // pedido justificativa
  function formata_id_motivo_liberacao($val)
  {
    global $op_id_motivo_liberacao;
    return formata_id_op($op_id_motivo_liberacao, $val);
  }

  function formata_id_situacao_titulo($val)
  {
    global $op_id_situacao_titulo;
    return formata_id_op($op_id_situacao_titulo, $val);
  }

  function formata_id_lote_titulo($val)
  {
    global $op_id_lote_titulo;
    return formata_id_op($op_id_lote_titulo, $val);
  }

  function formata_id_lote($val)
  {
    global $op_id_lote;
    return formata_id_op($op_id_lote, $val);
  }

  function formata_id_veiculo($val)
  {
    global $op_id_veiculo;
    return formata_id_op($op_id_veiculo, $val);
  }

  function formata_id_tipo_servico_telefonia($val)
  {
    global $op_id_tipo_servico_telefonia;
    return formata_id_op($op_id_tipo_servico_telefonia, $val);
  }

  function formata_id_situacao($val)
  {
    global $op_id_situacao;
    return "<font color='" . obtem_cor_id_situacao($val) . "'><b>" . formata_id_op($op_id_situacao, $val) . "</b></font>";
  }
  
  function formata_id_tipo_cobranca_tarifa($val)
  {
    global $op_id_tipo_cobranca_tarifa;
    return formata_id_op($op_id_tipo_cobranca_tarifa, $val);    
  }
  
  function formata_id_operadora($val)
  {
    global $op_id_operadora;
    return formata_id_op($op_id_operadora, $val);    
  }
  
  function formata_id_pagamento_servico_telefonico($val)
  {
    global $op_id_pagamento_servico_telefonico;
    return formata_id_op($op_id_pagamento_servico_telefonico, $val);    
  }
  
  function formata_id_pagamento_rede($val)
  {
    global $op_id_pagamento_rede;
    return formata_id_op($op_id_pagamento_rede, $val);
  }
  
  function formata_id_base_desconto($val)
  {
    global $op_id_base_desconto;
    return formata_id_op($op_id_base_desconto, $val);
  }
  
  function formata_id_beneficio_despesa($val)
  {
    global $op_id_beneficio_despesa;
    return formata_id_op($op_id_beneficio_despesa, $val);    
  }
  
  function formata_id_broker_distribuidora($val)
  {
    global $op_id_broker_distribuidora;
    return formata_id_op($op_id_broker_distribuidora, $val);    
  }
  
  function formata_id_tipo_rodado($val)
  {
    global $op_id_tipo_rodado;
    return formata_id_op($op_id_tipo_rodado, $val);
  }
  
  function formata_id_tipo_carroceria($val)
  {
    global $op_id_tipo_carroceria;
    return formata_id_op($op_id_tipo_carroceria, $val);
  }
  
  function formata_id_mes($val)
  {
    global $op_id_mes;
    return formata_id_op($op_id_mes, $val);
  }
  
  function formata_id_lcto_nao_importado($val)
  {
    global $op_id_lcto_nao_importado;
    return formata_id_op($op_id_lcto_nao_importado, $val);
  }
  
  function formata_id_aplicacao_negociacao($val)
  {
    global $op_id_aplicacao_negociacao;
    return formata_id_op($op_id_aplicacao_negociacao, $val);
  }
  
  function formata_id_fracionamento_produto($val)
  {
    global $op_id_fracionamento_produto;
    return formata_id_op($op_id_fracionamento_produto, $val);
  }
  
  function formata_id_tipo_pgto_impressao($val)
  {
    global $op_id_tipo_pgto_impressao;
    return formata_id_op($op_id_tipo_pgto_impressao, $val);
  }
  
  function formata_id_tipo_pgto_recebimento($val)
  {
    global $op_id_tipo_pgto_recebimento;
    return formata_id_op($op_id_tipo_pgto_recebimento, $val);
  }
  
  function formata_id_armazenagem_palete($val)
  {
    global $op_id_armazenagem_palete;
    return formata_id_op($op_id_armazenagem_palete, $val);
  }
  
  function formata_manifesto_destinatario($val, $id_link_manifesto = true)
  {
    global $conn;
    
    $arr = explode("_", $val);

    $nr_nota_fiscal = $arr[0];
    $cd_nota_fiscal = $arr[1]; 
    $cd_evento      = $arr[2];
    $nr_chave_nfe   = $arr[3];
    $id_doc_proprio = $arr[4];

    if (!str_value($nr_chave_nfe))
      return "<font color='" . obtem_cor_id_situacao(0) . "'><b>Sem Chave</b></font>";
    
    switch ($cd_evento)
    {
      case "210200": //Confirmada Operação 
        return "<font color='" . obtem_cor_id_situacao(2) . "'><b>Conf. Operação</b></font>";
      break;

      case "210210": //Ciência da Operação
        return "<font color='" . obtem_cor_id_situacao(1) . "'><b>Ciência</b></font>";
      break;

      case "210220": //Desconhecida
        return "<font color='" . obtem_cor_id_situacao(0) . "'><b>Desc. Operação</b></font>";
      break;

      case "210240": //Não realizada
        return "<font color='" . obtem_cor_id_situacao(0) . "'><b>Não realizada</b></font>";
      break;

      default:
        if (!$id_doc_proprio)
        {
          if ($id_link_manifesto)
            return "<a href=\"#\" id=\"ds_link_manifesto_" . $nr_nota_fiscal . "_" . $cd_nota_fiscal."\"class=\"ds_link_manifesto\">Manifestar NF</a>";
          else
            return "";
        }
        else
          return "<font color='red'><b>Emissão Própria</b></font>";
      break;
    }
  }
  
  function formata_id_situacao_sem_cor($val)
  {
    global $op_id_situacao;
    return formata_id_op($op_id_situacao, $val);
  }

  function formata_id_tipo_beneficio($val)
  {
    global $op_id_tipo_beneficio;
    return formata_id_op($op_id_tipo_beneficio, $val);
  }

  function formata_id_pis($val)
  {
    global $op_id_pis;
    return formata_id_op($op_id_pis, $val);
  }


  function formata_id_dados_investimento($val)
  {
    global $op_id_dados_investimento;
    return formata_id_op($op_id_dados_investimento, $val);
  }

  function formata_id_forma_pagamento($val)
  {
    global $op_id_forma_pagamento;
    return formata_id_op($op_id_forma_pagamento, $val);
  }

  function formata_id_situacao_cliente_tele_venda($val)
  {
    global $op_id_situacao_cliente_tele_venda;
    return formata_id_op($op_id_situacao_cliente_tele_venda, $val);  
  }
  
  function formata_id_tipo_rota($val)
  {
    global $op_id_tipo_rota;
    return formata_id_op($op_id_tipo_rota, $val);
  }
  
  function formata_id_manifesto_destinatario($val)
  {
    global $op_id_manifesto_destinatario;
    return formata_id_op($op_id_manifesto_destinatario, $val);
  }
  
  function formata_id_tipo_pgto_descarga($val)
  {
    global $op_id_tipo_pgto_descarga;
    return formata_id_op($op_id_tipo_pgto_descarga, $val);
  }
  
  function formata_id_apuracao_msl($val)
  {
    global $op_id_apuracao_msl;
    return formata_id_op($op_id_apuracao_msl, $val);
  }
  
  function formata_id_bandeira($val)
  {
    global $op_id_bandeira;
    return formata_id_op($op_id_bandeira, $val);
  }
  
  function formata_id_ambiente($val)
  {
    global $op_id_ambiente;
    
    return formata_id_op($op_id_ambiente, $val);
  }
  
  function formata_id_modelo_fiscal($val)
  {
    global $op_id_modelo_fiscal;
    return formata_id_op($op_id_modelo_fiscal, $val);
  }
  
  function formata_id_contrato_frete($val)
  {
    global $op_id_contrato_frete;
    return formata_id_op($op_id_contrato_frete, $val);
  }
  
  function formata_id_tipo_veiculo_frete($val)
  {
    global $op_id_tipo_veiculo_frete;
    return formata_id_op($op_id_tipo_veiculo_frete, $val);
  }
  
  function formata_id_status_armazem_posicao($val)
  {
    global $op_id_status_armazem_posicao;
    return formata_id_op($op_id_status_armazem_posicao, $val);
  }
  
  function formata_id_tipo_vasilhame($val)
  {
    global $op_id_tipo_vasilhame;
    return formata_id_op($op_id_tipo_vasilhame, $val);
  }
  
  function formata_id_modelo_separacao($val)
  {
    global $op_id_modelo_separacao;
    return formata_id_op($op_id_modelo_separacao, $val);
  }
  
  function formata_id_tipo_armazem($val)
  {
    global $op_id_tipo_armazem;
    return formata_id_op($op_id_tipo_armazem, $val);
  }
  
  function formata_id_tipo_separacao($val)
  {
    global $op_id_tipo_separacao;
    return formata_id_op($op_id_tipo_separacao, $val);
  }
  
  function formata_id_ordem_invertida($val)
  {
    global $op_id_ordem_invertida;
    return formata_id_op($op_id_ordem_invertida, $val);
  }
  
  function formata_id_montagem_produto($val)
  {
    global $op_id_montagem_produto;
    return formata_id_op($op_id_montagem_produto, $val);
  }
  
  function formata_id_entrega_produto($val)
  {
    global $op_id_entrega_produto;
    return formata_id_op($op_id_entrega_produto, $val);
  }
  
  function formata_id_validade_palete($val)
  {
    global $op_id_validade_palete;
    return formata_id_op($op_id_validade_palete, $val);
  }
  
  function formata_id_ocorrencia_titulo($val)
  {
    global $op_id_ocorrencia_titulo;
    return formata_id_op($op_id_ocorrencia_titulo, $val);
  }
  
  function formata_id_periodicidade_serasa($val)
  {
    global $op_id_periodicidade_serasa;
    return formata_id_op($op_id_periodicidade_serasa, $val);
  }
  
  function formata_id_premio_vendedor($val)
  {
    global $op_id_premio_vendedor;
    return formata_id_op($op_id_premio_vendedor, $val);
  }
  
  function formata_id_retorno_televenda($val)
  {
    global $op_id_mostra_nao_encerrado;
    return formata_id_op($op_id_mostra_nao_encerrado, $val);
  }
  
  function formata_cor_ocorrencia_titulo($val)
  {
    global $op_id_ocorrencia_titulo, $ManBD;
    
    $ParametroFinanceiro = new ParametroFinanceiro($ManBD->objConn);
    $ParametroFinanceiro->cd_parametro_financeiro = 1;
    $ManBD->PopulaObjetoGenerico($ParametroFinanceiro);
    
    switch ($val)
    {
      case $ParametroFinanceiro->id_tipo_ocorrencia_baixa:    $ds_cor = "#EEAD0E"; break;
      case $ParametroFinanceiro->id_tipo_ocorrencia_protesto: $ds_cor = "#FF0000"; break;
    }
    
    return "<font color='{$ds_cor}'><b>" . formata_id_op($op_id_ocorrencia_titulo, $val). "</b></font>";
  }
  
  // dt = YYYY-MM-DD
  function data_extenso($ds_cidade, $dt)
  {
    $arr_dt = explode("-", $dt);
    $dia    = $arr_dt[2];
    $mes    = SetMes($arr_dt[1]);
    $ano    = $arr_dt[0];

    return "$ds_cidade, $dia de $mes de $ano";
  }

  function SetMes($nr_mes)
  {
    $mes = array("01" => "Janeiro", 
                 "02" => "Fevereiro", 
                 "03" => "Março",
                 "04" => "Abril", 
                 "05" => "Maio", 
                 "06" => "Junho", 
                 "07" => "Julho", 
                 "08" => "Agosto", 
                 "09" => "Setembro", 
                 "10" => "Outubro",
                 "11" => "Novembro", 
                 "12" => "Dezembro"
                );
    return $mes[$nr_mes];
  }

  function SetDiaDaSemana($nr_semana)
  {
    $dia_semana = array("1" => "Dom",
                        "2" => "Seg", 
                        "3" => "Ter", 
                        "4" => "Qua", 
                        "5" => "Qui", 
                        "6" => "Sex", 
                        "7" => "Sab"
                       );
    return $dia_semana[$nr_semana];
  }
  
  // retorna valor formatado de acordo com a cor da situacao
  function formata_valor_cor_id_situacao($val, $id_situacao)
  {
    return "<font color='" . obtem_cor_id_situacao($id_situacao) . "'><b>" . $val . "</b></font>";
  }

  function formata_nr_cnpj_cpf($val)
  {
    if (strlen($val) == 11)
      return Format_Cpf($val, "sys", "pt_BR");
    else
      return Format_Cnpj($val, "sys", "pt_BR");
  }

  function formata_mes($data)
  {
    switch ($data)
    {
      case "01":  $mes = "Janeiro";    break;
      case "02":  $mes = "Fevereiro";  break;
      case "03":  $mes = "Março";      break;
      case "04":  $mes = "Abril";      break;
      case "05":  $mes = "Maio";       break;
      case "06":  $mes = "Junho";      break;
      case "07":  $mes = "Julho";      break;
      case "08":  $mes = "Agosto";     break;
      case "09":  $mes = "Setembro";   break;
      case "10":  $mes = "Outubro";    break;
      case "11":  $mes = "Novembro";   break;
      case "12":  $mes = "Dezembro";   break;
    }
    return $mes;
  }

  function formata_tamanho_arquivo($var = null, $id_unidade = null)
  {
    // formata tamanho de arquivo para ser mostrado
    if (!strlen($id_unidade))
    {
      $tam = $var;
      if ($tam >= 1024 && $tam < 1048576)
        return  round(($tam/1024), 2) . " Kb";
      elseif ($tam >= 1048576 && $tam < 1073741824)
        return  round(($tam/1048576), 2) . " Mb";
      elseif ($tam >= 1073741824)
        return  round(($tam/1073741824), 2) . " Gb";
      else
        return $tam." b";
    }
    else
    {
      //formata tamanho de arquivo para ser gravado no banco
      $tam = filesize($var);
      return $tam;
    }
  }

  function extenso($valor=0, $maiusculas=false, $id_moeda = true)
  {
    $singular = $plural = array();
    
    if ($id_moeda)
    {
      $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
      $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
    }
    
    $ds_concatena_valor = ($id_moeda ? "e" : "vírgula");
    
    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

    $z=0;

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    for($i=0;$i<count($inteiro);$i++)
        for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
            $inteiro[$i] = "0".$inteiro[$i];

    $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
     for ($i=0;$i<count($inteiro);$i++)
    {
      $valor = $inteiro[$i];
      $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
      $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
      $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
      $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
      $t = count($inteiro)-1-$i;
      $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
      if ($valor == "000") $z++; elseif ($z > 0) $z--;
      if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
      if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " $ds_concatena_valor ") : " ") . $r;
    }

    if (!$maiusculas)
    {
      return($rt ? $rt : "zero");
    }
    else
    {
      /*
       Trocando o " E " por " e ", fica muito + apresentável!
       Rodrigo Cerqueira, rodrigobc@fte.com.br
      */
      if ($rt) $rt=preg_replace("/ E /"," e ",ucwords($rt));
        return (($rt) ? ($rt) : "Zero");
    }
  }

  function concatena_valores($vl_1, $vl_2, $aux = " / ")
  {
    if (str_value($vl_1) && str_value($vl_2))
      return $vl_1 . $aux . $vl_2;
    elseif (str_value($vl_1))
      return $vl_1;
    elseif (str_value($vl_2))
      return $vl_2;
  }

  function valida_caixa_titulo($cd_caixa)
  {
    global $conn;

    $sql = "SELECT COUNT(hc.cd_historico)
              FROM caixa c
              JOIN historico_caixa hc ON hc.cd_historico = c.cd_historico
             WHERE c.cd_caixa = $cd_caixa
               AND hc.id_tipo = 2
               AND c.id_tipo_recebimento = 2 ";

    if ($rs = $conn->Select($sql))
      return $rs->GetField(0);
    else
      conn_mostra_erro();

    return false;
  }

  //--------------------------------
  // geracao de relatorios

  if ($horizontal)
  {
    define("LINHA_LARG",     290);
    define("TAMANHO_PAGINA", 195);
    define("TIPO_PDF",       "L");
  }
  else
  {
    define("LINHA_LARG",     205);
    define("TAMANHO_PAGINA", 280);
    define("TIPO_PDF",       "P");
  }

  define("FPDF_FONTPATH", $path . "lib/fpdf/font/");
  define("REL_SUBMIT",    "rel_" . substr(basename($PHP_SELF), 4, strpos(basename($PHP_SELF), ".")));
  define("REL_ARQ_NOME",  $_SESSION["s_cd_usuario"] ."_".substr(basename($PHP_SELF), 0, strpos(basename($PHP_SELF), ".")));


  /*
    $arr_label = array(
                    array(
                      [largura] => 0,
                      [altura]  => 1,
                      [label]   => 2,
                      [borda]   => 3,
                      [alinha]  => 4,
                      [fundo]   => 5
                    )
                 );

      separador = mostra linha de separacao
  */
  function rel_cabecalho($arr_label, $vl_fonte = 7)
  {
    global $pdf, $horizontal;

    if (!is_array($arr_label))
      return false;

    $orientation = (isset($horizontal) ? ($horizontal ? "L" : "P") : "");
    
    $pdf->AddPage($orientation);
    $pdf->SetFont('Arial', 'B', $vl_fonte);
    $pdf->SetXY(5, 20);

    foreach ($arr_label AS $chave => $valor)
    {
      if (is_array($valor))
      {
        $pdf->Cell($valor["largura"], 
                   ($valor["altura"]?$valor["altura"]:4), 
                   $valor["label"], 
                   ($valor["borda"]?$valor["borda"]:0), 
                   0, 
                   ($valor["alinha"]?$valor["alinha"]:"C"),
                   ($valor["fundo"]?$valor["fundo"]:0));
      }
      elseif ($valor == "separador")
      {
        $pdf->Line(5, $pdf->GetY()+4, LINHA_LARG, $pdf->GetY()+4);
        $pdf->SetXY(5, $pdf->GetY()+4);
      }
      elseif ($valor == "nova_linha")
        $pdf->SetXY(5, $pdf->GetY()+4);
    }

    $pdf->Line(5, $pdf->GetY()+4, LINHA_LARG, $pdf->GetY()+4);
    $pdf->SetXY(5, $pdf->GetY()+4);
    $pdf->SetFont('Arial', '', $vl_fonte);
  }

  function write_linha_assinatura($lado_esquerdo_title,     $lado_direito_title,
                                  $lado_esquerdo_dado = "", $lado_direito_dado = "",
                                  $set_x = PAPER_START_X, $w = 190, $w_tracado = 80, $w_espaco = 30, $id_border = 1)
  {
    global $pdf;

    if ($id_border)
    {
      $pdf->SetX($set_x);
      $pdf->Cell($w + (VERTICAL_CELL_WIDTH * 2), (HEIGHT * 2), '', 0, 1);
    }

    if (!str_value($lado_esquerdo_title))
      $borda_esquerda = "";
    else
      $borda_esquerda = "B";

    if (!str_value($lado_direito_title))
      $borda_direita = "";
    else
      $borda_direita = "B";

    $pdf->SetFont(FONT_TYPE, '', FONT_SIZE);
    $pdf->SetXY($set_x + VERTICAL_CELL_WIDTH, $pdf->GetY() - (HEIGHT * 2));
    $pdf->Cell($w_tracado, HEIGHT, $lado_esquerdo_dado, $borda_esquerda, 0, 'C');
    $pdf->Cell($w_espaco,  HEIGHT, '');
    $pdf->Cell($w_tracado, HEIGHT, $lado_direito_dado,  $borda_direita, 1, 'C');

    if (!str_value($lado_esquerdo_title))
      $borda_esquerda = "";
    else
      $borda_esquerda = "T";

    if (!str_value($lado_direito_title))
      $borda_direita = "";
    else
      $borda_direita = "T";

    $pdf->SetFont(FONT_TYPE, 'B', FONT_SIZE);
    $pdf->SetX($set_x + VERTICAL_CELL_WIDTH);
    $pdf->Cell($w_tracado, HEIGHT, $lado_esquerdo_title, $borda_esquerda, 0, 'C');
    $pdf->Cell($w_espaco,  HEIGHT, '');
    $pdf->Cell($w_tracado, HEIGHT, $lado_direito_title,  $borda_direita, 1, 'C');

    $pdf->SetFont(FONT_TYPE, '', FONT_SIZE);
  }

  function rel_testa_pagina($alt_extra = false, $nm_funcao = "cabecalho")
  {
    global $pdf;

    if ($alt_extra)
    { 
      if (($alt_extra + $pdf->GetY()) > TAMANHO_PAGINA+4)
        call_user_func($nm_funcao);
    }
    else
    {
      if ($pdf->GetY() > TAMANHO_PAGINA+4)
        call_user_func("$nm_funcao");
    }
  }

  function rel_valida_permissao($t_titulo)
  {
    global $conn;

    if (JAGUAR_VERSION >= 2.0)
    {
      $myAuth = new JObject();
      $myAuth->ValidatePermission($conn);
    }
    else
    {
      if (!$_SERVER["REQUEST_METHOD"])
        return true;

      $auth = new JDBAuth($conn);
      if (!$auth->CanSelect())
      {
        if (strpos($_SERVER["PHP_SELF"], "/rel_") !== false)
          $str = "<a href=\"#\" onClick=\"window.close();\">Fechar Janela</a>";

        $html = new JHtml($t_titulo);
        $html->AddHtml("<big>Permissão Negada!</big><br><br>$str");
        echo $html->GetHtml();
        exit();
      }
    }
  }
 
  function rel_sem_resultado($t_titulo, $t_msg="Não há registros para o(s) filtro(s) informado(s)!", $t_id_fecha=true)
  {
    global $argc;

    if ($argc > 0 && !count($_GET))
      return;

    $html = new JHtml($t_titulo);
    $html->AddHtml("<h4>$t_msg</h4>");

    if ($t_id_fecha)
      $html->AddHtml("<br><br><a href=\"#\" onClick=\"window.close();\">Fechar Janela</a>");

    echo $html->GetHtml();
  }

  function formata_sub_titulo_data($dt_inicio = "", $dt_final = "", $label = "Período")
  {
    if (str_value($dt_inicio) && str_value($dt_final))
      return "$label: $dt_inicio à $dt_final ";
    elseif (str_value($dt_inicio))
      return "$label: Maior ou igual a $dt_inicio ";
    elseif (str_value($dt_final))
      return "$label: Menor ou igual a $dt_final ";
    else
      return "";
  }

  function formata_sub_titulo_texto($valor=null, $label, $tamanho_maximo=20)
  {
    if (str_value($valor))
      return substr(trim($label . ": " . $valor), 0, $tamanho_maximo) . "  ";
    else
      return "";
  }

  function formata_sub_titulo_op($funcao, $id = "", $label, $op=false)
  {  
    if (str_value(trim($id)))
    {
      if (is_array($op))
        return $label . ": " . call_user_func_array($funcao, array($op, $id)). "  ";
      else
        return $label . ": " . call_user_func($funcao, $id) . "  ";
    }
    else
      return "";
  }
  
  function formata_sub_titulo_valor($vl_inicio = "", $vl_final = "", $label, $precisao = 0)
  {
    if (str_value($vl_inicio) && str_value($vl_final))
      return " $label: " . Format_Number(Format_Number($vl_inicio, $precisao, "pt_BR", "sys"), $precisao, "sys", "pt_BR") .
             " à " . Format_Number(Format_Number($vl_final, $precisao, "pt_BR", "sys"), $precisao, "sys", "pt_BR") . " ";
    elseif (str_value($vl_inicio))
      return " $label: Maior ou igual a " . Format_Number(Format_Number($vl_inicio, $precisao, "pt_BR", "sys"), $precisao, "sys", "pt_BR") . " ";
    elseif (str_value($vl_final))
      return " $label: Menor ou igual a " . Format_Number(Format_Number($vl_final, $precisao, "pt_BR", "sys"), $precisao, "sys", "pt_BR") . " ";
    else
      return "";
  }
  
  function obtem_dado_tabela($valor, $from, $select=false, $where=false, $id_unico_registro=true)
  {
    global $conn;

    if (str_value($from) && str_value($valor))
    {
      if (!str_value($select))
        $select = "nm_$from";
      
      if (!str_value($where))
        $where  = "cd_$from";

      if (!strpos($valor, ","))
        $valor = "= $valor";
      elseif ($id_unico_registro)
        return $valor;
      else
        $valor = "IN $valor";

      $txt = "";
      $sql = "SELECT $select FROM $from WHERE $where $valor ORDER BY 1";
      if ($rs = $conn->Select($sql))
      {
        while (!$rs->IsEof())
        {
          if ($rs->mIndex)
            $txt .= ", ";

          $txt .= $rs->GetField(0);
          $rs->Next();
        }
      }
      else
        conn_mostra_erro();

      return $txt;
    }
    else
      return false;
  }

  // dt_mes = MM/YYYY
  function inicio_fim_mes($dt_mes, &$dt_inicio, &$dt_fim)
  {
    $dt_inicio = date("Y-m-d", mktime(0, 0, 0, substr($dt_mes, 0, 2),   1, substr($dt_mes, 3, 4)));
    $dt_fim    = date("Y-m-d", mktime(0, 0, 0, substr($dt_mes, 0, 2)+1, 0, substr($dt_mes, 3, 4)));
  }

  function substr_pdf($conteudo_campo, $largura)
  {
    global $pdf;

    $largura -= 1;

    if ((strlen($conteudo_campo)) && ($largura > 0))
      while ($pdf->GetStringWidth($conteudo_campo) > $largura)
        $conteudo_campo = substr($conteudo_campo, 0, -1);

    return $conteudo_campo;
  }

  function gera_relatorio_xls($sql, $arq_name=false, 
                              $arr_total=false, $id_salva_arquivo=false,
                              $_titulo="")
  {
    global $conn;

    // para evitar estouro de memoria e timeout
    set_time_limit(0);
    ini_set("memory_limit", -1);
    
    $myxls = new DbWriteExcel($conn);
    
    if (!str_value($arq_name))
      $arq_name = REL_ARQ_NOME . ".xlsx";

    if (is_array($arr_total) && count($arr_total)) $myxls->SetTotalFieldsArray($arr_total);
    $myxls->SetNameFile($arq_name);
    $myxls->GetXlsFromQuery($sql, $_titulo, $id_salva_arquivo);
  }

  function campo_formato_relatorio(&$form, $colspan = 1)
  {
    $form->OpenHeader("<b>Formato</b>");
    $form->OpenCell("", array("colspan" => $colspan));
    $id_gerar = new JFormSelect("f_id_gerar");
    $id_gerar->SetTestIfEmpty(true, "Preencha o campo Formato!");
    $id_gerar->AddOption("2", "PDF");
    $id_gerar->AddOption("1", "XLS");
    $form->AddObject($id_gerar);
  }

  // geracao de relatorios
  //--------------------------------





  //--------------------------------
  function repete_char($qt = 1, $char = " ")
  {
    return str_repeat($char, $qt);
  }


  function intervalo_dias($fromtime, $totime = '')
  {
    if ($totime == '')
      $totime = time();

    if ($fromtime > $totime)
    {
      $tmp      = $totime;
      $totime   = $fromtime;
      $fromtime = $tmp;
    }
    $timediff = $totime - $fromtime;
    for ($i = date('Y', $fromtime); $i <= date('Y', $totime); $i++)
    {
      if ((($i%4 == 0) && ($i%100 != 0)) || ($i%400 == 0))
        $timediff -= 24*60*60;
    }
    $remain = $timediff;
    return intval($remain/(24*60*60));
  }

  function obtem_tipo_acao() 
  {
    $sql = "SELECT cd_tipo AS value, ds_tipo AS description 
              FROM tipo_acao
             ORDER BY ds_tipo";

    return obtem_pesquisa($sql);
  }

  function obtem_historico_credito_efetuado()
  {
    global $conn;

    $sql = "SELECT cd_historico AS value, nm_historico AS description
              FROM historico_credito_efetuado
             ORDER BY nm_historico ";
    if ($rs = $conn->Select($sql))
      return $rs->GetArray(true);
    else
      conn_mostra_erro();

    return false;
  }

  function obtem_caixa_financeiro($id_pessoa = false)
  {
    global $conn;

     $sql = "SELECT DISTINCT cf.cd_caixa_financeiro as value,
                    cf.nm_caixa_financeiro as description
               FROM caixa_financeiro cf
               JOIN caixa_financeiro_usuario cfu ON cfu.cd_caixa_financeiro = cf.cd_caixa_financeiro ";

     if (!$id_pessoa)
       $sql .= " WHERE cfu.cd_pessoa = ". $_SESSION["s_cd_usuario"] . " ";

     $sql .= "ORDER BY cf.nm_caixa_financeiro";

    if ($rs = $conn->Select($sql))
      return $rs->GetArray(true);
    else
      conn_mostra_erro();

    return false;
  }//function obtem_caixa_finaceiro 

  function obtem_tipo_servico_pagamento() 
  {
    $sql = "SELECT cd_tipo_servico AS value, nm_tipo_servico AS description 
              FROM tipo_servico_pagamento
             ORDER BY nm_tipo_servico";

    return obtem_pesquisa($sql);
  }

  function obtem_produto_consumo()
  {
    $sql = "SELECT pc.cd_produto AS value, nm_produto AS description ".
             "FROM produto_consumo pc " .
             "JOIN produto p ON p.cd_produto = pc.cd_produto ".
            "WHERE p.id_ativo = 1 ";
     return obtem_pesquisa($sql);
  }
  
  function obtem_veiculo_tipo() 
  {
    $sql = "SELECT cd_tipo AS value, ds_tipo AS description 
              FROM veiculo_tipo 
             ORDER BY ds_tipo";

    return obtem_pesquisa($sql);
  }

  function obtem_categoria()
  {
    $sql = "SELECT cd_categoria AS value, nm_categoria AS description
              FROM categoria_conciliacao 
             ORDER BY nm_categoria ";

    return obtem_pesquisa($sql);
  }

  function obtem_tipo_arquivo_morto()
  {

    $sql = "SELECT tam.cd_tipo_arquivo_morto AS value, tam.ds_tipo_arquivo_morto AS description ".
             "FROM tipo_arquivo_morto tam";
  
    return obtem_pesquisa($sql);
  }
  
  function obtem_funcionarios($arr_cargos = null)
  {
    $ds_cargos = ((is_array($arr_cargos) && sizeof($arr_cargos)) ? implode(",", $arr_cargos) : "");
    
    $sql = 
      "SELECT p.cd_pessoa AS value, 
              SUBSTR(p.nm_pessoa, 0, 30) AS description
         FROM funcionario f 
         JOIN pessoa p USING (cd_pessoa) 
         JOIN vw_funcionario vwf ON vwf.cd_pessoa_funcionario = f.cd_pessoa 
        WHERE vwf.dt_demissao IS NULL " .
          restricao_where("AND", "vwf.cd_cargo", "IN", $ds_cargos, false, true);
    
    $sql .=
      " ORDER BY nm_pessoa ";
    
    return obtem_pesquisa($sql);
  }

  function obtem_padrao($value, $description, $from, $where = "", $order = "2", $id_show_code = false)
  {
    global $conn;

    if ($id_show_code)
      $description = "($value || ' / ' || $description)";

    $sql = "SELECT $value AS value, $description AS description
              FROM $from ";

    if (strlen($where))
      $sql .= "WHERE $where ";

    if (strlen($order))
      $sql .= "ORDER BY $order ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_sub_select_telefone($cd_pessoa)
  {
    return "(SELECT nr_telefone 
               FROM telefone 
              WHERE cd_pessoa = $cd_pessoa 
              ORDER BY id_principal DESC 
              LIMIT 1) ";
  }
  
  function obtem_sub_select_email($cd_pessoa)
  {
    return "(SELECT ds_email 
               FROM email 
              WHERE cd_pessoa = $cd_pessoa 
              ORDER BY id_principal DESC 
              LIMIT 1) ";
  }

  function obtem_sub_select_endereco($cd_pessoa)
  {
    return "(SELECT cd_endereco 
               FROM endereco 
              WHERE cd_pessoa =  $cd_pessoa  
              ORDER BY id_tipo_endereco LIMIT 1) ";
  }

  function obtem_sql_qt_unitaria($cd_produto, $cd_unidade, $qt_solicitada)
  {
    return "(obtem_quantidade($cd_produto,$cd_unidade) * $qt_solicitada)"; 

  }

  function obtem_sql_qt_nova_unidade($cd_produto, $cd_unidade_old, $qt_solicitada_old, $cd_unidade_new)
  {
    return "COALESCE( ".obtem_sql_qt_unitaria($cd_produto, $cd_unidade_old, $qt_solicitada_old). ",$qt_solicitada_old) ".
           "/ COALESCE(NULLIF((obtem_quantidade($cd_produto, $cd_unidade_new)), 0), 1) ";

  }

  /*passe cd_unidade_old e qt_solicitada_old para alterar*/
  function obtem_qt_logico($cd_armazem, $cd_produto, $cd_unidade_old=false, $qt_solicitada_old = false)
  {
    global $conn;

    if ($qt_solicitada_old && $cd_unidade_old)
    {
      $sql = "SELECT qt_logico + ".obtem_sql_qt_unitaria($cd_produto, $cd_unidade_old, $qt_solicitada_old)." AS qt_logico 
                FROM armazem_estoque 
               WHERE cd_armazem = $cd_armazem 
                 AND cd_produto = $cd_produto ";
    }
    else
    {
      $sql = "SELECT qt_logico 
                FROM armazem_estoque 
               WHERE cd_armazem = $cd_armazem 
                 AND cd_produto = $cd_produto ";
    }
    
    if ($rs = $conn->Select($sql))
      $qt_logico = $rs->GetField("qt_logico");
    else
      conn_mostra_erro();

    return $qt_logico;
  }

  /*função que diminui a descrição do endereço mantendo o nr, quando o endereço foi pego por obtem_endereco*/
  function substr_endereco($ds_endereco, $tam)
  {
    //7 = 5( é o tamanho máximo do nr de um endereço) + 2 (", " que separa descrição do nr)
    if (strpos($ds_endereco, ",") <= $tam-7)
      $ds_endereco = substr($ds_endereco, 0, $tam);
    else
    {
      $str = explode(",", $ds_endereco);
      $nr = ", " . trim($str[1]);
      $ds = trim($str[0]);
      $ds_endereco = substr($ds, 0, $tam-(strlen($nr))); 
      $ds_endereco = substr($ds_endereco . $nr, 0, $tam);
    }

    return $ds_endereco;
  }
  
  // $cd_pessoa               = Obrigatório passar código do funcionário para buscar seus contratos
  // $cd_contrato_funcionario = Quando for registro existente DEVE passar o código do contrato se for CAMPO CHAVE da tabela
  // $dt_contrato             = Quando for registro existente PODE passar um objeto data para pegar a data, somente usado para quando for passado parâmetro em $cd_contrato_funcionario !== null
  function obtem_contrato_funcionario($cd_pessoa, $cd_contrato_funcionario = null, $dt_contrato = null, $id_libera_admissao=null)
  {
    global $conn;

    $sql = "SELECT c.cd_contrato_funcionario AS value,
                   TO_CHAR(c.dt_admissao, 'DD/MM/YYYY') || ' - Nr. Registro: ' ||
                   COALESCE(c.nr_registro::TEXT, '') AS description,
                   TO_CHAR(c.dt_admissao, 'DD/MM/YYYY') AS dt_contrato
              FROM contrato_funcionario c
             WHERE c.cd_pessoa = $cd_pessoa " ;

    if (str_value($cd_contrato_funcionario))
      $sql .= "AND c.cd_contrato_funcionario = $cd_contrato_funcionario ";
    else
      $sql .= "AND (dt_demissao IS NULL OR dt_demissao >= today()) " ;

    if (!$id_libera_admissao)
      $sql .= "AND c.dt_admissao <= today() ";

    $sql .= "ORDER BY c.dt_admissao DESC ";

    if ($rs = $conn->Select($sql))
    {
      if (($cd_contrato_funcionario !== null) && (is_object($dt_contrato)))
        $dt_contrato->SetValue($rs->GetField("dt_contrato"));
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    }

    return conn_mostra_erro();
  }

  function obtem_grupo() {
    $sql = "SELECT cd_grupo AS value, nm_grupo AS description 
              FROM grupo 
             ORDER BY nm_grupo";
    return obtem_pesquisa($sql);
  }

  function obtem_pesquisa($sql)
  {
    global $conn;

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_pesquisa_um_campo($sql)
  {
    global $conn;

    if ($rs = $conn->Select($sql))
      return $rs->GetField(0);
    else
      conn_mostra_erro();
  }

  function retorna_armazem($cd_nota_fiscal)
  {
    global $conn;

    $sql = "SELECT COALESCE(p.cd_armazem, pgf.cd_armazem_venda) AS cd_armazem 
              FROM nota_fiscal nf 
              JOIN pedido p ON p.cd_pedido = nf.cd_pedido 
              JOIN parametro_geral_filial pgf ON nf.cd_pessoa_filial = pgf.cd_pessoa_filial 
             WHERE nf.cd_nota_fiscal = $cd_nota_fiscal ";

    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    else
      return $rs->GetField("cd_armazem");
  }

  function obtem_campo_parametro_geral_filial($campo, $cd_filial)
  {
    global $conn;

    $sql = "SELECT $campo FROM parametro_geral_filial WHERE cd_pessoa_filial = $cd_filial ";
    if ($rs = $conn->Select($sql))
      return $rs->GetField($campo);
    else
      conn_mostra_erro();

    return false;
  }

  function obtem_tipo_pagamento($id_tipo = false, $id_tipo_recebimento = false, $id_concatena = false, $cd_tipo_pagamento = false)
  {

    get_where(false, 1);
    if ($id_concatena)
      $description = "cd_tipo_pagamento || ' / ' || ds_tipo_pagamento";
    else
      $description = "ds_tipo_pagamento";

    $sql = "SELECT cd_tipo_pagamento AS value, $description AS description 
              FROM tipo_pagamento ";
         
    if ($id_tipo)
      $sql .= get_where() . " id_tipo = $id_tipo ";

    if ($id_tipo_recebimento)
      $sql .=  get_where() . " id_tipo_recebimento = $id_tipo_recebimento ";

    if ($cd_tipo_pagamento)
      $sql .= get_where() . " cd_tipo_pagamento = $cd_tipo_pagamento ";

    $sql .= "ORDER BY ds_tipo_pagamento";

    return obtem_pesquisa($sql);
  }

  function obtem_historico_pagamento_titulo($id_concatena = false) 
  {
    if ($id_concatena)
      $description = "cd_historico || ' / ' || ds_historico";
    else
      $description = "ds_historico";

    $sql = "SELECT cd_historico AS value, $description AS description ".
             "FROM historico_pagamento_titulo ".
            "ORDER BY ds_historico ";
    
    return obtem_pesquisa($sql); 
  }

  function obtem_tipo_pedido($id_tipo_movimento = false)
  {
    $sql = "SELECT cd_tipo_pedido AS value, nm_tipo_pedido AS description 
              FROM tipo_pedido ";
    
    if ($id_tipo_movimento)
      $sql .= "WHERE id_tipo_movimento = $id_tipo_movimento ";

    $sql .= "ORDER BY nm_tipo_pedido";
    return obtem_pesquisa($sql);
  }
 
  function obtem_assunto_recado()
  {
    $sql = "SELECT cd_assunto_recado AS value, ds_assunto_recado AS description ".
           "FROM assunto_recado ".
          "ORDER BY ds_assunto_recado";

    return obtem_pesquisa($sql);
  }

  function obtem_desconto($id_tipo_desconto = false)
  {
    $sql = "SELECT cd_desconto AS value, nm_desconto AS description ".
             "FROM desconto ";

    if ($id_tipo_desconto)
      $sql .= "WHERE id_tipo_desconto = $id_tipo_desconto ";

    $sql .= "ORDER BY nm_desconto";
    return obtem_pesquisa($sql);
  }
 
  function obtem_operacao($id_tipo = false, $id_entrada = false, $id_sintegra = false, $id_venda=false, $cd_operacao=false, $id_ajuste_nfe=false)
  {
    $sql = 
      "SELECT cd_operacao AS value, SUBSTR(nm_operacao, 0, 40) AS description 
         FROM operacao 
        WHERE 1 = 1 " . 
          restricao_where("AND", "id_tipo",       "=", $id_tipo,       "'").
          restricao_where("AND", "id_entrada",    "=", $id_entrada,    "'").
          restricao_where("AND", "id_sintegra",   "=", $id_sintegra,   "'").
          restricao_where("AND", "id_venda",      "=", $id_venda,      "'").
          restricao_where("AND", "cd_operacao",   "=", $cd_operacao,   "'").
          restricao_where("AND", "id_ajuste_nfe", "=", $id_ajuste_nfe, "'").
      " ORDER BY nm_operacao";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_operacao_parametros($where)
  {

    $sql = "SELECT cd_operacao AS value, SUBSTR(nm_operacao, 0, 40) AS description 
              FROM operacao ";
    
    foreach ($where AS $chave => $valor)
      $sql .= get_where() . $chave . "=" .$valor . " ";

    $sql .= "ORDER BY nm_operacao";
    return obtem_pesquisa($sql);
  }

  function obtem_tipo_arquivo()
  {
    global $conn;

    $sql = "SELECT cd_tipo as value, nm_tipo as description " .
             "FROM tipo_arquivo " .
            "ORDER BY nm_tipo ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_unidade_operacional()
  {
    global $conn;
    
    $sql = "SELECT cd_unidade AS value, cd_unidade || ' / ' || nm_unidade AS description 
              FROM unidade_operacional 
             ORDER BY cd_unidade ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_centro_custo($where = "")
  {
    global $conn;
    
    $sql = "SELECT cd_centro_custo AS value, cd_centro_custo || ' / ' || nm_centro_custo AS description ".
             "FROM centro_custo ".
            $where .
            "ORDER BY cd_centro_custo ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_sindicato()
  {
    global $conn;
    
    $sql = "SELECT p.cd_pessoa AS value, SUBSTR(p.nm_pessoa, 0, 40) AS description 
              FROM sindicato s 
              JOIN pessoa p USING (cd_pessoa) 
             WHERE p.cd_pessoa = s.cd_pessoa 
             ORDER BY nm_pessoa ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_situacao_produto($t_cd_produto)
  {
    global $conn;

    $sql = "SELECT id_ativo " .
             "FROM produto " .
            "WHERE cd_produto = $t_cd_produto ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }

  function obtem_utilizacao_produto($t_cd_produto, $t_cd_unidade)
  {
    global $conn;

    $sql = "SELECT id_utilizacao " .
             "FROM produto_unidade " .
            "WHERE cd_produto = $t_cd_produto " . 
              "AND cd_unidade = $t_cd_unidade ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }

  function obtem_nome_produto($t_cd_produto)
  {
    global $conn;

    $sql = "SELECT nm_produto " .
             "FROM produto " .
            "WHERE cd_produto = $t_cd_produto ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);
    
    return conn_mostra_erro();
  }

  function obtem_tipo_produto()
  {
    global $conn;

    $sql = "SELECT cd_tipo_produto AS value, nm_tipo_produto AS description " .
             "FROM tipo_produto " .
            "ORDER BY nm_tipo_produto ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_classe_vendedor()
  {
    global $conn;
    
    $sql = "SELECT cd_classe_vendedor AS value, nm_classe_vendedor AS description " .
           "FROM classe_vendedor "; 
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_vendedores_filhos($cd_vendedor_pai)
  {
    global $conn;

    $sql = "SELECT v.cd_vendedor AS value, v.nm_vendedor AS description ".
             "FROM vw_vendedor v ".
             "JOIN vendedor_hierarquia_completa vhc ON vhc.cd_vendedor_subordinado = v.cd_vendedor ".
            "WHERE vhc.cd_vendedor = $cd_vendedor_pai ".
            "ORDER BY v.nm_vendedor ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_vendedor()
  {
    $sql = 
      "SELECT v.cd_vendedor AS value,
              v.cd_vendedor ||' / '|| v.nm_vendedor AS description 
         FROM vw_vendedor v 
        ORDER BY 1 ";
    
    return obtem_pesquisa($sql);
  }

  function obtem_atividade($cd_atividade = false, $id_condicao = "=", $where = false)
  {
    global $conn;

    $sql = "SELECT cd_atividade as value, cd_atividade || ' / ' || nm_atividade as description " .
             "FROM atividade ";

    if (strlen($cd_atividade) && strlen($id_condicao))
      $sql .= "WHERE cd_atividade $id_condicao $cd_atividade ";
    
    $sql .= (str_value($where) ? get_where($cd_atividade) . $where : "");
    
    $sql .= "ORDER BY nm_atividade ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_armazem()
  {
    global $conn;

    $sql = "SELECT a.cd_armazem AS value, vw.nm_pessoa || ' - ' || a.nm_armazem AS description " .
             "FROM armazem a " .
             "JOIN vw_empresa_grupo_filial vw ON a.cd_pessoa_filial = vw.cd_pessoa " .
            "ORDER BY vw.nm_pessoa, a.nm_armazem ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_armazem_controla_estoque()
  {
    global $conn;

    $sql = "SELECT a.cd_armazem AS value, vw.nm_pessoa || ' - ' || a.nm_armazem AS description 
              FROM armazem a 
              JOIN vw_empresa_grupo_filial vw ON a.cd_pessoa_filial = vw.cd_pessoa
              JOIN filial f ON f.cd_pessoa_filial = vw.cd_pessoa
              JOIN parametro_geral_empresa_grupo pgeg ON pgeg.cd_pessoa = f.cd_pessoa
             WHERE pgeg.id_broker_estoque = 1
             ORDER BY vw.nm_pessoa, a.nm_armazem ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
 
  function obtem_armazem_local()
  {
    global $conn;

    $sql = 
      "SELECT a.cd_armazem AS value, vw.nm_pessoa || ' - ' || a.nm_armazem AS description 
         FROM armazem a 
         JOIN vw_empresa_grupo_filial  vw ON   a.cd_pessoa_filial = vw.cd_pessoa 
         JOIN parametro_geral_filial  pgf ON pgf.cd_pessoa_filial = a.cd_pessoa_filial 
        WHERE pgf.cd_pessoa_local_armazem IN (" . obtem_filiais_usuario() . ") 
        ORDER BY vw.nm_pessoa, a.nm_armazem ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
 
  function obtem_acrescimo()
  {
    global $conn;

      $sql = "SELECT cd_acrescimo AS value, nm_acrescimo AS description ".
               "FROM acrescimo ".
              "ORDER BY nm_acrescimo";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_portador()
  {
    global $conn;

    $sql = "SELECT cd_portador AS value, cd_portador || ' / ' || SUBSTR(nm_portador, 0, 30) AS description 
              FROM portador 
             ORDER BY nm_portador";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_carteira($cd_banco = null)
  {
    global $conn;
    
    $sql =
      "SELECT c.cd_carteira AS value,
              b.nm_banco || ' - ' || c.nm_carteira || ' - Var. ' || LPAD(nr_variacao::TEXT, 3, '0') AS description
         FROM carteira c
         JOIN banco b ON c.cd_banco = b.cd_banco
        WHERE TRUE " .
          restricao_where("AND", "b.cd_banco", "=", $cd_banco, "'") .
      " ORDER BY b.nm_banco, c.nm_carteira";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    
    return conn_mostra_erro();
  }
  
  function obtem_raca()
  {
    global $conn;

    $sql = "SELECT cd_raca AS value, nm_raca AS description 
              FROM raca
             ORDER BY nm_raca";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_tipo_desconto_rede($cd_desconto = false)
  {
    global $conn;

    $sql = "SELECT cd_desconto AS value, nm_desconto AS description 
              FROM tipo_desconto_rede ";

    if ($cd_desconto)
      $sql .= "WHERE cd_desconto = $cd_desconto ";

    $sql .= "ORDER BY nm_desconto";

    return obtem_pesquisa($sql);
  }

  function obtem_grupo_fornecedor_pai_usuario($cd_grupo_fornecedor = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT gf.cd_grupo_fornecedor AS value, gf.nm_grupo_fornecedor AS description ".
             "FROM usuario_grupo_produto ugp " .
             "JOIN grupo_fornecedor gf ON gf.cd_grupo = ugp.cd_grupo " .
             "JOIN grupo_ligacao_fornecedor_completa glfc ON gf.cd_grupo_fornecedor = glfc.cd_grupo_fornecedor " .
            "WHERE ugp.cd_pessoa = " .$_SESSION["s_cd_usuario"] . "  " .
              "AND nr_nivel = 0 AND nr_nivel_grupo = 0 " ;

    if (strlen($cd_grupo_fornecedor) && strlen($id_condicao))
      $sql .= "AND gp.cd_grupo $id_condicao $cd_grupo_fornecedor ";

    $sql .= "ORDER BY 2";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  } 

  function obtem_grupo_fornecedor_pai($cd_grupo_fornecedor = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT gf.cd_grupo_fornecedor AS value, gf.nm_grupo_fornecedor AS description ".
             "FROM grupo_ligacao_fornecedor_completa glfc " .
             "JOIN grupo_fornecedor gf ON gf.cd_grupo_fornecedor = glfc.cd_grupo_fornecedor " .
            "WHERE nr_nivel = 0 AND nr_nivel_grupo = 0 " ;

    if (strlen($cd_grupo_fornecedor) && strlen($id_condicao))
      $sql .= "AND gp.cd_grupo $id_condicao $cd_grupo_fornecedor ";

    $sql .= "ORDER BY 2";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  } 

  function obtem_grupo_pai()
  {
    global $conn;

    $sql = "SELECT DISTINCT gp.cd_grupo AS value, LPAD(gp.cd_grupo::TEXT, 3, '0') || ' / ' || gp.nm_grupo AS description, ".
                  "glc.cd_grupo " .
           "FROM grupo_produto gp " .
           "JOIN grupo_ligacao_completa glc ON glc.cd_grupo = gp.cd_grupo " .
          "WHERE gp.id_ativo = 1 " .
            "AND glc.nr_nivel_grupo < 1 " .
          "ORDER BY glc.cd_grupo, gp.cd_grupo";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  } 

  function obtem_banco($cd_banco = false)
  {
    global $conn;

    $sql = "SELECT b.cd_banco AS value, b.nm_banco AS description 
              FROM banco b ";

    if ($cd_banco)
      $sql .= "WHERE cd_banco = $cd_banco ";

    $sql .= "ORDER BY 2";

    return obtem_pesquisa($sql);
  } 
  
  function obtem_dependente($t_cd_pessoa, $t_id_tipo = "")
  {
    global $conn;

    $sql = "SELECT cd_dependente, nm_dependente, id_tipo " .
             "FROM dependente " .
            "WHERE cd_pessoa = $t_cd_pessoa ";

    if ($t_id_tipo)
      $sql .= "AND id_tipo = $t_id_tipo ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  function obtem_regiao($where="")
  {
    global $conn;
    
    $sql = "SELECT r.cd_regiao AS value, r.nm_regiao AS description ".
             "FROM regiao r ";
    $sql .= $where;
    $sql .= "ORDER BY r.nm_regiao ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();

  }


  function obtem_dados_plano_saude_dependente($t_cd_dependente, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT psd.cd_categoria, psc.nm_categoria, psd.pr_desconto, pscv.vl_categoria " .
             "FROM plano_saude_dependente       psd " .
             "JOIN plano_saude_categoria        psc ON psc.cd_categoria   = psd.cd_categoria " .
             "JOIN plano_saude_categoria_valor pscv ON pscv.cd_categoria  = psc.cd_categoria " .
            "WHERE psd.cd_dependente = $t_cd_dependente " .
              "AND pscv.dt_vigencia <= '$t_dt_vigencia'::DATE " .
              "AND psd.dt_vigencia  <= '$t_dt_vigencia'::DATE " .
              "AND pscv.dt_vigencia <= today() " . 
              "AND psd.dt_vigencia <= today() " .
            "ORDER BY pscv.dt_vigencia DESC " .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }


  function obtem_plano_saude_categoria_valor($t_cd_categoria, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT vl_categoria " .
             "FROM plano_saude_categoria_valor " .
            "WHERE dt_vigencia <= '$t_dt_vigencia'::DATE " .
              "AND dt_vigencia <= today() " . 
              "AND cd_categoria = $t_cd_categoria " .
            "ORDER BY dt_vigencia DESC " .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  function obtem_tipo_protocolo($cd_tipo_protocolo = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT cd_tipo_protocolo AS value, ds_tipo_protocolo AS description " .
             "FROM tipo_protocolo ";

    if (strlen($cd_tipo_protocolo) && strlen($id_condicao))
      $sql .= "WHERE cd_tipo_protocolo $id_condicao $cd_tipo_protocolo ";
    
    $sql .= "ORDER BY ds_tipo_protocolo ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  function obtem_dados_plano_saude_funcionario($t_cd_pessoa, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT pscv.cd_categoria, psc.nm_categoria, psf.pr_desconto, pscv.vl_categoria " .
             "FROM plano_saude_funcionario      psf " .
             "JOIN plano_saude_categoria        psc ON psc.cd_categoria  = psf.cd_categoria " .
             "JOIN plano_saude_categoria_valor pscv ON pscv.cd_categoria = psc.cd_categoria " .
            "WHERE pscv.dt_vigencia <= '$t_dt_vigencia'::DATE " .
              "AND pscv.dt_vigencia <= today() " . 
              "AND psf.cd_pessoa = $t_cd_pessoa " .
            "ORDER BY pscv.dt_vigencia DESC " .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  function obtem_book($cd_book = false)
  {

    $sql = "SELECT cd_book AS value , nm_book AS description
              FROM book
             WHERE dt_inicio <= TODAY()
               AND (dt_termino > TODAY() OR dt_termino IS NULL) 
             ";

    if (str_value($cd_book))
      $sql .= " AND cd_book = ".$cd_book;

    $sql .= " ORDER BY nm_book ";

    return obtem_pesquisa($sql);
  }

  function verifica_plano_saude_categoria_idade($t_cd_pessoa, $t_cd_categoria, $id_dependente=false)
  {
    global $conn;

    $t_tabela = "pessoa";
    if ($id_dependente)
      $t_tabela = "dependente";

    $sql = "SELECT p.cd_pessoa " .
             "FROM plano_saude_categoria psc, $t_tabela p  " .
            "WHERE p.cd_$t_tabela = $t_cd_pessoa " .
              "AND p.dt_nascimento IS NOT NULL " .
              "AND psc.cd_categoria      =  $t_cd_categoria  " .
              "AND psc.vl_idade_inicial <=  ROUND((current_date - p.dt_nascimento)/365) " .
              "AND psc.vl_idade_final   >=  ROUND((current_date - p.dt_nascimento)/365) ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?true:false);

    return conn_mostra_erro();
  }


  function obtem_dados_linha_vigente_vale_transporte($t_cd_pessoa, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT pvt.cd_linha_transporte, pvt.id_computa_sabado, SUM(pvt.qt_passagem_dia) AS qt_passagem_dia " .
             "FROM pessoa_vale_transporte pvt " .
            "WHERE pvt.cd_pessoa = $t_cd_pessoa " .
              "AND pvt.dt_vigencia <= '$t_dt_vigencia'::DATE " .
              "AND pvt.dt_vigencia = (SELECT pvt2.dt_vigencia ".
                                       "FROM pessoa_vale_transporte pvt2 ".
                                      "WHERE pvt2.cd_pessoa = pvt.cd_pessoa ".
                                        "AND pvt2.cd_linha_transporte = pvt.cd_linha_transporte ".
                                        "AND dt_vigencia <= '$t_dt_vigencia'::DATE ".
                                      "ORDER BY pvt2.dt_vigencia DESC ". 
                                      "LIMIT 1) ".
            "GROUP BY 1, 2, dt_vigencia " ;
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }


  function obtem_linha_transporte_valor($t_cd_linha_transporte, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT vl_passagem " .
             "FROM linha_transporte_valor " .
            "WHERE dt_vigencia <= '$t_dt_vigencia'::DATE " .
              "AND cd_linha_transporte = $t_cd_linha_transporte " .
            "ORDER BY dt_vigencia DESC " .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }
  
  function obtem_mensagem_email($id_tipo)
  {
    if (!str_value($id_tipo))
      return;
    
    $sql = 
      "SELECT cd_mensagem AS value,
              SUBSTR(cd_mensagem || ' / ' || ds_titulo, 1, 55) AS description 
         FROM mensagem_email 
        WHERE id_tipo_mensagem = $id_tipo
        ORDER BY 1";
    
    return obtem_pesquisa($sql);
  }
  
  function verifica_funcionario_entrega_cesta_basica($t_cd_pessoa)
  {
    global $conn;

    $sql = "SELECT cd_pessoa " .
             "FROM funcionario_entrega_cesta_basica " .
            "WHERE cd_pessoa = $t_cd_pessoa ";
    if ($rs = $conn->Select($sql))
      return $rs->GetRowCount();

    return conn_mostra_erro();
  }


  function obtem_dados_beneficio_valor($t_cd_beneficio, $t_cd_pessoa_filial, $t_dt_vigencia)
  {
    global $conn;

    $t_dt_vigencia = explode("/", $t_dt_vigencia);
    $t_dt_vigencia = date('Y-m-d', mktime(0, 0, 0, $t_dt_vigencia[0]+1, 1-1, $t_dt_vigencia[1]));

    $sql = "SELECT vl_beneficio, vl_desconto, dt_vigencia " .
             "FROM beneficio_valor " .
            "WHERE cd_beneficio = $t_cd_beneficio " .
              "AND cd_pessoa_filial = $t_cd_pessoa_filial " .
              "AND dt_vigencia <= '$t_dt_vigencia'::DATE " .
            "ORDER BY dt_vigencia DESC " .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  function obtem_beneficio()
  {
    global $conn;

    $sql = "SELECT cd_beneficio AS value, ds_beneficio AS description " .
             "FROM beneficio ".
            "ORDER BY 2 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(1):false);

    return conn_mostra_erro();
  }

  // verifica se a pessoa eh funcionario
  function verifica_pessoa_funcionario($t_cd_pessoa)
  {
    global $conn;

    $sql = "SELECT cd_pessoa " .
             "FROM funcionario " .
            "WHERE cd_pessoa = $t_cd_pessoa ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?true:false);

    return conn_mostra_erro();
  }



  /*
    $id_msg_txt - controla se o conteudo do email
                  deve ser convertido para texto
  */
  function envia_email($from, $to, $subject, $body, $id_msg_txt = false, $attach = false, $id_is_txt = false)
  {
    if (($id_msg_txt && !$id_is_txt) || is_array($attach))
    {

      $body = str_replace("<BR>", "\n", $body);
      $body = str_replace("<br>", "\n", $body);
      $body = html_2_txt($body);
    }

    include($GLOBALS["path"] . "exe_envia_email.php");
  }


  //--------------------------------
  /* 
      controla envio de email para vendedores

    $t_cd_vendedor  - codigo do vendedor que recebe a mensagem
    $t_ds_remetente - remetente do email
    $t_ds_assunto   - assunto do email
    $t_ds_conteudo  - conteudo da mensagem (html)
  */
  function envia_email_vendedor($t_cd_vendedor, $t_ds_remetente, $t_ds_assunto, $t_ds_conteudo)
  {
    global $conn;

    $sql_palm = "SELECT ds_usuario_palm " .
                  "FROM vendedor " .
                 "WHERE cd_vendedor = $t_cd_vendedor " .
                 "LIMIT 1 ";

    $sql_mail = "SELECT e.ds_email " .
                  "FROM vw_vendedor vw " .
                  "JOIN email e ON e.cd_pessoa = vw.cd_pessoa_vendedor " . 
                 "WHERE vw.cd_vendedor = $t_cd_vendedor " .
                 "ORDER BY e.id_principal DESC " .
                 "LIMIT 1 ";

    $sql_vendedor = "SELECT ds_email_vendedor
                       FROM vendedor
                      WHERE cd_vendedor = $t_cd_vendedor";

    $enviado = false;
  
    $sql = "SELECT id_notifica_vendedor 
             FROM parametro_geral_notificacao";
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    else
      $id_notifica_vendedor = $rs->GetField(0);

    switch ($id_notifica_vendedor)
    {
      case '1':
      
        if ($rs = $conn->Select($sql_palm))
        {
          if (strpos($rs->GetField(0), "@")) // Se tiver @ ds_usuario_palm manda email, para o palm deve ser txt
          {
            $enviado = true;
            envia_email($t_ds_remetente, $rs->GetField(0), $t_ds_assunto, $t_ds_conteudo, true);
          }
        }
        else
          return conn_mostra_erro();
        
        if ($rs = $conn->Select($sql_vendedor))
        {
          if ($rs->GetRowCount()) // Se tiver ds_email_vendedor manda para este
          {
            $enviado = true;
            envia_email($t_ds_remetente, $rs->GetField("ds_email_vendedor"), $t_ds_assunto, $t_ds_conteudo, true);
          }
        }
        else
          return conn_mostra_erro();

        if (!$enviado) // Se tiver email em pessoa vendedor manda para a pessoa
        {
          if ($rs = $conn->Select($sql_mail))
          {
            if ($rs->GetRowCount()) // Manda para email normal, pode ser em html
            {
              $enviado = true;
              envia_email($t_ds_remetente, $rs->GetField(0), $t_ds_assunto, $t_ds_conteudo, false);
            }
          }
          else
            return conn_mostra_erro();
        }
        
        if (!$enviado) //Manda recado para o usuario
        {
          if ($t_cd_pessoa_vendedor = obtem_pessoa_vendedor($t_cd_vendedor))
            envia_recado($t_cd_pessoa_vendedor, html_2_txt($t_ds_conteudo));
        }
      break;

      case '2':

        if ($t_cd_pessoa_vendedor = obtem_pessoa_vendedor($t_cd_vendedor))
                    envia_recado($t_cd_pessoa_vendedor, html_2_txt($t_ds_conteudo));
        
        if ($rs = $conn->Select($sql_mail))
        {
          if ($rs->GetRowCount()) // Manda para email normal, pode ser em html
            envia_email($t_ds_remetente, $rs->GetField(0), $t_ds_assunto, $t_ds_conteudo, false);
        }
        else
          return conn_mostra_erro();
      break;

      case '3':

        if ($t_cd_pessoa_vendedor = obtem_pessoa_vendedor($t_cd_vendedor))
                    envia_recado($t_cd_pessoa_vendedor, html_2_txt($t_ds_conteudo));
      break;

      case '4':

        $enviado = false;
        if ($rs = $conn->Select($sql_palm))
        {
          if (strpos($rs->GetField(0), "@")) // Se tiver @ ds_usuario_palm manda email, para o palm deve ser txt
          {
            $enviado = true;
            envia_email($t_ds_remetente, $rs->GetField(0), $t_ds_assunto, $t_ds_conteudo, true);
          }
        }
        else
          return conn_mostra_erro();

        if (!$enviado) // Se tiver email em pessoa vendedor manda para a pessoa
        {
          if ($rs = $conn->Select($sql_mail))
          {
            if ($rs->GetRowCount()) // Manda para email normal, pode ser em html
            {
              $enviado = true;
              envia_email($t_ds_remetente, $rs->GetField(0), $t_ds_assunto, $t_ds_conteudo, false);
            }
          }
          else
            return conn_mostra_erro();
        }
      break;
    }
  }
  // controla envio de email para vendedores
  //--------------------------------
      


  //--------------------------------
  // "envia" recado para pessoa
  function envia_recado($t_cd_pessoa, $t_ds_recado, $t_cd_assunto_recado = "")
  {
    global $conn;

    if (!$t_cd_assunto_recado)
      $t_cd_assunto_recado = $_SESSION["s_cd_assunto_recado_palm"];

    $sql = "SELECT nextval('public.recado_cd_recado_seq'::text) AS cd_recado, obtem_lote() AS nr_lote ";
    if (!$rs = $conn->Select($sql))
      return conn_mostra_erro();
    else
    {
      $cd_recado = $rs->GetField("cd_recado");
      $nr_lote   = $rs->GetField("nr_lote");

      $values    = array("cd_recado"         => $cd_recado,
                         "cd_assunto_recado" => $t_cd_assunto_recado,
                         "cd_pessoa"         => $_SESSION["s_cd_usuario"] ,
                         "ds_recado"         => $t_ds_recado,
                         "dt_recado"         => "current_timestamp");
      if (!$conn->Insert("recado", $values))
        return conn_mostra_erro();

      $values    = array("cd_pessoa"         => $t_cd_pessoa,
                         "cd_recado"         => $cd_recado,
                         "nr_lote"           => $nr_lote,
                         "cd_pessoa_envio"   => $_SESSION["s_cd_usuario"]);
      if (!$conn->Insert("recado_usuario", $values))
        return conn_mostra_erro();
    }

    return $cd_recado;
  }
  // "envia" recado para pessoa
  //--------------------------------




  //--------------------------------
  /*
   funcoes para limpar html, vao ser usadas no envio
   de recados, quando envia por email vai como html,
   se for enviar recado para o palm entao elimina
   os codigos html e insere apenas como texto puro
  */
  function elimina_tags($text, $tags = array())
  {
    foreach ($tags as $tag)
      $text= preg_replace("#\<".$tag."(.*)/".$tag.">#iUs", "", $text);

    return $text;
  }

  /*
    $tags_elimina - array com as tags que serao eliminadas com o conteudo
  */
  function html_2_txt($ds, $tags_elimina = array("style", "title"))
  {
    $ds   = elimina_tags($ds, $tags_elimina);
    $ds   = strip_tags($ds);
    $t_ds = explode("\n", $ds);
    $ds   = "";
    foreach ($t_ds AS $lin)
    {
      if (strlen(trim($lin)))
      {
        $t_lin = trim($lin);
        $ds   .= $t_lin;

        if (substr($t_lin, -1, 1) != ":") 
          $ds .= "\r\n";
        else 
          $ds .= " ";
      }
    }
    return $ds;
  }
  //--------------------------------


  function limpa_variavel_multipla_entrada($str, $id_aspas = false, $id_parenteses = false)
  {
    $str = str_replace(";", ",", $str);
    $str = trim($str);
    $str = trim($str, ",");

    if (str_value($str))
    {    
      if ($id_aspas)
      {    
        $arr = explode(",", $str);
        $str = "'" . implode("','", $arr) . "'"; 
      }    

      if ($id_parenteses)
        $str = "($str)";
    }    

    return $str;
  }

  /* usada no rel quando no fil tiver um duallist e usar o padrão abre_relatorio_ */
  function filtro_duallist($nome_campo, $parenteses = false)
  {
    $destination = $GLOBALS[$nome_campo . "_destination"];
    if (is_array($destination) && count($destination))
       $GLOBALS[$nome_campo] = (($parenteses)?"(":"") . implode(", ", $destination) . (($parenteses)?")":"");
  }

  // pega os vendedores do cliente
  function obtem_pessoa_vendedor_cliente($t_cd_pessoa)
  {
    global $conn;
    
    $sql = "SELECT DISTINCT vw.cd_vendedor 
              FROM cliente_grupo_vendedor cgv 
              JOIN vw_vendedor vw ON vw.cd_vendedor = cgv.cd_vendedor 
             WHERE cgv.cd_pessoa = $t_cd_pessoa ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(0):false);

    return conn_mostra_erro();
  }
  
  function obtem_vendedores_cliente($t_cd_pessoa)
  {
    $sql = "SELECT DISTINCT vw.cd_vendedor AS value,
                   vw.cd_vendedor ||' / '|| vw.nm_vendedor AS description
              FROM cliente_grupo_vendedor cgv
              JOIN vw_vendedor vw ON vw.cd_vendedor = cgv.cd_vendedor
             WHERE cgv.cd_pessoa = $t_cd_pessoa ";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_nm_pessoa_vendedor($t_cd_vendedor)
  {
    global $conn;

    $sql = "SELECT vw.nm_pessoa 
              FROM vw_pessoa_vendedor vw 
             WHERE vw.cd_vendedor = $t_cd_vendedor";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }

  // pega os vendedores do cliente
  function obtem_pessoa_vendedor($t_cd_vendedor)
  {
    global $conn;

    $sql = "SELECT cd_pessoa_vendedor 
              FROM vw_vendedor
             WHERE cd_vendedor = $t_cd_vendedor ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }


  /*
    $t_cd_vendedor_ignora = array com os cd_vendedor que devem ser ignorados na busca
  */
  function obtem_cd_vendedor_superior($t_cd_vendedor, $t_cd_vendedor_ignora="")
  {
    global $conn;

    $sql_ignora = "";

    if (is_array($t_cd_vendedor_ignora) && count($t_cd_vendedor_ignora))
    {
      $sql_ignora .= "AND v.cd_vendedor_superior NOT IN(";
      foreach ($t_cd_vendedor_ignora AS $chave => $valor)
        $sql_ignora .= "$valor, ";
      $sql_ignora = substr($sql_ignora, 0, -2);
      $sql_ignora .= ")";
    }

    $sql = "SELECT v.cd_vendedor_superior " .
             "FROM vw_vendedor v " .
             "JOIN vw_vendedor pv ON pv.cd_vendedor = v.cd_vendedor_superior " .
            "WHERE v.cd_vendedor = $t_cd_vendedor " .
             $sql_ignora .
            "LIMIT 1 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }
  
  function obtem_email_superior($cd_vendedor_filho)
  {
    global $conn;

    $sql = "SELECT e.ds_email AS ds_email_vendedor_superior 
              FROM vw_vendedor v 
              JOIN vw_vendedor pv ON pv.cd_vendedor = v.cd_vendedor_superior 
              JOIN email e ON e.cd_pessoa = pv.cd_pessoa_vendedor 
             WHERE v.cd_vendedor = $cd_vendedor_filho 
             ORDER BY e.id_principal DESC   
             LIMIT 1 ";

    if ($rs = $conn->Select($sql))
    {
      return $rs->GetField(0);
    }
    else
      conn_mostra_erro();
  }

  /*esta função é baseada em op_id_destino_mensagem*/
  function verifica_destino_mensagem($para, $id_destino_mensagem)
  {
    switch($para)
    {
      case "Vendedor": 
        if ($id_destino_mensagem == 5 || $id_destino_mensagem == 6 || $id_destino_mensagem == 9)
          return true;
        else  
          return false;

      case "Supervisor":
        if ($id_destino_mensagem == 6 || $id_destino_mensagem == 9 || $id_destino_mensagem == 10)
          return true;
        else  
          return false;

      case "Gerente":
        if ($id_destino_mensagem == 9 || $id_destino_mensagem == 11)
          return true;
        else  
          return false;

    }

    return false;
  }

  /*ou passa arr_contem ou passa arr_nao_contem. Deve-se passar os códigos*/
  function obtem_array($arr_origem, $arr_contem = false, $arr_nao_contem = false)
  {
    $arr_destino = array();
    if (is_array($arr_contem))
    {
      foreach ($arr_origem AS $arr)
      {
        if (in_array($arr["value"], $arr_contem))
        {
          $arr_destino[] = $arr;
        }
      }
    }else if (is_array($arr_nao_contem))
    {
      foreach ($arr_origem AS $arr)
      {
        if (!in_array($arr["value"], $arr_nao_contem))
        {
          $arr_destino[] = $arr;
        }
      }

    }else
      return $arr_origem;

    return $arr_destino;
  }
  
  function obtem_cliente_pedido($t_cd_pedido)
  {
    global $conn;

    $sql = "SELECT cd_pessoa " .
             "FROM pedido " .
            "WHERE cd_pedido = $t_cd_pedido ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }


  function obtem_id_situacao_pedido($t_cd_pedido)
  {
    global $conn;

    $sql = "SELECT id_situacao " .
             "FROM pedido " .
            "WHERE cd_pedido = $t_cd_pedido ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }


  function obtem_id_situacao_cliente($t_cd_cliente)
  {
    global $conn;

    $sql = "SELECT id_situacao " .
             "FROM cliente " .
            "WHERE cd_pessoa = $t_cd_cliente ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }

  /**
    * Seta o lote em determinada tabela utilizando a função obtem_lote
    sendo que lote deve estar no formato

    $lote = array("nome_da_tabela", "nome_do_campo", "tabela_que_referencia");

    a condição pela a qual o lote será setado serão as chaves da tabela
   */

 
  function testa_valor_su_importacao()
  {
    global $importacao;

    $vl_su =  $importacao->GetValues("produto_venda", array("vl_su"))   ;

    if  ($vl_su["vl_su"] > 5)
      $importacao->AppendError("Valor do SU maior que 5!",0,1,1); 
  
  }

  function seta_lote_importacao($lote)
  {
    global $importacao, $conn;
   
    $referente = &$lote[2];
    if ( !sizeof( $ligacao = $importacao->getFieldsRelated($lote[2], $lote[0]) ) )
    {
      $ligacao = $importacao->getFieldsRelated($lote[0], $lote[2]);
      $referente = &$lote[0];
    }

    if (sizeof($ligacao))
    {
      $where = $importacao->GetValues($referente, $ligacao);

      if (!$conn->Update($lote[0], array($lote[1] => obtem_lote(true)), $where))
        $importacao->appendError(false, "atualizar lote");
 
      testa_valor_su_importacao();
    }
  }

  function obtem_lote($id_silencio=false) 
  {
    global $conn;

    $sql = "SELECT obtem_lote()";
    if ($rs = $conn->Select($sql))
      return $rs->GetField(0);

    if (!$id_silencio) 
      return conn_mostra_erro();
  }


  function obtem_lote_broker($t_cd_pessoa_matriz)
  {
    global $conn;

    $sql = "SELECT obtem_lote_broker($t_cd_pessoa_matriz) ";
    if ($rs = $conn->Select($sql))
      return $rs->GetField(0);

    return conn_mostra_erro();
  }


  function gera_lote_titulo()
  {
    global $conn;

    $sql = "SELECT nextval('public.lote_titulo_cd_lote_titulo_seq') " ;
    if (!$rs = $conn->Select($sql))
      return conn_mostra_erro();
    else
    {
      $cd_lote_titulo = $rs->GetField(0);
      $values = array("cd_lote_titulo" => $cd_lote_titulo,
                      "dt_lote"        => "today()");
      if (!$conn->Insert("lote_titulo", $values))
        return conn_mostra_erro();
      else
        return $cd_lote_titulo;
    }
  }

  function obtem_rede($cd_rede = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT cd_rede AS value, cd_rede || ' / ' || nm_rede AS description " .
             "FROM rede ";

    if (strlen($cd_rede) && strlen($id_condicao))
      $sql .= "WHERE cd_rede $id_condicao $cd_rede ";

    $sql .= "ORDER BY cd_rede";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_operacao_saida($id_sintegra=1)
  {
    global $conn;

    $sql = "SELECT cd_operacao AS value, SUBSTR(nm_operacao, 1, 20) AS description " .
             "FROM operacao " .
            "WHERE id_tipo = 2 " .
              "AND id_sintegra = $id_sintegra " .
            "ORDER BY 2";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_nm_operacao($cd_operacao)
  {
    global $conn;

    $sql = "SELECT SUBSTR(COALESCE(ds_palm, nm_operacao), 1, 30)
              FROM operacao
             WHERE cd_operacao = $cd_operacao ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();
  }

  function obtem_nm_operacao_palm()
  {
    $sql = "SELECT o.cd_operacao AS value, o.ds_palm AS description 
              FROM operacao o 
             WHERE o.ds_palm IS NOT NULL 
             ORDER BY o.ds_palm";
    return obtem_pesquisa($sql);
  }

  function obtem_empresa_grupo($cd_pessoa = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT cd_pessoa AS value, nm_pessoa AS description " .
             "FROM vw_empresa_grupo ";

    if (strlen($cd_pessoa) && strlen($id_condicao))
      $sql .= "WHERE cd_pessoa $id_condicao $cd_pessoa ";

    $sql .= "ORDER BY nm_pessoa";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_cd_empresa_matriz_filial($cd_pessoa)
  {
    global $conn; 

    $sql = "SELECT eg.cd_pessoa 
              FROM vw_empresa_grupo eg
              JOIN filial f ON f.cd_pessoa = eg.cd_pessoa
             WHERE f.cd_pessoa_filial = $cd_pessoa";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    else
      return conn_mostra_erro();
  }

  function obtem_empresa_filial($cd_pessoa = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT cd_pessoa AS value , nm_pessoa AS description " .
             "FROM vw_empresa_filial ";

    if (is_array($cd_pessoa) && sizeof($cd_pessoa))
      $sql .= "WHERE cd_pessoa IN (" . implode (",", $cd_pessoa) . ") ";
    elseif (strlen($cd_pessoa) && strlen($id_condicao))
      $sql .= "WHERE cd_pessoa $id_condicao $cd_pessoa ";

    $sql .= "ORDER BY nm_pessoa";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_grupo_produto_usuario($cd_grupo = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT DISTINCT gp.cd_grupo AS value, gp.cd_grupo || ' / ' || gp.nm_grupo AS description ".
             "FROM usuario_grupo_produto ugp " .  
             "JOIN grupo_produto gp ON gp.cd_grupo = ugp.cd_grupo " .
             "JOIN grupo_ligacao gl ON gp.cd_grupo = gl.cd_grupo ".
            "WHERE ugp.cd_pessoa = " . $_SESSION["s_cd_usuario"] . " " .
              "AND gp.id_ativo = 1 ";

    if (strlen($cd_grupo) && strlen($id_condicao))
      $sql .= "AND gp.cd_grupo $id_condicao $cd_grupo ";

    $sql.=   "ORDER BY gp.cd_grupo ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    else
      conn_mostra_erro();
  }

  function obtem_grupo_produto_completo($cd_grupo = false, $id_condicao = "=", $extra_where = "")
  {
    global $conn;

    $sql = "SELECT DISTINCT glc.cd_grupo_filho AS value, 
                   glc.cd_grupo || ' / ' || SUBSTR(gpp.nm_grupo, 1, 10) ||
                   (CASE WHEN glc.nr_nivel > 0 
                          THEN ' - ' || glc.cd_grupo_filho ||  ' / ' || SUBSTR(gp.nm_grupo, 1, 10)
                          ELSE ''
                    END) AS description ,
                   glc.nr_nivel_grupo, glc.cd_grupo, glc.nr_nivel, glc.cd_grupo_filho
              FROM grupo_ligacao_completa glc
              JOIN grupo_produto gp ON glc.cd_grupo_filho = gp.cd_grupo
              JOIN grupo_produto gpp ON glc.cd_grupo = gpp.cd_grupo
             WHERE glc.nr_nivel_grupo = 0
               AND gpp.id_ativo = 1
               AND gp.id_ativo = 1 ";

    if (strlen($cd_grupo) && strlen($id_condicao))
      $sql .= "AND glc.cd_grupo $id_condicao $cd_grupo ";
    
    $sql .= $extra_where;

    $sql.=   "ORDER BY glc.nr_nivel_grupo,glc.nr_nivel,glc.cd_grupo,glc.cd_grupo_filho";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    else
      conn_mostra_erro();
  }

  function obtem_grupo_produto($cd_grupo = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT DISTINCT gp.cd_grupo AS value, gp.cd_grupo || ' / ' || gp.nm_grupo AS description ".
             "FROM grupo_produto gp " .
             "JOIN grupo_ligacao gl ON gp.cd_grupo = gl.cd_grupo ".
             "WHERE gp.id_ativo = 1 ";

    if (strlen($cd_grupo) && strlen($id_condicao))
      $sql .= "AND gp.cd_grupo $id_condicao $cd_grupo ";

    $sql.=   "ORDER BY gp.cd_grupo ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    else
      conn_mostra_erro();
  }

  function obtem_empresa_grupo_ativo($cd_pessoa = false, $id_condicao = "=")
  { 
    global $conn;
    
    if (strlen($cd_pessoa) && strlen($id_condicao))
      $where = "AND vw.cd_pessoa $id_condicao $cd_pessoa";

    $sql = "SELECT DISTINCT vw.cd_pessoa AS value, vw.nm_pessoa AS description 
              FROM vw_empresa_grupo vw 
              JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_matriz = vw.cd_pessoa 
             WHERE pgf.nr_broker IS NOT NULL
            $where

             UNION

            SELECT DISTINCT vw.cd_pessoa AS value, vw.nm_pessoa AS description 
              FROM vw_empresa_grupo vw 
              JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_matriz = vw.cd_pessoa 
              JOIN empresa_contabil ec ON ec.cd_pessoa = pgf.cd_pessoa_matriz
             WHERE ec.id_atividade = 1
            $where

             ORDER BY 2 ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_empresa_grupo_filial_ativo($cd_pessoa_matriz = null, $cd_pessoa_filial = false, $cd_pessoa_filial_diferente = false, $id_condicao = "=", $id_ordenacao_filial = false)
  { 
    global $conn;

    //Serve apenas para ordenar por primeiro as filias com Oniz (SMA, PF, CCH e SJP)
    if ($id_ordenacao_filial)
    {
      $fields = " , (CASE WHEN f.cd_pessoa NOT IN (SELECT cd_pessoa FROM empresa_contabil) THEN 2 ELSE 1 END) AS nr_order ";
      $order_by = " nr_order, ";
    }
    else
    {
      $fields = "";
      $order_by = "";
    }
         
    if (strlen($cd_pessoa_matriz) && strlen($id_condicao))
      $where .= "AND f.cd_pessoa $id_condicao $cd_pessoa_matriz ";

    if ($cd_pessoa_filial)
      $where .= "AND vw.cd_pessoa = $cd_pessoa_filial";

    if ($cd_pessoa_filial_diferente)
      $where .= "AND vw.cd_pessoa != $cd_pessoa_filial_diferente";

     $sql = "SELECT vw.cd_pessoa AS value, vw.nm_pessoa AS description 
                    $fields 
               FROM vw_empresa_grupo_filial vw 
               JOIN filial f ON f.cd_pessoa_filial = vw.cd_pessoa 
               JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_filial = vw.cd_pessoa 
              WHERE pgf.nr_broker IS NOT NULL
             $where

              UNION 

               SELECT vw.cd_pessoa AS value, vw.nm_pessoa AS description 
                    $fields 
               FROM vw_empresa_grupo_filial vw 
               JOIN filial f ON f.cd_pessoa_filial = vw.cd_pessoa 
               JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_filial = vw.cd_pessoa 
               JOIN empresa_contabil ec ON ec.cd_pessoa = pgf.cd_pessoa_matriz
              WHERE ec.id_atividade = 1
             $where
              ORDER BY $order_by 2 ";
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();

  }
  
  function obtem_empresa_grupo_filial_local_armazem_ativo($cd_pessoa_matriz = null, $apenas_filial_usuario = true, 
                                                          $usa_empresa_contabil = false, $apenas_filiais_usuario = false)
  { 
    global $conn;

    $condicao = "f.cd_pessoa NOT IN (SELECT ec.cd_pessoa FROM empresa_contabil ec WHERE ec.id_atividade=1) ";

    $sql = "SELECT vw.cd_pessoa AS value, vw.nm_pessoa AS description ".
             "FROM vw_empresa_grupo_filial vw " .
             "JOIN filial f ON f.cd_pessoa_filial = vw.cd_pessoa " .
             "JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_filial = vw.cd_pessoa " .
            "WHERE (CASE WHEN $condicao THEN pgf.nr_broker IS NOT NULL ELSE true END) ";

    if ($apenas_filial_usuario)
      $sql .= "AND pgf.cd_pessoa_local_armazem IN (" . obtem_filiais_usuario() . ") ";

    if ($apenas_filiais_usuario)
      $sql .= "AND pgf.cd_pessoa_local_armazem IN (SELECT uf.cd_pessoa_filial 
                                                     FROM usuario_filial uf 
                                                    WHERE uf.cd_pessoa = " . $_SESSION["s_cd_usuario"] . ") ";

    if (strlen($cd_pessoa_matriz))
      $sql .= "AND f.cd_pessoa = $cd_pessoa_matriz ";

    $sql .= "ORDER BY 2 ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_empresa_broker_ativo()
  {
    global $conn;

    $sql = "SELECT vw.cd_pessoa AS value, vw.nm_pessoa AS description 
              FROM vw_empresa_grupo_filial vw 
              JOIN vw_empresa_grupo vwg ON vwg.cd_pessoa = vw.cd_pessoa ";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);
    
    return conn_mostra_erro();
  }

  function obtem_matriz($cd_pessoa_filial)
  {
    global $conn;

    $sql = "SELECT cd_pessoa AS cd_matriz
              FROM filial f
             WHERE f.cd_pessoa_filial = $cd_pessoa_filial ";

    if ($rs = $conn->Select($sql))
      return $rs->GetField("cd_matriz");
    else
      conn_mostra_erro();
  }

  function obtem_filial_broker($so_ativo = false)
  {
    global $conn;

    $sql = "SELECT DISTINCT vw.cd_pessoa AS value , vw.nm_pessoa AS description " .
             "FROM vw_empresa_grupo_filial vw " .
             "JOIN filial f ON f.cd_pessoa_filial = vw.cd_pessoa ";

    if ($so_ativo)
      $sql .= "JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_filial = vw.cd_pessoa ";

    $sql .= "WHERE f.cd_pessoa NOT IN (SELECT cd_pessoa FROM empresa_contabil) ";

    if ($so_ativo)
      $sql .= "AND pgf.nr_broker IS NOT NULL ";

    $sql .= "ORDER BY 2";

    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
        return $rs->GetArray(true);
    }
    else
      conn_mostra_erro();

    return false;
  }
  
  function obtem_filial_geracao_mdfe()
  {
    $sql =
      "SELECT cd_pessoa AS value,
              nm_pessoa AS description
         FROM vw_empresa_filial
        WHERE cd_pessoa IN (SELECT cd_pessoa
                              FROM parametro_geral
                             WHERE cd_parametro_geral = 1
                            UNION ALL
                            SELECT cd_pessoa_filial_mdfe_broker
                              FROM parametro_geral
                             WHERE cd_parametro_geral = 1) ";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_cargo()
  {
    global $conn;

    $sql = "SELECT c.cd_cargo AS value, c.nm_cargo AS description " .
             "FROM cargo c " .
            "ORDER BY c.nm_cargo";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_cargo_contato($cd_cargo_contato)
  {
    global $conn;

    $sql = "SELECT cd_cargo_contato AS value, nm_cargo_contato AS description " .
             "FROM cargo_contato " ;

    if (str_value($cd_cargo_contato))
      $sql .= "WHERE cd_cargo_contato = '$cd_cargo_contato'" ;

    $sql .= "ORDER BY nm_cargo_contato ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_cargo_funcionario($cd_contrato_funcionario, $dt_base = "current_date")
  {
    return "(SELECT c.nm_cargo
               FROM cargo_funcionario caf
               JOIN cargo c ON c.cd_cargo = caf.cd_cargo
              WHERE caf.cd_contrato_funcionario = $cd_contrato_funcionario
                AND caf.dt_vigencia <= $dt_base
              ORDER BY caf.dt_vigencia DESC
              LIMIT 1) ";
  }

  function obtem_conta_empresa_grupo($cd_pessoa = null)
  {
    global $conn;

    $sql = "SELECT cd_conta AS value, nm_conta AS description ".
             "FROM vw_conta_empresa_grupo 
             WHERE TRUE " .
              restricao_where("AND", "cd_pessoa", "=", $cd_pessoa, "'");
    
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_conta_empresa_filial()
  {
    global $conn;

    $sql = "SELECT cd_conta AS value, nm_conta AS description ".
             "FROM vw_conta_empresa_filial";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }
  
  function obtem_conta_empresa_contabil_filial()
  {
    $sql =
      "SELECT c.cd_conta AS value,
              c.nm_conta AS description
         FROM vw_conta_empresa_contabil_filial c";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_empresa_contabil_filial($cd_pessoa = false, $id_condicao = "=", $id_atividade = false)
  {
    global $conn;

    $sql = "SELECT vw.cd_pessoa AS value , vw.nm_pessoa AS description " .
             "FROM vw_empresa_contabil_filial vw ";

    if (strlen($id_atividade))
      $sql .= "JOIN filial f ON vw.cd_pessoa = f.cd_pessoa_filial
               JOIN empresa_contabil ec ON f.cd_pessoa = ec.cd_pessoa
                                        AND ec.id_atividade = 1 ";

    $sql .= "WHERE 1 = 1";

    if (strlen($cd_pessoa) && strlen($id_condicao))
      $sql .= "AND vw.cd_pessoa $id_condicao $cd_pessoa ";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_empresa_contabil($id_atividade)
  {
    $sql = "SELECT ec.cd_pessoa AS value, vw.nm_pessoa AS description
              FROM empresa_contabil ec
              JOIN vw_empresa_contabil vw ON vw.cd_pessoa = ec.cd_pessoa
             WHERE 1=1 " .
             restricao_where("AND", "ec.id_atividade", "=", $id_atividade) . "
             ORDER BY vw.nm_pessoa ";

    return obtem_pesquisa($sql);
  }

  function obtem_empresa_grupo_filial($cd_pessoa = false, $id_condicao = "=")
  {
    global $conn;

    $sql = "SELECT cd_pessoa AS value , nm_pessoa AS description " .
             "FROM vw_empresa_grupo_filial ";

    if (strlen($cd_pessoa) && strlen($id_condicao))
      $sql .= "WHERE cd_pessoa $id_condicao $cd_pessoa ";

    $sql .= "ORDER BY nm_pessoa";

    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_condicao_pagamento($t_cd_condicao="", $id_envio_palm = "") // separadas por virgula, ex: 1,2,3
  {
    global $conn;

    $sql = "SELECT cd_condicao AS value, nm_condicao AS description ".
             "FROM condicao_pagamento ";

    if (strlen($t_cd_condicao))
      $sql .= get_where() . " cd_condicao IN ($t_cd_condicao) ";

    if (str_value($id_envio_palm))
      $sql .= get_where() . " id_envio_palm = $id_envio_palm ";

    $sql .= "ORDER BY nr_dias";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetArray(true):false);

    return conn_mostra_erro();
  }

  function obtem_tipo_pagamento_credito($id_tipo_recebimento = null)
  {
    global $conn;

    $sql = "SELECT cd_tipo_pagamento AS value, ds_tipo_pagamento AS description ".
             "FROM tipo_pagamento " .
            "WHERE id_tipo = 1 " ;

    if (strlen($id_tipo_recebimento))
      $sql .= "AND id_tipo_recebimento = $id_tipo_recebimento ";
    
    $sql .= "ORDER BY ds_tipo_pagamento";

    if ($rs = $conn->Select($sql))
      return ($rs->GetRowCount()) ? $rs->GetArray(true) : false;

    return conn_mostra_erro();
  }

  function obtem_menor_condicao_pagamento_tipo_pagamento($cd_tipo_pagamento)
  {
    global $conn;

    $sql = "SELECT tpcp.cd_condicao 
              FROM tipo_pagamento_condicao_pagamento tpcp 
              JOIN condicao_pagamento cp ON cp.cd_condicao = tpcp.cd_condicao
             WHERE tpcp.cd_tipo_pagamento = $cd_tipo_pagamento
             ORDER BY cp.nr_dias 
             LIMIT 1";
    if ($rs = $conn->Select($sql))
      return (($rs->GetRowCount())?$rs->GetField(0):false);

    return conn_mostra_erro();

  }

  function obtem_unidade($cd_unidade = false)
  {
    global $conn;

    $sql = "SELECT cd_unidade AS value, nm_unidade AS description ".
             "FROM unidade ";

    if ($cd_unidade)
      $sql .= "WHERE cd_unidade = $cd_unidade ";

    $sql .= "ORDER BY nm_unidade ";
    if ($rs = $conn->Select($sql))
      return ($rs->GetRowCount()) ? $rs->GetArray(true) : false;

    return conn_mostra_erro();
  }

  function obtem_cor_id_situacao($id)
  {
    switch($id)
    {
      case "0":  return "#FF0000";  break;
      case "1":  return "#EEAD0E";  break;
      case "2":  return "#008B00";  break;
    }
  }

  function obtem_tipo_ocorrencia()
  {
    global $conn;
  
    $sql = "SELECT cd_tipo_ocorrencia AS value, ds_tipo_ocorrencia AS description " .
            "FROM tipo_ocorrencia t " .
            "ORDER BY ds_tipo_ocorrencia ";

    if ($rs = $conn->Select($sql))
      return ($rs->GetRowCount()) ? $rs->GetArray(true) : false;

    return conn_mostra_erro();
  }

  function obtem_estado()
  {
    global $conn;
    $sql = "SELECT cd_uf AS value, ds_sigla AS description FROM uf ORDER BY ds_sigla";

    if (($rs = $conn->Select($sql)))
      return ($rs->GetRowCount()) ? $rs->GetArray(true) : false;

    return conn_mostra_erro();
  }
  
  function obtem_motorista_frota()
  {
    $sql = 
      "SELECT v.nr_frota AS value,
              v.nr_frota ||' / '|| pm.nm_pessoa AS description
         FROM veiculo v
         JOIN pessoa pm ON pm.cd_pessoa = v.cd_pessoa_motorista 
        WHERE v.nr_frota IS NOT NULL 
          AND cd_pessoa_motorista IS NOT NULL
        ORDER BY nr_frota ";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_transportadora()
  {
    $sql =
      "SELECT DISTINCT t.cd_pessoa AS value,
              t.cd_pessoa || ' / ' || p.nm_pessoa AS description
         FROM transportadora t
         JOIN pessoa p ON p.cd_pessoa = t.cd_pessoa
         JOIN veiculo v ON v.cd_pessoa = t.cd_pessoa
        WHERE v.id_ativo = 1
        ORDER BY t.cd_pessoa ";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_motivo_cancelamento()
  {
    global $conn;
    
    $sql = "SELECT cd_motivo AS value, ds_motivo AS description FROM motivo_cancelamento ORDER BY ds_motivo";

    if (($rs = $conn->Select($sql)))
      return ($rs->GetRowCount()) ? $rs->GetArray(true) : false;

    return conn_mostra_erro();
  }
  
  //--------------------------------
  // controla transacoes e erros
  function conn_mostra_erro($other_conn = null)
  {
    global $conn, $man, $html, $form, $trans_ok;
    
    if (is_object($other_conn))
      $conn = $other_conn;
    else
      global $conn;

    if (get_class($conn) != "JDBConn")
      return;
    
    $trans_ok = false;

    if (is_object($man))
      $man->AddObject($conn->GetError());
    elseif (is_object($html))
      $html->AddObject($conn->GetError());
    elseif (is_object($form))
      $form->AddObject($conn->GetError());
    else
      echo $conn->GetTextualError();

    return false;
  }

  function ifr_conn_mostra_erro()
  {
    global $conn, $trans_ok;

    $trans_ok = false;

    $object = get_document_type();
    global $$object;

    $msg = $conn->GetTextualError();
    $msg = str_replace("'", "\'", $msg);
    $msg = str_replace("\"", "\\\"", $msg);
    $msg = str_replace("\n", "\\n", $msg);

    $$object->AddHtml("
    <script>
      var janela = pop_open('', 400, 400, 'erro', true);
      janela.document.write('$msg');
    </script>");
  }

  //---------------------------------------------------------------------------------------------
  // controla transacoes e erros de processos que podem rodar tanto pela cron quanto pelo browser
  // OBS.: utiliza $id_linha_comando para testar sendo assim o processo que utilizará essa função
  // deve usar o mesmo nome de variável

  function cron_mostra_erro()
  {
    global $conn, $id_linha_comando;

    if ($id_linha_comando)
    {
      $log_name = busca_nome_funcao(false, true);
      if (JAGUAR_VERSION >= 2.0)
        $log = new JLog("log/$log_name.erro", "w", array(date('Y-m-d H:i:s'), $conn->GetTextualError()));
      else
        system('echo "'. date('Y-m-d H:i') . "^" . $conn->GetTextualError() . '" >> log/' . $log_name) . '.erro';
    }
    else
      conn_mostra_erro();
  }

  //---------------------------------------------------------------------------------------------------------
  // $id_sem_inicio - se true não pegará os dados antes do primeiro '_'. Ex: exe_exemplo.php retorna exemplo.php
  // $id_sem_final  - se true não pegará os dados após último '.'. Ex: exe_exemplo.php retorna exe_exemplo
  // caso os 2 estejam true, retornará apenas exemplo e se os dois estiverem false retornará exe_exemplo.php

  function busca_nome_funcao($id_sem_inicio = false, $id_sem_final = false)
  {
    $nome = basename($_SERVER["PHP_SELF"]);

    if ($id_sem_inicio)
      $nome = substr($nome, strpos($nome, "_")+1, strlen($nome));

    if ($id_sem_final)
      $nome = substr($nome, 0, strpos($nome, "."));

    return $nome;
  }

  function busca_nextval($seq)
  {
    global $conn, $msg_erro;
    
    $sql = "SELECT nextval('public.$seq') " ;
    if (!$rs = $conn->Select($sql))
    {
      conn_mostra_erro();
      $msg_erro .= "Erro: Problema ao buscar próxima chave em $seq.\\n";
      return false;
    }
    else
      return $rs->GetField(0);
  }
  
  function busca_currval($seq)
  {
    global $conn, $msg_erro;

    $sql = "SELECT CURRVAL('public.$seq') " ;
    
    if (!$rs = $conn->Select($sql))
    {
      conn_mostra_erro();
      $msg_erro .= "Erro: Problema ao buscar chave em $seq.\\n";
      return false;
    }
    else
      return $rs->GetField(0);
  }

  function get_document_type()
  {
    global $man, $html, $form, $table;

    if (is_object($man))
      return "man";
    elseif (is_object($html))
      return "html";
    elseif (is_object($form))
      return "form";
    elseif (is_object($table))
      return "table";
  }
  
  function mostra_mensagem($object = "man")
  {
    global $msg_erro, $$object;

    if (strlen($msg_erro))
    {
      $msg_erro = strtr($msg_erro, array(". " => ". \\n"));
      $$object->AddJs("alert('" . SUBSTR($msg_erro, 0, -3) . "');");
      if ($object == "man")
        $man->SetUseLocation(false);
    }
  }

  /*
   ->Função criada para mostrar os avisos na manutenção quando a ação é efetuada e quer-se dirigir para
   outra tela, mas antes deseja-se dar um aviso
   ->Deve ser a última coisa a ser chamada devido aos testes de UseLocation, CancelLocation , GetError e trans_ok
  */
  function mostra_mensagem_aviso($msg, $trans_ok)
  {
    global $man;
   
    if ($man->mForm->IsValid())
    {
      if (!$man->mConn->mDriver->GetError() && $man->mUseLocation && !$man->mCancelAction && $trans_ok)
      {
        $action = $man->mAction->GetValue();
        
        if (strlen($man->mLocation[$action]))
        {
          $str = "location.href=\"".$man->mLocation[$action];
          
          if (is_array($man->mUrlFields[$action]))
          {
            $operator = "&";

            reset($man->mUrlFields[$action]);
            for($i = 0; $i < sizeof($man->mUrlFields[$action]); $i++)
            {
              $str .= $operator.key($man->mUrlFields[$action])."=";

              $value = current($man->mUrlFields[$action]);
              
              if (!$value)
                $str .= $GLOBALS[key($man->mUrlFields[$action])];
              else
                $str .= $value;

              if (strpos($str, "?"))
                $operator = "&";
                
              next($man->mUrlFields[$action]);
            }
          }
          
          $str .= "&message=".str_replace('"', '', $man->mMaintenanceMessage)."&grid=grid_".$man->mGridName;

          $str .= "\";";
          $man->SetUseLocation(false);
          $man->AddHtml("<script>alert('$msg');".preg_replace('(\n|\r)', '', $str)."</script>");
        }
      }//if ($man->mUseLocation)
    }//if ($man->mForm->IsValid())
  }

  //
  // Funcão que verifica e insere dados em tabelas de parâmetros.
  //   insere nulls caso a tabela esteja vazia, com isso força
  //   a man. de parâmetro a entrar em modo de alteração.
  // todos os campos da tabela não podem ser not null
  // 
  function inicia_parametro($ds_tabela)
  {
    global $conn;

    $sql = "SELECT *
              FROM $ds_tabela ";
    if ($rs = $conn->Select($sql))
    {
      if (!$rs->GetRowCount())
      {
        $values = array();
        for ($i = 0; $i < $rs->GetFieldCount(); $i++)
          $values[$rs->GetFieldName($i)] = "NULL";

        if (!$conn->Insert($ds_tabela, $values))
          conn_mostra_erro();
      }
    }
    else
      conn_mostra_erro();
  }

  function inicia_transacao()
  {
    global $conn, $trans_ok;

     $conn->BeginTransaction();
     $trans_ok = true;
  }

  /* -------------------
      retorna true  = ok
              false = ocorreu algum erro...
     -------------------
  */
  function termina_transacao($id_silencio = false)
  {
    global $conn, $trans_ok, $popup, $man;

    if ($trans_ok)
    {
      $conn->Commit();
      return true;
    }

    if (!$id_silencio)
      conn_mostra_erro();

    $conn->RollBack();
    return false;
  }
  // controla transacoes
  //--------------------------------
  /* -------------------------------
    Apaga conjunto de tabelas que tenham a mesma chave
    
    $tabelas = array com todas as dependencias a serem excluidas ou string com a tabela a ser excluida - podem ser informados aliases para os campos que diferem do padrão 
      Ex.: cd_pessoa pode ser nomeado como cd_usuario, neste caso seria informada exclusao de usuario com: 
        array("usuario" => array("cd_pessoa" => "cd_usuario")). 
    Importante listar, no caso de usar os aliases, todos os campos, mesmo que seja utilizado o mesmo nome, bastando para isso listar em um array normal. 
      Ex.: array("tabela" => array("campo_padrao" => "campo_alias", "campo_extra1", "campo_extra2", .., "campo_extraN"));
    $cd_campo = array associativo com todas os campos que podem ser utilizados na filtragem dos registros a serem excluidos
    $cd_campo_principal = string ou array numérico com o(s) nome(s) de todos os campos que serão usados em todas as exclusões. Se não for informado, todos os campos de cd_campo serão considerados
    $id_silencio = Determina se erros na exclusão serão exibidos. true = Modo Silencioso, false = Aparece os erros
    $id_no_trans = Controla a transacao (Caso seja true, não inicia nem finaliza transacao)
  --------------------------------------------------- */
  function exclui_dependencias($tabelas, $cd_campo,$cd_campo_principal = false,$id_silencio = false,$id_no_trans = false)
  {
    global $conn, $trans_ok;

    //Validação do parâmetro tabelas
    if (is_string($tabelas) && strlen(trim($tabelas)))
      $tabelas = array(trim($tabelas));
    elseif (!is_array($tabelas) || (is_array($tabelas) && !sizeof($tabelas)))
    {
      echo "<p><b>Erro:</b> O parâmetro 1 não possui um valor válido. Deve ser um array ou uma string</p>";
      exit;
    }
    
    //Validação do parâmetro cd_campo
    if (!is_array($cd_campo))
    {
      echo "<p><b>Erro:</b> O parâmetro 2 não possui um valor válido. Deve ser um array.</p>";
      exit;
    }
    
    $id_ok = true; 
    //Aqui se forma o where dos Deletes, se informado como array
    foreach ($cd_campo AS $campo=>$valor)
    {
      if (!is_numeric($campo))
        $tmp_where[$campo]  = $valor;
      else
        $id_ok = false;
    }

    if (!$id_ok)
    {
      echo "<p><b>Erro:</b> O parâmetro 3 deve ser associativo em todos os seus registros.</p>";
      exit;
    }

    //Se houver campo(s) principal(is), separa os valores de campo principais dos secundários
    if (strlen($cd_campo_principal))
    {
      if (!is_array($cd_campo_principal))
      {
        $tmp = $cd_campo_principal;
        unset($cd_campo_principal);
        $cd_campo_principal[] = $tmp;
      }
      unset($where);
      foreach($tmp_where as $campo => $valor)
      {
        if (in_array($campo, $cd_campo_principal))
          $where[$campo] = $valor;
      }
    }
    else
      $where = $tmp_where;
    
    if (!$id_no_trans)
      inicia_transacao();
    
    //Inicia a exclusão
    foreach($tabelas as $key => $valor)
    {
      unset($where_);
      //Caso não seja numérico, pode haver uma personalização dos nomes dos campos
      if (!is_numeric($key))
      {
        $tabela = $key;
        //Sendo array, poderão ser utilizadas os campos secundários, se houverem ou os nomes dos campos podem ser renomeados pra aquela tabela
        if (is_array($valor))
        {
          foreach ($valor as $campo => $alias)
          {
            if (is_numeric($campo))
              $where_[$alias] = $cd_campo[$alias];
            else
              $where_[$alias] = $cd_campo[$campo];
          }
        }
      }
      else
      {
        $tabela = $valor;
        $where_ = $where;
      }

      if (!$conn->Delete($tabela, $where_))
      {
        if (!$id_silencio)
          conn_mostra_erro();
        break;
      }
    }
    
    if (!$id_no_trans)
      termina_transacao($id_silencio); 
  }
  
  /*
      Adiciona mensagem de erro na manutenção
      msg = Mensagem de erro
      id_cancelar = true - Cancela Processo | false - Cancela o UseLocation
  */
  function adiciona_erro($msg, $id_cancelar = true, $useLocation = false)
  {
    global $man, $msg_erro;

    $msg_erro .= "$msg . ";
    if ($id_cancelar)
      $man->SetCancelAction(true);
    if (!$useLocation)
      $man->SetUseLocation(false);
  }

  /*
      Adiciona mensagem de confirmação na manutenção, cancela processo, mas mantém todos os valores informados pelo usuário
      msg = Mensagem de Confirmação
      nm_campo_confirmacao = Informa qual campo da manutenção será usado para informar qual campo será usado para fazer a 
      confirmacao (obrigatório para evitar um loop infinito)
      Obs.: É imperativo que se crie um campo para a confirmação funcionar.
      op_manter_valores = Se informado (deve ser array), indica quais campos devem ser mantidos com o mesmo valor informado pelo usuário, com confirmação ou não, caso não informado, considera-se que todos os campos devem ser revertidos aos valores antigos
  */
  function adiciona_confirmacao($msg, $nm_campo_confirmacao, $op_manter_valores = false)
  {
    global $man;
    
    if (!is_array($op_manter_valores) && strlen($op_manter_valores))
     $op_manter_valores = false;
    
    $op_inuteis = array("f_submit", "f_maintenance_submitted", $nm_campo_confirmacao);

    foreach($_POST AS $chave => $valor)
    {
      if (!in_array($chave, $op_inuteis))
      {
        if (!is_numeric($valor))
          $valor_tmp = "'$valor'";
        else
          $valor_tmp = "$valor";
          
        $tmp_keys .= "\t\tdocument.maintenance.$chave.value = $valor_tmp;\n";
        if (is_array($op_manter_valores))
          if (in_array($chave, $op_manter_valores))
            $tmp_keys_manter .= "\tdocument.maintenance.$chave.value = $valor_tmp;\n";
          
      }
    }
    $man->SetCancelAction(true);
    $msg_confirm = $msg;
    $man->SetUseLocation(false);
    $js = "\n<script> \n".
          "\n$tmp_keys_manter".
          "\n\tconfirma = confirm('$msg_confirm');\n".
          "\n\tif (confirma) ".
          "\n\t{ ".
          "\n\t\tdocument.maintenance.$nm_campo_confirmacao.value = 1; ".
          "\n$tmp_keys ".
          "\n\t\tdocument.maintenance.submit(); ".
          "\n\t}".
          "\n</script>";
   
    $man->AddHtml($js);
  }

  function adiciona_loop_status_nfe()
  {
    $js = "
      <script language=\"javascript\" type=\"text/javascript\">
      <!--
      //Browser Support Code
      function loop_status_nfe(){
        if ($('#id_emissao_nfe').val() == '2' ||
            $('#id_emissao_nfe').val() == '-1')
          return;
          
        var ajaxRequest;  // The variable that makes Ajax possible!
        var load = document.getElementById('loading_status_nfe');
        var res = document.getElementById('txt_status_nfe');
        
        load.style.display='inline';
        
        try{
          // Opera 8.0+, Firefox, Safari
          ajaxRequest = new XMLHttpRequest();
        } catch (e){
          // Internet Explorer Browsers
          try{
            ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
          } catch (e) {
            try{
              ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
            } catch (e){
              // Something went wrong
              return false;
            }
          }
        }
        // Create a function that will receive data sent from the server
        ajaxRequest.onreadystatechange = function()
        {
          if(ajaxRequest.readyState == 4)
          {
            response = ajaxRequest.responseText.replace(/^\s+|\s+$/g, '');
            
            if (response == 'ON')
            {
              $('#submit').attr('disabled', false);
              $('#id_emissao_nfe').val('1');
              res.innerHTML = '<font color=\"darkgreen\">ONLINE</font>';
            }
            else if (response == 'OFF')
            {
              res.innerHTML = '<font color=\"red\">OFFLINE</font>';
              $('#submit').attr('disabled', true);
              
              if ($('#id_emissao_nfe').val() != '0')
              {
                ds_link = location.href;
                ds_link = ds_link.substr(0, ds_link.lastIndexOf('.php') + 4);
                ds_link = ds_link.substr(ds_link.lastIndexOf('/') + 1);
                
                if (ds_link == 'fil_nf_geracao.php' || ds_link == 'fil_nf_cancelamento.php' || ds_link == 'exe_nfe_ajuste.php')
                {
                  ds_msg_svc = 'Atenção: SEFAZ RS está OFFLINE. ';
                  
                  if (ds_link == 'fil_nf_geracao.php' || ds_link == 'exe_nfe_ajuste.php')
                    ds_msg_svc += 'Deseja emitir a NF-e em contingência?';
                  else
                    ds_msg_svc += 'Deseja cancelar a NF-e em contingência? (Somente para NF-e emitida em ambinente de contingência)';
                  
                  if (confirm(ds_msg_svc))
                  {
                    $('#id_emissao_nfe').val('2');
                    $('#row_status_svc').show();
                    loop_status_svc();
                  }
                  else
                    $('#id_emissao_nfe').val('0');
                }
              }
            }
            else if (response == 'VENCIDO')
              res.innerHTML = '<font color=\"red\">CERTIFICADO DIGITAL VENCIDO</font>';
            else
              res.innerHTML = 'ERRO!';
            
            load.style.display='none';
          }
        }
        
        cd_pessoa_empresa = $(':input[name^=f_cd_pessoa_filial]').val();
        cd_pessoa_empresa = (cd_pessoa_empresa == '' || cd_pessoa_empresa == undefined ?  $(':input[name^=f_cd_pessoa]').val() : cd_pessoa_empresa);
        
        ajaxRequest.open('GET', 'exe_status_nfe.php?f_cd_pessoa_empresa=' + cd_pessoa_empresa + '&_=' + Math.random(), true);
        ajaxRequest.send(null);
      }
      loop_status_nfe();
      setInterval('loop_status_nfe()', 30000);
      -->
      </script>
    ";
    
    $html = "
      <div id=\"status_nfe\"><strong>
      <span id=\"txt_status_nfe\"></span>&nbsp;&nbsp;<img id=\"loading_status_nfe\" style=\"display:none;\" src=\"img/load.gif\" width=\"10\" height=\"10\">
      </strong></div>
    ";
    
    return $html . $js;
  }
  
  function adiciona_loop_status_svc()
  {
    $js = "
      <script language=\"javascript\" type=\"text/javascript\">
      <!-- 
      //Browser Support Code
      function loop_status_svc(){
      
        if ($('#id_emissao_nfe').val() != '2')
          return;
          
        $('#row_status_nfe').hide();
        
        var ajaxRequest;  // The variable that makes Ajax possible!
        var load = document.getElementById('loading_status_svc');
        var res = document.getElementById('txt_status_svc');
        
        load.style.display='inline';
        
        try{
          // Opera 8.0+, Firefox, Safari
          ajaxRequest = new XMLHttpRequest();
        } catch (e){
          // Internet Explorer Browsers
          try{
            ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
          } catch (e) {
            try{
              ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
            } catch (e){
              // Something went wrong
              return false;
            }
          }
        }
        // Create a function that will receive data sent from the server
        ajaxRequest.onreadystatechange = function()
        {
          if(ajaxRequest.readyState == 4)
          {
            response = ajaxRequest.responseText.replace(/^\s+|\s+$/g, '');
            
            if (response == 'ON')
            {
              $('#submit').attr('disabled', false);
              $('#id_emissao_nfe').val('2');
              res.innerHTML = '<font color=\"darkgreen\">ONLINE</font>';
            }
            else if (response == 'OFF')
            {
              $('#submit').attr('disabled', true);
              res.innerHTML = '<font color=\"red\">OFFLINE</font>';
            }
            else if (response == 'VENCIDO')
              res.innerHTML = '<font color=\"red\">CERTIFICADO DIGITAL VENCIDO</font>';
            else
              res.innerHTML = 'ERRO!';
              
            load.style.display='none';
          }
        }
        
        cd_pessoa_empresa = $(':input[name^=f_cd_pessoa_filial]').val();
        cd_pessoa_empresa = (cd_pessoa_empresa == '' || cd_pessoa_empresa == undefined ?  $(':input[name^=f_cd_pessoa]').val() : cd_pessoa_empresa);
        
        ajaxRequest.open('GET', 'exe_status_nfe.php?f_cd_pessoa_empresa=' + cd_pessoa_empresa + '&f_cd_uf=SVC-AN&_=' + Math.random(), true);
        ajaxRequest.send(null);
      }
      loop_status_svc();
      setInterval('loop_status_svc()', 30000);
      -->
      </script>
    ";
    
    $html = "
      <div id=\"status_svc\"><strong>
      <span id=\"txt_status_svc\"></span>&nbsp;&nbsp;<img id=\"loading_status_svc\" style=\"display:none;\" src=\"img/load.gif\" width=\"10\" height=\"10\">
      </strong></div>
    ";
    
    return $html . $js;
  }
  
  function adiciona_loop_status_mdfe()
  {
    $js = "
      <script language=\"javascript\" type=\"text/javascript\">
      <!-- 
      //Browser Support Code
      function loop_status_mdfe(){  
        var ajaxRequest;  // The variable that makes Ajax possible!
        var load = document.getElementById('loading_status_mdfe');
        var res = document.getElementById('txt_status_mdfe');
        
        load.style.display='inline';
        
        try{
          // Opera 8.0+, Firefox, Safari
          ajaxRequest = new XMLHttpRequest();
        } catch (e){
          // Internet Explorer Browsers
          try{
            ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
          } catch (e) {
            try{
              ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
            } catch (e){
              // Something went wrong
              return false;
            }
          }
        }
        
        // Create a function that will receive data sent from the server
        ajaxRequest.onreadystatechange = function()
        {
          if(ajaxRequest.readyState == 4)
          {
            response = ajaxRequest.responseText.replace(/^\s+|\s+$/g, '');

            if (response == 'ON')
            {
              $(':input[name=\"submete\"]').attr('disabled', false);
              res.innerHTML = '<font color=\"darkgreen\">ONLINE</font>';
            }
            else if (response == 'OFF')
            {
              res.innerHTML = '<font color=\"red\">OFFLINE</font>';
              $(':input[name=\"submete\"]').attr('disabled', true);
            }
            else
              res.innerHTML = 'ERRO!';
            
            load.style.display='none';
          }
        }
        
        cd_pessoa_empresa = $(':input[name^=f_cd_pessoa_filial]').val();
        cd_pessoa_empresa = (cd_pessoa_empresa == '' || cd_pessoa_empresa == undefined ?  $(':input[name^=f_cd_pessoa]').val() : cd_pessoa_empresa);
        
        ajaxRequest.open('GET', 'exe_status_mdfe.php?f_cd_pessoa_empresa=' + cd_pessoa_empresa + '&_=' + Math.random(), true);
        ajaxRequest.send(null); 
      }
      loop_status_mdfe();
      setInterval('loop_status_mdfe()', 30000);
      -->
      </script>
    ";
    
    $html = "
      <div id=\"status_mdfe\"><strong>
      <span id=\"txt_status_mdfe\"></span>&nbsp;&nbsp;<img id=\"loading_status_mdfe\" style=\"display:none;\" src=\"img/load.gif\" width=\"10\" height=\"10\">
      </strong></div>
    ";
    
    return $html . $js;
  }
  
  function monta_parametros_retorno($arr_key_ignora_extras = array())
  {
    $arr_key_ignora = array("f__submitted", "f_form_submitted", "f_submit", "PHPSESSID");

    if (sizeof($arr_key_ignora_extras))
      $arr_key_ignora = array_merge($arr_key_ignora, $arr_key_ignora_extras);

    $key = "";

    foreach ($_REQUEST AS $key_aux=>$val)
    {
      if (!in_array($key_aux, $arr_key_ignora))
        $key .= "&" . $key_aux . "=" . $val;
    }

    return $key;
  }
  
  function valida_variaveis()
  {
    $num_arg = func_num_args();
    $ok = true;
  
    for ($i = 0; $i < $num_arg; $i++)
    {
      $arg = func_get_arg($i);
      if (!strlen($arg))
        $ok = false;
    }

    return $ok;
  }

  function valida_vendedor()
  {
    global $title, $titulo;

    $t_titulo = (str_value($title))?$title:$titulo;

    if (!strlen($_SESSION["s_cd_vendedor"]))
    {
      $html = new JHtml($t_titulo);
      $html->AddHtml("<h3>$t_titulo</h3>");
      $html->AddHtml("<h4>Usuário não é Vendedor!<h4><BR>");
      echo $html->GetHtml();
      exit;
    }
  }

  /* 
    valida se produto esta sendo lancado em uma unidade valida
    $t_id_mensagem = mostra mensagem e cancela acao
  */
  function valida_unidade_produto_unidade($t_cd_produto, $t_cd_unidade, $t_id_mensagem=false)
  {
    global $conn, $man;

    $sql = "SELECT cd_unidade " .
             "FROM produto_unidade " .
            "WHERE cd_produto = $t_cd_produto " .
              "AND cd_unidade = $t_cd_unidade ";
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    elseif ($rs->GetRowCount())
      return true;
    elseif ($t_id_mensagem && is_object($man))
    {
      $man->SetCancelAction(true);
      $man->mStatus->OpenCell("<script>alert('Erro: Produto não cadastrado para esta Unidade.');</script>");
      $man->SetUseLocation(false);
    }
    
    return false;
  }


  /*
    valida se produto ja esta associado a uma unidade para determinada empresa e operacao
    retorna true se eh valido = nao existe
    retorna false se ja existe na base
  */  
  function valida_produto_operacao($t_cd_produto, $t_cd_unidade, $t_cd_pessoa_empresa, $t_cd_operacao, $t_id_mensagem=false)
  {
    global $conn, $man;

    $sql = "SELECT cd_produto " .
             "FROM produto_operacao " .
            "WHERE cd_produto = $t_cd_produto " .
              "AND cd_unidade = $t_cd_unidade " .
              "AND cd_pessoa = $t_cd_pessoa_empresa " .
              "AND cd_operacao = $t_cd_operacao ";
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    elseif (!$rs->GetRowCount())
      return true;
    elseif ($t_id_mensagem && is_object($man))
    {
      $man->SetCancelAction(true);
      $man->mStatus->OpenCell("<script>alert('Erro: Operação já associada ao Produto para esta Unidade na Empresa.');</script>");
      $man->SetUseLocation(false);
    }
    
    return false;
  }



  /*
    cria tabela temporaria com grupos - EXPORTACAO
  */
  function cria_tabela_temporaria_grupo($t_cd_grupo, $t_nm_tabela)
  {
    global $conn;

    $sql = "SELECT cd_grupo_filho AS cd_grupo
              INTO TEMPORARY $t_nm_tabela 
              FROM grupo_ligacao_completa glc
              JOIN grupo_produto gp ON gp.cd_grupo = glc.cd_grupo_filho
                                   AND gp.id_fornecedor_exportacao = 1
             WHERE glc.cd_grupo IN ($t_cd_grupo) ";
    if (!$conn->Execute($sql))
      return conn_mostra_erro();

    return true;
  }


  function formata_celula($txt, $nr_char, $id_alinhamento="D", $ds_char = " ")
  {
    switch ($id_alinhamento)
    {
      case "C": $txt = str_pad(substr($txt, 0, $nr_char), $nr_char, $ds_char, STR_PAD_BOTH);   break;
      case "E": $txt = str_pad(substr($txt, 0, $nr_char), $nr_char, $ds_char, STR_PAD_LEFT);   break;
      case "D": $txt = str_pad(substr($txt, 0, $nr_char), $nr_char, $ds_char, STR_PAD_RIGHT);  break;
    }

    return $txt;
  }
  
  //para adicionar tips onde hoje o jaguar não permite
  //Use o método AddHtml
  function adicionaTip($id, $title, $texto, $is_con = false)
  {
    if (JAGUAR_VERSION >= 2.0)
    {
      global $man, $html, $form, $table; 

      $container = get_document_type();

      if (is_object($$container))
      {
        $js = "Style[0] = [\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,,,2,\"#FFFFFF\",2,,,,,\"\",,,,];
                  var TipId=\"tiplayer\"; 
                  var FiltersEnabled = 1; 
                  mig_clay(); 
                  ";

        $$container->AddJS($js, "end");
      }
      
      if ($is_con)
          $$container->AddJSFile(URL."js/main15.js");
    }
    else
    {
      if ($is_con)
      {
        $out .= "<script language=\"JavaScript\" src=\"".URL."js/main15.js\"></script>
                  <script language=\"JavaScript\">
                  Style[0] = [\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,,,2,\"#FFFFFF\",2,,,,,\"\",,,,];
                  var TipId=\"tiplayer\";
                  var FiltersEnabled = 1;
                  mig_clay();
                  </script>";
      }
    }


      $out = "";

      if (!$title)
        $title = "";

      $out .= "
        <script language=\"JavaScript\">
        Tips[\"$id\"] = [\"$title\", \"$texto\"];
        </script>

        <a disabled href=\"#\" onMouseOver=\"stm(Tips['$id'],Style[0])\" onMouseOut=\"htm()\" ><img src=\"".URL."img/lamp.gif\" border=\"0\" height=\"14\" width=\"16\"></A>";

      return $out;
  }

  function adiciona_pop_up($label, $address, $width = 600, $height = 400, $windowName = '', $resize = true)
  {
    if (strpos($address, '?') === false)
      $address .= '?f_popup=1';
    else
      $address .= '&f_popup=1';
      
    return "<a href=\"#\" onClick=\"javascript: if (top.pop) top.pop.close(); top.pop = pop_open('".$address."', ".$width.", ".$height.", '".$windowName."', '".($resize ? "yes" : "no")."');\">".$label."</a>";
  }

  function busca_quinzena_anterior($id_inicio_fim = 'I', $ds_formato = 'Y-m-d')
  {
    if (date('d') > 15)
    {
       switch ($id_inicio_fim)
      {
        case 'I': return date($ds_formato, mktime(0, 0, 0, date('m'),  1, date('Y')));
        case 'F': return date($ds_formato, mktime(0, 0, 0, date('m'), 15, date('Y')));
      }
    }
    else
    {
      switch ($id_inicio_fim)
      {
        case 'I': return date($ds_formato, mktime(0, 0, 0, date('m')-1, 16, date('Y')));
        case 'F': return date($ds_formato, mktime(0, 0, 0, date('m'),    0, date('Y')));
      }
    }
  }
  
  /*
    $ds_table               = nome da table com a hierarquia completa
    &$retorno_nm_tabela_tmp = retorna na var que foi passada como parâmetro o nome da tabela tmp com os códigos
    &$retorno_nivel         = quantia de colunas na tabela tmp retornada
    $max_nivel              = níveis a serem pegos no sql
  */
  function tmp_hierarquia_completa($ds_table, &$retorno_nm_tabela_tmp, &$retorno_nivel, $max_nivel = null)
  {
    global $conn;

    $sql = "SELECT a.attname
              FROM pg_class c, pg_attribute a
             WHERE relkind in ('r','v')
               AND c.relname = '$ds_table'
               AND a.attnum > 0
               AND a.attrelid = c.oid
             ORDER BY a.attname ";

    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount() == 4)
      {
        $arr_fields = $rs->GetArray(true);

        $campo_pai   = $arr_fields[0]['attname'];
        $campo_filho = $arr_fields[1]['attname'];
        $nivel_filho = $arr_fields[2]['attname'];
        $nivel_pai   = $arr_fields[3]['attname'];

        // MAX NIVEL
        $sql = "SELECT MAX(nr_nivel)
                  FROM $ds_table ";

        if (str_value($max_nivel))
          $sql .= "WHERE nr_nivel < $max_nivel ";

        if ($rs = $conn->Select($sql))
          $max_nivel = $rs->GetField(0);
        else
          conn_mostra_erro();
        // --------

        $sql_fields_lc = "SELECT DISTINCT COALESCE(lc_0.$campo_pai, 0) AS $campo_pai"."_0, ";

        $sql_join_lc   = "JOIN $ds_table lc_0 ON lc_0.$campo_filho = lc.$campo_pai
                                             AND lc_0.$nivel_pai = 0 ";
        $sql_order_lc  = "ORDER BY 1, ";

        for ($i = 1; $i <= $max_nivel; $i++)
        {
          $tmp = $i - 1;

          $sql_fields_lc .= "COALESCE(lc_$i.$campo_pai, 0) AS $campo_pai"."_$i, ";

          $sql_join_lc   .= "LEFT OUTER JOIN $ds_table lc_$i ON lc_$i.$campo_pai = lc_$tmp.$campo_filho
                                                            AND lc_$i.$nivel_pai = $i ";
          $sql_order_lc  .= ($i+1).", ";
        }

        $tmp_ds_table = "tmp_$ds_table"."_".date("YmdHis");

        $sql = substr($sql_fields_lc, 0, -2) . 
               " INTO TEMPORARY $tmp_ds_table " .
               " FROM $ds_table lc " . 
               $sql_join_lc . 
               substr($sql_order_lc, 0, -2);

        if ($conn->Execute($sql))
        {
          $retorno_nm_tabela_tmp = $tmp_ds_table;
          $retorno_nivel         = $max_nivel;
          return true;
        }
        else
          conn_mostra_erro();
      }
      else
        echo "Erro tabela $ds_table não possui os 4 campos necessários<HR>";
    }
    else
    {
      echo "Erro ao buscar os campos da tabela $ds_table<HR>";
      conn_mostra_erro();
    }

    return false;
  }

  /*
    Função que verifica se as variáveis de sessão passadas no array estão setadas
    array(
      array ("var"        => "s_nome_da_var_de_sessao_a_ser_testada",
             "var_label"  => "label do parametro em que esta a var de sessao para orientar o usuario",
             "file"       => "man_nome_do_parametro_a_direcionar.php",
             "file_label" => "label do parametro para mostrar para o usuario com o link para o arquivo que esta em file")
    );
  */
  function verifica_vars_sessao($arr_vars)
  {
    $id_ok        = true;
    $t_html       = "";
    $tmp_anterior = "";

    foreach ($arr_vars AS $value)
    {
      if (!str_value($_SESSION[$value["var"]]))
      {
        if ($tmp_anterior != $value["file"])
        {
          $t_html .= "<BR><a href='".$value["file"]."'>".$value["file_label"]."</a><BR>";

          $tmp_anterior = $value["file"];
        }

        $t_html .= $value["var_label"]."<BR>";
        $id_ok = false;
      }
    }

    if (!$id_ok)
    {
      $title = "Atenção as seguintes variáveis de sessão devem estar setadas para prosseguir:";
      $html = new JHtml($title);
      $html->AddHtml("<p>$title<BR>$t_html</p>");
      echo $html->GetHtml();
      exit();
    }
  }

  function cancela_acao($msg)
  {
    global $man, $trans_ok;

    $trans_ok = false;

    $man->AddJSOnLoad("alert('Erro: ".$msg."')");
    $man->SetCancelAction(true);
    $man->SetUseLocation(false);
  }



  /**
  * Verifica se o vendedor atende um cliente para 
  * determinado grupo em uma empresa ou determinado produto 
  *
  * @param integer $t_cd_vendedor          codigo do vendedor 
  * @param integer $t_cd_pessoa            codigo do cliente 
  * @param integer $t_cd_grupo             codigo do grupo 
  * @param integer $t_cd_pessoa_empresa    codigo da empresa 
  * @param integer $t_cd_produto           codigo do produto 
  */
  function verifica_cliente_grupo_vendedor($t_cd_vendedor,        $t_cd_pessoa, 
                                           $t_cd_grupo   = null,  $t_cd_pessoa_empresa = null,
                                           $t_cd_produto = null)
  {
    global $conn;

    // se foi informado produto mas o teste para produto nao é obrigatorio retorna 
    // 
    if (str_value($t_cd_produto) && !$_SESSION["s_id_vendedor_produto"])
      return true;

    // se foi informado grupo mas o teste para grupo nao é obrigatorio retorna 
    // 
    if (str_value($t_cd_grupo) && !$_SESSION["s_id_cliente_vendedor"])
      return true;

    $sql = "SELECT COUNT(cgv.cd_vendedor) 
              FROM cliente_grupo_vendedor cgv 
             WHERE cgv.cd_pessoa   = $t_cd_pessoa 
               AND cgv.cd_vendedor = $t_cd_vendedor ";

    // busca grupo pai do grupo informado
    //
    if (str_value($t_cd_grupo))
      $sql .= "AND cgv.cd_grupo IN (SELECT cd_grupo 
                                      FROM grupo_ligacao_completa 
                                     WHERE cd_grupo_filho = $t_cd_grupo 
                                       AND nr_nivel_grupo = 0) ";

    if (str_value($t_cd_pessoa_empresa))
      $sql .= "AND cgv.cd_pessoa_empresa = $t_cd_pessoa_empresa ";

    // busca grupo pai do grupo do produto informado 
    //
    if (str_value($t_cd_produto))
      $sql .= "AND cgv.cd_grupo IN (SELECT cd_grupo 
                                      FROM grupo_ligacao_completa 
                                     WHERE cd_grupo_filho = (SELECT cd_grupo
                                                               FROM produto 
                                                              WHERE cd_produto = $t_cd_produto) 
                                       AND nr_nivel_grupo = 0) ";

    if (!$rs = $conn->Select($sql))
      return conn_mostra_erro();

    return $rs->GetField(0);
  }

  function adiciona_validacao_campo_percentagem(&$campo)
  {
    $campo->SetValue1("100");
    $campo->SetCondition("<=");
    $campo->SetError("Erro: Valor máximo deve ser 100%!");
  }

  function obrigatorio($label, &$campo)
  {
    $campo->SetTestIfEmpty(true, "Preencha o campo $label!");
    return "<b>$label</b>";
  }

  function testa_parametros_invalidos($array_parametros)
  {
    if (!$array_parametros || !is_array($array_parametros))
      exit("Erro: testa_parametros_invalidos deve receber um array como parâmetro");
      
    $msg_erro = "Campo(s) chave sem valor!";

    foreach ($array_parametros as $parametro)
      if (!str_value($parametro)) 
        exit("<script>alert('".$msg_erro."'); history.back();</script>"); 
  }

  function verifica_tabela($nm_tabela)
  {
    global $conn;

    $sql = "SELECT relname FROM pg_class WHERE relname = '$nm_tabela' ";
    if ($rs = $conn->Select($sql))
      return $rs->GetRowCount();
    else
      conn_mostra_erro();
  }

  function valida_maior_desconto($p_cd_pessoa_matriz,$p_cd_pessoa_filial,$p_cd_produto,$p_cd_cliente,&$p_pr_df,&$p_pr_dg, $p_cd_pedido = null) 
  {
    global $conn; 
    if (!is_object($conn))return(false);
    $pr_dg_normal = $pr_df_normal = $pr_dg_edi = $pr_df_edi = null;

    $sql = "SELECT COALESCE(obtem_dg($p_cd_produto,$p_cd_pessoa_matriz,$p_cd_pessoa_filial,current_date),0) AS max_dg, 
                   COALESCE(obtem_df($p_cd_produto,$p_cd_pessoa_matriz,$p_cd_pessoa_filial,current_date),0) AS max_df "; 
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro(); 
    else
    {
      $pr_dg_normal = $rs->GetField("max_dg");
      $pr_df_normal = $rs->GetField("max_df");
    }

    $t_cd_pedido = ($p_cd_pedido ? $p_cd_pedido : "NULL");
    
    $sql = "SELECT obtem_df_cliente_pedido($p_cd_produto,$p_cd_pessoa_matriz,$p_cd_pessoa_filial,today(),$p_cd_cliente, $t_cd_pedido) AS pr_df,
                   obtem_dg_cliente_pedido($p_cd_produto,$p_cd_pessoa_matriz,$p_cd_pessoa_filial,today(),$p_cd_cliente, $t_cd_pedido) AS pr_dg "; 
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    else
    {
      $pr_df_edi = $rs->GetField("pr_df");
      $pr_dg_edi = $rs->GetField("pr_dg");
    }

    if ($pr_dg_edi > 0)
      $pr_dg_max = $pr_dg_edi;
    elseif ($pr_dg_normal > 0)
      $pr_dg_max = $pr_dg_normal;
    else
    {
      $pr_dg_padrao=0;
      $sql = "SELECT pr_dg_padrao
                FROM parametro_geral_empresa_grupo
               WHERE cd_pessoa = $p_cd_pessoa_matriz ";
      if (!$rs = $conn->Select($sql))
        conn_mostra_erro();
      elseif ($rs->GetField("pr_dg_padrao"))
        $pr_dg_padrao = $p_pr_dg * ($rs->GetField("pr_dg_padrao")/100.0);
      $pr_dg_max=$p_pr_dg=$pr_dg_padrao; 
    }

    if ($pr_df_edi > 0)
      $pr_df_max = $pr_df_edi;
    elseif ($pr_df_normal > 0)
      $pr_df_max = $pr_df_normal;
    else
      $pr_df_max = $p_pr_df = 0;

    return array("df"=>$pr_df_max,"dg"=>$pr_dg_max); 
  }

  //a cada identificação de <b> troca o style
  function multicell_multistyle($w,$h,$txt,$border,$align,$fill, $font_family, $font_size, $style_inicial = "")
  {
    global $pdf;

    $style = $style_inicial;
    $ocupado = 0;
    $pdf->SetX(5);

    $t_txt = explode("<b>", $txt);
    for ($j=0; $j<count($t_txt); $j++)
    {
      $pdf->SetFont($font_family, $style, $font_size);
      $style = troca_style($style);
      if ($ocupado+$pdf->GetStringWidth($t_txt[$j])+2 <= $w)
      {
        $ocupado += $pdf->GetStringWidth($t_txt[$j])+2;
        $pdf->Cell($pdf->GetStringWidth($t_txt[$j])+2, $h, $t_txt[$j], $border, ($j == count($t_txt)-1), $align, $fill);
      }
      else
      {
        $arr = explode(" ", $t_txt[$j]);
        
        foreach ($arr as $id => $ds_palavra)
        {
          if ($ocupado+$pdf->GetStringWidth($ds_palavra)+2 <= $w)
          {
            $ocupado += $pdf->GetStringWidth($ds_palavra)+2; 
            $id_quebra = (($ocupado+$pdf->GetStringWidth($arr[$id+1])+2 > $w) || ($id == count($arr) - 1) ? 1 : 0);
            
            $pdf->Cell($pdf->GetStringWidth($ds_palavra)+2, $h, $ds_palavra, $border, $id_quebra, $align, $fill);
          }
          else
          {
            $pdf->SetX(5);
            $ocupado = $pdf->GetStringWidth($ds_palavra)+2;
            $pdf->Cell($pdf->GetStringWidth($ds_palavra)+2, $h, $ds_palavra, $border, ($id == count($arr) - 1), $align, $fill);
          }
        }
      }
    }
    
    $pdf->SetFont($font_family, $style_inicial, $font_size);
    $pdf->SetX(5);
  }

  function troca_style($style)
  {
    if ($style == "B")
      return "";

    return "B";
  }


  function fil_botao(&$p_form, $p_colspan=2, $p_mostra_reset=true, $p_label_submit="Gerar", $p_label_reset="Limpar", $force_reset = false) 
  {
    $ds_botao = ""; 

    if (!is_array($p_colspan))
      $p_colspan = array("colspan" => $p_colspan);

    $bt = new JFormSubmit("submete", $p_label_submit);
    $ds_botao .= $bt->GetHtml();

    if ($p_mostra_reset)
    {
      $bt = new JFormReset("limpa", $p_label_reset, $force_reset);
      $ds_botao .= $bt->GetHtml(); 
    }

    $p_form->OpenRow(); 
    $p_form->OpenHeader($ds_botao, $p_colspan); 
  } 

  /*nome é o nome dado no AddArea
   em vez de primeiro podia ter usado a var campo mas quando percebi já havia usado em outros e não valia a pena alterar*/
  function seta_negrito_produto_filial($val, $nome, $primeiro = false, $campo = "cd_pessoa_filial", $funcao = false, $pFuncao = false)
  {
    global $conn, $consulta, $is_filial_usuario;

    if ($funcao)
    {
      $pFuncao = (is_array($pFuncao))?$pFuncao:array();
      $pFuncao = array_merge(array($val), $pFuncao);
      $val = call_user_func_array($funcao, $pFuncao);
    }
    
    if ($primeiro)
    {
      $sql = "SELECT COUNT(*) 
                FROM parametro_geral_filial pgf 
               WHERE pgf.cd_pessoa_local_armazem IN (" . obtem_filiais_usuario() . ")  
                 AND cd_pessoa_filial = ".$consulta->mRs[$nome]->GetField($campo); 
      
      if ($rs = $conn->Select($sql))
        $is_filial_usuario = (boolean)$rs->GetField(0);
      else
        conn_mostra_erro();    
    }

    if ($is_filial_usuario)
        $val = "<b>$val</b>";
    
    return $val;
  }

  function mostra_msg_acao_disabled()
  {
    global $msg_acao_disabled, $man;

    if (!is_array($msg_acao_disabled))
      return;

    if (count($msg_acao_disabled))
    {
      $msg = implode("<br>", $msg_acao_disabled);
      $msg = str_replace("!", "", $msg);
      $msg = "<font color=red><b>$msg</b></font>";
      $man->SetMaintenanceMessage($msg);
    }
                                                                                                     
  }

  function obtem_cidade_pessoa($cd_pessoa)
  {
    global $conn;

    $sql = "SELECT cd_cidade
              FROM pessoa
             WHERE cd_pessoa = $cd_pessoa ";

    if ($rs = $conn->Select($sql))
    {
      return $rs->GetField(0);
    }
    else
      conn_mostra_erro();
  }

  /*
    Retorno:
      true:  Grupo de Produto pode ser vendido na região do cliente
      false: Grupo de Produto não pode ser vendido na região do cliente
  */
  function verifica_grupo_produto_regiao($cd_cidade_cliente, $cd_grupo_produto, $cd_pessoa_empresa)
  {
    global $conn;

    $sql_regiao = "SELECT cr.cd_regiao 
                     FROM cidade_regiao cr
                    WHERE cr.cd_cidade = $cd_cidade_cliente ";
    if ($rs = $conn->Select($sql_regiao))
    {
      if (!$rs->GetRowCount())
        return true; //se cidade não tem região não valida
    }
    else  
      conn_mostra_erro();

    $sql = "SELECT cd_grupo
              FROM grupo_produto_regiao gpr
             WHERE gpr.cd_grupo         = $cd_grupo_produto
               AND gpr.cd_pessoa        = $cd_pessoa_empresa
               AND cd_regiao           IN ($sql_regiao) ";
    if ($rs = $conn->Select($sql))
    {
      if (!$rs->GetRowCount())
        return true; //se grupo não tem região não valida
    }
    else  
      conn_mostra_erro();

    $sql = "SELECT id_valida
              FROM grupo_produto_regiao gpr
             WHERE gpr.cd_grupo         = $cd_grupo_produto
               AND gpr.cd_pessoa        = $cd_pessoa_empresa
               AND cd_regiao           IN ($sql_regiao) ";
    if ($rs = $conn->Select($sql))
    { 
      if ($rs->GetField("id_valida") == 1)
        return false;
      else
        return true;
    }
    else
      conn_mostra_erro();
  }

  /*
    sql           = Os campos do select serão registrados como variável de sessão. s_$nm_campo
    ds_campo_erro = Se o arquivo que chamou a função contém controle de transação e usa outra var, passa o nome dela aqui
  */
  function seta_vars_sessao_sql($sql, $ds_campo_erro = "id_erro")
  {
    global $conn, $trans_ok;

    // Executa sql
    if ($rs = $conn->Select($sql))
    {
      if (!$rs->GetRowCount())
        return;

      unset($campos);

      // Busca linha por linha do rs
      foreach ($rs->GetArray(true) as $nro => $registro)
      {
        // Pega campo por campo de cada linha pra registrar
        foreach ($registro as $campo => $valor)
        {
          $s_campo = "s_$campo";
          global $$s_campo;
          $$s_campo = $valor;

          $_SESSION["s_$campo"] = $valor;

          // Guarda nomes em array
          $campos[] = $s_campo;
        }
        break;
      }
      // Passa o array com o nome das vars de sessão para serem registradas
      call_user_func_array("session_register", $campos);
    }
    else
    {
      if (is_object($table))
      {
        $trans_ok = false;
        $table->AddObject($conn->GetError());
      }
      else
        conn_mostra_erro();

      // Se passou var pra controle de erro seta valor
      if (str_value($ds_campo_erro))
      {
        global $$ds_campo_erro;
        $$ds_campo_erro = 1;
      }
    }
  }

  function foi_filtrado($nome_grid, $nome_campo)
  {
    if (str_value($GLOBALS["f_".$nome_grid."_".$nome_campo]) || 
         (str_value($GLOBALS["s_".$nome_grid."_".$nome_campo]) && 
         !str_value($GLOBALS["f_filter_$nome_grid"."_submitted"]))){
      return true;
    }

    return false;
  }

  define("LABEL_REMESSA_NF", "REF NF REM");
  function obtem_nfs_remessa($cd_carga)
  {
    global $conn;

    //nfs de remessa
    $sql = "SELECT nr_nota_fiscal 
              FROM nota_fiscal 
             WHERE cd_carga = $cd_carga
               AND cd_operacao = " . $_SESSION["s_cd_operacao_remessa_manifesto"] . "
               AND dt_cancelamento IS NULL ";

    if (!$rs = $conn->Select($sql))
      echo $conn->GetTextualError();

    $nfs_remessa = LABEL_REMESSA_NF . " ";
    while(!$rs->IsEof())
    {
      $nfs_remessa .= $rs->GetField("nr_nota_fiscal") . ",";
      $rs->Next();
    }
    
    return substr($nfs_remessa, 0, -1);
  }

  /*retorna a posição onde quebrar
   retorna -1 se não precisa quebrar*/
  function ind_quebra_obs_remessa($texto, $tam)
  {
    if (strlen($texto) > $tam)
    {
      for ($i=43; $i>=0; $i--)
      {
        if ($texto[$i] == ",")
          return $i;
      }
    }
    else
      return -1;
  }

  /*retorna a filial do armazem do pedido ou a filial do armazem de venda da filial do pedido*/
  function insereHistoricoPendente($t_cd_nota_fiscal)
  {
    global $conn;

    $sql = "SELECT nf.cd_pedido, nf.cd_carga
              FROM nota_fiscal nf 
             WHERE cd_nota_fiscal = $t_cd_nota_fiscal";
    if ($rs = $conn->Select($sql))
    {
      $cd_pedido = $rs->GetField("cd_pedido");
      $cd_carga  = $rs->GetField("cd_carga");

      $values = array("cd_pedido"           => $cd_pedido,
                      "cd_pedido_situacao"  => $_SESSION["s_cd_pedido_situacao_erro_nfe"] ,
                      "dt_historico"        => "CURRENT_TIMESTAMP",
                      "cd_pessoa_historico" => $_SESSION["s_cd_usuario"]);
      if (!$conn->Insert("historico_situacao_pedido", $values))
        conn_mostra_erro();

      $values = array("id_atualizada_armazem_saida" => "0");
      $where = array("cd_carga" => $cd_carga);
      if (!$conn->Update("carga_saida", $values, $where))
        conn_mostra_erro();

      $sql = "SELECT sn.cd_status_nfe, sn.ds_status_nfe
                FROM nota_fiscal_status_nfe nfs
                JOIN status_nfe sn USING(cd_status_nfe)
               WHERE nfs.cd_nota_fiscal = $t_cd_nota_fiscal ";
      if ($rs = $conn->Select($sql))
      {
        $ds_status = "";
        while (!$rs->IsEof())
        {
          $ds_status .= $rs->GetField(0) . " - " . $rs->GetField(1) . ", ";
          $rs->Next();
        }
        $ds_status = SUBSTR($ds_status, 0, -2);
      }
      else
        conn_mostra_erro;

      if (strlen($ds_status))
      {
        $values = array("cd_pedido"           => $cd_pedido,
                        "ds_observacao"       => $ds_status,
                        "id_destino_mensagem" => 1);
        if (!$conn->Insert("pedido_observacao", $values))
          conn_mostra_erro();
      }
    }
    else
      conn_mostra_erro();
  }

  function obtem_filial_armazem_pedido($cd_pedido, $cd_armazem = false)
  {
    global $conn;
    
    if ($cd_armazem)
    {
      $sql = "SELECT cd_pessoa_filial FROM armazem WHERE cd_armazem = $cd_armazem ";  
      if ($rs = $conn->Select($sql))
        return $rs->GetField("cd_pessoa_filial");
      else
        conn_mostra_erro();
    }
    else
    {
      $sql = "SELECT cd_armazem, cd_pessoa_filial FROM pedido WHERE cd_pedido = $cd_pedido";
      if ($rs = $conn->Select($sql))
      {
        if (str_value($rs->GetField("cd_armazem")))
        {
          $sql = "SELECT cd_pessoa_filial FROM armazem WHERE cd_armazem = " . $rs->GetField("cd_armazem") . " ";
          if ($rs = $conn->Select($sql))
            return $rs->GetField("cd_pessoa_filial");
          else
            conn_mostra_erro();
        }
        elseif (str_value($rs->GetField("cd_pessoa_filial")))
        {
          $sql = "SELECT a.cd_pessoa_filial 
                    FROM parametro_geral_filial pgf
                    JOIN armazem a ON a.cd_armazem = pgf.cd_armazem_venda
                   WHERE pgf.cd_pessoa_filial = " . $rs->GetField("cd_pessoa_filial") . " ";
          if ($rs = $conn->Select($sql))
            return $rs->GetField("cd_pessoa_filial");
          else
            conn_mostra_erro();

        }
      }
      else
        conn_mostra_erro();
    }
  }

  /* só pode inserir um produto em um pedido se o produto está em produto_estocagem para a filial do armazem do pedido*/
  function verifica_produto_armazem($cd_pedido, $cd_produto, $cd_armazem = false)
  {
    global $conn;

    $sql = "SELECT COUNT(*) 
              FROM produto_estocagem pe
             WHERE pe.cd_produto       = $cd_produto 
               AND pe.cd_pessoa_filial = " . obtem_filial_armazem_pedido($cd_pedido, $cd_armazem) . " ";
    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetField(0))
        return true;
    }
    else
      conn_mostra_erro();

    return false;
  }

  function funcao_js_get_sys_float_value()
  {
    return "
      function get_sys_float_value(nm_campo, is_campo, debug)
      {
        if (is_campo)
          valor = eval(nm_campo+'.value');
        else
          valor = nm_campo;
        
        valor = valor.replace(/\./g, '');
        valor = valor.replace(',', '.');
        valor = parseFloat(valor);
        return valor;
      }
  
    ";
  }

  /* Para usar essa função tem que ter adicionado a função tira_ponto_apos_virgula() no JavaScript*/
  function funcao_get_pt_BR_float_value()
  {
    return "
      function get_pt_BR_float_value(valor, nr_casas)
      {
        valor = return_formatted_value(Math.round(valor * Math.pow(10, nr_casas)) / Math.pow(10, nr_casas), nr_casas);
        return tira_ponto_apos_virgula(valor);
      }
    ";
  }

  /* o return_formatted_value qdo tem 3 casas após a vírgula estava colocando 2,.123*/
  function funcao_tira_ponto_apos_virgula()
  {
    return "
      function tira_ponto_apos_virgula(valor)
      {
        virgula = valor.indexOf(',');
        if (virgula == -1)
          return valor;
        else
          return valor.substr(0, virgula+1) + (valor.substr(virgula+1).replace('.', ''));
      }

    ";
  }
  

  /*seta informações ao tip*/
  /*para adicionar mais funcionalidade consulte: jaguar/js/main15.js cada elemento do vetor s que está em main15.js é um elemento em mTipStyle 
  tem que setar ao objeto e para cada configuração diferente tem que por um ind diferente e este ind deve ser maior que 0
  */
  function seta_informacoes_tip(&$objeto, $ind, $width = "", $height = "")
  {
    
    $tipStyle = "\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,$width,$height,2,\"#FFFFFF\",2,,,,,\"\",,,,";
    $objeto->AddJs("Style[$ind] = [" . $tipStyle . "];");
    $objeto->mIndTipStyle = $ind;
  }

  /* 
    usada em efesus_coletor 
      param_load são os parametros a serem passados no carretar 
      param_atualizacao são os parametros a serem passados a cada atualização. Deve começar por ' (aspa simples)
  */
  function iframe_simples(&$form, &$campo, $event, $nome, $url, $param_load, $param_atualizacao, $js = "")
  {
    if (!str_value($js))
    {
      $js = "
        function js_$nome()
        {
          $nome.location.replace('$url?'+$param_atualizacao);
        }
      ";
    }
    $form->AddJs($js);

    $frame_options = array("height"    => "0",
                           "width"     => "0",
                           "scrolling" => "auto");
    $iframe_ = OpenIframe($nome, $url."?".$param_load, $frame_options);
    $form->AddHtml($iframe_);
    $campo->SetEvents($event, "js_".$nome);
  }

  /* 
    retorna false se operação ecf não deve ser usada
    retorna o código da operação ecf se deve ela deve ser usada
  */
  function operacao_ecf($cd_pessoa_filial, $cd_cliente)
  {
    global $conn;

    //verifica se parametro_geral tem cd_operacao_ecf
    $sql = "SELECT cd_operacao_ecf FROM parametro_geral ";
    if (!str_value(obtem_pesquisa_um_campo($sql)))
      return false;

    //verifica se em parametro_geral_filial emite ecf
    $sql = "SELECT id_permite_emissao_ecf 
              FROM parametro_geral_filial
             WHERE cd_pessoa_filial = $cd_pessoa_filial ";
    if (obtem_pesquisa_um_campo($sql) != 1)
      return false;

    //se cliente tem setado uma operação de venda em cliente_financeiro para a empresa
    $sql = "SELECT cd_operacao_venda
              FROM cliente_financeiro
             WHERE cd_pessoa = $cd_cliente
               AND cd_pessoa_grupo = (SELECT cd_pessoa
                                        FROM filial
                                       WHERE cd_pessoa_filial = $cd_pessoa_filial)";
    $cd_operacao_ecf = obtem_pesquisa_um_campo($sql);
    if (str_value($cd_operacao_ecf))
      return $cd_operacao_ecf;
    else
      return false;
  }

  
  /* formata campos timestamp */
  function formata_data_hora($val, $de, $para)
  {
    $data = substr($val, 0, 10);
    $hora = substr($val, 11);

    return Format_Date($data, $de, $para) . " " . $hora;
  }

  function busca_dias_uteis($dt_inicial, $dt_final, $cd_pessoa_filial, $id_sql = 0)
  {
    global $conn;

    if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt_inicial))
      $dt_inicial = "'$dt_inicial'::DATE";

    if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt_final))
      $dt_final   = "'$dt_final'::DATE";

    $sql = "SELECT (/* pega dias da semana */
                    (SELECT COALESCE(COUNT(d.dt_dia), 0)
                       FROM dia d
                      WHERE d.dt_dia >= $dt_inicial
                        AND d.dt_dia <= $dt_final
                        AND EXTRACT(DOW FROM d.dt_dia) NOT IN (0, 6))
                    /* desconta feriado fixo */
                    - (SELECT COALESCE(COUNT(d.dt_dia), 0)
                         FROM dia d
                         JOIN feriado_fixo ff ON ff.dt_dia_mes = d.dt_dia
                                             AND TO_CHAR(ff.dt_dia_mes, 'MM-DD') >= TO_CHAR($dt_inicial, 'MM-DD')
                                             AND TO_CHAR(ff.dt_dia_mes, 'MM-DD') <= TO_CHAR($dt_final, 'MM-DD')
                        WHERE EXTRACT(DOW FROM ('" . date("Y") . "-' || TO_CHAR(d.dt_dia, 'MM-DD'))::DATE) NOT IN (0, 6))
                    /* desconta feriado variavel */
                    - (SELECT COALESCE(COUNT(d.dt_dia), 0)
                         FROM dia d
                         JOIN feriado_variavel fv ON fv.dt_feriado = d.dt_dia
                                                 AND fv.cd_cidade = ef.cd_cidade
                                                 AND fv.dt_feriado >= $dt_inicial
                                                 AND fv.dt_feriado <= $dt_final
                        WHERE EXTRACT(DOW FROM d.dt_dia) NOT IN (0, 6))
                    ) AS qt_dia_semana
               FROM vw_empresa_grupo_filial ef 
              WHERE ef.cd_pessoa = $cd_pessoa_filial";
    if (!$id_sql)
    {
      if (!$rs = $conn->Select($sql))
        conn_mostra_erro();
      else
        return $rs->GetField("qt_dia_semana");
    }
    else
      return $sql;
  }

  /* função que seta o width em arr_campo a partir do width de arr_label */
  function seta_width_arr_campo()
  {
    global $arr_campo, $arr_label;

    $i = 0;
    foreach($arr_label AS $arr)
    {
      $arr_campo[$i++]["width"] = $arr["width"];
    }
  }

  /* seta a borda para todos os campos para os testes */
  function seta_borda_rel_arr(&$arr)
  {

    for ($i=0; $i< count($arr); $i++)
    {
      $arr[$i]["border"] = 1;
    }
  }
  
  /*
  $sql_dados: deve conter 3 campos: 
              -> identificador: ex: cliente, produto. Deve ser um só, caso necessite de mais concatene
              -> coluna: campo que virará coluna. Exemplo Mês.
              -> valor: é o valor em si
  $sql_colunas: representa as opções que podem aparecer no campo coluna do sql dos dados. Este SQL deve retornar os mesmos valores (no mesmo formato) que retorna no campo coluna do sql_dados 
  $label_identificador: label que aparecerá no identificador
  $tipo_identificador: é o tipo do campo identificador. Ex: INTEGER, TEXT, etc.
  $tipo_valor: é o tipo do campo valor. Ex: INTEGER, TEXT, NUMERIC, etc. 
  $into: se quiser criar uma temporaria

  OBS: Coloque 1 aspa simples apenas que a função adiciona a outra aspa
  */
  function obtem_sql_crosstab($sql_dados, $sql_colunas, $label_identificador, $tipo_identificador, $tipo_valor, $into = "")
  {
    global $conn;

    if ($rs = $conn->Select($sql_colunas))
    {
      if (!$rs->GetRowCount())
        return;

      $sql_definicao = "($label_identificador $tipo_identificador"; 
      while(!$rs->IsEof())
      {
        $sql_definicao .= ", \"" . $rs->GetField(0) . "\" $tipo_valor";
        $rs->Next();
      }

      $sql_definicao .= ")";

      //adiciona mais uma aspa
      $sql_dados = str_replace("'", "''", $sql_dados);
      $sql_colunas = str_replace("'", "''", $sql_colunas);

      return "SELECT * $into FROM CROSSTAB('$sql_dados', '$sql_colunas') AS campos $sql_definicao ";
    }
    else
      conn_mostra_erro();
  }
  
  function verifica_fields_sql($sql, $arr_vars)
  {
    global $conn;

    $id_ok        = true;
    $t_html       = "";
    $tmp_anterior = "";

    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        while(!$rs->IsEof())
        {
          foreach ($arr_vars AS $value)
          {
            if (!str_value($rs->GetField($value["field"])))
            {
              // Monta o link para o arquivo
              $arr_retorno = $value["return"];
              $ds_retorno = "";
              foreach ($arr_retorno AS $key_ret => $value_ret)
                $ds_retorno .= "&$key_ret=" . $rs->GetField($value_ret);

              if ($tmp_anterior != $value["file"] || $tmp_ds_retorno != $ds_retorno)
              {
                $t_html .= "<BR><a href=\"#\" onClick=\"window.open('".$value["file"]."?f_id_retorno=997$ds_retorno','".
                           $value["file"]."',".
                           "'width=800,height=600,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,".
                           "location=no');\">".$value["file_label"]."</a><BR>";

                $tmp_anterior = $value["file"];
                $tmp_ds_retorno = $ds_retorno;
              }
              // ---------------------------

              $t_html .= $value["field_label"]."<BR>";
              $id_ok = false;
            }
          }

          $rs->Next();
        }
      }
    }
    else
      conn_mostra_erro();

    if (!$id_ok)
    {
      $title = "Atenção os seguintes campos devem estar setados para prosseguir:";
      $html = new JHtml($title);
      $html->AddHtml("<p>$title<BR>$t_html</p>");
      echo $html->GetHtml();
      exit();
    }
  }
  
  
  function formata_data_mes($val)
  {
    $data = Format_Date($val, "sys", "pt_BR");
    return substr($data, 3);
  }

  function valida_permissao_funcao($ds_funcao, $permissao = "select")
  {
    global $conn;

    $auth = new JDBAuth($conn);
    $auth->SetScript("fun_$ds_funcao.php");

    switch ($permissao)
    {
      case "update": return $auth->CanUpdate();
      case "delete": return $auth->CanDelete();
      case "insert": return $auth->CanInsert();
      case "select": return $auth->CanSelect();
    }
  }
  
  function obtem_parametro($tabela, $parametro)
  {
    global $conn;

    $sql = "SELECT $parametro
              FROM $tabela ";

    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    elseif ($rs->GetRowCount())
    {
      $parametro = $rs->GetField(0);

      if (empty($parametro))
        return false;
      else
        return $parametro;
    }

    return false;
  }

  function verifica_hierarquia_tipo_pagamento()
  {
    global $conn, $cd_pessoa_matriz, $cd_cliente, $cd_pedido;

    $t_cd_pedido  = (is_object($cd_pedido))        ? $cd_pedido->GetValue()        : $cd_pedido;
    $t_cd_cliente = (is_object($cd_cliente))       ? $cd_cliente->GetValue()       : $cd_cliente;
    $t_cd_matriz  = (is_object($cd_pessoa_matriz)) ? $cd_pessoa_matriz->GetValue() : $cd_pessoa_matriz;

    if ($t_cd_cliente)
    {
      $sql = "SELECT cf.nr_hierarquia_tipo_pagamento AS nr_hierarquia
                FROM cliente_financeiro cf
               WHERE cf.cd_pessoa = '$t_cd_cliente'
                 AND cf.cd_pessoa_grupo IN (SELECT cd_pessoa FROM empresa_contabil)
                 AND cf.cd_pessoa_grupo = '$t_cd_matriz'";

      if (!$rs_h = $conn->Select($sql))
        conn_mostra_erro();
      elseif ($rs_h->GetField("nr_hierarquia") == 5)
        return true;
    }

    if ($t_cd_pedido)
    {
      $sql = "SELECT tp.nr_hierarquia
                FROM pedido p
                JOIN tipo_pagamento tp USING (cd_tipo_pagamento)
               WHERE p.cd_pedido = '$t_cd_pedido' ";

      if (!$rs_h = $conn->Select($sql))
        conn_mostra_erro();
      elseif ($rs_h->GetField("nr_hierarquia") == 5)
        return true;
    }

    return false;
  }

  function quebra_linha_arquivo(&$arq)
  {
    fwrite($arq, "\n");
  }

  function espacamento_arquivo(&$arq, $esp, $qt)
  {
    for ($i=0;$i<$qt;$i++)
      $espacamento .= $esp;

    fwrite($arq, $espacamento);
  }

  // função de cálculo do Módulo 11
  function calcula_modulo_11($var)
  {
    $tamanho = strlen($var) -1;
    $soma    = 0 ;
    $fator   = 1 ;                                                                                                                           
    settype($tamanho, "integer");

    while ($tamanho >= 0)
    {
      if ($fator < 9)
        $fator++;
      else
        $fator = 2;

      $soma += (substr($var, $tamanho, 1) * $fator) ;
 
      $tamanho--;
    }

    $mod11 = bcmod($soma, 11);

    if ($mod11 > 1)
     $mod11 = 11 - $mod11;
    else
     $mod11 = 0;

    return $mod11;
  }

  function verifica_mes_fechado_pessoa($cd_pessoa, $dt_mes, $cd_caixa = null)
  {
    global $conn, $msg_erro;

    inicio_fim_mes($dt_mes, $dt_inicio, $dt_final);

    // Verifica data do caixa
    if ($cd_caixa != null)
    {
      $sql = "SELECT COUNT(*)
                FROM caixa
               WHERE cd_caixa = $cd_caixa
                 AND dt_documento >= '$dt_inicio'::DATE
                 AND dt_documento <= '$dt_final'::DATE";
      if ($rs = $conn->Select($sql))
      {
        // Caixa não é do mês que está sendo inserido
        if (!$rs->GetField(0))
        {
          $msg_erro .= "Erro: Caixa não é referente ao mês informado. ";
          return 1;
        }
      }
      else
        conn_mostra_erro();
    }

    $sql = "SELECT p.cd_pessoa || ' / ' || p.nm_pessoa AS nm_pessoa,
                   (CASE WHEN (p.dt_ultimo_fechamento_salario >= '$dt_inicio'::DATE)
                      THEN 1
                      ELSE 0
                    END) AS id_fechado
              FROM pessoa p
             WHERE p.cd_pessoa = $cd_pessoa ";

    if ($rs = $conn->Select($sql))
    {
      $id_fechado = $rs->GetField("id_fechado");
      $nm_pessoa  = $rs->GetField("nm_pessoa");

      if ($id_fechado)
        $msg_erro .= "Erro: Mês ($dt_mes) já fechado para pessoa $nm_pessoa. ";

      return $id_fechado;
    }
    else
      conn_mostra_erro();
  }

  /*
   * Se o usuário possuir mais de um caixa financeiro retorna verdadeiro
   */
  function verifica_qt_caixa_financeiro_usuario($cd_usuario)
  {
    global $conn;
    
    $sql = "SELECT COUNT(*) AS qt_caixa_financeiro_usuario
              FROM caixa_financeiro_usuario
             WHERE cd_pessoa    = $cd_usuario
               AND id_principal = 1 ";

    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    elseif ($rs->GetField("qt_caixa_financeiro_usuario") != 1)
      return true;

    return false;
  }

  function verifica_cadastro_cliente_na_sefaz($cd_pessoa, $cd_cliente_situacao, $id_testa_tipo = true)
  {
    global $conn;

    // Verifica se a situacao que esta sendo inserida ou atualizada para o cliente e do tipo normal
    $sql = "
      SELECT cs.id_tipo
        FROM cliente_situacao cs
       WHERE cs.cd_cliente_situacao = $cd_cliente_situacao ";

    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    elseif ($rs->GetRowCount() and ($rs->GetField(0) == 2 or !$id_testa_tipo)) // se for verifica na sefaz
    {
      $sql = "
        SELECT pf.nr_cpf, pj.nr_cnpj, pj.nr_ie, p.cd_pessoa
          FROM cliente             cli 
          JOIN pessoa                p ON   p.cd_pessoa = cli.cd_pessoa
          JOIN endereco              e ON e.cd_endereco = (SELECT e_.cd_endereco
                                                             FROM endereco e_
                                                            WHERE e_.cd_pessoa = p.cd_pessoa
                                                            ORDER BY e_.id_tipo_endereco
                                                            LIMIT 1)
          JOIN cep                  cp ON      e.cd_cep = cp.cd_cep
          JOIN cidade               ci ON  ci.cd_cidade = p.cd_cidade
          JOIN uf                   uf ON      ci.cd_uf = uf.cd_uf
          LEFT JOIN pessoa_fisica   pf ON  pf.cd_pessoa = p.cd_pessoa
          LEFT JOIN pessoa_juridica pj ON  pj.cd_pessoa = p.cd_pessoa
         WHERE cli.cd_pessoa = $cd_pessoa ";
    
      if (!$rs = $conn->Select($sql))
	      conn_mostra_erro();
      elseif ($rs->GetRowCount())
      {
        $soapNfe = new soapNfe($conn);
        $soapNfe->setaDebug(0);
        	
        if (str_value($rs->GetField("nr_ie")))
        {
          $nr_busca = $rs->GetField("nr_ie");
          $ds_busca = "IE";
        }
        elseif (str_value($rs->GetField("nr_cnpj")))
        {
          $nr_busca = $rs->GetField("nr_cnpj");
          $ds_busca = "CNPJ";
        }
        elseif (str_value($rs->GetField("nr_cpf")))
        {
          $nr_busca = $rs->GetField("nr_cpf");
          $ds_busca = "CPF";
        }

        $obj = $soapNfe->nfeConsultaCadastro(43, $nr_busca, $ds_busca, true);

        if ($obj->infCons->cStat == 111 || $obj->infCons->cStat == 112)
        {
          $id_problema = false;
          
          foreach ($obj->infCons->infCad as $infCad)
          {
            /* no sistema, pessoa física não possui ie então verifica o município do cliente e se houver
               pelo menos uma situação favorável não cancela o cadastro */
            if ($ds_busca != "CPF")
            {
              if ($infCad->cSit == "0")
              {
                if ($ds_busca == "IE" && $infCad->IE == $nr_busca)
                {
                  $id_problema = true;
                  break;
                }
                elseif ($ds_busca == "CNPJ" && $infCad->CNPJ == $nr_busca && $rs->GetField("nr_ie") == $infCad->IE)
                {
                  $id_problema = true;
                  break;
                }
              }
            }
            elseif ($infCad->CPF == $nr_busca && $rs->GetField("nr_ibge_cidade") == $infCad->ender->cMun)
            {
              if ($infCad->cSit == "0")
                $id_problema = true;
              elseif ($infCad->cSit == "1" && $id_problema)
              {
                $id_problema = false;
                break;
              }
            }
          }

          if ($id_problema)
          {
            $sql_sit = "
              SELECT COUNT(1) AS qt_registro
                FROM historico_situacao_cliente 
               WHERE cd_pessoa = {$rs->GetField("cd_pessoa")}
                 AND cd_cliente_situacao = {$_SESSION["s_cd_cliente_situacao_problema_sefaz"]} 
                 AND dt_resolucao IS NULL ";

            if (!$rs_sit = $conn->Select($sql_sit))
              conn_mostra_erro();
            elseif (!$rs_sit->GetField("qt_registro"))
            {
              $values = array("cd_cliente_situacao" => $_SESSION["s_cd_cliente_situacao_problema_sefaz"],
                              "cd_pessoa_historico" => $_SESSION["s_cd_usuario"],
                              "cd_pessoa"           => $rs->GetField("cd_pessoa"));
              
              if (!$conn->Insert("historico_situacao_cliente", $values))
                conn_mostra_erro();
            }  
          }
        }
      }
    }
  }
  
  function mostrarStackTrace(Exception $e)
  {
    $msg = PHP_EOL . "---" . PHP_EOL;
    $trace = $e->getTrace();
    $msg .= $e->getMessage();
    $msg .= PHP_EOL . "Causado por: " . PHP_EOL;
    $msg .= $e->getFile().":".$e->getLine() . PHP_EOL;
    $msg .= "Stacktrace: " . PHP_EOL;

    foreach ($trace as $value)
    {
      if (!str_value($value["file"])) continue;
      $msg .= $value["file"].":" . (int)$value["line"];
      $msg .= PHP_EOL;
    }

    $msg = str_replace("/var/www", "", $msg);
    $msg = str_replace("/home/www", "", $msg);
    $msg .= "---" . PHP_EOL;
    return nl2br($msg);
  }
  
  //IFrame criado para buscar nome ou descrição. Usado apenas em campos Código/Nome
  //Deve ser usado juntamente com a função ifr_busca_nome() logo abaixo para facilitar.
  //Exemplo no arquivo fil_ctrc_geracao.php
  //Já criada função para buscar nome da pessoa ifr_busca_nome_pessoa()
  $js_iframe_busca_nome = "
    function ifr_busca_nome(nm_campo_codigo, nm_campo_descricao, nm_campo, id_document_type, nm_tabela, ds_codigo, id_tipo, extra_where)
    {
      cd_codigo = eval('document.'+ id_document_type +'.f_' + nm_campo_codigo + '.value');

      if (cd_codigo != '')
      {
        abre_iframe('include/ifr_busca_nome.inc.php?f_cd_codigo='          +  cd_codigo           +
                                                  '&f_nm_campo='           +  nm_campo            +
                                                  '&f_id_document_type='   +  id_document_type    +
                                                  '&f_nm_tabela='          +  nm_tabela           +
                                                  '&f_ds_codigo='          +  ds_codigo           +
                                                  '&f_nm_campo_descricao=' +  nm_campo_descricao  +
                                                  '&f_nm_campo_codigo='    +  nm_campo_codigo     +
                                                  '&f_id_tipo='            +  id_tipo             +
                                                  '&f_ds_extra_where='     + extra_where);
      }
      else
      {
        if(nm_campo_descricao != '')
        {
          ds_campo =  eval('document.'+ id_document_type +'.f_' + nm_campo_descricao);
          ds_campo.value = '';
        }
      }
    }
  ";

  function ifr_busca_nome($ds_campo, $nm_campo, $id_document_type, $nm_tabela, $ds_codigo, $id_tipo=false, $ds_prefixo_campo="nm_", $extra_where="")
  {
    global $$ds_campo, $js;
        
    $$ds_campo->SetEvents("onChange", "ifr_busca_nome");
    $$ds_campo->SetParameters("ifr_busca_nome", "$ds_campo");
    $ds_campo_descricao = str_replace("cd_", "$ds_prefixo_campo", $ds_campo);
    $$ds_campo->SetParameters("ifr_busca_nome", "$ds_campo_descricao");
    $$ds_campo->SetParameters("ifr_busca_nome", "$nm_campo");
    $$ds_campo->SetParameters("ifr_busca_nome", "$id_document_type");
    $$ds_campo->SetParameters("ifr_busca_nome", "$nm_tabela");
    $$ds_campo->SetParameters("ifr_busca_nome", "$ds_codigo");
    $$ds_campo->SetParameters("ifr_busca_nome", "$id_tipo");
    $$ds_campo->SetParameters("ifr_busca_nome", "$extra_where");  
  }
  
  function abre_iframe()
  {
    $frame_options = array("height"    => "0",
                           "width"     => "0",
                           "scrolling" => "no");
    $iframe_generico = OpenIframe("iframe_generico", "", $frame_options);

    $js .= "
    <script language=\"javascript\" type=\"text/javascript\">

      function abre_iframe(endereco)
      {
        $.ajax({
          async: false,
          url: endereco,
          cache: false,
          type: 'POST',
          data: '&jQuery=0',
          beforeSend: function(){
            $('#loading_iframe').modal(
            {
              close:     false,
              opacity:   30,
              maxHeight: screen.availHeight - 50,
              maxWidth:  screen.availWidth - 300,
              autoResize: true,
              overlayCss:
              {
                backgroundColor:'#000'
              }
            });
            $(window).trigger('resize.simplemodal');
          },
          success: function(dat){
            $('iframe[name=iframe_generico]').html(dat);
            $.modal.close();
          }
        });
      }

    </script>
    ";

    $html = "
      <div id=\"loading_iframe\" style=\"display:none;\">
      <img src=\"img/load.gif\" width=\"20\" height=\"20\">
      </div>
    ";

    return $html . $iframe_generico . $js;
  }
  
  /*
   * Para funcionar o pop deve funcionar com as funções abaixo:
   *  parent.pop_up_back_uf(cd_uf, nm_uf, ds_sigla, nm_campo);
   *  parent.close_pop();
   * TODO: testar quando abre uma manutenção dentro do pop para inserir registro novo
   */
  function abre_pop()
  {
    $js .= "
    <script language=\"javascript\" type=\"text/javascript\">
      function abre_pop(endereco, hideclose, onClose, onCloseArgs)
      {
        option = {width: window.innerWidth * 0.5,
                  height: window.innerHeight * 0.7,
                  modal: true,
                  autoOpen: false,
                  draggable: false,
                  resizable: false,
                  closeOnEscape: false,
                  closeText: 'hide'};
        $('#pop_dialog').dialog(option);
        $('#pop_dialog').dialog({
          open: function(event, ui) {
            $('#iframe').attr('src', endereco + '&f_modal=true');

            if ($('#loading').is(':visible'))
              $.modal.close();

            if (hideclose)
            {
              $('.ui-dialog-titlebar-close').hide();
              $('#close_pop').hide();
            }
            else
            {
              $('.ui-dialog-titlebar-close').show();
              $('#close_pop').show();
            }
          },
          close: function() {
            $('#iframe').attr('src', '').html('');

            if (typeof onClose == 'function')
              onClose(onCloseArgs);
          }
        });
        $('#pop_dialog').dialog('open');
      }

      function close_pop()
      {
        $('#pop_dialog').dialog('close');
      }
    </script>
    ";

    $html = "
      <div id=\"pop_dialog\" style=\"display:none;\"><table width=\"100%\" height=\"100%\">
      <tr><td colspan=\"3\">&nbsp;</td></tr>
      <tr width=\"100%\" height=\"100%\"><td>&nbsp;&nbsp;&nbsp;</td><td align=\"center\"><iframe id=\"iframe\" width=100% height=100% frameborder=\"no\" src=\"\" ></iframe></td><td>&nbsp;&nbsp;&nbsp;</td></tr>
      <tr><td colspan=\"3\">&nbsp;</td></tr>
      <tr><td colspan=\"3\" align=\"center\">&nbsp;<a id=\"close_pop\" href=\"javascript:void(0);\" onClick=\"close_pop()\">Fechar</a>&nbsp;</td>
      </table></div>
    ";

    return $html . $js;
  }
  
  function limpa_dados($val)
  {
    $codes   = array(",", ".", "-", "/", "\\", "&");
    $decodes = array("",  "",  "",  "",  "",   "");
    
    return str_replace($codes, $decodes, $val);
  }

  function define_cd_pessoa_busca_nome($cd_pessoa)
  {
    global $conn;

    $cd_pessoa = call_user_func("limpa_dados", $cd_pessoa);

    if (strlen($cd_pessoa) == 11)
    {
      $where = "(SELECT p.cd_pessoa
                  FROM pessoa p
                  JOIN pessoa_fisica pf ON pf.cd_pessoa = p.cd_pessoa
                 WHERE pf.nr_cpf = '$cd_pessoa'
                 ORDER BY p.cd_pessoa
                 LIMIT 1)";
    }
    elseif (strlen($cd_pessoa) == 14)
    {
      $where = "(SELECT p.cd_pessoa
                   FROM pessoa p
                   JOIN pessoa_juridica pj ON pj.cd_pessoa = p.cd_pessoa
                  WHERE pj.nr_cnpj = '$cd_pessoa'
                  ORDER BY p.cd_pessoa
                  LIMIT 1)";
    }
    else
      $where = "$cd_pessoa";

    return $where;
  }
  
  function obtem_objetivo_visita_campo($dt_visita, $cd_vendedor, $arr_pessoa)
  {
    global $conn, $arr_valores_venda, $arr_quantidade_realizada;
        
    if (!str_value($dt_visita) || !str_value($cd_vendedor) || (!is_array($arr_pessoa) || !sizeof($arr_pessoa)))
      return;
   
    //Define operações de DEVOLUÇÃO
    //Inclui como devolução também a operação de ESTORNO
    $arr_operacao_dev = array();
    $arr_operacao_dev[] = $_SESSION["s_cd_operacao_devolucao"];
    $arr_operacao_dev[] = $_SESSION["s_cd_operacao_estorno"];

    define("TMP_FINANCEIRO", "tmp_vendedor_obj_finan_acum_" . $_SESSION["s_cd_usuario"] . "_" . date("Ymd_His"));
    define("TMP_QUANTIDADE", "tmp_vendedor_obj_quant_acum_" . $_SESSION["s_cd_usuario"] . "_" . date("Ymd_His"));
    define("CD_PESSOA_MELITTA", 18002); // cd_pessoa_matriz da Melitta

    $from = 
      " FROM pedido p
        JOIN operacao         o ON o.cd_operacao = p.cd_operacao
        JOIN produto_pedido  pp ON  pp.cd_pedido = p.cd_pedido
        JOIN produto         pr ON pr.cd_produto = pp.cd_produto
        JOIN produto_venda  prv ON pr.cd_produto = prv.cd_produto
        JOIN parametro_geral_empresa_grupo pge ON pge.cd_pessoa = p.cd_pessoa_matriz
        JOIN vendedor_hierarquia_completa   vh ON vh.cd_vendedor_subordinado = p.cd_vendedor
        JOIN pessoa_vendedor                pv ON vh.cd_vendedor = pv.cd_vendedor
                                              AND pv.cd_pessoa_vendedor = (SELECT pv2.cd_pessoa_vendedor
                                                                             FROM pessoa_vendedor pv2
                                                                            WHERE pv2.cd_vendedor = vh.cd_vendedor
                                                                              AND (pv2.dt_termino >= p.dt_pedido OR pv2.dt_termino IS NULL)
                                                                              AND pv2.dt_inicio <= p.dt_pedido
                                                                            ORDER BY pv2.dt_inicio DESC
                                                                            LIMIT 1)
        JOIN carga        c ON  c.cd_carga = p.cd_carga
        JOIN carga_saida cs ON cs.cd_carga = c.cd_carga ";
    
    $from_grupo = 
      " JOIN grupo_ligacao_completa glc       ON glc.cd_grupo_filho = pr.cd_grupo
        JOIN grupo_produto gp                 ON        gp.cd_grupo = glc.cd_grupo
        JOIN grupo_produto_empresa_grupo gpeg ON     gpeg.cd_pessoa = pge.cd_pessoa
                                             AND      gpeg.cd_grupo = gp.cd_grupo ";
    
    $from_ligacao = 
      " JOIN grupo_ligacao_completa       glc ON glc.cd_grupo_filho = pr.cd_grupo 
        JOIN grupo_produto_empresa_grupo gpeg ON     gpeg.cd_pessoa = pge.cd_pessoa
                                             AND gpeg.cd_grupo = glc.cd_grupo ";
    
    $where_normal = 
      " WHERE o.id_sintegra = 1
          AND p.id_situacao > 0 
          AND p.dt_pedido = '$dt_visita'
          AND vh.cd_vendedor = '$cd_vendedor' ";
    
    $where_venda = 
      " AND o.id_tipo  = 2
        AND o.id_venda = 1 ";

    $where_operacao = 
      " AND ((o.id_tipo = 2 AND o.id_venda = 1)
             OR o.cd_operacao IN (" . implode(",", $arr_operacao_dev) . ")
             OR o.cd_operacao = '" . $_SESSION["s_cd_operacao_bonificacao"] ."') ";
    
    $where_faturado = 
      " AND p.dt_faturado >= '$dt_visita' ";
    
    $where_pedido = 
      " AND p.dt_faturado IS NULL
        AND p.dt_pedido = '$dt_visita'
        AND (cs.dt_saida::DATE < ('$dt_visita'::DATE + CASE WHEN p.cd_pessoa_matriz::TEXT = '" . CD_PESSOA_MELITTA . "'
                                                         THEN INTERVAL '10 DAYS'
                                                         ELSE INTERVAL '1 DAY'
                                                    END)::DATE
             OR
             CASE WHEN cs.dt_saida::DATE >= ('$dt_visita'::DATE + INTERVAL '1 DAY')::DATE AND
                   EXTRACT(DOW FROM cs.dt_saida::DATE) = 1 AND
                   (cs.dt_saida::DATE - INTERVAL '3 DAYS')::DATE < '$dt_visita'::DATE
               THEN TRUE
               ELSE FALSE
             END) ";
    
    $where_pessoa = restricao_where("AND", "p.cd_pessoa", "IN", implode(",", $arr_pessoa), false, true);
    
    ##############################################
    ############# VENDAS REALIZADAS ##############
    ##############################################
    $arr_valores_venda = array();
    
    $sql  = "(SELECT p.cd_pessoa,
                     SUM(pp.vl_total) - ROUND(SUM(obtem_vl_desconto_pedido(p.cd_pedido, 1)), 2) AS vl_nota_fiscal,
                     0 AS vl_pedido,
                     0 AS vl_devolucao,
                     0 AS vl_retorno
                INTO TEMPORARY " . TMP_FINANCEIRO . "
               $from
               $from_grupo
               $where_normal
               $where_venda
               $where_pessoa
               AND gpeg.id_objetivo_financeiro > 0
               $where_faturado
               GROUP BY 1)

             UNION
            
             (SELECT p.cd_pessoa, 
                     0 AS vl_nota_fiscal,
                     SUM(pp.vl_total) - ROUND(SUM(obtem_vl_desconto_pedido(p.cd_pedido, 1)), 2) AS vl_pedido,
                     0 AS vl_devolucao,
                     0 AS vl_retorno
               $from
               $from_grupo
               $where_normal
               $where_venda
               $where_pessoa
               AND gpeg.id_objetivo_financeiro > 0
               $where_pedido
               GROUP BY 1)

             UNION
            
             (SELECT p.cd_pessoa,
                     0 AS vl_nota_fiscal,
                     0 AS vl_pedido,
                     SUM(pp.vl_total) AS vl_devolucao,
                     0 AS vl_retorno
               $from
               $from_grupo
               $where_normal
               $where_pessoa
               AND o.cd_operacao IN (" . implode(",", $arr_operacao_dev) . ")
               AND gpeg.id_objetivo_financeiro > 0
               AND p.cd_pedido_origem IS NULL
               $where_faturado
               GROUP BY 1)

             UNION

             (SELECT p.cd_pessoa, 
                     0 AS vl_nota_fiscal,
                     0 AS vl_pedido,
                     0 AS vl_devolucao,
                     SUM(pp.vl_total) AS vl_retorno
               $from
               $from_grupo
               $where_normal
               $where_pessoa
               AND o.cd_operacao IN (" . implode(",", $arr_operacao_dev) . ")
               AND gpeg.id_objetivo_financeiro > 0
               AND p.cd_pedido_origem IS NOT NULL
               $where_faturado
               GROUP BY 1) ";
    
    if (!$conn->Execute($sql))
      conn_mostra_erro();
    
    $sql = "SELECT cd_pessoa,
                   SUM(vl_nota_fiscal) AS vl_nota_fiscal,
                   SUM(vl_pedido) AS vl_pedido,
                   SUM(vl_devolucao) AS vl_devolucao,
                   SUM(vl_retorno) AS vl_retorno
              FROM " . TMP_FINANCEIRO . "
             GROUP BY 1 ";
    
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    else
    {
      if ($rs->GetRowCount())
      {
        while (!$rs->IsEof())
        {
          $arr_valores_venda[$rs->GetField("cd_pessoa")] = 
            Format_Number($rs->GetField("vl_nota_fiscal") + $rs->GetField("vl_pedido") - $rs->GetField("vl_devolucao") - $rs->GetField("vl_retorno"), 2, "sys", "pt_BR");
          
          $rs->Next();
        }
      }
    }
    
    ##############################################
    ################# QUANTIDADE #################
    ##############################################
    $arr_quantidade_realizada = array();
    
    $sql  =            
      "(SELECT (CASE WHEN gpeg.id_objetivo_quantidade = 1 THEN gpeg.cd_grupo
                     WHEN gpeg.id_objetivo_quantidade = 2 THEN pge.cd_grupo_objetivo_caixa
                END) AS cd_grupo,
               COALESCE(ROUND(SUM(pp.qt_faturada * obtem_quantidade(pp.cd_produto, pp.cd_unidade) *
                        COALESCE(prv.vl_conversao_objetivo, 1) / prv.qt_unitaria_caixa::numeric), 2), 0) AS qt_caixa_nf,
               0 AS qt_caixa_ped,
               0 AS qt_caixa_dev 
         $from
         $from_ligacao
         $where_normal
         $where_venda
         AND gpeg.id_objetivo_quantidade > 0
         $where_faturado
         GROUP BY 1)
            
       UNION
            
       (SELECT (CASE WHEN gpeg.id_objetivo_quantidade = 1 THEN gpeg.cd_grupo
                     WHEN gpeg.id_objetivo_quantidade = 2 THEN pge.cd_grupo_objetivo_caixa
                END) AS cd_grupo,
               0 AS qt_caixa_nf,
               COALESCE(ROUND(SUM(pp.qt_faturada * obtem_quantidade(pp.cd_produto, pp.cd_unidade) *
                         COALESCE(prv.vl_conversao_objetivo, 1) / prv.qt_unitaria_caixa::numeric), 2), 0) AS qt_caixa_ped,
               0 AS qt_caixa_dev 
         $from
         $from_ligacao
         $where_normal
         $where_venda
         AND gpeg.id_objetivo_quantidade > 0
         $where_pedido
         GROUP BY 1)

       UNION

       (SELECT (CASE WHEN gpeg.id_objetivo_quantidade = 1 THEN gpeg.cd_grupo
                     WHEN gpeg.id_objetivo_quantidade = 2 THEN pge.cd_grupo_objetivo_caixa
                END) AS cd_grupo,
               0 AS qt_caixa_nf,
               0 AS qt_caixa_ped,
               COALESCE(ROUND(SUM(pp.qt_faturada * obtem_quantidade(pp.cd_produto, pp.cd_unidade) *
               COALESCE(prv.vl_conversao_objetivo, 1) / prv.qt_unitaria_caixa::numeric), 2), 0) AS qt_caixa_dev 
         $from
         $from_ligacao
         $where_normal
         AND o.cd_operacao IN (" . implode(",", $arr_operacao_dev) . ")  
         AND gpeg.id_objetivo_quantidade > 0
         $where_faturado
         GROUP BY 1) ";
        
    $sql = 
      "SELECT t.cd_grupo,
              SUM(t.qt_caixa_nf) AS qt_caixa_nf,
              SUM(t.qt_caixa_ped) AS qt_caixa_ped,
              SUM(t.qt_caixa_dev) AS qt_caixa_dev
         FROM ($sql) AS t
        GROUP BY 1 ";
    
    if (!$rs = $conn->Select($sql))
      conn_mostra_erro();
    {
      if ($rs->GetRowCount())
      {
        while (!$rs->IsEof())
        {
          $qt_caixa_nf  = $rs->GetField("qt_caixa_nf");
          $qt_caixa_ped = $rs->GetField("qt_caixa_ped");
          $qt_caixa_dev = $rs->GetField("qt_caixa_dev");
          $qt_caixa     = $qt_caixa_nf + $qt_caixa_ped - $qt_caixa_dev;
          
          $arr_quantidade_realizada[$rs->GetField("cd_grupo")]["qt_realizada"] = $qt_caixa;
          $rs->Next();
        }
      }
    }
    
    ############################################
    ############### OBJ. QUANTIDADE ############
    ############################################
    
    $arr_dt_visita = explode("-", $dt_visita);
    $dt_inicio     = substr($dt_visita, 0, 7) . "-01";
    $dt_termino    = date("Y-m-d", mktime(0, 0, 0, $arr_dt_visita[1] + 1, 0, $arr_dt_visita[0]));
            
    $sql = 
      "SELECT cd_grupo,
              ROUND(qt_cliente_objetivo / (" . busca_dias_uteis($dt_inicio, $dt_termino, $_SESSION["s_cd_pessoa_filial"]) . ")::NUMERIC, 2) AS qt_objetivo
         FROM vendedor_objetivo_quantidade voq
        WHERE qt_cliente_objetivo > 0 " .
          restricao_where("AND", "cd_vendedor", "=", $cd_vendedor, "'") .
          restricao_where("AND", "dt_mes",      "=", $dt_inicio,   "'");
    
    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        while (!$rs->IsEof())
        {
          $arr_quantidade_realizada[$rs->GetField("cd_grupo")]["qt_objetivo"] = $rs->GetField("qt_objetivo");
          $rs->Next();
        }
      }
    }
    else
      conn_mostra_erro();
  }
  
  function verifica_manifesto_nao_inserido($nr_chave_nfe, $nr_cnpj, $tp_evento)
  {
    global $conn;
    
    if (!str_value($nr_chave_nfe) || !str_value($nr_cnpj) || !str_value($tp_evento))
      return;
    
    $sql = 
      "SELECT *
         FROM manifesto_destinatario_nao_inserido
        WHERE TRUE " .
          restricao_where("AND", "nr_chave_nfe", "=", $nr_chave_nfe, "'").
          restricao_where("AND", "nr_cnpj",      "=", $nr_cnpj,      "'").
          restricao_where("AND", "tp_evento",    "=", $tp_evento,    "'");
    
    if ($rs = $conn->Select($sql))
      return ($rs->GetRowCount() ? true : false);
    else
      conn_mostra_erro();
  }
  
  function calcula_horario_total($dt_inicial, $dt_final)
  {
    if (!str_value($dt_inicial) || !str_value($dt_final) ||
        $dt_inicial == "NULL" || $dt_final == "NULL")
      return;
   
    //Calcula qt horas
    $arr_dt_inicial = explode("-", substr($dt_inicial,     0, 10));
    $arr_dt_final   = explode("-", substr($dt_final, 0, 10));

    $arr_hr_inicial = explode(":", substr($dt_inicial,     11, 8));
    $arr_hr_final   = explode(":", substr($dt_final, 11, 8));
                
    $dt_inicio = mktime($arr_hr_inicial[0], $arr_hr_inicial[1], 0,     
                        $arr_dt_inicial[1], $arr_dt_inicial[2], $arr_dt_inicial[0]);

    $dt_final  = mktime($arr_hr_final[0], $arr_hr_final[1], 0, 
                        $arr_dt_final[1], $arr_dt_final[2], $arr_dt_final[0]);
                                                    
    $qt_tempo_total = ($dt_final - $dt_inicio);
    
    $qt_horas_total = ($qt_tempo_total / 60) / 60;
    $qt_horas       = floor($qt_horas_total);

    $qt_minutos_total = ($qt_horas_total - $qt_horas) * 60;
    $qt_minutos       = floor($qt_minutos_total);
    
    $qt_segundos =  0;
    
    $ds_hora_total = str_pad($qt_horas,    2, "0", STR_PAD_LEFT) . ":" . 
                     str_pad($qt_minutos,  2, "0", STR_PAD_LEFT) . ":" .
                     str_pad($qt_segundos, 2, "0", STR_PAD_LEFT);
                     
    return $ds_hora_total;
  }
  
  function remove_acentuacao($str)
  {
    if (!str_value($str))
      return;
    
    $arr = array("Á" => "A", "Ã" => "A", "À" => "A", "Â" => "A", "Ä" => "A",
                 "É" => "E", "È" => "E", "Ê" => "E", "Ë" => "E",
                 "Í" => "I", "Ì" => "I", "Î" => "I", "Ï" => "I",
                 "Ó" => "O", "Õ" => "O", "Ò" => "O", "Ô" => "O", "Ö" => "O",
                 "Ú" => "U", "Ù" => "U", "Û" => "U", "Ü" => "U",
                 "Ç" => "C",
                 "á" => "a", "ã" => "a", "à" => "a", "â" => "a", "ä" => "a",
                 "é" => "e", "è" => "e", "ê" => "e", "ë" => "e",
                 "í" => "i", "ì" => "i", "î" => "i", "ï" => "i",
                 "ó" => "o", "õ" => "o", "ò" => "o", "ô" => "o", "ö" => "o",
                 "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u",
                 "ç" => "c");
    
    return strtr($str, $arr);
  }
  
  function obtem_pedido_situacao($id_tipo = null)
  {
    $sql = 
      "SELECT cd_pedido_situacao AS value,
              (CASE id_tipo
                 WHEN 0 THEN 'CANCELADO' 
                 WHEN 1 THEN 'PENDENTE' 
                 WHEN 2 THEN 'NORMAL' 
               END) ||' - ' || ds_pedido_situacao AS description
         FROM pedido_situacao
        WHERE TRUE " .
        restricao_where("AND", "id_tipo", "=", $id_tipo, "'");
    
    return obtem_pesquisa($sql);
  }

  function obtem_matriz_usuario($cd_pessoa_usuario = null)
  {
    global $conn;

    if (!str_value($cd_pessoa_usuario))
      $cd_pessoa_usuario = $_SESSION["s_cd_usuario"];

    if (str_value($cd_pessoa_usuario))
    {
      $sql = 
        "SELECT f.cd_pessoa AS cd_pessoa_matriz
           FROM filial f
           JOIN usuario u ON u.cd_pessoa_ligacao = f.cd_pessoa_filial
          WHERE u.cd_pessoa = '$cd_pessoa_usuario' ";
      
      if ($rs = $conn->Select($sql))
        return $rs->GetField("cd_pessoa_matriz");
      else
        conn_mostra_erro();
    }
  }
  
  function obtem_filiais_usuario()
  {
    global $conn;
    
    $sql = 
      "SELECT cd_pessoa_filial AS cd_pessoa_filial
         FROM usuario_filial 
        WHERE cd_pessoa = " . $_SESSION["s_cd_usuario"] . "
       UNION
       SELECT cd_pessoa_ligacao AS cd_pessoa_filial
         FROM usuario 
        WHERE cd_pessoa = " . $_SESSION["s_cd_usuario"];
    
    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        $arr_filial = array();
        
        while (!$rs->IsEof())
        {
          $arr_filial[] = $rs->GetField("cd_pessoa_filial");
          
          $rs->Next();
        }
        
        return implode(",", $arr_filial);
      }
    }
    else
      conn_mostra_erro();
  }
  
  // Registra as vars de sessao automaticamente
  function array_session_register($arr, $id_formatado = 1)
  {
    $op_inutil = array("f_maintenance_submitted", "f_action", "f_submit",
                       "f_maintenance_already_submitted", "f_id_retorno");

    foreach ($arr as $nm_campo => $vl_campo)
    {
      if (!str_value($vl_campo)) continue;

      if (!in_array($nm_campo, $op_inutil))
      {
        $campo  = ((substr($nm_campo, 0, 2) == "f_") ? substr($nm_campo, 2) : $nm_campo);
        $campo_ = "s_" . $campo;
        global $$campo_;

        if (is_object($$campo))
        {
          if (preg_match("/^[0-9]/", $$campo->GetValue(true)) && $id_formatado)
            $_SESSION["s_$campo"] = str_replace(",", ".", str_replace(".", "",$$campo->GetValue(true)));
          else
            $_SESSION["s_$campo"] = $$campo->GetValue(true);
        }
        else
        {
          if (preg_match("/^[0-9]/", $vl_campo) && $id_formatado)
            $_SESSION["s_$campo"] = str_replace(",", ".", str_replace(".", "",$vl_campo));
          else
            $_SESSION["s_$campo"] = $vl_campo;
        }
      }
    }
  }
  
  /*
    Recebe um sql e registra os fields retornados como vars de sessão concatenando o s_ na frente do nome do campo
    Deve-se cuidar para que o sql retorne apenas um registro, senão somente serão registrados os valores do
    primeiro registro retornado
  */
  function sql_session_register($sql)
  {
    global $conn, $id_erro, $trans_ok;

    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        foreach ($rs->GetArray(true) as $indice => $registro)
        {
          array_session_register($registro, 0);
          break;
        }
      }
    }
    else
    {
      $trans_ok = false;
      $id_erro  = true;
      conn_mostra_erro();
    }
  }

  function obtem_usuario_grupo()
  {
    global $conn;

    $sql = 
      "SELECT cd_grupo AS value,
	      nm_grupo AS description
         FROM grupo";

    return obtem_pesquisa($sql);
  }

  function obtem_permissao_cadastro_funcionario()
  {
    global $ManBD, $f_cd_pessoa;

    if (!str_value($f_cd_pessoa))
      return true;

    $ParametroGeralRh = new ParametroGeralRh($ManBD->objConn);
    $ManBD->PopulaObjetoGenerico($ParametroGeralRh, array("1" => "1"), "LIMIT 1");

    $Funcionario = new Funcionario($ManBD->objConn);
    $Funcionario->cd_pessoa = $f_cd_pessoa;
    $ManBD->PopulaObjetoGenerico($Funcionario);

    if ($Funcionario->cd_pessoa)
    {
      $UsuarioGrupo = new UsuarioGrupo($ManBD->objConn);
      $UsuarioGrupo->cd_pessoa = $_SESSION["s_cd_usuario"];
      $UsuarioGrupo->cd_grupo  = $ParametroGeralRh->cd_grupo_usuario_rh;
      $ManBD->PopulaObjetoGenerico($UsuarioGrupo);

      return ($UsuarioGrupo->cd_pessoa ? true : false);
    }

    return true;
  }
  
  function obtem_servico_telefonia()
  {
    $sql = 
      "SELECT cd_servico_telefonia AS value,
	      ds_servico_telefonia AS description
         FROM servico_telefonia
        ORDER BY ds_servico_telefonia ";

    return obtem_pesquisa($sql);
  }
  
  function obtem_patrimonio($cd_grupo = null, $ds_equipamento = null)
  {
    $sql = 
      "SELECT p.cd_patrimonio AS value,
              nr_serie        AS description
         FROM patrimonio p
         JOIN equipamento        e ON e.cd_equipamento = p.cd_equipamento
         JOIN grupo_equipamento ge ON      ge.cd_grupo = e.cd_grupo
        WHERE TRUE " .
          restricao_where("AND", "ge.cd_grupo",      "=",  $cd_grupo,       "'").
          restricao_where("AND", "e.ds_equipamento", "~*", $ds_equipamento, "'").
      " ORDER BY 2";
          
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_csta()
  {
    $sql = 
      "SELECT nr_csta AS value,
              (nr_csta || ' - ' || SUBSTR(nm_csta, 1, 30)) AS description 
         FROM cst_a 
        ORDER BY nr_csta";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_cstb($sql_extra_where = "")
  {
    $sql = 
      "SELECT nr_cstb AS value,
              (RPAD(nr_cstb, 2, '0') || ' - ' || SUBSTR(nm_cstb, 1, 40)) AS description 
         FROM cst_b 
        WHERE TRUE
          $sql_extra_where
        ORDER BY nr_cstb";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_cliente_situacao($id_tipo = "", $id_analise = "")
  {
    $sql =
      "SELECT cd_cliente_situacao AS value,
              ds_cliente_situacao AS description
         FROM cliente_situacao
        WHERE TRUE " . 
          restricao_where("AND", "id_tipo",    "=", $id_tipo,    "'") .
          restricao_where("AND", "id_analise", "=", $id_analise, "'") .
      " ORDER BY 2";
    
    return obtem_pesquisa($sql);
  }
  
  /**
  * Retorna a diferença entre duas datas em dias ou segundos<br>
  * Tempo negativo = passado | positivo = futuro
  * @param type $data1 <i> Data base a comparar
  * @param type $data2 <i> Data alvo. Usa data e hora atuais se for null </i>
  * @param type $retornarSegundos <i> Caso TRUE retorna em segundos ao inves de dias </i>
  * @return int <i> Número de dias ou segundos de diferença</i>
  */
  function diffDate($data1, $data2=false, $retornarSegundos=false)
  {
    // Se não veio com espaço (tempo) adiciona 00:00
    if (!strpos($data1, " "))
      $data1 .= " 00:00";
    if ($data2 && !strpos($data1, " "))
      $data2 .= " 00:00";

    // Detecta formato DD/MM/YYYY de banco e converte
    if ( strpos($data1, "-") === false )
    {
      $tmExplode = explode(" ", $data1);
      $dtExplode = explode("/", $tmExplode[0]);
      $data1 = $dtExplode[2]."-".$dtExplode[1]."-".$dtExplode[0]." ".$tmExplode[1];
    }

    // Detecta formato DD/MM/YYYY de banco e converte
    if ( $data2 && strpos($data2, "-") === false )
    {
      $tmExplode = explode(" ", $data2);
      $dtExplode = explode("/", $tmExplode[0]);
      $data2 = $dtExplode[2]."-".$dtExplode[1]."-".$dtExplode[0]." ".$tmExplode[1];
    }

    $ts1 = strtotime($data1);

    if (!$data2)
      $ts2 = (int) gettimeofday(true);
    else
      $ts2 = strtotime($data2);

    $diferenca = floor($ts2 - $ts1);

    if ($retornarSegundos)
      return $diferenca * -1;
    else
      return floor(($ts2 - $ts1)/3600/24) * -1;
  }
  
  /**
   * * Modifica data conforme necessidade
   * * @param string $date, formato sys
   * * @param string $day
   * * @param string $month
   * * @param string $year
   * * @return string, data no formato sys
  * */
  function modDate($date, $day="+0", $month="+0", $year="+0", $format="Y-m-d")
  {
          $dt = new DateTime($date);
          $dt->modify("$day day $month month $year year");
          return $dt->format($format);
  }

  /**
   * Obtem índice do diferimento para o produto
   * @param integer $cd_produto
   * @param integer $cd_pessoa_filial
   * @param string $dt_vigencia (data padrão "pt_BR")
   * @return float
   */
  function obtem_indice_diferimento($cd_produto, $cd_pessoa_filial, $dt_vigencia = "")
  {
    global $conn;

    if (!str_value($cd_produto) || !str_value($cd_pessoa_filial))
      return;

    $f_cd_produto       = $cd_produto;
    $f_cd_pessoa_filial = $cd_pessoa_filial;
    $f_cd_pessoa_matriz = obtem_matriz($cd_pessoa_filial);
    $s_cd_usuario       = $_SESSION["s_cd_usuario"];
    $id_insere_preco_filial_aprovacao = true;
    $f_dt_vigencia      = $dt_vigencia;

    unset($sql);
    $sql = "DROP TABLE IF EXISTS tmp_markup_" . $_SESSION["s_cd_usuario"];

    if (!$conn->Execute($sql))
      conn_mostra_erro();

    unset($sql);
    include("fun_preco_venda_inferior_minimo.inc.php");

    if ($rs_markup = $conn->Select($sql))
    {
      $sql_indice_sem_diferimento =
        "SELECT ROUND (pr_indice / pr_indice_sem_diferimento, 5) AS pr_indice_difermento
           FROM tmp_markup_" . $_SESSION["s_cd_usuario"] . "
          WHERE pr_indice_sem_diferimento IS NOT NULL
            AND pr_indice_sem_diferimento > 0
            AND pr_indice_sem_diferimento <> pr_indice ";

      if ($rs_indice = $conn->Select($sql_indice_sem_diferimento))
        return $rs_indice->GetField("pr_indice_difermento");
      else
        conn_mostra_erro();
    }
    else
      conn_mostra_erro();
  }
  
  function obtem_pessoa_vale_pedagio($cd_pessoa = false, $id_condicao = "=", $id_ativo = null)
  {
    global $conn;
    
    $sql =
      "SELECT p.cd_pessoa AS value,
              vp.nm_cartao AS description
         FROM vale_pedagio vp
         JOIN pessoa p ON p.cd_pessoa = vp.cd_pessoa
        WHERE TRUE ".
          restricao_where("AND", "vp.cd_pessoa", $id_condicao, $cd_pessoa, "'").
          restricao_where("AND", "id_ativo",     "=",          $id_ativo,  "'").
      " ORDER BY p.nm_pessoa ";
    
    if ($rs = $conn->Select($sql))
      $op_pessoa_vale_pedagio = $rs->GetArray(true);
    else
      conn_mostra_erro();
    
    return $op_pessoa_vale_pedagio;
  }
  
  function obtem_grupo_cfop()
  {
    $sql =
      "SELECT gc.cd_grupo_cfop AS value,
              gc.nm_grupo_cfop AS description
         FROM grupo_cfop gc
        ORDER BY gc.cd_grupo_cfop";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_tipo_separacao()
  {
    $sql =
      "SELECT cd_tipo_separacao AS value,
              ds_tipo_separacao AS description
         FROM tipo_separacao ";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_checkout()
  {
    $sql =
      "SELECT cd_checkout AS value,
              nr_checkout AS description
         FROM checkout 
        ORDER BY 2, 1";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_codigo_ajuste_fiscal()
  {
    $sql =
      "SELECT cd_codigo_ajuste_fiscal AS value,
              nm_ajuste ||' / '|| SUBSTR(ds_ajuste, 0, 40) AS description
         FROM codigo_ajuste_fiscal
        ORDER BY 2, 1";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_grupo_produtividade()
  {
    $sql =
      "SELECT cd_grupo_produtividade AS value,
              cd_grupo_produtividade ||' / '|| nm_grupo_produtividade AS description
         FROM grupo_produtividade
        ORDER BY 2, 1";
    
    return obtem_pesquisa($sql);
  }
  
  function obtem_funcao_produtividade()
  {
    $sql =
      "SELECT cd_funcao_produtividade AS value,
              cd_funcao_produtividade ||' / '|| nm_funcao_produtividade AS description
         FROM funcao_produtividade
        ORDER BY 2, 1";
    
    return obtem_pesquisa($sql);
  }
  
  function formata_status_mdfe($id_status)
  {
    $ds_status = "";
    
    if ($id_status >= 200)
      $ds_status = "<font color='orange'><b>Rejeitado</b></font>";
    else
    {
      switch ($id_status)
      {
        case "100": $ds_status = "<font color='green'><b>Autorizado</b></font>"; break;
        case "101": $ds_status = "<font color='red'><b>Cancelado</b></font>";    break;
        case "132": $ds_status = "<font color='black'><b>Encerrado</b></font>";  break;
      }
    }
    
    return $ds_status;
  }
  
  function monta_campos_formulario(array $arr_dados, array $arr_campo, JTable $table, 
                                   $id_linha_unica = false, $arr_campo_total = array(), $id_unico_registro = false)
  {
    $arr_total = array();
    
    $i = 0;
    
    foreach ($arr_dados as $id => $arr_values)
    {
      if ($id_unico_registro && $i > 0)
        break;
      
      if ($id_linha_unica)
      {
        $table->OpenRow();
        
        //Imprime Header linha única
        if ($id == 0)
        {
          foreach ($arr_campo as $key => $arr)
            $table->OpenHeader($arr["label"]);  
        }
      }
      
      $table->OpenRow();
      
      foreach ($arr_campo as $key => $arr)
      {
        if (!$id_linha_unica && $arr["openRow"])
          $table->OpenRow();
        
        if (!$id_linha_unica)
          $table->OpenHeader($arr["label"]);
        
        if ($arr["callBack"])
        {
          $arr_param = array($arr_values[$arr["fieldName"]]);

          if (is_array($arr["callBack"][1]) && sizeof($arr["callBack"][1]))
            $arr_param = array_merge($arr_param, $arr["callBack"][1]);

          $data = call_user_func_array($arr["callBack"][0], $arr_param);
        }
        else
          $data = $arr_values[$arr["fieldName"]];
                
        $table->OpenCell($data, $arr["cellOptions"]);
        
        if (sizeof($arr_campo_total) && in_array($arr["fieldName"], $arr_campo_total))
          $arr_total[$arr["fieldName"]] += $arr_values[$arr["fieldName"]];
      }
      
      $i++;
    }
    
    //Linha Total
    if (sizeof($arr_total))
    {
      $table->OpenRow();
      
      foreach ($arr_campo as $arr)
      {
        if (str_value($arr_total[$arr["fieldName"]]))
        {
          if ($arr["callBack"])
          {
            $arr_param = array($arr_total[$arr["fieldName"]]);
            
            if (is_array($arr["callBack"][1]) && sizeof($arr["callBack"][1]))
              $arr_param = array_merge($arr_param, $arr["callBack"][1]);
            
            $vl = call_user_func_array($arr["callBack"][0], $arr_param);
          }
          
          $table->OpenCell("<b>$vl</b>", $arr["cellOptions"]);
        }
        else
          $table->OpenCell("", array("id" => "cell_total_" . $arr["fieldName"], "align" => "right"));
      }
    }
  }
  
  /**
   * Busca ou cria (se não existir) a carga principal do transbordo<br>,
   * apartir dos dados de transbordo da Rota
   * @global $conn
   * @param int $cd_rota
   * @param string $dt_saida (padrão sys)
   * @param int $id_semana
   * @return int
   */
  function busca_carga_principal_transbordo($cd_rota, $dt_saida, $id_semana)
  {
    global $conn;
    
    $cd_carga_transbordo = "";
    
    $sql_transbordo =
      "SELECT rt.cd_pessoa_transportadora,
              t.cd_rota_transbordo,
              rt.cd_cidade,
              r.id_tipo_frete,
              r.id_dia_inicio_entrega,
              r.cd_pessoa,
              r.cd_pessoa_filial,
              r.id_pedido_liberado,
              r.cd_vendedor
         FROM rota_transbordo rt
         JOIN transportadora   t ON t.cd_pessoa = rt.cd_pessoa_transportadora
         JOIN rota             r ON   r.cd_rota = t.cd_rota_transbordo
        WHERE rt.cd_rota = $cd_rota";
    
    if ($rs_transbordo = $conn->Select($sql_transbordo))
    {
      if ($rs_transbordo->GetRowCount())
      {
        $cd_transp_transbordo = $rs_transbordo->GetField("cd_pessoa_transportadora");
        $cd_cidade            = $rs_transbordo->GetField("cd_cidade");
        $cd_rota_transbordo   = $rs_transbordo->GetField("cd_rota_transbordo");
        $cd_pessoa            = $rs_transbordo->GetField("cd_pessoa");
        $cd_pessoa_filial     = $rs_transbordo->GetField("cd_pessoa_filial");
        $id_tipo_frete        = $rs_transbordo->GetField("id_tipo_frete");
        $id_pedido_liberado   = $rs_transbordo->GetField("id_pedido_liberado");
        
        $sql_carga_transbordo =
          "SELECT c.cd_carga
             FROM carga c
             JOIN carga_saida      cs ON cs.cd_carga = c.cd_carga
             JOIN carga_transbordo ct ON ct.cd_carga = cs.cd_carga
            WHERE cs.id_tipo_frete = 1
              AND cs.cd_empresa_transportadora = $cd_transp_transbordo
              AND cs.cd_rota   = $cd_rota_transbordo
              AND cs.dt_saida  = '$dt_saida'";
        
        if ($rs_carga_transbordo = $conn->Select($sql_carga_transbordo))
        {
          if ($rs_carga_transbordo->GetRowCount())
            $cd_carga_transbordo = $rs_carga_transbordo->GetField("cd_carga");
          else
          {
            //Insere a carga Principal
            $cd_carga_transbordo = busca_nextval("carga_cd_carga_seq");
            
            $values = array ("cd_carga"          => $cd_carga_transbordo,
                             "cd_pessoa_usuario" => $_SESSION["s_cd_usuario"],
                             "cd_pessoa_matriz"  => $cd_pessoa,
                             "cd_pessoa_filial"  => $cd_pessoa_filial);
            
            if (!$conn->Insert("carga", $values))
              conn_mostra_erro();
            else
            {
              //Se a transportadora Pai tiver somente um veículo cadastrado,
              //associa este veículo à carga principal que está sendo criada
              $sql_veiculo =
                "SELECT cd_veiculo,
                        cd_pessoa,
                        cd_pessoa_motorista
                   FROM veiculo
                  WHERE cd_pessoa = $cd_transp_transbordo";
              
              if ($rs_veiculo = $conn->Select($sql_veiculo))
              {
                if ($rs_veiculo->GetRowCount() == 1)
                {
                  $cd_veiculo               = $rs_veiculo->GetField("cd_veiculo");
                  $cd_pessoa_transportadora = $rs_veiculo->GetField("cd_pessoa");
                  $cd_pessoa_motorista      = $rs_veiculo->GetField("cd_pessoa_motorista");
                }
              }
              else
                conn_mostra_erro();
              
              //Insere Carga Saída
              $values = array("cd_carga"                  => $cd_carga_transbordo,
                              "cd_rota"                   => $cd_rota_transbordo,
                              "id_semana"                 => $id_semana,
                              "id_tipo_frete"             => $id_tipo_frete,
                              "dt_saida"                  => $dt_saida,
                              "id_fechada"                => 0,
                              "id_pedido_liberado"        => $id_pedido_liberado,
                              "cd_veiculo"                => $cd_veiculo,
                              "cd_pessoa_transportadora"  => $cd_pessoa_transportadora,
                              "cd_pessoa_motorista"       => $cd_pessoa_motorista,
                              "cd_empresa_transportadora" => $cd_transp_transbordo);
              
              if (!$conn->Insert("carga_saida", $values))
                conn_mostra_erro();
              
              //Insere em "carga_transbordo"
              $values = array("cd_carga"      => $cd_carga_transbordo,
                              "cd_cidade"     => $cd_cidade,
                              "dt_transbordo" => $dt_saida);
              
              if (!$conn->Insert("carga_transbordo", $values))
                conn_mostra_erro();
            }
          }
        }
        else
          conn_mostra_erro();
      }
    }
    else
      conn_mostra_erro();
    
    return $cd_carga_transbordo;
  }
  
  function verifica_dependencias($cd_pessoa)
  {
    global $conn;

    $msg = "";

    $sql =
      "SELECT (CASE WHEN c.cd_pessoa IS NOT NULL
                 THEN 'Cliente'
                 ELSE ''
               END)::TEXT AS ds_cliente,

              (CASE WHEN fd.cd_pessoa IS NOT NULL
                 THEN 'Fornecedor Diverso'
                 ELSE ''
               END)::TEXT AS ds_fornecedor_diverso,

              (CASE WHEN m.cd_pessoa IS NOT NULL
                 THEN 'Motorista'
                 ELSE ''
               END)::TEXT AS ds_motorista,

              (CASE WHEN t.cd_pessoa IS NOT NULL
                 THEN 'Proprietário Veículo'
                 ELSE ''
               END)::TEXT AS ds_proprietario,

              (CASE WHEN f.cd_pessoa IS NOT NULL
                 THEN 'Fornecedor'
                 ELSE ''
               END)::TEXT AS ds_fornecedor
         FROM pessoa p
         LEFT OUTER JOIN cliente             c ON c.cd_pessoa  = p.cd_pessoa
         LEFT OUTER JOIN fornecedor_diverso fd ON fd.cd_pessoa = p.cd_pessoa
         LEFT OUTER JOIN motorista           m ON m.cd_pessoa  = p.cd_pessoa
         LEFT OUTER JOIN transportadora      t ON t.cd_pessoa  = p.cd_pessoa
         LEFT OUTER JOIN fornecedor          f ON f.cd_pessoa  = p.cd_pessoa
        WHERE p.cd_pessoa = '$cd_pessoa'";
    
    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        $arr_registros = $rs->GetArray(true);
        
        foreach ($arr_registros as $key => $arr_values)
        {
          foreach ($arr_values as $ds_campo => $vl_campo)
          {
            if (str_value($vl_campo))
              $arr_campos[] = " - $vl_campo";
          }
        }
        
        $msg = ((is_array($arr_campos) && sizeof($arr_campos)) ? implode("\\n", $arr_campos) : "");
      }
    }
    else
      conn_mostra_erro();
    
    return $msg;
  }
  
  function validarNrCartaoCredito($idBandeira, $nrCartao)
  {
    if (!str_value($idBandeira) || !str_value($nrCartao)) return true;
    
    $nrCartao = preg_replace('/[-\s]/', '', $nrCartao);
    
    switch ($idBandeira)
    {
      case 1: // Visa
        if ((strlen($nrCartao) != 13 && strlen($nrCartao) != 16) || substr($nrCartao, 0, 1) != 4)
          return false;
      break;
      
      case 2: // Mastercard
        if (strlen($nrCartao) != 16 || !preg_match('/5[1-5]/', $nrCartao))
          return false;
      break;
      
      case 3: // American Express
        if (strlen($nrCartao) != 15 || !preg_match('/3[47]/', $nrCartao))
          return false;
      break;
      
      case 4: // Dinners
        if (strlen($nrCartao) != 16 || substr($nrCartao, 0, 4) != '6011')
          return false;
      break;
      
      default: return false; break;  
    }
    
    $dig    = toCharArray($nrCartao);
    $numdig = sizeof($dig);
    $j      = 0;
    
    for ($i = ($numdig - 2); $i >= 0; $i-=2)
      $dbl[$j++] = $dig[$i] * 2;
    
    $dblsz    = sizeof($dbl);
    $validate = 0;
    
    for ($i = 0; $i < $dblsz; $i++)
    {
      $add = toCharArray($dbl[$i]);
      
      for ($j = 0; $j < sizeof($add); $j++)
        $validate += $add[$j];
    }
    
    for ($i = ($numdig - 1); $i >= 0; $i-=2)
      $validate += $dig[$i];
    
    return (substr($validate, -1, 1) == "0") ? true : false;
  }
  
  function verificarTipoPessoa()
  {
    global $id_tipo_pessoa, $cd_pessoa;
    
    $ManBD = ManBD::getInstance();
    
    $Pessoa = new Pessoa($ManBD->objConn);
    $Pessoa->cd_pessoa = $cd_pessoa->GetValue();
    $ManBD->PopulaObjetoGenerico($Pessoa);
    
    try {
      $idTipoDaPessoa = $Pessoa->obterTipoDaPessoa($ManBD);
    } catch (Exception $ex) {
      $idTipoDaPessoa = false;
    }
    
    if ($idTipoDaPessoa == "juridica")
      $id_tipo_pessoa->SetValue("2");
    elseif ($idTipoDaPessoa == "fisica")
      $id_tipo_pessoa->SetValue("1");
    else
      $id_tipo_pessoa->SetValue("0");
  }
  
  function toCharArray($input)
  {
    $len = strlen($input);
    
    for ($j = 0; $j < $len; $j++)
      $char[$j] = substr($input, $j, 1);
    
    return ($char);
  }
  
  function busca_cheques_lote($cd_lote, $id_valida_lote = false)
  {
    global $conn;
    
    if (!str_value($cd_lote))
      return;
    
    $sql_lote_cheque =
      "SELECT lc.dt_compensacao,
              lc.cd_pessoa_matriz,
              lc.cd_pessoa_filial
         FROM lote_cheque lc
        WHERE lc.dt_compensacao IS NOT NULL
          AND lc.cd_lote = {$cd_lote}";
    
    if ($rs_lote_cheque = $conn->Select($sql_lote_cheque))
    {
      if ($rs_lote_cheque->GetRowCount())
      {
        //Restrições
        $sql_where_cheque = restricao_where("AND", "cr.dt_vencimento",    "=", $rs_lote_cheque->GetField("dt_compensacao"), "'");
        
        $arr_empresa_contabil = obtem_empresa_contabil(1);
        
        foreach ($arr_empresa_contabil as $arr_dados)
          $arr_empresa[] = $arr_dados["value"];
        
        if (!in_array($rs_lote_cheque->GetField("cd_pessoa_filial"), $arr_empresa))
          $sql_where_cheque .= " AND cr.cd_pessoa_matriz NOT IN (SELECT cd_pessoa FROM empresa_contabil)  ";
        else
          $sql_where_cheque .= " AND cr.cd_pessoa_matriz IN (SELECT cd_pessoa FROM empresa_contabil)  ";
        
        $sql_with_cheques =
          "WITH tmp_cheques_lote AS
           ((SELECT COUNT(cr.*) AS qt_cheque_total,
                    SUM(cr.vl_cheque) AS vl_cheque_total,
                    NULL AS qt_cheque_lote,
                    NULL AS vl_cheque_lote
               FROM cheque_recebido cr
              WHERE TRUE 
              $sql_where_cheque)
            UNION ALL
            (SELECT NULL AS qt_cheque_total,
                    NULL AS vl_cheque_total,
                    COUNT(cr.*) AS qt_cheque_lote,
                    SUM(cr.vl_cheque) AS vl_cheque_lote
               FROM cheque_recebido cr
              WHERE cr.cd_lote = {$cd_lote}))";
        
        $sql_cheques =
          "$sql_with_cheques
           SELECT COALESCE(SUM(qt_cheque_total), 0) AS qt_cheque_total,
                  COALESCE(SUM(vl_cheque_total), 0) AS vl_cheque_total,
                  COALESCE(SUM(qt_cheque_lote),  0) AS qt_cheque_lote,
                  COALESCE(SUM(vl_cheque_lote),  0) AS vl_cheque_lote
             FROM tmp_cheques_lote";
        
        if ($rs_cheques = $conn->Select($sql_cheques))
        {
          if ($id_valida_lote)
          {
            return ((($rs_cheques->GetField("qt_cheque_total") != $rs_cheques->GetField("qt_cheque_lote")) ||
                     ($rs_cheques->GetField("vl_cheque_total") != $rs_cheques->GetField("vl_cheque_lote"))) ? false : true);
          }
          else
            return $rs_cheques->GetArray(true)[0];
        }
        else
          conn_mostra_erro();
      }
    }
    else
      conn_mostra_erro();
  }
  
  function obtem_arr_funcionario_cargo($cd_cargo, $cd_pessoa)
  {
    global $conn;
    
    $sql = "SELECT DISTINCT vw.cd_pessoa_funcionario AS value, 
                   vw.nm_pessoa_funcionario AS description ,  
                   vw.cd_pessoa_filial
              FROM vw_funcionario vw              
              JOIN vw_empresa_contabil_filial vwf ON vwf.cd_pessoa = vw.cd_pessoa_filial 
              JOIN parametro_geral_filial pgf ON pgf.cd_pessoa_transportadora = vw.cd_pessoa_filial 
                                          AND pgf.cd_pessoa_filial = '{$_SESSION["s_cd_filial"]}'
             WHERE vw.dt_demissao IS NULL 
               AND vw.cd_cargo = '{$cd_cargo}' ";

    if (strlen($cd_pessoa))
    {
      $sql .="  UNION 
               SELECT DISTINCT vw.cd_pessoa_funcionario AS value, 
                      vw.nm_pessoa_funcionario AS description , 
                      vw.cd_pessoa_filial
                 FROM vw_funcionario vw 
                 JOIN vw_empresa_contabil_filial vwf ON vwf.cd_pessoa = vw.cd_pessoa_filial 
                WHERE vw.dt_demissao IS NULL 
                  AND vw.cd_pessoa_funcionario = '{$cd_pessoa}' ";
    }
    
    $sql .= "ORDER BY 2,1";

    if ($rs = $conn->Select($sql))
    {
      return $rs->GetArray(true);
    }
    else
      conn_mostra_erro();
  }
  
  function obtem_quantidade_min_venda($cd_produto, $cd_unidade, $cd_operacao)
  {
    global $conn;
    
    $sql_min_venda =
      "SELECT qt_minima_venda
         FROM produto_operacao
        WHERE cd_produto  = {$cd_produto}
          AND cd_unidade  = {$cd_unidade}
          AND cd_operacao = {$cd_operacao}";
    
    if ($rs_min_venda = $conn->Select($sql_min_venda))
      return $rs_min_venda->GetField("qt_minima_venda");
    else
      conn_mostra_erro();
  }
  
  /**
   * Imprime a etiqueta automaticamente conforme configurações
   * @global $pdf
   * @global ManBD $ManBD
   * @param int $cd_checkout
   */
  function imprime_etiqueta_checkout($cd_checkout = null)
  {
    global $pdf, $ManBD;
    
    if (!is_object($pdf))
      return;
    
    //Impressão Automática
    $ParametroGeral = new ParametroGeral($ManBD->objConn);
    $ParametroGeral->cd_parametro_geral = 1;
    $ManBD->PopulaObjetoGenerico($ParametroGeral);
    
    //Imprime automático somente quando SO é Linux
    $id_impressao_so = strpos($_SERVER['HTTP_USER_AGENT'], "Linux");
    
    if ($ParametroGeral->id_impressao_etiqueta && $id_impressao_so &&
        str_value($ParametroGeral->nm_usuario_pc_deposito) && str_value($ParametroGeral->ds_senha_pc_deposito) &&
        str_value($ParametroGeral->ds_opcoes_impressao_etiqueta))
    {
      require_once("include/fun_dir.inc.php");
      
      $ds_caminho_pdf = EFESUS . "/relatorios/etiquetas/";
      
      cria_dir(EFESUS . "/relatorios/");
      cria_dir(EFESUS . "/relatorios/etiquetas/");
      
      deleta_dir("$ds_caminho_pdf/{$_SESSION["s_cd_usuario"]}_*.pdf");
      
      $nm_arquivo = "{$ds_caminho_pdf}/" . REL_ARQ_NOME . ".pdf";
      $pdf->Output($nm_arquivo , "F");
      
      $nm_usuario_ssh = $ParametroGeral->nm_usuario_pc_deposito;
      $ds_senha_ssh   = $ParametroGeral->ds_senha_pc_deposito;
      
      /**
       * Busca opções impressão
       * 1º Cadastro de Impressora (Cadastro > Depósito > Impressora)
       * 2º Checkout (Cadastro > Depósito > Checkout) - Se existir
       * 3º Parâmetro Geral
       */
      $nm_impressora_padrao =
        exec("sshpass -p {$ds_senha_ssh} ssh -o StrictHostKeyChecking=no {$nm_usuario_ssh}@{$_SERVER["REMOTE_ADDR"]} lpstat -d");
      
      $nm_impressora_padrao = substr($nm_impressora_padrao, strpos($nm_impressora_padrao, ":") + 1);
      
      $impressora = new Impressora($ManBD->objConn);
      $impressora->nm_impressora = $nm_impressora_padrao;
      $ManBD->PopulaObjetoGenerico($impressora, false, " LIMIT 1");
      
      if (is_numeric($impressora->cd_impressora))
        $ds_opcoes_impressao = $impressora->ds_opcoes_impressao;
      elseif (is_numeric($cd_checkout))
      {
        $checkout = new Checkout($ManBD->objConn);
        $checkout->cd_checkout = $cd_checkout;
        $ManBD->PopulaObjetoGenerico($checkout);
        
        $ds_opcoes_impressao = $checkout->ds_opcoes_impressao_etiqueta;
      }
      else
        $ds_opcoes_impressao = $_SESSION["s_ds_opcoes_impressao_etiqueta"];
      
      if (!str_value($ds_opcoes_impressao))
        $ds_opcoes_impressao = $ParametroGeral->ds_opcoes_impressao_etiqueta;
      
      exec("cat {$nm_arquivo} | sshpass -p {$ds_senha_ssh} ssh -o StrictHostKeyChecking=no {$nm_usuario_ssh}@{$_SERVER["REMOTE_ADDR"]} lpr {$ds_opcoes_impressao}");
      
      echo "<script>window.close();</script>";
    }
    else
      $pdf->Output(REL_ARQ_NOME, "I");
  }
  
  function envia_mensagem_slack($txt)
  {
    $web_hook = "https://hooks.slack.com/services/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";
    
    $msg = array('text' => $txt);
    $c = curl_init($web_hook);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, array('payload' => json_encode($msg)));
    curl_exec($c);
    curl_close($c);
  }
  
  function valida_acesso_dados_lgpd($cd_pessoa)
  {
    global $conn;
    
    $sql =
      "SELECT controla_acesso_dados({$_SESSION['s_cd_usuario']}, p.cd_pessoa, p.cd_pessoa::TEXT)
         FROM pessoa p
        WHERE p.cd_pessoa = {$cd_pessoa}";
    
    if ($rs = $conn->Select($sql))
      return is_numeric($rs->GetField(0));
    else
      conn_mostra_erro();
  }