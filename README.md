# Online Doctor Appointment System

## 1. Descripción del Proyecto

El **Sistema de Citas Médicas en Línea** es una plataforma web diseñada para facilitar el proceso de reserva de citas con médicos para pacientes, utilizando un enfoque eficiente para la programación de sesiones. El sistema permite a los pacientes buscar médicos, revisar sus horarios, y realizar solicitudes de citas desde cualquier dispositivo con acceso a Internet.

### Propósito

El objetivo de este sistema es optimizar el proceso de programación de citas, reduciendo los tiempos de espera y mejorando la experiencia tanto para médicos como para pacientes. Este sistema está dirigido a establecimientos médicos como clínicas y hospitales.

## 2. Componentes del Sistema

El sistema está compuesto por tres roles principales:

1. **Administrador**
    - Agregar, editar y eliminar médicos.
    - Programar nuevas sesiones de médicos y eliminarlas.
    - Ver detalles de los pacientes y sus citas.
  
2. **Médico**
    - Ver citas programadas y solicitudes de citas de los pacientes.
    - Gestionar su perfil y detalles.
    - Eliminar cuenta.

3. **Paciente**
    - Crear cuenta, hacer citas y ver citas anteriores.
    - Gestionar su perfil y detalles.
    - Eliminar cuenta.

### Interfaz de Usuario
- Acceso para Administradores, Médicos y Pacientes a través de una única página de inicio de sesión.

---

## 3. Instalación

### Requisitos del Sistema

- **XAMPP**: Para la ejecución de Apache y MySQL.
- **PHP**: Versión 7.3.5 o superior.
- **MySQL**: Para la base de datos.
- **PHPMyAdmin**: Para la gestión de la base de datos.

### Pasos para la instalación

1. **Iniciar XAMPP**:
   - Abre el panel de control de **XAMPP**.
   - Inicia **Apache** y **MySQL**.
   
2. **Configurar el Proyecto**:
   - Extrae el archivo ZIP del código fuente descargado.
   - Copia la carpeta extraída a la carpeta **htdocs** de **XAMPP**.

3. **Configurar la Base de Datos**:
   - Abre **PHPMyAdmin** en tu navegador (http://localhost/phpmyadmin).
   - Crea una base de datos llamada **edoc**.
   - Importa el archivo **edoc.sql** que se encuentra en la raíz del código fuente.

---

## 4. Datos de Prueba

Para facilitar las pruebas iniciales, se proporcionan cuentas predeterminadas:

- **Administrador**
  - Email: `admin@edoc.com`
  - Contraseña: `admin`

- **Médico**
  - Email: `doctor@edoc.com`
  - Contraseña: `doctor`

- **Paciente**
  - Email: `patient@edoc.com`
  - Contraseña: `patient`

---

## 5. Tecnologías Utilizadas

- **Servidor Web**: Apache 2.4.39
- **PHP**: 7.3.5
- **Base de Datos**: MySQL
- **PHPMyAdmin**: Herramienta para gestionar bases de datos
- **XAMPP**: Paquete de herramientas para desarrollo local

---

## 6. Estructura del Proyecto

### 6.1 Patrones de Diseño

Este sistema sigue el patrón **Modelo-Vista-Controlador (MVC)**, lo que permite una separación clara entre la lógica de negocio, la presentación de datos y la gestión de las solicitudes de los usuarios.

- **Modelo**: Se encarga de la interacción con la base de datos.
- **Vista**: Se encarga de mostrar los datos al usuario (interfaz de usuario).
- **Controlador**: Maneja las interacciones del usuario y las respuestas del sistema.

### 6.2 Estándares de Programación

Se han seguido buenas prácticas de desarrollo para garantizar un código limpio y mantenible, tales como:

- **Convenciones de nombres** claras y consistentes.
- **Control de errores** adecuado en las interacciones con la base de datos.
- **Modularidad** en el código para facilitar el mantenimiento y la reutilización.

### 6.3 Manejo de la Base de Datos

La base de datos utiliza **MySQL** y se encuentra estructurada en tablas como:

- **admin**: Almacena la información de los usuarios (administradores, médicos y pacientes).
- **appointment**: Almacena las citas programadas entre pacientes y médicos.
- **doctor**: Contiene la información de los médicos.
- **patient**: Contiene la información de los pacientes.
- **payments**: Contiene la información de los pagos.
- **reviews**: Contiene la información de las reseñas hacia los medicos.
- **specialties**: Contiene la información de las especialidades de los medicos.
- **webuser**: Contiene la información del tipo de usuario. 
- **schedule**: Guarda las sesiones programadas de los médicos.

La base de datos se configura mediante el archivo **edoc.sql**, el cual es importado durante la instalación del sistema.

---

## 7. Pruebas

Se han implementado pruebas unitarias utilizando **PHPUnit** para asegurar la fiabilidad del sistema. Las pruebas cubren:

- Validaciones de entrada de datos del usuario.
- Verificación de las interacciones con la base de datos.
- Funcionalidad de los módulos principales (como la creación de citas y la gestión de cuentas).

---

## 8. Flujo de Trabajo

El flujo de trabajo de desarrollo para este proyecto se basó en el modelo **Git Flow**. Esto permitió una gestión eficiente de las ramas y el control de versiones mientras se implementaban nuevas funcionalidades y correcciones. A continuación se describe el flujo de trabajo seguido:

---

### 9. Ramas de Características (Feature Branches)

Las nuevas funcionalidades o mejoras se desarrollaron en ramas específicas para cada tarea o módulo. Estas ramas se creaban a partir de la rama `develop` y tenían el siguiente formato:

- **`feature/{nombre-de-la-funcionalidad}`**

#### Ejemplo de Creación de Ramas de Características:
- **`feature/nombre`**: Para nuevas funcionalidades.
- **`fix/nombre`**: Para correcciones de errores.
- **`test/nombre`**: Para agregar o modificar pruebas.

### 9.1 Convenciones de Commit

Los mensajes de commit siguieron la convención **Conventional Commits**, que facilita la claridad y organización del historial de cambios. Los tipos de cambios más comunes fueron:

- **`feat:`** para nuevas funcionalidades.
- **`fix:`** para correcciones de errores.
- **`chore:`** para tareas de mantenimiento, como la limpieza de archivos.
- **`test:`** para agregar o modificar pruebas.

---
