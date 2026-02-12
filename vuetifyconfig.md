
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

- Si aparece el botón azul -> Vuetify está funcionando correctamente.
-AHORA, si NO aparece asi podriamos probar con lo siguiente
- En la carpeta JS hay que crear otra carpeta con el nombre de Plugins.
Dentro de Plugins hay que importar algunas configuraciones de vuetify en un nuevo archivo llamado `vuetify.js`
```vue
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { mdi } from 'vuetify/iconsets/mdi'

export default createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        sets: {
            mdi,
        },
    },
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#22c55e', // Verde principal
                    secondary: '#fbbf24', // Amarillo secundario
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#ffffff',
                    surface: '#ffffff',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#2d3748',
                    'on-surface': '#2d3748',
                    'grey-50': '#f9fafb',
                    'grey-100': '#f3f4f6',
                    'grey-200': '#e5e7eb',
                    'grey-300': '#d1d5db',
                    'grey-400': '#9ca3af',
                    'grey-500': '#6b7280',
                    'grey-600': '#4b5563',
                    'grey-700': '#374151',
                    'grey-800': '#1f2937',
                    'grey-900': '#111827',
                }
            },
            dark: {
                dark: true,
                colors: {
                    primary: '#22c55e',
                    secondary: '#fbbf24',
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#1f2937',
                    surface: '#374151',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#f9fafb',
                    'on-surface': '#f9fafb',
                }
            }
        }
    }
})
```
---
###  También modificar el archivo ```app.js``` con el siguiente codigo.
```vue

import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import vuetify from './Plugins/vuetify'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

```
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
