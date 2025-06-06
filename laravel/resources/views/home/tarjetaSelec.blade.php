<main id=app>
  
  <h1><button onclick="window.location='{{ route('home') }}'" style="margin-top: 2rem; padding: 0.5em 1.5em; border-radius: 8px; border: none; background: #2e2e2e; color: #fff; font-size: 1rem; cursor: pointer;">
    Volver a inicio
  </button></h1>
  
  <aside class="card-front">
     <label class="number" for="cardNumber">
      {{ $cuenta->num_cuenta ?? '---- ---- ---- ----' }}
    </label>
    <label class="name" for="cardHolder">
      {{ $user->nombre ?? 'Nombre Usuario' }}
    </label>
    <label class="expiry" for="expiryMonth">
      {{ $cuenta->fecha_expiracion ? \Carbon\Carbon::parse($cuenta->fecha_expiracion)->format('d M. Y') : 'N/A' }}
    </label>
    <img class="cardLogo" style="opacity: 1;" src="https://simey-credit-card.netlify.app/img/logos/master.svg" alt="Card Logo">
      
    <div class="chip">
      <svg role="img" viewBox="0 0 100 100" aria-label="Chip">
        <use href="#chip-lines" />
      </svg>
    </div>
    <svg class="contactless" role="img" viewBox="0 0 24 24" aria-label="Contactless">
      <use href="#contactless">
    </svg>
    
  </aside>
  
</main>





<svg id="chip">
  <g id="chip-lines">
    <polyline points="0,50 35,50"></polyline>
    <polyline points="0,20 20,20 35,35"></polyline>
    <polyline points="50,0 50,35"></polyline>
    <polyline points="65,35 80,20 100,20"></polyline>
    <polyline points="100,50 65,50"></polyline>
    <polyline points="35,35 65,35 65,65 35,65 35,35"></polyline>
    <polyline points="0,80 20,80 35,65"></polyline>
    <polyline points="50,100 50,65"></polyline>
    <polyline points="65,65 80,80 100,80"></polyline>
  </g>
</svg>


<svg id="contactless">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M9.172 15.172a4 4 0 0 1 5.656 0"></path>
   <path d="M6.343 12.343a8 8 0 0 1 11.314 0"></path>
   <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0"></path>
</svg>

<style>:root {

  --glitter: url("https://assets.codepen.io/13471/silver-glitter-background.png");
  --duration: 6.66s;

}

.card-front:before {

  content: "";
  inset: 0;
  position: absolute;
  transform: translate3d(0, 0, 0.01px);

  background-image: var(--glitter), var(--glitter),
    linear-gradient(120deg, black 25%, white, black 75%);
  background-size: 100% 100%, 80% 80%, 200% 200%;
  background-blend-mode: multiply, multiply, overlay;
  background-position: 50% 50%, 50% 50%, 50% 50%;

  mix-blend-mode: color-dodge;
  filter: brightness(2) contrast(0.8);

  animation: bg var(--duration) ease infinite;

}

.card-front {

  display: grid;
  position: relative;
  transform: translate3d(0, 0, 0.01px);
  width: 90vw;
  max-width: 580px;
  aspect-ratio: 3/2;

  border-radius: 3.5% 3.5% 3.5% 3.5% / 5% 5% 5% 5%;

  background-image: url(https://simey-credit-card.netlify.app/img/bgs/default.jpg);
  background-size: cover;

  box-shadow: 0 30px 40px -25px rgba(15, 5, 20, 1), 0 20px 50px -15px rgba(15, 5, 20, 1);
  overflow: hidden;
  animation: tilt var(--duration) ease infinite;
  image-rendering: optimizequality;

}

.card-front:after {
  
  content: "";
  background: none, none, linear-gradient(125deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.4) 0.1%, rgba(255,255,255,0) 60%);
  background-size: 200% 200%;
  mix-blend-mode: hard-light;
  animation: bg var(--duration) ease infinite;
  
}






.card-front * {

  font-family: PT Mono, monospace;

}

.cardLogo,
.expiry,
.name,
.number,
.chip,
.icon {

  color: #ccc;
  position: absolute;
  margin: 0;
  padding: 0;
  letter-spacing: 0.075em;
  text-transform: uppercase;
  font-size: clamp(0.75rem, 2.8vw + 0.2rem, 1.1rem);
  inset: 5%;
  text-shadow: -1px -1px 0px rgba(255,255,255,0.5),1px -1px 0px rgba(255,255,255,0.5),1px 1px 0px rgba(0,0,0,0.5),1px -1px 0px rgba(0,0,0,0.5);
  z-index: 5;

}

.name, .number, .expiry {
  background-image: linear-gradient(to bottom, #ededed 20%, #bababa 70%), none,
    linear-gradient(120deg, transparent 10%, white 40%, white 60%, transparent 90%);
  background-size: cover, cover, 200%;
  background-position: 50% 50%;
  background-blend-mode: overlay;
  -webkit-text-fill-color: transparent;
  -webkit-background-clip: text;
  animation: bg var(--duration) ease infinite;
  
}

.number {

  font-family: PT Mono, monospace;
  text-align: center;
  font-size: clamp(1rem, 8vw - 0.5rem, 2.5rem);
  letter-spacing: 0.025em;
  top: 60%;
  bottom: auto;

}
.expiry,
.name {

  top: auto;

}

.name {

  right: auto;
  max-width: 180px;
  line-height: 1.2;
  text-align: left;

}

.expiry {

  left: auto;

}

.cardLogo {

  bottom: auto;
  left: auto;
  width: 15%;
  filter: invert(1) saturate(0) brightness(1) contrast(1.2);
  mix-blend-mode: screen;

}

.chip {

  display: grid;
  place-items: center;
  width: 14%;
  aspect-ratio: 5/4;
  left: 10%;
  top: 30%;
  border-radius: 10% 10% 10% 10% / 15% 15% 15% 15%;

  background-image: none, none,
    linear-gradient(120deg, #777 10%, #ddd 40%, #ddd 60%, #777 90%);
  background-size: 200% 200%;
  background-position: 50% 50%;

  overflow: hidden;
  animation: bg var(--duration) ease infinite;

}













.chip svg {

  display: block;
  width: 90%;
  fill: none;
  stroke: #444;
  stroke-width: 2;

}

.contactless {

  position: absolute;
  left: 23%;
  top: 30%;
  width: 12%;
  rotate: 90deg;

  stroke-width: 1.25;
  stroke: currentColor;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
  opacity: 0.5;

}

.icon {

  width: 25%;
  bottom: auto;
  right: auto;
  top: 0;
  left: 15px;
  filter: invert(1) hue-rotate(180deg) saturate(5) contrast(2);

}


























@keyframes tilt {

  0%, 100% { transform: translate3d(0, 0, 0.01px) rotateY(-20deg) rotateX(5deg); }
  50% { transform: translate3d(0, 0, 0.01px) rotateY(20deg) rotateX(5deg); }

}

@keyframes bg {

  0%, 100% { background-position: 50% 50%, calc(50% + 1px) calc(50% + 1px), 0% 50%; }
  50% { background-position: 50% 50%, calc(50% - 1px) calc(50% - 1px), 100% 50%; }

}


main {

  display: grid;
  grid-template-rows: minmax(20px,100px) 1fr;
  place-items: center;
  min-height: 100%;
  perspective: 1000px;

}

body {

  color: white;
  background: #333844;
  font-family: "Heebo", sans-serif;
  background: url(https://images.pexels.com/photos/3612932/pexels-photo-3612932.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  backdrop-filter: blur(5px);

}

body,
html {

  height: 100%;
  padding: 0;
  margin: 0;

}

#chip,
#contactless {

  display: none;

}

h1 {
  margin: 1em;
  color: white;
  opacity: 0.7;
  text-shadow: 0 1px 1px black;
}</style>