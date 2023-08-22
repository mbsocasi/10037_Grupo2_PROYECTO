let preguntas = [];
let correcta = [];
let opciones = [];

fetch('opciones.json')
  .then(response => response.json())
  .then(data => {
    preguntas = data.preguntas;
    correcta = data.correcta;
    opciones = data.opciones;
  });

//variable que guarda la posicion actual
let posActual = 0;
//variable que guarda la cantidad acertadas hasta el moemento
let cantidadAcertadas = 0;
//variable para almacenar el nombre del usuario
let nombreUsuario = '';
//variable para almacenar las opciones seleccionadas por el usuario
let opcionesSeleccionadas = [];

function comenzarJuego(){
    // Obtenemos el valor del campo de entrada y lo almacenamos en la variable nombreUsuario
    nombreUsuario = document.getElementById('nombre-usuario').value;

    // Verificamos si el campo está vacío
    if (nombreUsuario.trim() === '') {
        // Si está vacío, mostramos un mensaje al usuario
        alert('Por favor ingresa tu nombre antes de comenzar el juego');
        return;
    }

    //reseteamos las variables
    posActual = 0;
    cantidadAcertadas = 0;
    //activamos las pantallas necesarias
    document.getElementById("pantalla-inicial").style.display = "none";
    document.getElementById("pantalla-juego").style.display = "block";
    cargarPregunta();
}


//funcion que carga la siguiente bandera y sus opciones
function cargarPregunta(){
    //controlo sis se acabaron las preguntas
    if(preguntas.length <= posActual){
        terminarJuego();
    }
    else{//cargo las opciones
        //limpiamos las clases que se asignaron
        limpiarOpciones();

        document.getElementById("imgBandera").src = "img/" + preguntas[posActual];
        document.getElementById("n0").innerHTML = opciones[posActual][0];
        document.getElementById("n1").innerHTML = opciones[posActual][1];
        document.getElementById("n2").innerHTML = opciones[posActual][2];
    }
}

function limpiarOpciones(){
    document.getElementById("n0").className = "nombre";
    document.getElementById("n1").className = "nombre";
    document.getElementById("n2").className = "nombre";

    document.getElementById("l0").className = "letra";
    document.getElementById("l1").className = "letra";
    document.getElementById("l2").className = "letra";
}

function comprobarRespuesta(opElegida){
    // Guardamos la opción seleccionada en la variable opcionesSeleccionadas
    opcionesSeleccionadas.push(opElegida);

    if(opElegida==correcta[posActual]){//acertó
        //agregamos las clases para colocar el color verde a la opcion elegida
        document.getElementById("n" + opElegida).className = "nombre nombreAcertada";
        document.getElementById("l" + opElegida).className = "letra letraAcertada";
        cantidadAcertadas++;
    }else{//no acerto
        //agramos las clases para colocar en rojo la opcion elegida
        document.getElementById("n" + opElegida).className = "nombre nombreNoAcertada";
        document.getElementById("l" + opElegida).className = "letra letraNoAcertada";

        //opcion que era correcta
        document.getElementById("n" + correcta[posActual]).className = "nombre nombreAcertada";
        document.getElementById("l" + correcta[posActual]).className = "letra letraAcertada";
    }
    posActual++;
    //Esperamos 1 segundo y pasamos mostrar la siguiente bandera y sus opciones
    setTimeout(cargarPregunta,1000);
}
function terminarJuego(){
    //ocultamos las pantallas y mostramos la pantalla final
    document.getElementById("pantalla-juego").style.display = "none";
    document.getElementById("pantalla-final").style.display = "block";
    //agreamos los resultados
    document.getElementById("numCorrectas").innerHTML = cantidadAcertadas;
    document.getElementById("numIncorrectas").innerHTML = preguntas.length - cantidadAcertadas;
    
    // Eliminamos cualquier elemento h2 existente que muestre el nombre del usuario
    let mensajeFinalAnterior = document.querySelector('#pantalla-final h2');
    if (mensajeFinalAnterior) {
        mensajeFinalAnterior.remove();
    }

    // Mostramos el nombre del usuario
    let mensajeFinal = document.createElement('h2');
    mensajeFinal.textContent = 'Usuario: ' + nombreUsuario;
    document.getElementById('pantalla-final').appendChild(mensajeFinal);

    // Guardamos el resultado en el archivo resultados.json en el servidor utilizando PHP y una solicitud POST
    guardarResultado();
}

function volverAlInicio(){
    //ocultamos las pantallas y activamos la inicial
    document.getElementById("pantalla-final").style.display = "none";
    document.getElementById("pantalla-inicial").style.display = "block";
    document.getElementById("pantalla-juego").style.display = "none";
    location.reload();
}

function guardarResultado() {
    // Creamos un objeto con el nombre del usuario, las opciones seleccionadas y el número de respuestas correctas
    let resultado = {
        usuario: nombreUsuario,
        opcionesSeleccionadas: opcionesSeleccionadas,
        respuestasCorrectas: cantidadAcertadas
    };

    // Enviamos una solicitud POST al script guardar.php en el servidor con los datos del resultado
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`usuario=${resultado.usuario}&opcionesSeleccionadas=${JSON.stringify(resultado.opcionesSeleccionadas)}&respuestasCorrectas=${resultado.respuestasCorrectas}`);
}

function mostrarTabla() {
    // Obtenemos una referencia al botón "MOSTRAR RESULTADOS"
    let botonMostrarResultados = document.querySelector('#pantalla-inicial .btn1');

    // Verificamos si la tabla ya está visible
    let tabla = document.querySelector('#pantalla-inicial table');
    if (tabla) {
        // Si la tabla está visible, la ocultamos
        tabla.style.display = (tabla.style.display === 'none') ? 'table' : 'none';

        // Actualizamos el texto del botón "MOSTRAR RESULTADOS"
        botonMostrarResultados.textContent = (tabla.style.display === 'none') ? 'MOSTRAR RESULTADOS' : 'OCULTAR RESULTADOS';
    } else {
        // Si la tabla no está visible, leemos el contenido del archivo resultados.json
        fetch('resultados.json')
            .then(response => response.json())
            .then(data => {
                // Creamos una tabla con los usuarios y sus respuestas correctas
                let tabla = document.createElement('table');
                let filaEncabezado = document.createElement('tr');
                let celdaEncabezadoUsuario = document.createElement('th');
                celdaEncabezadoUsuario.textContent = 'Usuario';
                filaEncabezado.appendChild(celdaEncabezadoUsuario);
                let celdaEncabezadoRespuestasCorrectas = document.createElement('th');
                celdaEncabezadoRespuestasCorrectas.textContent = 'Respuestas Correctas';
                filaEncabezado.appendChild(celdaEncabezadoRespuestasCorrectas);
                tabla.appendChild(filaEncabezado);

                for (let resultado of data) {
                    let fila = document.createElement('tr');
                    let celdaUsuario = document.createElement('td');
                    celdaUsuario.textContent = resultado.usuario;
                    fila.appendChild(celdaUsuario);
                    let celdaRespuestasCorrectas = document.createElement('td');
                    celdaRespuestasCorrectas.textContent = resultado.respuestasCorrectas;
                    fila.appendChild(celdaRespuestasCorrectas);
                    tabla.appendChild(fila);
                }

                // Mostramos la tabla en la pantalla final
                document.getElementById('pantalla-inicial').appendChild(tabla);

                // Actualizamos el texto del botón "MOSTRAR RESULTADOS"
                botonMostrarResultados.textContent = 'OCULTAR RESULTADOS';
            });
    }
}


