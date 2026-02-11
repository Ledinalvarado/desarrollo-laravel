
#  Laravel + Inertia + Vue + Vuetify

## Implementación de Vuetify y Ruta POST para Student

---

#  PARTE 1 — INSTALAR VUETIFY EN LARAVEL + INERTIA + VUE

 Se asume que ya tienes:

* Laravel instalado
* Breeze con `vue`
* `npm install` ejecutado

---

## 1️. Instalar Vuetify

 Ejecutar en la raíz del proyecto (donde está `package.json`):

```bash
npm install vuetify
```

Instalar iconos recomendados:

```bash
npm install @mdi/font
```

---

## 2️. Configurar Vuetify

Ir a:

```
resources/js/app.js
```

---

###  Importar Vuetify

```js
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
```

---

### Crear instancia de Vuetify

```js
const vuetify = createVuetify()
```

---

###  Modificar `createInertiaApp`

```js
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .mount(el)
    },
})
```

---

## 3️. Compilar

```bash
npm run dev
```

---

## 4️. Prueba rápida

En cualquier vista Vue (por ejemplo `Index.vue`):

```vue
<template>
  <v-container>
    <v-btn color="primary">Botón Vuetify</v-btn>
  </v-container>
</template>
```

✔ Si aparece el botón azul → Vuetify está funcionando correctamente.

---

#  PARTE 2 — IMPLEMENTAR RUTA POST PARA STUDENT

---

## 1️. Verificar Ruta Resource

 Archivo:

```
routes/web.php
```

Debe existir:

```php
use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class);
```

Esto crea automáticamente:

```
POST /students → store()
```

---

#  PARTE 3 — MÉTODO STORE EN EL CONTROLLER

 Archivo:

```
app/Http/Controllers/StudentController.php
```

---

###  Implementar `store()`

```php
use App\Models\Student;
use Illuminate\Http\Request;

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string',
        'phone' => 'required|string'
    ]);

    Student::create($request->all());

    return redirect()->route('students.index')
        ->with('success', 'Estudiante creado correctamente');
}
```

---

###  IMPORTANTE

En el modelo `Student.php` agregar:

```php
protected $fillable = [
    'name',
    'email',
    'phone'
];
```

---

#  PARTE 4 — FORMULARIO CON VUETIFY + INERTIA

 Crear archivo:

```
resources/js/Pages/Students/Create.vue
```

---

##  Formulario con Vuetify

```vue
<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  phone: ''
})

const submit = () => {
  form.post('/students')
}
</script>

<template>
  <v-container>
    <v-card>
      <v-card-title>Crear Estudiante</v-card-title>

      <v-card-text>
        <v-text-field v-model="form.name" label="Nombre" />
        <v-text-field v-model="form.email" label="Correo" />
        <v-text-field v-model="form.phone" label="Teléfono" />
      </v-card-text>

      <v-card-actions>
        <v-btn color="primary" @click="submit">
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
```

---

#  PARTE 5 — PRUEBA DE FUNCIONAMIENTO

1️. Ir a:

```
/students/create
```

2️. Llenar formulario
3️. Presionar **Guardar**

✔ Debe redirigir a `/students`
✔ Debe guardar en base de datos

---

#  ¿QUÉ ESTÁ PASANDO AQUÍ?

| Tecnología | Función                   |
| ---------- | ------------------------- |
| Laravel    | Procesa datos             |
| Inertia    | Conecta backend y Vue     |
| Vue        | Maneja la vista           |
| Vuetify    | Diseño visual             |
| Route POST | Envía datos al controller |

---

#  ERRORES COMUNES

*  No agregar `$fillable`
*  No ejecutar `npm run dev`
*  Ruta mal escrita en `form.post()`
*  No importar `useForm`
*  No ejecutar migraciones

---

# ASPECTO CLAVE 

> Inertia permite enviar datos al backend sin necesidad de crear una API separada, manteniendo una arquitectura limpia y moderna.

---
