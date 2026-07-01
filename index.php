<!doctype html>
<html>
<head>
  <title>Dirline</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <button class="request-button" type="button" onclick="window.location.href='public/auth/logreg.php'">
      Login
    </button>
    <section class="hero-text">
      <h1>LAKO I JEDNOSTAVNO DODJITE <br>DO <span class="blue">JEDINSTVENOG</span> REŠENJA</h1>
      <p>Adekvatna podrška za razvoj vašeg <span class="purple">web sajta</span></p>
    </section>

    <section class="swirl-wrap">
      <svg class="swirl" width="724" height="594" viewBox="0 0 724 594" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M619 12.5H624.465C660.717 12.5 678.701 56.4849 652.832 81.8831C645.25 89.3277 635.045 93.4932 624.418 93.481L205 93H336.5H162H51C24.2142 93 2.5 114.714 2.5 141.5C2.5 168.286 24.2142 190 51 190H103H153.75C182.055 190 205 212.945 205 241.25C205 269.555 182.055 292.5 153.75 292.5H118H50C23.7665 292.5 2.5 313.766 2.5 340C2.5 366.234 23.7665 387.5 50 387.5H118H156C183.062 387.5 205 409.438 205 436.5C205 463.562 183.062 485.5 156 485.5H118H50.5C23.9903 485.5 2.5 506.99 2.5 533.5C2.5 560.01 23.9903 581.5 50.5 581.5H118H205" stroke="url(#paint0_linear_47_154)" stroke-width="5"/>
        <path d="M206.5 581.5C206.5 587.023 210.977 591.5 216.5 591.5C222.023 591.5 226.5 587.023 226.5 581.5C226.5 575.977 222.023 571.5 216.5 571.5C210.977 571.5 206.5 575.977 206.5 581.5Z" stroke="#9A42E8" stroke-width="5"/>
        <path d="M621.5 13.5V12.5C621.5 6.97715 617.023 2.5 611.5 2.5C605.977 2.5 601.5 6.97715 601.5 12.5V13.5C601.5 19.0228 605.977 23.5 611.5 23.5C617.023 23.5 621.5 19.0228 621.5 13.5Z" stroke="#5B42E8" stroke-width="5"/>
        <defs>
          <linearGradient id="paint0_linear_47_154" x1="294.25" y1="11" x2="294.25" y2="575.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="#5B42E8"/>
            <stop offset="1" stop-color="#9A42E8"/>
          </linearGradient>
        </defs>
      </svg>

      <div class="bubble bubble-1">
        <p>Potreban <br> vam je <br> savet?</p>
      </div>

      <div class="bubble bubble-2">
        <p>Zakažite besplatne konsultacije!</p>
      </div>

      <div class="forma">
        <label class="label">Ime</label>
        <input class="input" type="text" placeholder="Value">
        <label class="label">Email adresa</label>
        <input class="input" type="email" placeholder="Value">
        <label class="label">Broj telefona</label>
        <input class="input" type="tel" placeholder="Value">
        <label class="label">Poruka</label>
        <textarea placeholder="Zanima me..."></textarea>
        <button class="request-button">Želim da me kontaktirate!</button>
      </div>

      <div class="right-image">
        <img src="assets/img/image1.png" alt="Dirline tim">
      </div>

    </section>

<!-- OVO IDE ISPOD SEKCIJE -->
    <section class="donji-tekst">
      <div class="levi-tekst">
        <p>
          Naša misija je da vašu ideju pretvorimo u digitalnu stvarnost – od
          <span class="purple">kreativnog dizajna</span> do
          <span class="blue">tehnički besprekorne realizacije</span>.
        </p>
      </div>

      <div class="desni-tekst">
        <h3>KRATKI BENEFITI:</h3>
        <ul>
          <li><span class="blue">Brza</span> i <span class="purple">sigurna</span> realizacija</li>
          <li><span class="purple">Moderan dizajn</span> po <span class="blue">vašoj meri</span></li>
          <li>Potpuno <span class="blue">responzivni</span> <span class="purple">sajtovi</span></li>
          <li><span class="blue">Tehnička podrška</span> i <span class="purple">održavanje</span></li>
        </ul>
      </div>
    </section>

    <section class="about mt-20">
    
    <header class="mb-16">
        <h1 class="text-center text-4xl font-bold">
            O NAMA
        </h1>
    </header>

    <div class="about-cards">

        <!-- Kartica 1 -->
        <article class="about-card">
            <div class="bg-[#091B37] p-8 text-white md:w-[70%]">
                <h2 class="mb-4 text-3xl font-bold">
                    KO STOJI IZA DIRLINE-A?
                </h2>

                <p class="text-lg md:text-xl">
                    Mi smo <span class="blue">David</span> i
                    <span class="purple">Iskra</span> Radisavljević – brat i sestra
                    koje spaja ambicija prema dizajnu i tehnologiji.

                    David se fokusira na funkcionalnost, strukturu i optimizaciju,
                    dok Iskra unosi kreativnost, estetiku i vizuelni identitet.
                    Zajedno spajamo logiku i umetnost, gradeći digitalna rešenja
                    koja su i moćna i lepa.
                </p>
            </div>

            <figure class="md:w-[30%]">
                <img
                    src="assets/img/image2.png"
                    class="h-full w-full object-cover"
                >
            </figure>
        </article>

        <!-- Kartica 2 -->
      <article class="about-card about-card-center bg-white p-8">
          <h2 class="mb-6 text-center text-3xl font-bold">
              ZAŠTO BAŠ DIRLINE?
          </h2>

          <p class="text-lg md:text-xl">
              Naziv Dirline dolazi od našeg ličnog potpisa –
              <strong>DIR</strong> = David, Iskra, Radisavljević,
              što znači da iza svakog projekta stoji naš zajednički rad,
              kreativnost i posvećenost.

              Sve počinje od linije – linija je osnova svakog dizajna,
              svake ideje i svakog koda. Dirline je naš simbol:
              od prve povučene linije na papiru do gotovog sajta koji
              spaja ljude i ideje. Verujemo da svaka linija ima svoju svrhu,
              a naš zadatak je da je usmerimo ka rešenju koje vam donosi vrednost.
          </p>
      </article>

        <!-- Kartica 3 -->
        <article class="about-card">
            <figure class="md:w-[30%]">
                <img
                    src="assets/img/image3.png"
                    class="h-full w-full object-cover"
                >
            </figure>

            <div class="bg-[#091B37] p-8 text-right text-white md:w-[70%]">
                <h2 class="mb-4 text-3xl font-bold">
                    NAŠE VREDNOSTI
                </h2>

                <p class="mb-4 text-lg md:text-xl">
                    Naš rad zasnivamo na tri stuba:
                </p>

                <ul class="space-y-2 text-lg md:text-xl">
                    <li><strong>Kreativnost</strong> – svaka ideja zaslužuje jedinstven vizuelni izraz.</li>
                    <li><strong>Preciznost</strong> – obraćamo pažnju na detalje koji prave razliku.</li>
                    <li><strong>Pouzdanost</strong> – tu smo i nakon lansiranja sajta.</li>
                </ul>
            </div>
        </article>

    </div>

</section>


  </div>
</body>
</html>