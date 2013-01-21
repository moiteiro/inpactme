#Soccer Startup Championship

### Caracteristicas

Sistema gerenciador de campeonatos para a Startup Championship.
http://sandbox.brunomoiteiro.com

Tecnologias:
- HTML5 + CSS3 + JavaScript (client Side)
- PHP + MySQL (server side)

Bibliototecas:
- Jquery
- Underscore
- require.js
- text.js
- chosen (para os selects) 

Frameworks:
- Backbone (client Side)
- Framework pessoal (server side) https://github.com/moiteiro/Framework

A ideia inicial da aplicação seria aplicar javascript no server side tambem mas tive alguns problemas para dar o deploy no heroku e por isso tive que optar por outra solução.

A aplicação não garante o funcionamento correto em browser que não possui suporte a html5.

No server foi montado um Web Service em cima dos padrões REST. Por causa disso, a edição dos clubs foi prejudicada pois existêm algumas limitações ao se utilizar o PUT para alterar os dados.

Para evitar o uso de HTML dentro dos arquivos .js, eu utilizei text.js que lê os arquivos a partir da pasta /public/scripts/templates.

A aplicação carrega primeiramente todos os módulos necessários pra depois se torna disponível para a utilização. Essa caracteristica foi obtida através do require.js. 

Caso haja limitações com a velocidade da internet, é necessario atualizar a página novamente caso a aplicação não inicialize, pois o require.js está configurado com limite de 7 segundos para o carregamento para todas as dependências.

Depois da aplicação ter sido totalmente carregada, todas as telas ficam disponívies para o usuário quase que de imediato, tendo como delay apenas as requisições em AJAX para buscar os dados armazenados no banco.

### Funcionamento

1. boot.js é carregado pelo require.js
2. Todas as dependências dentro do boot.js são cerregadas e aplicação é iniciada.
3. router.js lê as URL e determina qual ação tela deve ser visualizada.
4. todas as telas são carregadas a partir da pasta templates e populadas pelo View gerado pelo Backbone.
5. Após o carregamento da tela, o Backbone espera que todos os dados sejam recebidos por meio de um JSON do serve e então popula a tela gerada anteriormente.
