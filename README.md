# Reta Cantabria 2024/2025

Proyecto académico basado en la adaptación y ampliación de una aplicación web de inventario en PHP y SQL, desarrollado en el marco del proyecto **ABS Alisal Me Activa** del ciclo de **Administración de Sistemas Informáticos en Red (ASIR)**.

## Descripción general

**Reta Cantabria 2024/2025** es una plantilla de trabajo orientada a la modificación de una aplicación web existente para adaptarla a nuevos requisitos funcionales, estructurales y visuales.

El proyecto se centra en la integración entre aplicación web y base de datos, la adaptación de operaciones CRUD, la validación de datos en XML, la transformación XSL y la mejora de la interfaz, todo ello dentro de un entorno de desarrollo colaborativo y documentado.

## Tecnologías

- PHP
- SQL
- MySQL
- XML
- XSD
- XSLT
- Git
- GitHub

## Objetivos del proyecto

Este proyecto permite trabajar competencias técnicas relacionadas con:

- Configuración y adaptación de aplicaciones web existentes.
- Gestión de bases de datos relacionales.
- Conexión entre PHP y MySQL.
- Implementación y mantenimiento de operaciones CRUD.
- Validación de datos mediante XML Schema.
- Transformación de datos XML a HTML mediante XSL.
- Mejora visual y estructural de interfaces web.
- Trabajo colaborativo con control de versiones.

## Instalación y desarrollo

### 1. Publicación de la aplicación

Copiar la carpeta `INVENTARIO` en la ubicación de publicación del servidor web.

### 2. Importación de la base de datos

Importar en MySQL la base de datos diseñada para el inventario.

### 3. Creación del usuario de base de datos

A continuación se muestra un ejemplo de creación de un usuario con permisos para realizar operaciones CRUD sobre la base de datos:

```sql
-- Seleccionar la base de datos
USE pdo;

-- Crear el usuario
CREATE USER 'userCRUD'@'localhost' IDENTIFIED BY 'CRUD@1234';

-- Otorgar permisos CRUD sobre la base de datos
GRANT SELECT, INSERT, UPDATE, DELETE ON pdo.* TO 'userCRUD'@'localhost';

-- Aplicar los cambios
FLUSH PRIVILEGES;
```

## Modificaciones a realizar

### Fase 1: Preparación de la base de datos

- Ejecutar la consulta del fichero ` /INVENTARIO-main/bd/pdo.sql ` para crear una tabla de usuarios.
- Cargar el usuario inicial `Administrador/Administrador` del inventario.
- Modificar la tabla para ajustarla al diseño final de la base de datos.
- Crear un usuario de base de datos con permisos para las operaciones CRUD.

### Fase 2: Conexión con la base de datos

- Modificar los parámetros de conexión en ` /INVENTARIO-main/php/main.php ` para adaptarlos al servidor de desarrollo.
- Trabajar inicialmente en un servidor local.
- Actualizar el repositorio remoto de forma continua para mantener acceso compartido al estado del proyecto.
- Una vez validada la aplicación, migrarla al servidor web del reto y reajustar la configuración para producción.

### Fase 3: Adaptación de formularios y consultas

- Modificar los formularios de intercambio de datos ubicados en ` /INVENTARIO-main/vistas `.
- Ajustar los campos de formulario a la estructura real de la base de datos.
- Adaptar las consultas SQL de los archivos en ` /INVENTARIO-main/vistas ` y ` /INVENTARIO-main/php `.
- Verificar la funcionalidad de listado, búsqueda, creación y eliminación de registros.

### Fase 4: Transformación XSL

- Crear el fichero ` /INVENTARIO-main/schemas/estilo-transformacion.xsl `.
- Transformar a HTML el XML generado por la aplicación al solicitar un listado de recursos del inventario.
- Aplicar un formato visual distinto a cada recurso según su estado.
- Definir el estilo mediante un archivo CSS ubicado en el directorio correspondiente de la aplicación.

### Fase 5: Nueva opción de carga masiva

- Añadir una nueva opción al menú de navegación dentro del desplegable de recursos.
- Asociar esta opción al fichero ` /INVENTARIO-main/vistas/resource_upload_file.php `.
- Crear el esquema ` /INVENTARIO-main/schemas/validacion_recursos.xsd `.
- Garantizar mediante XML Schema que la estructura y el formato del fichero XML sean válidos para la carga masiva.
- Verificar el correcto funcionamiento de la nueva opción.

### Fase 6: Mejora visual de la aplicación

- Modificar el menú de navegación para que tenga orientación vertical.
- Realizar cambios libres en el estilo visual de la aplicación.

## Buenas prácticas aplicadas durante el desarrollo

A lo largo del proceso se deben mantener las siguientes prácticas:

- Código limpio y documentado.
- Uso de GitHub para el versionado continuo del proyecto.
- Actualización constante del archivo `README.md`.
- Trabajo progresivo en entorno local antes del despliegue final.
- Validación funcional antes de migrar a producción.

## Estructura del proyecto

```text
INVENTARIO-main/
├── bd/
│   └── pdo.sql
├── php/
│   └── main.php
├── vistas/
├── schemas/
│   ├── estilo-transformacion.xsl
│   └── validacion_recursos.xsd
└── README.md
```

## Valor técnico del proyecto

Este proyecto resulta relevante a nivel formativo y profesional porque combina en una misma práctica varias áreas fundamentales:

- Desarrollo web backend con PHP.
- Administración y diseño de bases de datos.
- Adaptación de aplicaciones existentes a nuevos modelos de datos.
- Procesamiento, validación y transformación de documentos XML.
- Mejora visual y reorganización de la interfaz.
- Documentación técnica y control de versiones.

## Estado del proyecto

Proyecto académico en desarrollo, orientado a la personalización técnica y funcional de una aplicación web de inventario.

## Licencia

Proyecto desarrollado con fines educativos y formativos.
