(() => {
'use strict';
const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
const loader = document.getElementById('sc-loader');
const start = performance.now();
const dismiss = () => setTimeout(() => loader?.classList.add('is-done'), reduced ? 0 : Math.max(0, 1050 - (performance.now()-start)));
if (document.readyState === 'complete') dismiss(); else addEventListener('load',dismiss,{once:true});
setTimeout(() => loader?.classList.add('is-done'),2600);
addEventListener('pageshow',() => document.body.classList.remove('sc-leaving'));
const toggle=document.querySelector('.sc-menu-toggle'),menu=document.getElementById('sc-mobile-menu');
function closeMenu(){if(menu){menu.hidden=true;toggle.setAttribute('aria-expanded','false');}}
toggle?.addEventListener('click',()=>{menu.hidden=!menu.hidden;toggle.setAttribute('aria-expanded',String(!menu.hidden));});
addEventListener('keydown',e=>{if(e.key==='Escape')closeMenu();});
document.addEventListener('click',event=>{
 const anchor=event.target.closest('a[href]');
 if(!anchor || event.defaultPrevented || event.button!==0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || anchor.target || anchor.hasAttribute('download'))return;
 const url=new URL(anchor.href,location.href);
 if(url.origin!==location.origin || !/^https?:$/.test(url.protocol) || /\/(logout|api)(\/|$)/.test(url.pathname))return;
 if(url.pathname===location.pathname && url.search===location.search)return;
 closeMenu();if(reduced)return;
 event.preventDefault();document.body.classList.add('sc-leaving');setTimeout(()=>location.assign(url.href),450);
});
if(reduced)return;
// Enhance existing PHP content without replacing forms, route handling or commerce actions.
const headings=[...document.querySelectorAll('.sc-hero h1,.sc-story h2,.sc-care-heading h2,.sc-collection h2,.sc-finale h2,.sc-inner .breadcrumb_part h2,.sc-page-experience h2,.sc-inner .section_tittle h2')];
headings.forEach(heading=>{
 const walker=document.createTreeWalker(heading,NodeFilter.SHOW_TEXT);const nodes=[];while(walker.nextNode())nodes.push(walker.currentNode);
 let word=0;nodes.forEach(node=>{const frag=document.createDocumentFragment();node.textContent.split(/(\s+)/).forEach(text=>{if(!text.trim()){frag.append(document.createTextNode(text));return;}const outer=document.createElement('span');outer.className='sc-word';const inner=document.createElement('span');inner.textContent=text;inner.style.setProperty('--sc-delay',`${word++*65}ms`);outer.append(inner);frag.append(outer);});node.replaceWith(frag);});
 heading.classList.add('sc-enter');
});
const revealSelector='.sc-inner .single_feature,.sc-inner .category-card,.sc-inner .product-tile,.sc-inner .about_us_text,.sc-inner .contact-info,.sc-inner form,.sc-inner .foam-box-section .col-md-6,.sc-inner .filters-wrapper,.sc-inner .products-details .cube-inner,.sc-site .sc-care-row,.sc-site .sc-product';
document.querySelectorAll(revealSelector).forEach((el,i)=>{el.classList.add('sc-enter');el.style.setProperty('--sc-delay',`${(i%3)*95}ms`);});
document.querySelectorAll('.sc-inner .about_us_img,.sc-inner .single_feature_img,.sc-inner .foam-box-section .image-wrapper').forEach(el=>el.classList.add('sc-image-reveal'));
if('IntersectionObserver' in window){const observer=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('sc-seen');observer.unobserve(entry.target);}}),{threshold:.08});document.querySelectorAll('.sc-enter,.sc-image-reveal').forEach(el=>observer.observe(el));document.body.classList.add('sc-animated');}
const parallax=[...document.querySelectorAll('.sc-art,.sc-asterisk,.sc-inner .about_us_img img,.sc-inner .single_feature_img img,.sc-inner .foam-box-section img')];parallax.forEach(el=>el.classList.add('sc-parallax'));
const meter=document.querySelector('.sc-scroll-meter');let queued=false;
function scrollFrame(){queued=false;const h=document.documentElement.scrollHeight-innerHeight;meter.style.transform=`scaleX(${h>0?scrollY/h:0})`;parallax.forEach((el,i)=>{const box=el.getBoundingClientRect();if(box.bottom< -100 || box.top>innerHeight+100)return;const shift=Math.max(-45,Math.min(45,(innerHeight*.5-(box.top+box.height*.5))*(i===0?.075:.045)));el.style.setProperty('--sc-shift',`${shift}px`);});}
addEventListener('scroll',()=>{if(!queued){queued=true;requestAnimationFrame(scrollFrame);}},{passive:true});scrollFrame();
document.querySelectorAll('.category-card,.product-tile,.sc-product-image').forEach(card=>{
 card.addEventListener('pointermove',e=>{if(e.pointerType!=='mouse')return;const r=card.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;card.style.transform=`perspective(900px) rotateX(${-y*5}deg) rotateY(${x*7}deg) translateY(-5px)`;});card.addEventListener('pointerleave',()=>card.style.transform='');
});
const cursor=document.querySelector('.sc-cursor');
if(cursor && matchMedia('(pointer:fine)').matches){let lastX=0,lastY=0,lastStamp=0,side=1;
 document.addEventListener('pointermove',e=>{if(e.pointerType!=='mouse')return;document.body.classList.add('sc-cursor-ready');const editing=!!e.target.closest('input,textarea,select,[contenteditable="true"]');cursor.style.opacity=editing?'0':'1';cursor.style.transform=`translate(${e.clientX-8}px,${e.clientY-8}px)`;cursor.classList.toggle('is-link',!!e.target.closest('a,button'));const now=performance.now();if(!editing && Math.hypot(e.clientX-lastX,e.clientY-lastY)>65 && now-lastStamp>90){const track=document.createElement('i');track.className='sc-trail';track.style.left=`${e.clientX+side*7}px`;track.style.top=`${e.clientY+15}px`;track.style.rotate=`${side*18}deg`;document.body.append(track);setTimeout(()=>track.remove(),850);lastX=e.clientX;lastY=e.clientY;lastStamp=now;side*=-1;}});
 document.addEventListener('mouseleave',()=>{cursor.style.opacity='0';document.body.classList.remove('sc-cursor-ready');});
}
})();
