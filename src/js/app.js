document.addEventListener('DOMContentLoaded', () => {
    eventListeners();
    darkMode();
})

const darkMode = () => {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    botonDarkMode = document.querySelector('.dark-mode-boton');


    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        const nuevoSrc = document.body.classList.contains('dark-mode')
            ? "/build/img/light-mode.svg"
            : "/build/img/dark-mode.svg";

        botonDarkMode.setAttribute('src', nuevoSrc);
    })

}


const eventListeners = () => {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //Mostrar campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}


const navegacionResponsive = () => {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

const mostrarMetodosContacto = (e) => {
    const contacto = document.querySelector('#contacto');
    if (e['target']['value'] === 'telefono') {
        contacto.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu teléfono" id="telefono" name="contacto[telefono]">

                    <p>Elija fecha y hora para ser contactado</p>

                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="contacto[fecha]">

                    <label for="hora">Hora</label>
                    <input type="time" id="hora" min="9:00" max="18:00" name="contacto[hora]">
        `;
    } else if (e['target']['value'] === 'email') {
        contacto.innerHTML = `
                    <label for="email">E-Mail</label>
                    <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>
        `;
    }
}