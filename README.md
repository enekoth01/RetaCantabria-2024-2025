# Paleta en Mano

Plataforma web para la gestión integral de una academia de arte, orientada a la administración de usuarios, clases, grupos, inventario y comunicaciones internas.

## Descripción del proyecto

Paleta en Mano es una aplicación web desarrollada como proyecto académico con enfoque profesional, simulando un entorno real de gestión de una academia de arte y su infraestructura TI.  
La solución centraliza la operativa diaria de la academia (gestión de alumnos, profesores, clases, materiales y comunicaciones internas) en un único sistema, con control de acceso basado en roles y tareas automatizadas mediante scripts en servidor.

Este proyecto pone el foco en buenas prácticas de desarrollo web, administración de sistemas Linux, automatización de tareas y seguridad básica en entornos productivos.

## Características principales

- Gestión completa de usuarios y roles (administración, profesores, alumnos).
- Administración de clases, grupos y asignación de profesores.
- Sistema de notificaciones internas entre usuarios autenticados.
- Gestión de inventario de materiales de la academia.
- Control de notas y seguimiento académico por alumno y grupo.
- Automatización de tareas administrativas mediante scripts en Bash.
- Sistema de copias de seguridad automáticas de la base de datos.
- Arquitectura preparada para despliegues escalables en servidores Linux.

## Roles del sistema

La aplicación adapta sus funcionalidades según el tipo de usuario autenticado.

### Administradores

Los administradores disponen de acceso completo a las funcionalidades de administración del sistema.

#### Gestión de usuarios

- Archivo principal: `admin_usu.php`
- Funcionalidades:
  - Visualización de usuarios registrados.
  - Creación de nuevos usuarios.
  - Modificación de datos existentes.
  - Control de usuarios creados recientemente.

#### Gestión de clases

- Archivo principal: `admin_clases.php`
- Funcionalidades:
  - Administración de clases disponibles.
  - Asignación de grupos y profesores.
  - Organización de las actividades académicas.

#### Sistema de notificaciones

- Archivo principal: `notificaciones.php`
- Funcionalidades:
  - Envío de notificaciones globales.
  - Consulta de mensajes leídos y no leídos.
  - Comunicación interna entre usuarios.

#### Perfil de usuario

- Archivo principal: `perfil.php`
- Funcionalidades:
  - Modificación de datos personales.
  - Actualización de credenciales y configuración.

### Profesores

Los profesores disponen de herramientas orientadas al seguimiento académico y a la organización de sus grupos.

#### Mis clases

- Archivo principal: `misclases_prof.php`
- Funcionalidades:
  - Consulta de clases asignadas.
  - Acceso a notas e inventario asociado.
  - Gestión académica de alumnos.

#### Sistema de notificaciones

- Archivo principal: `notificaciones.php`
- Funcionalidades:
  - Consulta de avisos y comunicaciones internas.

#### Perfil de usuario

- Archivo principal: `perfil.php`
- Funcionalidades:
  - Gestión de información personal.

## Scripts de automatización

### `nuevosUsers.sh`

Script orientado a la provisión de nuevos usuarios en el sistema.

- Creación automática de usuarios en el servidor.
- Generación de claves SSH.
- Preparación del acceso remoto seguro para nuevos usuarios.

Ejemplo de uso:

```bash
./nuevosUsers.sh nombre_usuario
```

### `backupsBaseDatos.sh`

Script destinado a la generación automática de copias de seguridad mediante `mysqldump`.

- Exportación completa de la base de datos.
- Automatización mediante tareas cron.
- Soporte para recuperación ante fallos y pérdida de datos.

Ejemplo de automatización diaria (cron):

```bash
0 2 * * * /ruta/backupsBaseDatos.sh
```

## Tecnologías utilizadas

### Backend

- PHP 8.x
- MySQL / MariaDB
- PDO para acceso a base de datos

### Frontend

- HTML5
- CSS3
- JavaScript

### Infraestructura y sistemas

- Linux
- Bash scripting
- SSH
- Cron Jobs
- Servidor web Apache o Nginx

### Control de versiones

- Git
- GitHub

## Seguridad

La aplicación incorpora medidas orientadas a garantizar la integridad y seguridad del sistema:

- Autenticación de usuarios.
- Control de permisos por roles.
- Uso de PDO para conexiones seguras a base de datos (prevención de inyecciones SQL).
- Automatización de copias de seguridad periódicas.
- Acceso remoto mediante claves SSH en lugar de contraseñas planas.

## Estructura del proyecto

```text
/
├── admin/
├── profesores/
├── alumnos/
├── funciones/
├── scripts/
├── bbdd/
├── assets/
├── evidencias/
└── README.md
```

## Instalación y despliegue

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/usuario/repositorio.git
   cd repositorio
   ```

2. Configurar la base de datos:

   - Crear una base de datos en MySQL / MariaDB.
   - Importar los scripts SQL incluidos en el directorio:

   ```text
   /bbdd/
   ```

3. Configurar credenciales de conexión:

   - Editar el archivo de configuración correspondiente (por ejemplo, `config.php` o similar).
   - Ajustar host, nombre de base de datos, usuario y contraseña.

4. Configurar el servidor web:

   - Configurar Apache o Nginx apuntando al directorio principal del proyecto.
   - Asegurarse de que PHP esté habilitado y correctamente configurado.

5. Acceso a la aplicación:

   - Abrir el navegador y acceder a la URL configurada en el servidor (por ejemplo, `http://localhost/paleta-en-mano`).

## Objetivos del proyecto

Este proyecto busca simular un entorno real de administración TI aplicando conceptos relacionados con:

- Desarrollo web orientado a gestión interna.
- Administración de sistemas Linux.
- Gestión de usuarios y permisos.
- Automatización de tareas de administración mediante scripts.
- Seguridad informática básica en entorno servidor.
- Trabajo colaborativo y control de versiones con Git y GitHub.

## Estado del proyecto

Proyecto académico en desarrollo activo, con base funcional completa para la gestión interna de una academia de arte y margen de ampliación para nuevas funcionalidades.


## Licencia

Proyecto desarrollado con fines educativos y formativos.  
Puede adaptarse y reutilizarse para fines académicos o personales, respetando el reconocimiento de la autoría original.
