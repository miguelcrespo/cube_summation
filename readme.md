Cube Summation Challenge
------------------------

Repositorio que contiene la implementación en Laravel del reto planteado en https://www.hackerrank.com/challenges/cube-summation.

**Demo:**
https://cube-summation-miguelcrespo.c9users.io/public/


![App](http://s16.postimg.org/c2znqlmat/Screen_Shot_2016_01_15_at_5_06_24_PM.png)


Capas de la aplicacion
=======
![Capas de la aplicacion](http://s2.postimg.org/atowpupe1/Screen_Shot_2016_01_15_at_8_14_23_PM.png)

**Capa del cliente:**
La capa del cliente ejecutada en el navegador se encarga de crear una interfaz interactiva para el usuario, ademas de realizar también las validaciones requeridas en el navegador para dar retroalimentación al usuario más rápidamente y ahorrar carga al servidor (Sin embargo también se realizan las validaciones en el servidor).

**Esta capa consiste de:**

 - Vue..JS para el data-binding y el manejo de la vista con Javascript.
 - Bootstrap y Jquery para los modals.
 - app.js encargado de configurar el vue.js y procesar las acciones del usuario en el cliente.

**Presentacion servidor:**
Se usa Laravel Blade para pre-renderizar la plantilla y usar una plantilla maestra para evitar la repetición de código HTML.

 **Logica servidor:**
 Esta capa se encarga de procesar la información que llega mediante peticiones del usuario y dar respuesta a este, consiste en las siguientes clases:

 - **Matrix.php: ** Es la encargada de llevar a cabo toda la lógica respecto a la multiplicación y actualización de datos en la matriz de 3D.
 - **CuboController.php:** Es el controlador que se encarga de procesar las peticiones del usuario, conectándose a **Matrix.php** para calcular las respuestas que serán dadas al usuario.

**Capa persistencia:**
Esta capa se encarga de guardar los datos de las respectivas sesiones de cada usuario para asi permitir el juego a diferentes personas con diferentes matrices, se implementaron sesiones para poder realizar un juego paso por paso donde el usuario vea las respuestas a sus comandos inmediatamente en vez de enviar todas los comandos de una vez.

**Esta capa consiste en:**

 - Datos.php que se encarga de manejar todo lo respectivo a las sesiones, al separar esta capa del resto de la aplicacion se permite que en un futuro sea más fácil cambiar la capa de persistencia sin afectar el resto de la aplicacion.


Ejemplo
--------


    Tests: 2
	N Matrix: 4
	N Comandos: 5

	UPDATE 2 2 2 4
	QUERY 1 1 1 3 3 3
	UPDATE 1 1 1 23
	QUERY 2 2 2 4 4 4
	QUERY 1 1 1 3 3 3

	N Matrix: 2
	N Comandos: 4

	UPDATE 2 2 2 1
	QUERY 1 1 1 1 1 1
	QUERY 1 1 1 2 2 2
	QUERY 2 2 2 2 2 2


Tests
-------

    phpunit