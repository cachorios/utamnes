#language: es

Característica: Administración de Empleadores
    Como en la aplicacion es un auto-gestion de empleadores
    Debemos brindar las  tareas basica de CRUD


Antecedentes:
    Dado que estoy en la pagina "/admin"
    Y que estoy autenticado como "cachorios@gmail.com" clave "11"

Escenario: Lista de Empleadores
    Cuando voy a la pagina "/admin/empleador/"
    Entonces deberia estar en la pagina "/admin/empleador/"
    Y debo ver "Lista de Empleadores" como titulo


Escenario: Nuevo empleador
    Dado que estoy en la pagina "/admin/empleador/"
    Cuando presiono en el link "Nuevo Empleado"
    Entonces deberia estar en la pagina "/admin/empleador/new"
    Y debo ver "Nuevo Empleador" como titulo

Escenario: Rellenar formulario Nuevo Empleador
    Dado que estoy en la pagina "/admin/empleador/new"
    Y aun no existe el empleador Amarilla Eugenia
    Y relleno el campo "appbundle_empleador_razon" con "Amarilla Eugenia"
    Y relleno el campo "appbundle_empleador_cuit" con "2716111111"
    Y relleno el campo "appbundle_empleador_direccion" con "Calle 69 Cas 9821"
    Y relleno el campo "appbundle_empleador_telefono" con "154720203"
    Y relleno el campo "appbundle_empleador_email" con "eugeolay@hotmail.com"
    Y relleno el campo "appbundle_empleador_localidad" con "Posadas"
    Cuando presiono en el boton "Guardar"
    Entonces deberia estar en la pagina "/admin/empleador/"
    Y debo ver "Lista de Empleadores" como titulo
    Y debo ver el mensaje de success "se creó correctamente"

#    Y debo recibir un email con el texto "xxxx"
