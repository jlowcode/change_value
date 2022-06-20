# Change Value Plugin

![Joomla Badge](https://img.shields.io/badge/Joomla-5091CD?style=for-the-badge&logo=joomla&logoColor=white) ![PHP Badge](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

<div align="center">
  <img src="./.github/jlowcodelogo.png" width="350" />
</div>

## Conteúdo

- [Sobre](#sobre)
- [Configuração](#configuração)
  - [Capitalization](#capitalization)
    - [Element](#element)
    - [Style](#style)
  - [Values](#values)
    - [Element](#element)
    - [Current Value](#current-value)
    - [Compare Mode](#compare-mode)
    - [All Records](#all-records)
    - [Desired Value](#desired-value)
    - [NULL](#null)
- [Uso](#uso)

## 💭 Sobre

O plugin change_value surge da necessidade de alterar valores já presentes no banco de dados a partir de um elemento de lista do Fabrik. Sendo responsável por verificar o valor atual do elemento e mudá-lo de acordo com as definições do plugin. Sendo também possível alterar o tipo de caixa (caixa alta, caixa baixa e outros) a qual um dado será gravado no banco de dados.

## ⚙️ Configuração

Com o plugin devidamente instalado no Joomla, há duas opções de configuração:

### Capitalization

Responsavel por lidar diretamente com o estilo de letra (no que diz respeito à caixa) que será registrado no banco de dados.

#### Element

Selecionar o elemento ao qual sera aplicado o estilo de letra.

![Element](./.github/03.png)

#### Style

Selecionar o tipo de estilo de caixa da letra que será salvo no banco de dados.

- UPPERCASE: Salvara o registro no banco de dados em MAIUSCULO.

  ![Element](./.github/04.png)

- lowercase: Salvara o registro no banco de dados em minusculo.

  ![Element](./.github/05.png)

- First character uppercase: Salvara o registro no banco de dados com a Primeira letra maiuscula.

  ![Element](./.github/06.png)

- First Character Of Each Word Uppercase: Salvara o registro no banco de dados com Todas As Primeiras Letras Em Maiusculo.

  ![Element](./.github/07.png)

### Values

Responsavel por substituir um valor atual digitado pelo usuário no Element para um outro valor predefinido no plugin.

#### Element

Selecionar o elemento ao qual sera aplicada alteracao de valores.

![Element](./.github/08.png)

#### Current Value

Inserir o valor atual ao qual sera substituido pelo novo valor

![Element](./.github/09.png)

#### Compare Mode

Selecionar a forma a qual sera feita a comparacao entre o valor `Current Value` e o valor registrado pelo `Element` no banco de dados.

![Element](./.github/10.png)

- Equal: Utilizado para valores como `boolean`, `INTEGER`, `FLOAT`, `DECIMAL` e etc.
- Like: Utilizado para valores `VARCHAR`.

#### All Records

Marcar caso queira que todos os registros do banco de dados do `Element` tambem mudem seu valor de `Current Value` para o `Desired Value` de acordo.

![Element](./.github/11.png)

#### Desired Value

Inserir o valor que substituira o `Current Value` do `Element`.

![Element](./.github/12.png)

#### NULL

Marcar caso queira trocar o `Current Value` do `Element` por `NULL`.

![Element](./.github/13.png)

## 💻 Uso

### Captalization

Com o plugin configurado para UPPERCASE, basta inserir o valor no Element escolhido nas configurações do plugin que este será automaticamente transformado em UPPERCASE.

<div align="center">
  <img src="./.github/14.png" alt="Example captalization image" width=800><br>
  Inserindo o valor no element
</div><br>

<div align="center">
  <img src="./.github/16.png" alt="Example captalization image" width=800><br>
  Valor na lista
</div><br>

<div align="center">
  <img src="./.github/15.png" alt="Example captalization image" width=300><br>
  Valor no banco de dados
</div><br>

### Values

Values configurado para que o `Current Value` igual a `ALL_LETTERS_SHOULD_BE_IN_UPPER_CASE` ser substituído por `brand_new_value` (sendo o `Desired Value`).

_Atenção_: Neste caso também está habilitado o Captalization como uppercase, ou seja, o valor `brand_new_value` será `BRAND_NEW_VALUE`.

<div align="center">
  <img src="./.github/17.png" alt="Example captalization image" width=300><br>
  Plugin configurado
</div><br>
<div align="center">
  <img src="./.github/18.png" alt="Example captalization image" width=700><br>
  Valor substituído após submissão do formulário "Adicionar"
</div><br>
