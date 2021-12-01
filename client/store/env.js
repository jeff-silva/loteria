/* Este arquivo é gerado via script, não edite-o diretamente.
Para alterar as variáveis guardadas aqui edite o comando app/Console/Commands/AppMakeEnv.php
Para gerar este arquivo execute os comandos "php artisan app:make-env"
ou "php artisan app:dev" */

export const state = {
    "exportExtensions": [
        {
            "name": "Planilha CSV",
            "extension": "csv",
            "mime": "text\/csv"
        },
        {
            "name": "HTML",
            "extension": "html",
            "mime": "text\/html"
        },
        {
            "name": "JSON",
            "extension": "json",
            "mime": "application\/json"
        },
        {
            "name": "XML",
            "extension": "xml",
            "mime": "application\/xml"
        }
    ],
    "artisanCommands": [
        {
            "name": "app:db-export",
            "description": "Exporta estrutura do banco de dados para o arquivo config\/database-schema.php"
        },
        {
            "name": "app:db-import",
            "description": "Cria tabelas e colunas no banco baseado na estrutura salva em config\/database-schema.php"
        },
        {
            "name": "app:dev",
            "description": "Utilize este comando sempre que alterar algo no banco de dados ou nos arquivos em app\/Formats"
        },
        {
            "name": "app:install",
            "description": "Executa a instala\u00e7\u00e3o inicial da aplica\u00e7\u00e3o"
        },
        {
            "name": "app:make-controllers",
            "description": "Criar\/alterar controllers de acordo com tabelas no banco de dados"
        },
        {
            "name": "app:make-env",
            "description": "Gera arquivo \/client\/store\/env.js contendo dados est\u00e1ticos do sistema para consumo do frontend"
        },
        {
            "name": "app:make-models",
            "description": "Criar\/alterar models de acordo com tabelas no banco de dados"
        },
        {
            "name": "app:make-routes",
            "description": "Gera rotas de API e salva em routes\/api_generated.php"
        },
        {
            "name": "app:root-user",
            "description": "Gera\/reseta usu\u00e1rio root"
        },
        {
            "name": "app:sync",
            "description": "Sincroniza arquivos entre projeto atual e projeto configurado no .env (SYNC_PATH=\"C:\\folder\\project\")"
        }
    ]
};