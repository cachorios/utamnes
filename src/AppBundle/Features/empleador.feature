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

Escenario: Cargar Nuevo Empleador


