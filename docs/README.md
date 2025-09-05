# ShoppingCart
ShoppingCart diz respeito a um sistema que simula o funcionamento de um carrinho de compras, utilizando Clean Code e boas práticas de desenvolvimento.  
Desenvolvido por:
- *Larissa Vitória Custódio de Carvalho RA: 1995354*
- *Marcela Buzzo de Oliveira RA: 2014340*

## Funcionalidades do Sistema
O sistema simula todo o gerenciamento de um carrinho de compras, com as mais diversas funcionalidades comumente usada no mesmo. Dentre as funcionalidades estão:<br>
- #### Adicionar Item ao Carrinho 
  A funcionalidade Adicionar Item ao Carrinho recebe os atributos de identificação do carrinho, sendo elas, id do carrinho, quantidade do produto e o seu subtotal,
  chama uma função função de validação, que dentro dela são chamadas as funções responsavéis por verificar se o produto que está sendo adicionado ao carrinho é um produto
  existente e se a quantidade desejada está disponível no estoque. Caso a validação não passe, o erro é informado ao usuário, caso  a validação não gere erros, o array de carrinhos
  é iterado para ver ser o carrinho existe, se o mesmo for encontrado, o produto é adicionado. Caso o carrinho não seja encontrado uma mensagem informando o ocorrido é retornada.<br>
- #### Remover Item do Carrinho 
  A fucionalidade Remover Item do Carrinho remove o produto do carrinho por meio de seu identificador e chama a função responsavél por devolver essa quantidade que estava no carrinho 
  ao estoque.
- #### Listar Itens do Carrinho
  A funcionalidade Listar Itens do Carrinho, recebe o identificador do carrinho como parâmetro e lista todos os produtos adicionados com sua quantidade e subtotal.

- #### Calcular Total
  A funcionalidade Calcular Total, receber o identificador do carrinho como parametro e soma todos os subtotais dos produtos para ter o valor total do carrinho.
- #### Aplicar Desconto Fixo 
  A funcionalidade Aplicar Desconto Fixo é uma Regra de Negócio simples que simula a aplicação de um cupom de desconto de 10%. Sendo assim, a função recebe o identificador do carrinho, chama a função
  de Calcular o Total do mesmo, e aplica um desconto simples de 10% no valor total do carrinho.
<br>
As funcionalidades apresentadas são úteis e se relacionam de determinada forma com os usuários e com os desenvolvedores, 
as próximas funcionalidades apresentadas estão mais focadas para o desenvolvedor e a melhor organização do sistema em si, não se relacionando diretamente com o usuário.

- #### Validar Produto
  A funcionalidade de validar produto, no sistema funciona para verificar e garantir que o produto no qual, alguma ação está tentando ser realizada, realmente existe no sistema.
- #### Validar Estoque
  A funcionalidade de validar o estoque serve para garantir que a quantidade de produto que o usuário está tentando adicionar ao carrinho está disponível. 
- #### Validar se o Produto já está no carrinho
  Essa funcionalidade serve para verificar se o produto que o usuário está tentando adicionar em seu carrinho, já não está dotada no mesmo. Caso já esteja, ao invés de criar um novo array do produto, 
  ele aumenta a sua quantidade.
- #### Remover e Adicionar Estoque
  Tais funcionalidades servem para quando um produto for adicionado ao carrinho a sua quantidade no estoque diminuir e quando for removido a sua quantidade aumentar, bem como quando for necessário fazer a
  sua manutenção.
- #### Calcular Subtotal
  A função de Calcular Subtotal serve para calcular o valor total de cada produto inserido no carrinho de acordo com a quantidade inserida.
- #### Criar Carrinho
  A função de Criar Carrinho, como seu nome já diz, serve para criar um novo carrinho para o usuário.   

- #### Pegar produto por identificador
  Em diversas funções, sentimos a necessidade de pegar determinado produto para manipulação, dessa forma, visando boas práticas e clean code, tal função foi criada para que não precise 
  ser refeito esse processo várias vezes.
- #### Funções de Log
  As funções de Log são funções simples e padrões que serve para retornos de funções informando ao usuário se a ação foi realizada com sucesso ou se deu erro informando o erro.

## Como rodar o projeto
```
1.Certifique-se de ter o Xampp e o Apache instalados na máquina;
2.Baixe a pasta 'ShoppingCart' completa na sua máquina;
3.Descompactue e extraia a pasta;
4.Coloque a pasta descompactada dentro de 'C:\xampp\htdocs\';
5.Para rodar o projeto, abra o navegador e digite 'https://localhost/shoppingCart'.
```
 

