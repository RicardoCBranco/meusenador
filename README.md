# Meu Senador

Sistema web com o objetivo de interpretar os dados do portal da transparência do Senado Federal tornando-os didaticamente compreensível para todos os cidadãos.

## Iniciando

O código do Meu Senador pode ser obtido através do link: [GitHub Pages](https://github.com/RicardoCBranco/meusenador.git), faça o download da última versão clicando no botão localizado na página do github "Clone or download", ao abrir o diálogo baixe o arquivo clicando em "Download Zip".
Concluído o download do arquivo extraia na página do seu servidor, caso utilize como servidor local recomendamos que seja criado um virtual host. Tanto no servidor quanto no local deverá o servidor apontar para a pasta public do sistema.

### Pré-requisitos

PHP7 e MySQL

### Instalando
1) Faça o Download na página do GitHub
![Download GitHub](/public/img/tela1.png)


2) Ao concluir o download vá na pasta onde o arquivo baixou e extraia na página do servidor.
![Extraindo Arquivos](/public/img/tela2.png)

3) Após extrair configure o servidor para que aponte para a pasta public.
![Configurar host](/public/img/tela3.png)

4) Terminado a configuração inicial crie o banco de dados, com o servidor MySQL configurado, inclua seus dados no arquivo "config.php" na pasta "app" do sistema.
![Configurar MySQL](/public/img/tela4.png)

5) Com o sistema rodando acesse o endereço "http://{seu site}/admin/insert" aguarde concluir a criação do banco de dados ao exibir a mensagem de término: "Fim da Execução do Extractor".
![Extractor](/public/img/tela5.png)


## Construído com

* [HTML5](https://www.w3schools.com/html/html5_intro.asp) - Linguagem web
* [PHP7](https://secure.php.net/) - Programação backend
* [Bootstrap](https://getbootstrap.com/) - Framework para construção responsiva


## Versioning

Nós usamos [SemVer](http://semver.org/) para determinar a versão. Para as versões disponíveis [tags neste repositório](https://github.com/RicardoCBranco/meusenador/tags). 

## Authors

* **Antonio Ricardo Andrade Castelo Branco** - *Initial work* - [RicardoCBranco](https://github.com/RicardoCBranco)

* **Verônica Santos** - *Initial work* - 

* **Wellington Eugênio da Silva** - *Initial work* - [leto-silva](https://github.com/leto-silva)


## License

Este projeto é licenciado sobre a UFRPE License - veja o [LICENSE.md](LICENSE.md) para mais detalhes
