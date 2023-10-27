<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHP-4f5b93?style=for-the-badge&logo=php&logoColor=white"/>
</p>

## Sumário

:small_blue_diamond: [Requisitos](#requisitos)

:small_blue_diamond: [Execução do projeto](#execução-do-projeto)

:small_blue_diamond: [Tecnologias utilizadas](#tecnologias-utilizadas)

:small_blue_diamond: [Autor](#autor)

:small_blue_diamond: [Licença](#licença)

## Requisitos

:warning: [PHP:^8.1](https://www.php.net/releases/8.1/en.php)

:warning: [Composer](https://getcomposer.org/download/)

:warning: [MySQL](https://hub.docker.com/_/mysql)

## Execução do projeto

No terminal, clone o projeto:

```
git clone https://github.com/AleixoThiago/api-hub-marketplace
```

Entre na pasta

```
cd api-hub-marketplace
```

Instale as dependências do composer:

```
composer install
```

Copie .env.example e preencha o .env:

```
cp .env.example .env
```

Gerar a chave do projeto:

```
php artisan key:generate
```

Execute as migrations semeando:

```
php artisan migrate --seed
```

## Tecnologias utilizadas

-   [PHP 8.1](https://www.php.net/)
-   [Laravel 10.x](https://laravel.com/docs/10.x)

## Autor

[<img src="https://avatars.githubusercontent.com/u/68597119?v=4" width=115><br><sub>Thiago Aleixo</sub>](https://github.com/AleixoThiago)

## Licença

The [MIT License]() (MIT)

Copyright :copyright: 2023 - app-a431p22i76h
