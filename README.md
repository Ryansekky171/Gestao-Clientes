Sistema de Gerenciamento

Requisitos:
- Docker e Docker Compose instalados

Instalação e Execução:
Siga todos os comandos abaixo na ordem indicada:

# Subir os containers
docker compose up -d --build

# Entrar no container da aplicação
docker compose exec app bash

# Configurar o ambiente
cp .env.example .env
php artisan key:generate
composer install
npm install && npm run build

# Rodar o banco de dados
php artisan migrate

# Popular dados iniciais (seed)
php artisan db:seed

Acesso:
Acesse no navegador: http://localhost:8000
Login Admin Padrão: admin@gmail.com / admin
Login Usuario comum: comum1@gmail.com / 123456

Observações:
- Execute os comandos de configuração, migração e seed dentro do container 'app'.
- Para limpar cache: php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear
