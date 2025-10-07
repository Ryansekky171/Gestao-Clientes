Sistema de Gerenciamento

Requisitos:
- Docker e Docker Compose instalados
- php instalado na maquina
- node.js instalado e comandos nmp funcionando
- verificar se as extenções do postgree(pdo_pgsql e pgsql) e zip estão habilitadas no php.ini

Instalação e Execução:
Siga todos os comandos abaixo na ordem indicada:

# Subir o container postgree
docker compose up -d --build

# Configurar o ambiente
cp .env.example .env
composer install
php artisan key:generate
npm install && npm run build

# Rodar o banco de dados
php artisan migrate

# Popular dados iniciais (seed)
php artisan db:seed

# iniciar laravel
php artisan serve 

# compilar frontend
npm run dev
Acesso:
Acesse no navegador: http://localhost:8000
Login Admin Padrão: admin@gmail.com / admin
Login Usuario comum: comum1@gmail.com / 123456

Observações:
- Execute os comandos de configuração, migração e seed.
- Para limpar cache: php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear
- O projeto utiliza PostgreSQL via Docker, pode ser configurado no .env.
- Ambiente configurado para Laravel + Tailwind.