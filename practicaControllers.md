
#  CLASE DE LARAVEL 

## Controllers y Rutas con Breeze + Inertia.js

---

## 1. INSTALACIÓN DE BREEZE CON INERTIA.JS

### + ¿QUÉ ES BREEZE?

Laravel Breeze es un sistema de autenticación simple que incluye:

* Login
* Registro
* Recuperación de contraseña

---

### + ¿QUÉ ES INERTIA.JS?

Inertia.js permite usar **Vue.js como frontend** sin crear una API separada.

* Laravel maneja las rutas y controladores
* Vue maneja las vistas

---

### + COMANDOS DE INSTALACIÓN

Dentro del proyecto Laravel:

```bash
composer require laravel/breeze --dev
```

Instalar Breeze con Inertia + Vue:

```bash
php artisan breeze:install vue
```

Instalar dependencias frontend:

```bash
npm install
npm run dev
```

Ejecutar migraciones:

```bash
php artisan migrate
```

---

### + VERIFICACIÓN

Levantar el servidor:

```bash
php artisan serve
```

Abrir en el navegador:

```
http://127.0.0.1:8000
```

 Debería mostrarse la pantalla de **login / registro**

---

## 2. ESTRUCTURA GENERAL DEL PROYECTO

Archivos importantes después de instalar Breeze:

```
routes/web.php
app/Http/Controllers
resources/js/Pages
```

---

## 3. CREACIÓN DE UN CONTROLLER CON RECURSOS

### + ¿QUÉ ES UN RESOURCE CONTROLLER?

Un **resource controller** crea automáticamente los métodos CRUD:

* index
* create
* store
* show
* edit
* update
* destroy

---

### + COMANDO PARA CREAR EL CONTROLLER

```bash
php artisan make:controller StudentController --resource
php artisan make:model Student -mcr //esta opcion es para hacerlo desde el inicio
```
```bash
Si ya existen los controller sin resources ejecutar
php artisan make:controller StudentController --resource --force
```

---

### + MÉTODOS CREADOS

```php
index()
create()
store()
show()
edit()
update()
destroy()
```


---

## 4. EXPLICACIÓN BÁSICA DEL CONTROLLER

**Archivo:**
`app/Http/Controllers/StudentController.php`

```php
use Inertia\Inertia; //es importante que importemos Inertia
// en la parte superior del controller

class StudentController extends Controller
{
    public function index()
    {
        return Inertia::render('Students/Index');
    }

    public function create()
    {
        return Inertia::render('Students/Create');
    }

    public function store()
    {
        return redirect()->route('students.index');
    }
}
```

### + ¿QUÉ PASA AQUÍ?

* `Inertia::render()` carga una vista Vue
* `redirect()->route()` redirige a una ruta específica

---

## 5. CREACIÓN DE VISTAS EN VUE (INERTIA)

**Ruta:**

```
resources/js/Pages/Students
```

### 📄 Index.vue

```vue
<template>
  <h1>Listado de Estudiantes</h1>
</template>
```

---

### 📄 Create.vue

```vue
<template>
  <h1>Crear Estudiante</h1>
</template>
```

---

## 6. DEFINICIÓN DE RUTAS

**Archivo:**
`routes/web.php`

### + RUTA RESOURCE

```php
use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class);
```

### + Rutas creadas automáticamente

| Método | URL              | Acción |
| ------ | ---------------- | ------ |
| GET    | /students        | index  |
| GET    | /students/create | create |
| POST   | /students        | store  |

---

## 7️. PRUEBAS SENCILLAS DE FUNCIONAMIENTO

### + PRUEBA 1: ACCESO A INDEX

Ir a:

```
http://127.0.0.1:8000/students
```

+ Debe mostrar:
**Listado de Estudiantes**

---

### + PRUEBA 2: ACCESO A CREATE

Ir a:

```
http://127.0.0.1:8000/students/create
```

✔ Debe mostrar:
**Crear Estudiante**

---

### + PRUEBA 3: REDIRECCIÓN

En el método `store()`:

```php
return redirect()->route('students.index');
```

 Hay que verificar que vuelve a:

```
/students
```

---

## 8. COMANDO PARA VER LAS RUTAS

```bash
php artisan route:list
```

### + Útil para:

* Ver nombres de rutas
* Ver métodos HTTP
* Depurar errores

---

## 9. ERRORES COMUNES 

* ❌ No ejecutar `npm run dev`
* ❌ No crear la carpeta `Students`
* ❌ Nombre incorrecto de la vista
* ❌ No importar `Inertia`

---

## Resumen de lo que hace Laravel, Inertiajs y Vue

> **Laravel maneja la lógica, Inertia conecta con Vue y las rutas unen todo.**

---

##  ACTIVIDAD RÁPIDA 

* Crear otro controller con `--resource`
* Crear una vista Vue simple
* Acceder por la ruta correspondiente
* Verificar la redirección

---
