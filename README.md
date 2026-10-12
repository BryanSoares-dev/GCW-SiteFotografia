# GCW-RafaelFotografia
## Pagamentos dos pacotes (Asaas)

O checkout dos pacotes cobra o valor integral configurado no servidor via Pix. Para habilitar, configure `ASAAS_API_KEY` e `ASAAS_BASE_URL` no arquivo `.env` da raiz (use `.env.example` como modelo). Comece com a chave de testes e `https://api-sandbox.asaas.com/v3`; para produção, use a chave e a URL de produção da sua conta Asaas. O PHP precisa da extensão cURL habilitada. O `.env` está excluído do Git e o Apache bloqueia sua leitura direta.

A cobrança vence em três dias. A confirmação do agendamento deve ser feita após verificar o pagamento no painel do Asaas; este fluxo gera e apresenta QR Code/link, sem webhook de confirmação.

## Estrutura do projeto

- `front-end/`: páginas PHP apresentadas ao visitante e arquivos estáticos (`css/`, `img/`).
- `back-end/`: conexão e operações de conta, além da integração de pagamentos Asaas.
- `index.php`: encaminha a URL da raiz para `front-end/index.php`.
- `.env`: permanece na raiz e guarda as credenciais; não publique esse arquivo.

As páginas do site ficam em `/front-end/`. Formulários e ações de conta apontam para os controladores em `/back-end/`; o formulário de pacotes chama `back-end/asaas-pagamento/cobranca-pacote.php`.
