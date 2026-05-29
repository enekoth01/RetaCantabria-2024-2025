# Reta Cantabria 2025

## Contenidos

[1. Información general.](#informacion-general)

[2. Tecnologías.](#tecnologias)

[3. Instrucciones de instalación y desarrollo.](#instrucciones-de-instalacion)

[4. Modificaciones a realizar.](#modificaciones-a-realizar)

## Información general

Plantilla para la modificación de una aplicación web durante el proyecto ABS **Alisal Me Activa** de primer curso de **Administración de Sistemas Informáticos en Red**.

## Tecnologías

- SQL.
- PHP.


## Instrucciones de instalación 

1. Copiar la carpeta **`INVENTARIO`** a la ubicación de publicación del servidor web.

2. Importar a MySql la base de datos que hayáis diseñado para el inventario.

3. A continuación se facilita la creación de un usuario de la BD con los premisos para hacer las operaciones de CRUD.

<details>
    <summary>Desplegar para ver el código</summary>

        -- Seleccionar la base de datos pdo
        USE pdo;
        -- Crear el usuario
        CREATE USER 'userCRUD'@'localhost' IDENTIFIED BY 'CRUD@1234';
        -- Otorgar permisos de CRUD sobre la base de datos pdo
        GRANT SELECT, INSERT, UPDATE, DELETE ON pdo.* TO 'userCRUD'@'localhost';
        -- Aplicar los cambios
        FLUSH PRIVILEGES;
</details>

## Modificaciones a realizar

<details>
    <summary>Desplegar para ver</summary>

    Fase 1: Preparación de la base de datos para que la aplicación pueda operar sobre ella
        Ejecutar la consulta del fichero **`/INVENTARIO-main/bd/pdo.sql`** para crear una tabla usuarios y cargar el usuario **Administrador/Administrador** del inventario.
        📌 Modificar dicha tabla para ajustarla a la de la base de datos diseñada.
        📌 Crear un usuario de la base de datos que pueda hacer las operaciones del CRUD.

    Fase 2: Establecer la conexión con la base de datos
        Modificar los parámetros de llamada de la función PHP de conexión a la base de datos, que está en **`/INVENTARIO-main/php/main.php`**, para que coincidan con los del servidor de desarrollo.
        *RECOMENDACIÓN:* Modificar la aplicación en un servidor local, actualizando el repositorio remoto para que todos los miembros del equipo tengáis acceso en todo momento a la aplicación actualizada. Una vez que verifiquéis la funcionalidad completa de la aplicación, migrarla al servidor web del reto, modificando de nuevo estos parámetros de conexión a la base de datos para que coincidan con los del servidor de producción. 

    Fase 3: Modificar los ficheros PHP necesarios para asegurar la funcionalidad de las operaciones de listado, búsqueda, creación y eliminación
        📌 Modificar los formularios de intercambio de datos, que se encuentran en el directorio /INVENTARIO-main/vistas para ajustar los campos a los de las tablas de la base de datos.
        📌 Adaptar las consultas SQL de los ficheros de /INVENTARIO-main/vistas y /INVENTARIO-main/php que lo requieran para que operen sobre los campos de la base de datos.

    Fase 4: Crear transformación XSL
        Construir un fichero de transformación /INVENTARIO-main/schemas/estilo-transformacion.xsl que visualice como HTML el fichero XML generado por la aplicación al solicitar un listado de los recursos del inventario.
        El formato aplicado a cada recurso será diferente en función del valor de su estado.
        El estilo de la transformación se definirá en un fichero CSS y se ubicará en el directorio adecuado de la aplicación.

    Fase 5: Creción de una nueva opción del menú de navegación
        📌 Modificar las opciones del menú de navegación, creando una nueva opción en el desplegable de Recursos que permitirá al usuario la carga masiva de la tabla de recursos a través de un fichero XML. El enlace estará asociado con el fichero /INVENTARIO-main/vistas/resource_upload_file.php.
        📌 Construir un vocabulario XML-Schema que llamaremos /INVENTARIO-main/schemas/validación_recursos.xsd para garantizar que la estructura y el formato de los datos del fichero xml de carga masiva es la adecuada para cargar los datos en la tabla de recursos.
        📌 Verificar la funcionalidad de la opción de carga masiva que se encuentra en el menú de Recursos.

    Fase 6: Modificar el estilo de la aplicación
        📌 Realizar los cambios necesarios en la aplicación para que el menú de navegación pase a tener orientación vertical.
        📌 Modificar el estilo de la aplicación de forma libre.

    A lo largo del proceso:
        - Mantener el código límpio y documentado.
        - Utilizar GitHub para mantener actualizado el versionado de código.
        - Actualizar el fichero **`README.md`** para mantener el repositorio de la aplicación documentado durante todo el proceso de desarrollo.
</details>
