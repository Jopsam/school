---

## 🛠️ Instalación

Sigue estos pasos para instalar y correr el proyecto localmente:

```bash
# 1. Clona el repositorio
git clone https://github.com/Jopsam/school.git
cd nombre-del-repo

# 2. Instala las dependencias de PHP
composer install

# 3. Instala las dependencias de JavaScript
npm install

# 4. Copia y configura el archivo .env
cp .env.example .env
php artisan key:generate

# 5. Ejecuta las migraciones
php artisan migrate

# 6. Si tienes seeders configurados, ejecútalos
php artisan db:seed

# 7. Compila los assets
npm run dev

# 8. Inicia el servidor de desarrollo
php artisan serve
