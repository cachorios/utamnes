# Uta Misiones #

## Introducción ##

Hacer una Aplicación Web, para administrar los aportes y contribuciones de los afiliados a través de sus empleadores.
Para lograr este cometido, los empleadores, tendrán que informar en cada periodo de liquidación, los empleados que aporten a uta y sus remuneraciones para determinar los importes de aporte y contribuciones, registrado esto, el empleador podrá generar su cupón de pago para los medios habilitados, cuando este pague, el ente recaudador informa el pago, se registra en el sistema la cancelación de este devengado.
Como esto es un proceso periódico, los procesos de generación  de devengados y pagos van generando la cuenta corriente del empleador, donde este podrá consultarlo cuando lo requiera. Como se puedo devengar sin pago, en cualquier momento se podrá reimprimir el cupón de pago.

## Alcance ##

El sistema inicialmente contendrá tres módulos, CMS, administración y auto-gestión, en el futuro se podría implementar gestión personal, para que cada trabajador puede ver su estado o aportes.

El módulo CMS, será una aplicación independiente, implementando Drupal CMS, desde este se podrá administrar los contenidos dinámicos del sitio, este sería el portal de UTA, aquí tendríamos el punto de acceso para el módulo "auto-gestión".


## Guía para desarrollo ##

Tanto Administración como Auto-gestión dependen del usuario con el cual se ingresa al sitio, por lo que primero describiremos.

### Usuarios de Administración ###

Para administrar el sitio se requieren roles especiales, (`ROLE_ADMIN, ROLE_UTA`), como es necesario que existe el primer usuario, este se creará por consola de comando, a partir de esto, ingresará al sitio y podra crear otros usuarios, y realizar tares de administración.

Para crear un usuario de este tipo, se requiere un seudonimo, email, al crear el usuario, se envía por correo información para confirmación de usuario.    


  
  
## Procedimiento para generar cupón: ##
Se requiere un empleador autenticado en el sistema.
De este requerimiento, tendremos una entidad de Empleador con atributos para autenticarse.
     
