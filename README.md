# 📚 Proyecto School

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

NOTA: Debes configurar tus variables de entorno para la base de datos y se recomienda usar Mailtrap para las notificaciones, con lo cual, debes configurar también las variables de entorno MAIL_ usando dicho servicio.

# 5. Ejecuta las migraciones
php artisan migrate

# 6. Ejecuta los seeders
php artisan db:seed

# 7. Compila los assets
npm run dev

# 8. Levanta el servidor
php artisan serve
```

---

## ✅ Testing

Para correr las pruebas del proyecto, sigue estos pasos:

1. Crea una base de datos llamada `test_school`.

2. Corre las migraciones para el entorno de pruebas:

```bash
php artisan migrate --env=testing
```

3. Ejecuta las pruebas con:

```bash
php artisan test --filter=CourseControllerTest
```

---

## 📡 API REST

Para probar los endpoints de la API, puedes utilizar la colección de Postman disponible en el siguiente enlace:

🔗 [Colección Postman - School API](https://www.postman.com/red-rocket-496922/workspace/school/collection/21246879-ba0d3b28-f008-477c-83fc-3332a3e0812d?action=share&creator=21246879)

### Pasos para usar la colección:

1. Asegúrate de haber levantado el servidor local:

```bash
php artisan serve
```

2. En Postman, importa la colección desde el enlace y configura el entorno con la URL base:

```
http://localhost:8000
```
3. Ejecuta la peticion de autenticación en la api.

4. Copia el valor de "access_token" y en cada petición configuralo en "Authorization" como Bearer token.

5. Ejecuta las peticiones disponibles (listar, crear, actualizar, eliminar, etc.).
