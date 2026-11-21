(() => {
 'use strict';
 const root = document.querySelector('.sc-experience');
 if (!root) return;
 const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
 if ('IntersectionObserver' in window && !reduce) {
  root.classList.add('sc-motion');
  const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); } }), {threshold: .08});
  root.querySelectorAll('.sc-reveal').forEach(el => observer.observe(el));
 }
 const stages = [
  ['Understand<br><em>your step.</em>', 'Advanced foot scanning helps us understand pressure, alignment and the way you move.'],
  ['Look beyond<br><em>the surface.</em>', 'Clinical assessment connects what your feet tell us with your comfort, lifestyle and individual needs.'],
  ['Made for<br><em>only you.</em>', 'Custom orthotics and footwear bring together considered materials and a fit shaped around your feet.'],
  ['Go your<br><em>own way.</em>', 'Take your next steps with personalized support and guidance from the StepCure team.']
 ];
 const tabs = [...root.querySelectorAll('[data-stage]')];
 let active = -1;
 function setStage(index) {
  if (active === index) return;
  active = index;
  document.getElementById('sc-stage-title').innerHTML = stages[index][0];
  document.getElementById('sc-stage-description').textContent = stages[index][1];
  document.getElementById('sc-process-count').textContent = `0${index + 1} — 04`;
  tabs.forEach((tab, i) => {tab.classList.toggle('is-active', i === index); tab.setAttribute('aria-pressed', String(i === index));});
  root.querySelector('.sc-footprint').style.transform = `rotate(${22 - index * 13}deg)`;
 }
 const process = document.getElementById('sc-process');
 let scrollPending = false;
 function syncScroll() {
  scrollPending = false;
  if (innerWidth <= 800 || reduce) return;
  const rect = process.getBoundingClientRect();
  if (rect.top <= 0 && rect.bottom >= innerHeight) {
   const progress = Math.min(1, Math.max(0, -rect.top / Math.max(1, process.offsetHeight - innerHeight)));
   setStage(Math.min(3, Math.floor(progress * 4)));
  }
 }
 addEventListener('scroll', () => {if (!scrollPending) {scrollPending = true; requestAnimationFrame(syncScroll);}}, {passive:true});
 tabs.forEach((tab, i) => tab.addEventListener('click', () => {
  setStage(i);
  if (innerWidth > 800 && !reduce) {
   const top = scrollY + process.getBoundingClientRect().top;
   window.scrollTo({top:top + (process.offsetHeight - innerHeight) * ((i + .15) / 4), behavior:'instant'});
  }
 }));
 setStage(0);
 const canvas = document.getElementById('sc-pressure');
 const ctx = canvas.getContext('2d');
 if (!ctx) return;
 let width = 0, height = 0, pixelRatio = 1, visible = true, frame = 0, last = 0;
 const pointer = {x:0,y:0};
 const particles = [];
 // A point-cloud foot silhouette: an abstract visual, never a clinical measurement.
 for (let y = 0; y < 1; y += .012) {
  const center = .49 + Math.sin(y * 5) * .055;
  const radius = y < .23 ? .16 + y * .3 : y < .6 ? .23 - (y - .23) * .38 : .09 + Math.sin((y - .6) / .4 * Math.PI) * .045;
  for (let x = center - radius; x < center + radius; x += .012) {
   const edge = Math.abs(x - center) / radius;
   if (edge < 1) particles.push({x,y:y * .77 + .19,z:Math.sin(edge * Math.PI) * .06,heat:Math.exp(-((y-.79)**2)/.009) + .75*Math.exp(-((y-.17)**2)/.008)});
  }
 }
 [[.32,.17,.075,.095],[.47,.1,.054,.07],[.59,.11,.047,.06],[.69,.15,.04,.05],[.77,.21,.032,.04]].forEach(([cx,cy,rx,ry]) => {
  for(let x=cx-rx;x<cx+rx;x+=.012) for(let y=cy-ry;y<cy+ry;y+=.012) if(((x-cx)/rx)**2+((y-cy)/ry)**2<1) particles.push({x,y,z:.04,heat:.15});
 });
 function resize() {
  const box = canvas.getBoundingClientRect(); width = box.width; height = box.height;
  pixelRatio = Math.min(devicePixelRatio || 1, 1.5);
  canvas.width = Math.round(width * pixelRatio); canvas.height = Math.round(height * pixelRatio);
  ctx.setTransform(pixelRatio,0,0,pixelRatio,0,0);
  if (reduce) draw(0);
 }
 function draw(time) {
  ctx.clearRect(0,0,width,height);
  const scale = Math.min(width * 1.15, height * .98);
  const drift = reduce ? 0 : Math.sin(time * .0005) * .045;
  ctx.save(); ctx.translate(width * .49 + pointer.x * 12,height * .5 + pointer.y * 8);
  ctx.scale(1, .94);
  particles.forEach(p => {
   const x=(p.x-.5)*scale*(1+drift) + p.z * pointer.x * 35;
   const y=(p.y-.5)*scale;
   const scan = reduce ? 0 : Math.max(0,1-Math.abs(p.y-((time*.00012)%1)) * 16);
   const heat = Math.min(1,p.heat);
   ctx.fillStyle = heat>.45 ? `rgba(233,${Math.round(190-heat*75)},100,${.65+scan*.3})` : `rgba(${25+Math.round(scan*35)},${95+Math.round(scan*35)},${70+Math.round(scan*30)},${.65+scan*.3})`;
   ctx.beginPath();ctx.arc(x,y,(scan>.2?1.5:1)*Math.max(.75,scale/650),0,Math.PI*2);ctx.fill();
  });
  ctx.restore();
 }
 function animate(time) {
  frame = requestAnimationFrame(animate);
  if (!visible || document.hidden || time-last < 32) return;
  last=time;draw(time);
 }
 canvas.parentElement.addEventListener('pointermove', event => {const box=canvas.getBoundingClientRect();pointer.x=(event.clientX-box.left)/box.width-.5;pointer.y=(event.clientY-box.top)/box.height-.5;});
 canvas.parentElement.addEventListener('pointerleave', () => {pointer.x=pointer.y=0;});
 if ('ResizeObserver' in window) new ResizeObserver(resize).observe(canvas); else addEventListener('resize',resize);
 if ('IntersectionObserver' in window) new IntersectionObserver(entries => {visible=entries[0].isIntersecting;}).observe(canvas);
 resize(); if (!reduce) frame=requestAnimationFrame(animate);
 addEventListener('pagehide', () => cancelAnimationFrame(frame),{once:true});
})();
