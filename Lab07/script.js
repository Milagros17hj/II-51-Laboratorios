document.getElementById("validarBtn").addEventListener("click", function () {
  const nombre = document.getElementById("nombre").value.trim();
  const apellido = document.getElementById("apellido").value.trim();
  const correo = document.getElementById("correo").value.trim();
  const mensaje = document.getElementById("mensaje");

  const correoValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);

  if (nombre === "" || apellido === "" || correo === "") {
    mensaje.textContent = "Debe completar todos los campos.";
    mensaje.className = "alert alert-danger";
  } else if (!correoValido) {
    mensaje.textContent = "Ingrese un correo válido.";
    mensaje.className = "alert alert-warning";
  } else {
    mensaje.textContent = `Bienvenido, ${nombre} ${apellido}. Tu correo es: ${correo}`;
    mensaje.className = "alert alert-success";

    // Limpiar campos después de validar
    document.getElementById("miFormulario").reset();
  }

  Swal.fire(mensaje.textContent);
});
