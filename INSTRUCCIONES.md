
#  Fase de Configuración y Modelado de Sistema

---

# PARTE 1 — CONFIGURACIÓN INICIAL (RAMA: base-configuracion)

##  Objetivo

Configurar correctamente el entorno del proyecto antes de iniciar el desarrollo del sistema educativo.
Tener un proyecto base configurado para su uso en las clases.
---

##  PASOS OBLIGATORIOS

### 1️. Crear el proyecto

- Crear un nuevo proyecto con Laravel.
- Configurar conexión a base de datos.
- Verificar funcionamiento del servidor.

---

### 2️. Instalar autenticación

- Instalar Laravel Breeze.
- Seleccionar stack: Vue + Inertia.
- Ejecutar migraciones.
- Verificar:
  - Registro
  - Login
  - Logout
  - Middleware `auth`

---

### 3️. Configurar Frontend

- Verificar que Vue 3 esté funcionando.
- Instalar Vuetify.
- Integrar Vuetify al proyecto.
- Crear layout principal con:
  - Barra de navegación
  - Menú lateral
  - Área dinámica de contenido

Debe existir al menos:
- Una vista protegida por autenticación.
- Uso de un componente Vuetify (ej. botón o tabla).

---

### 4️. Control de Versiones

1. Inicializar repositorio Git.
2. Crear repositorio en GitHub.
3. Subir proyecto.
4. Crear rama:

```
base-configuracion
```

Esta rama debe contener únicamente:
- Proyecto configurado
- Breeze funcionando
- Vue + Inertia funcionando
- Vuetify integrado
- Layout base listo
 
**NO deben existir modelos académicos aún en esta rama.**

---

#  PARTE 2 — MODELOS Y RELACIONES DEL SISTEMA

Una vez finalizada la configuración inicial, se debe crear una nueva rama:

```

dev

```

En esta rama se desarrollará el sistema educativo.

---

#  MODELOS OBLIGATORIOS Y SUS RELACIONES

---

## 1️. User

(Ya creado por Breeze)

### Relación:
- 1:1 con Profile

```

User 1 —— 1 Profile

```

---

## 2. Profile

Tabla adicional para información extendida del usuario.

### Relación:
- Pertenece a User (1:1)

```

Profile —— pertenece a —— User

```

---

## 3️. Teacher

Representa a los docentes.

### Relaciones:

- 1:N con Course

```

Teacher 1 —— N Course

```

Un docente puede impartir varios cursos.

---

## 4️. Student

Representa a los estudiantes.

### Relaciones:

- N:M con Course (a través de Enrollment)

```

Student N —— M Course

```

---

## 5️. Course

Representa los cursos académicos.

### Relaciones:

- Pertenece a Teacher (N:1)
- Pertenece a AcademicPeriod (N:1)
- N:M con Student (mediante Enrollment)

```

Course —— pertenece a —— Teacher
Course —— pertenece a —— AcademicPeriod
Course N —— M Student

```

---

## 6️. AcademicPeriod

Representa períodos académicos (ej. 2026-I).

### Relación:

- 1:N con Course

```

AcademicPeriod 1 —— N Course

```

Un período puede tener varios cursos.

---

## 7️. Enrollment (Tabla Intermedia)

Representa la matrícula de un estudiante en un curso.

### Relaciones:

- Pertenece a Student
- Pertenece a Course
- 1:N con Grade

```

Enrollment —— pertenece a —— Student
Enrollment —— pertenece a —— Course
Enrollment 1 —— N Grade

```

---

## 8️. Grade

Representa evaluaciones o notas.

### Relación:

- Pertenece a Enrollment

```

Grade —— pertenece a —— Enrollment

```

Una matrícula puede tener varias calificaciones.

---

# RESUMEN GENERAL DE RELACIONES

```

User 1 —— 1 Profile

Teacher 1 —— N Course
AcademicPeriod 1 —— N Course

Student N —— M Course (por Enrollment)

Enrollment 1 —— N Grade

```

---

#  REQUERIMIENTOS DE IMPLEMENTACIÓN

Cada modelo debe incluir:

- Migración con llaves foráneas
- Relaciones en el Modelo (Eloquent) correspondiente
- Controlador
- Rutas protegidas en web.php 
- TRABAJAR EN CLASE
  - CRUD completo
  - Uso de Vuetify en formularios y tablas

---

#  RESULTADO ESPERADO

Al finalizar:

- La rama `base-configuracion` contiene únicamente la configuración inicial.
- La rama `development` contiene todas las tablas y relaciones con sus rutas 



---
CLASE DE DESARROLLO DE SOFTWARE
