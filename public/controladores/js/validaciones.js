function validarCamposObligatorios() {
    var bandera = false
    var banderav = true
    var banderac = false
    var banderae = false
    var banderaf = false
    for (var i = 0; i < document.forms[0].elements.length - 2; i++) {
        var elemento = document.forms[0].elements[i]
        if (elemento.value == '' && (elemento.type == 'text' || elemento.type == 'password')) {
            if (elemento.id == 'cedula') {
                document.getElementById('mensajeCedula').innerHTML = '<br>La cedula esta vacía'
            } else if (elemento.id == 'nombres') {
                document.getElementById('mensajeNombres').innerHTML = '<br>Los nombres estan vacíos'
            } else if (elemento.id == 'apellidos') {
                document.getElementById('mensajeApellidos').innerHTML = '<br>Los apellidos estan vacíos'
            } else if (elemento.id == 'direccion') {
                document.getElementById('mensajeDireccion').innerHTML = '<br>La dirección esta vacía'
            } else if (elemento.id == 'telefono') {
                document.getElementById('mensajeTelefono').innerHTML = '<br>El telefono está vacío'
            } else if (elemento.id == 'fechaNacimiento') {
                document.getElementById('mensajeFechaNacimiento').innerHTML = '<br>La fecha de nacimiento esta vacía'
            } else if (elemento.id == 'correo') {
                document.getElementById('mensajeCorreo').innerHTML = '<br>El correo esta vacío'
            } else if (elemento.id == 'contrasena') {
                document.getElementById('mensajeContrasena').innerHTML = '<br>La contraseña esta vacía'
            }
            elemento.style.border = "1px red solid"
            banderav = false
        }
        if (elemento.id == 'cedula') {
            if (valCedula(elemento.id) == true) {
                banderac = true
            } else {
                elemento.style.border = "1px red solid"
            }
        }
        if (elemento.id == 'correo') {
            if (valCorreo(elemento.id) == true) {
                banderae = true
            } else {
                elemento.style.border = "1px red solid"
            }
        }
        if (elemento.id == 'fechaNacimiento') {
            if (valFecha(elemento.id) == true) {
                banderaf = true
            } else {
                elemento.style.border = "1px red solid"
            }
        }
    }
    if (banderav == true && banderac == true && banderae == true && banderaf == true) {
        bandera = true
    }
    console.log(bandera)
    return bandera
}

function valLetras(datos) {
    var na = document.getElementById(datos.id).value
    if (datos.id == 'nombres') {
        var n = na.substr(na.length - 1).charCodeAt(0)
        if ((n >= 65 && n <= 90) || (n >= 97 && n <= 122) || n == 32 || n == 225 || n == 233 || n == 237 || n == 243 || n == 250 || n == 193 || n == 201 || n == 205 || n == 211 || n == 218) {
            nom = na.split(" ").length
            if (nom > 2) {
                datos.style.border = "1px red solid"
                document.getElementById('mensajeNombres').innerHTML = '<br>Solo se permiten dos nombres'
            }
        } else {
            document.getElementById('nombres').value = na.substr(0, na.length - 1)
        }
    } else if (datos.id == 'apellidos') {
        var n = na.substr(na.length - 1).charCodeAt(0)
        if ((n >= 65 && n <= 90) || (n >= 97 && n <= 122) || n == 32 || n == 225 || n == 233 || n == 237 || n == 243 || n == 250 || n == 193 || n == 201 || n == 205 || n == 211 || n == 218) {
            ape = n.split(" ").length
            if (ape > 2) {
                datos.style.border = "1px red solid"
                document.getElementById('mensajeApellidos').innerHTML = '<br>Solo se permiten dos apellidos'
            }
        } else {
            document.getElementById('apellidos').value = na.substr(0, na.length - 1)
        }
    }
}

function valFecha(valor) {
    var fecha = document.getElementById(valor).value
    if (fecha.length == 10 && fecha !== '') {
        var dia = fecha.substr(0, 2)
        var mes = fecha.substr(3, 2)
        var año = fecha.substr(6, 4)
        var s1 = fecha.substr(2, 1)
        var s2 = fecha.substr(5, 1)
        var val1 = false
        var val2 = false
        var val3 = false
        var val4 = false
        var vals = false
        var valg = true
        añov = parseInt(año)
        diav = parseInt(dia)

        if (mes == '01' || mes == '03' || mes == '05' || mes == '07' || mes == '08' || mes == '10' || mes == '12') {
            diav = parseInt(dia)
            if (diav >= 1 && diav <= 31) {
                val1 = true;
            }
        } else if (mes == '02') {
            if (añov % 4 == 0) {
                if (diav >= 1 && diav <= 29) {
                    val2 = true;
                }
            } else {
                if (diav >= 1 && diav <= 28) {
                    val3 = true;
                }
            }
        } else if (mes == '04' || mes == '06' || mes == '09' || mes == '11') {
            if (diav >= 1 && diav <= 30) {
                val4 = true;
            }
        }
        var fechaActual = new Date();
        var diaActual = fechaActual.getDate()
        var mesActual = fechaActual.getMonth() + 1
        var añoActual = fechaActual.getFullYear()
        if (s1 == '/' && s2 == '/') {
            vals = true
        } else {
            document.getElementById('mensajeFechaNacimiento').innerHTML = '<br> El formato de fecha es incorrecto'
            valg = false
        }
        if (parseInt(año) < añoActual) {
            if ((val1 == true || val2 == true || val3 == true || val4 == true) && vals == true) {
                document.getElementById('mensajeFechaNacimiento').innerHTML = ''
            }
        } else if (parseInt(año) >= añoActual) {
            if ((val1 == true || val2 == true || val3 == true || val4 == true) && vals == true && parseInt(mes) <= mesActual && parseInt(dia) <= diaActual) {
                document.getElementById('mensajeFechaNacimiento').innerHTML = ''
            } else {
                if (vals == false) {
                    document.getElementById('mensajeFechaNacimiento').innerHTML = '<br>El formato de fecha es incorrecto'
                    valg = false
                } else {
                    document.getElementById('mensajeFechaNacimiento').innerHTML = '<br>La fecha es incorrecta'
                    valg = false
                }
            }
        }
        if (val1 == false && val2 == false && val3 == false && val4 == false) {
            document.getElementById('mensajeFechaNacimiento').innerHTML = '<br>La fecha es incorrecta'
            valg = false
        }
    } else {
        document.getElementById('mensajeFechaNacimiento').innerHTML = '<br>La fecha es incorrecta o está vacía'
        valg = false
    }
    return valg;
}

function valNumeros(datos) {
    var nums = document.getElementById(datos.id).value
    if (datos.id == 'telefono') {
        document.getElementById('mensajeTelefono').innerHTML = ''
        var n = nums.substr(nums.length - 1).charCodeAt(0)
        if (n >= 48 && n <= 57) {
            if (nums.length > 10) {
                datos.style.border = "1px red solid"
                document.getElementById('mensajeTelefono').innerHTML = '<br>Número de teléfono incorrecto'
            }
        } else {
            document.getElementById('telefono').value = nums.substr(0, nums.length - 1)
        }
    }
}

function valCedula(valor) {
    var ced = document.getElementById(valor).value.trim()
    var bandera = true;
    var valp = false
    var valtd = false
    var valud = false
    var total = 0
    if (ced.length != 10 || ced.value == '') {
        document.getElementById('mensajeCedula').innerHTML = '<br>Número de cédula vacío, incompleto o excedido'
        bandera = false;
    } else {
        document.getElementById('mensajeCedula').innerHTML = ''
        var prov = parseInt(ced.substr(0, 2))
        if (prov >= 1 && prov <= 24) {
            valp = true
        } else {
            bandera = false;
            document.getElementById('mensajeCedula').innerHTML = '<br>No existe la provincia - 01 a 24'
        }
        var terd = parseInt(ced.substr(2, 1))
        if (terd >= 0 && terd <= 5) {
            valtd = true
        } else {
            bandera = false;
            document.getElementById('mensajeCedula').innerHTML = '<br>Tercer Digito Incorrecto - 0 a 5'
        }
        var lon = ced.length
        for (var i = 0; i < lon - 1; i++) {
            if (i % 2 == 0) {
                var digp = ced.charAt(i) * 2
                if (digp > 9) digp -= 9
                total += digp
            } else {
                total += parseInt(ced.charAt(i))
            }
        }
        var ud = total % 10 ? 10 - total % 10 : 0;
        if (ud == parseInt(ced.substr(lon - 1, 1))) {
            valud = true
        } else {
            bandera = false;
            document.getElementById('mensajeCedula').innerHTML = '<br>Último Digito Incorrecto'
        }

        if (valp == true && valtd == true && valud == true) {
        } else if (valp == false && valtd == false) {
            bandera = false;
            document.getElementById('mensajeCedula').innerHTML = '<br>Provincia (01-24) y Tercer Digito (0-5) Incorrectos'
        }
    }
    return bandera;
}

function valCorreo(valor) {
    var correo = document.getElementById(valor).value.trim()
    bandera = true
    var lon = correo.length
    var cm = '@ups.edu.ec'
    var ce = '@est.ups.edu.ec'
    if (lon <= 70) {
        var cm1 = correo.substr(lon - 11, lon - 1)
        var ce1 = correo.substr(lon - 15, lon - 1)
        if (cm1 == cm && lon >= 14 && (n >= 65 && n <= 90) || (n >= 97 && n <= 122) || (n >= 48 && n <= 57)) {
            console.log(cm1)
            document.getElementById('mensajeCorreo').innerHTML = ''
        } else if (ce1 == ce && lon >= 18 && (n >= 65 && n <= 90) || (n >= 97 && n <= 122) || (n >= 48 && n <= 57)) {
            console.log(ce1)
            document.getElementById('mensajeCorreo').innerHTML = ''
        } else {
            bandera = false;
            document.getElementById('mensajeCorreo').innerHTML = '<br>Fuera Requisitos - Tener 3 caracteres alfanumericos como minimo y finalizar(@est.ups.edu.ec / @ups.edu.ec)'
        }
    } else {
        bandera = false;
        document.getElementById('mensajeCorreo').innerHTML = '<br> El correo excede el tamaño establecido'
    }
    return bandera;
}