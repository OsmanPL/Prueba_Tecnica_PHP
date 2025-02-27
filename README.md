# Prueba_Tecnica_PHP

Este proyecto es una prueba técnica en PHP que utiliza Docker para la configuración del entorno de desarrollo. Incluye servicios para PHP, MySQL y un `Makefile` para facilitar la inicialización y ejecución de las pruebas.

## Requisitos

- Docker
- Docker Compose
- Make

## Configuración del Entorno
### 1. Clonar Repositorio
```sh
git clone https://github.com/OsmanPL/Prueba_Tecnica_PHP
cd Prueba_Tecnica_PHP
```

### 2. Inicializar el Entorno 
Para inicializar el entorno, construir y levantar los contenedores, y ejecutar las dependencias de Composer, usa el siguiente comando:
```sh
make init
```

### 3. Ejecutar los Tests
Para ejecutar las pruebas unitarias y de integración, usa el siguiente comando:
```sh
make test
```

### 4. Bajar los contenedores
Para bajar los contenedores, usa el siguiente comando:
```sh
make down
```

## Otros Comandos
### Levantar Contenedores
Si ya has inicializado el entorno anteriormente y solo necesitas levantar los contenedores, usa el siguiente comando:
```sh
make up
```

### Instalar dependencias de Composer
Para instalar las dependencias de Composer, usa el siguiente comando:
```sh
make composer-install
```

Contacto
Para cualquier pregunta o problema, por favor contacta a [osmanperez66@gmail.com].