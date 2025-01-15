<main class="contenedor seccion">
            <h1>Más sobre Nosotros</h1>
            <div class="iconos-nosotros">
                <div class="icono">
                    <img src="build/img/icono1.svg" alt="icono seguridad"
                        loading="lazy">
                    <h3>Seguridad</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Quibusdam, alias in incidunt commodi iste perferendis
                        ipsa ipsum itaque beatae aliquam aspernatur ut
                        voluptatum ab natus eius cum tempore ipsam fugit?</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono2.svg" alt="icono precio"
                        loading="lazy">
                    <h3>Precio</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Quibusdam, alias in incidunt commodi iste perferendis
                        ipsa ipsum itaque beatae aliquam aspernatur ut
                        voluptatum ab natus eius cum tempore ipsam fugit?</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono3.svg" alt="icono tiempo"
                        loading="lazy">
                    <h3>A tiempo</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Quibusdam, alias in incidunt commodi iste perferendis
                        ipsa ipsum itaque beatae aliquam aspernatur ut
                        voluptatum ab natus eius cum tempore ipsam fugit?</p>
                </div>
            </div>
        </main>

        <section class="seccion contenedor">
            <h2>Casas y Deptos en Venta</h2>
            
            <?php 
            $limite = 3;
            include 'listado.php'
            ?>

            <div class="alinear-derecha">
                <a href="/propiedades" class="boton-verde">Ver Todas</a>
            </div>
        </section>

        <section class="imagen-contacto">
            <h2>Encuentra la casa de tus sueños</h2>
            <p>Llena el formulario de contacto y un asesor se pondra en contacto
                contigo a la brevedad</p>
            <a href="/contacto" class="boton-amarillo">Contacto</a>
        </section>

        <div class="contenedor seccion seccion-inferior">
            <section class="blog">
                <h3>Nuestro Blog</h3>
                <article class="entrada-blog">
                    <div class="imagen">
                        <picture>
                            <source srcset="build/img/blog1.webp"
                                type="image/webp">
                            <source srcset="build/img/blog1.jpg"
                                type="image/jpeg">
                            <img src="build/img/blog1.jpg" alt="imagen Blog"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="texto-entrada">
                        <a href="/entrada">
                            <h4>Terraza en el techo de tu casa</h4>
                            <p class="informacion-meta">Escrito el:
                                <span>2/11/2024</span> por:
                                <span>Marcos</span></p>
                            <p>Consejo para construir una terraza en el techo de
                                tu casa, con lo mejores materiales y al mejor
                                precio</p>
                        </a>
                    </div>
                </article>

                <article class="entrada-blog">
                    <div class="imagen">
                        <picture>
                            <source srcset="build/img/blog2.webp"
                                type="image/webp">
                            <source srcset="build/img/blog2.jpg"
                                type="image/jpeg">
                            <img src="build/img/blog2.jpg" alt="imagen Blog"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="texto-entrada">
                        <a href="/entrada">
                            <h4>Guia para la decoración de tu hogar</h4>
                            <p class="informacion-meta">Escrito el:
                                <span>2/11/2024</span> por:
                                <span>Marcos</span></p>
                            <p>Maximiza el espacio de tu hogar con esta guia,
                                aprende a combinar muebles y colores para darle
                                vida a tu espacio</p>
                        </a>
                    </div>
                </article>
            </section>

            <section class="testimoniales">
                <h3>Testimoniales</h3>
                <div class="testimonial">
                    <blockquote>
                        El personal se comportó de excelente forma, muy buena
                        atención y la casa ofrecida cumplió con todas mis
                        espectativas.
                    </blockquote>
                    <p>--Marcos Bruno--</p>
                </div>
            </section>
        </div>