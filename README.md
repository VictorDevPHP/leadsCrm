# SendEmail.php

Este arquivo contém a definição de um comando de console Laravel para enviar e-mails e mensagens WhatsApp com relatórios de anúncios do Meta Ads para clientes.

## Comando de Console

### Nome e Assinatura

- **Nome**: `send:email`
- **Assinatura**: `$signature = 'send:email';`

### Descrição

Este comando envia relatórios de desempenho de anúncios do Meta Ads via e-mail e WhatsApp para os clientes.

### Execução

O método `handle()` é executado quando o comando é chamado.

## Método `handle()`

Este método é responsável por iterar sobre todos os clientes e enviar os relatórios.

### Parâmetros

- Nenhum.

### Funcionalidades

1. **Obtenção de Clientes**: Obtém todos os clientes da base de dados.
2. **Iteração de Clientes**: Itera sobre cada cliente para enviar relatórios individualmente.
3. **Geração de Mensagem WhatsApp**: Gera mensagens personalizadas com os resultados dos anúncios.
4. **Envio de Mensagem WhatsApp**: Envia as mensagens WhatsApp usando a API do Meta WPP.
5. **Atualização de Dados do Anúncio**: Atualiza ou cria registros de dados de desempenho do anúncio na base de dados.
6. **Registro de Logs**: Registra informações sobre o envio das mensagens.

## Método `getAdsInsights($id_meta)`

Este método é responsável por obter os insights dos anúncios do Meta Ads.

### Parâmetros

- `$id_meta`: ID da conta do Meta Ads.

### Funcionalidades

1. **Inicialização da API do Meta Ads**: Inicializa a API do Meta Ads.
2. **Definição de Campos e Parâmetros**: Define os campos e parâmetros para obter insights dos anúncios.
3. **Obtenção de Insights**: Obtém os insights dos anúncios usando a ID da conta.

## Método `sendWpp($text, $wpp)`

Este método é responsável por enviar mensagens WhatsApp usando a API do Meta WPP.

### Parâmetros

- `$text`: Texto da mensagem WhatsApp.
- `$wpp`: Número de telefone do destinatário.

### Funcionalidades

1. **Montagem dos Dados da Mensagem**: Monta os dados da mensagem WhatsApp.
2. **Envio da Mensagem**: Envia a mensagem WhatsApp usando a API do Meta WPP.
3. **Registro de Logs**: Registra informações sobre o envio da mensagem.

## Dependências

- **Laravel Framework**: Requer o framework Laravel para execução do comando de console.
- **Facebook Business SDK**: Requer o SDK do Facebook Business para interação com a API do Meta Ads e Meta WPP.

## Variáveis de Ambiente

- `META_ADS_TOKEN`: Token de acesso para a API do Meta Ads.
- `META_WPP_TOKEN`: Token de acesso para a API do Meta WPP.

## Logs

- **log-whatsapp**: Registra informações sobre o envio das mensagens WhatsApp.

---

Este documento descreve o funcionamento e a estrutura do comando `send:email` para envio de relatórios de anúncios do Meta Ads via e-mail e WhatsApp.
