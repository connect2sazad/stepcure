(function () {
  'use strict';
  const data = window.StepCureDashboard || {};
  const primary = (window.config && config.colors.primary) || '#696cff';
  const info = (window.config && config.colors.info) || '#03c3ec';
  const success = (window.config && config.colors.success) || '#71dd37';
  const warning = (window.config && config.colors.warning) || '#ffab00';
  const danger = (window.config && config.colors.danger) || '#ff3e1d';
  const text = getComputedStyle(document.documentElement).getPropertyValue('--admin-text').trim() || '#697a8d';
  const grid = getComputedStyle(document.documentElement).getPropertyValue('--admin-border').trim() || '#eceef1';
  const base = { chart:{fontFamily:'Public Sans, sans-serif',toolbar:{show:false},animations:{enabled:true,speed:550}},dataLabels:{enabled:false},grid:{borderColor:grid},legend:{labels:{colors:text}},tooltip:{theme:'light'},noData:{text:'No records available',align:'center',verticalAlign:'middle'} };
  const mount=(selector,options)=>{const el=document.querySelector(selector);if(el&&window.ApexCharts)new ApexCharts(el,Object.assign({},base,options)).render();};

  mount('#revenueChart',{series:[{name:'Revenue',data:data.revenue?.values||[]}],chart:{type:'area',height:320,toolbar:{show:false}},colors:[primary],stroke:{curve:'smooth',width:3},fill:{type:'gradient',gradient:{opacityFrom:.36,opacityTo:.04}},xaxis:{categories:data.revenue?.labels||[],labels:{style:{colors:text}}},yaxis:{labels:{style:{colors:text},formatter:v=>'₹'+Number(v).toLocaleString('en-IN')}},tooltip:{y:{formatter:v=>'₹'+Number(v).toLocaleString('en-IN',{maximumFractionDigits:2})}}});
  mount('#salesStatusChart',{series:data.salesStatus||[],chart:{type:'donut',height:310},labels:['Finalized','Draft','Archived'],colors:[success,warning,danger],plotOptions:{pie:{donut:{size:'70%',labels:{show:true,total:{show:true,label:'All sales'}}}}},legend:{position:'bottom'}});
  mount('#activityChart',{series:[...(data.activity?.patients?.length?[{name:'Patients',data:data.activity.patients}]:[]),{name:'Consultations',data:data.activity?.consultations||[]}],chart:{type:'bar',height:320,toolbar:{show:false}},colors:[primary,info],plotOptions:{bar:{borderRadius:6,columnWidth:'52%'}},xaxis:{categories:data.activity?.labels||[],labels:{rotate:-35,style:{colors:text}}},yaxis:{min:0,forceNiceScale:true,labels:{style:{colors:text},formatter:v=>Math.round(v)}}});
  mount('#stockChart',{series:data.stock?.values||[],chart:{type:'donut',height:310},labels:data.stock?.labels||[],colors:[primary,info,success,warning,'#8592a3','#8b5cf6','#ef6c9e','#2f9e8f'],legend:{position:'bottom'},plotOptions:{pie:{donut:{size:'62%'}}}});
  mount('#siteChart',{series:[{name:'Consultations',data:data.sites?.values||[]}],chart:{type:'bar',height:310,toolbar:{show:false}},colors:[info],plotOptions:{bar:{horizontal:true,borderRadius:5,barHeight:'55%'}},xaxis:{categories:data.sites?.labels||[],labels:{style:{colors:text}}},yaxis:{labels:{style:{colors:text}}}});

  const board=document.getElementById('dashboard-grid');
  const edit=document.getElementById('dashboard-edit');
  const reset=document.getElementById('dashboard-reset');
  if(!board)return;
  const storageKey='stepcure-dashboard-layout:'+board.dataset.layoutUser;
  let saved=[];try{const parsed=JSON.parse(localStorage.getItem(storageKey)||'[]');if(Array.isArray(parsed))saved=parsed.filter(id=>typeof id==='string');}catch{};
  saved.forEach(id=>{const item=board.querySelector('[data-widget="'+CSS.escape(id)+'"]');if(item)board.appendChild(item);});
  let editing=false,dragged=null;
  edit?.addEventListener('click',()=>{editing=!editing;board.classList.toggle('dashboard-editing',editing);board.querySelectorAll('.dashboard-widget').forEach(x=>x.draggable=editing);edit.classList.toggle('btn-primary',editing);edit.classList.toggle('btn-outline-primary',!editing);edit.innerHTML=editing?'<i class="bx bx-check"></i> Finish arranging':'<i class="bx bx-move"></i> Arrange dashboard';});
  board.addEventListener('dragstart',e=>{dragged=e.target.closest('.dashboard-widget');if(!dragged)return;dragged.classList.add('dragging');e.dataTransfer.effectAllowed='move';});
  board.addEventListener('dragover',e=>{if(!dragged)return;e.preventDefault();const target=e.target.closest('.dashboard-widget');board.querySelectorAll('.drag-over').forEach(x=>x.classList.remove('drag-over'));if(target&&target!==dragged){target.classList.add('drag-over');const rect=target.getBoundingClientRect();const after=e.clientY>rect.top+rect.height/2;board.insertBefore(dragged,after?target.nextSibling:target);}});
  board.addEventListener('dragend',()=>{board.querySelectorAll('.dashboard-widget').forEach(x=>x.classList.remove('dragging','drag-over'));dragged=null;try{localStorage.setItem(storageKey,JSON.stringify([...board.querySelectorAll('.dashboard-widget')].map(x=>x.dataset.widget)));}catch{}});
  reset?.addEventListener('click',()=>{try{localStorage.removeItem(storageKey);}catch{}location.reload();});
})();

(() => {
 const area=document.getElementById('sc-followups');if(!area||!window.fetch)return;
 const list=area.querySelector('.sc-task-list'),status=area.querySelector('#sc-task-status'),add=area.querySelector('.sc-task-form');let busy=false;
 area.addEventListener('submit',async event=>{const form=event.target;if(!form.matches('form'))return;event.preventDefault();if(busy)return;busy=true;const data=new FormData(form);area.querySelectorAll('button').forEach(b=>b.disabled=true);status.textContent='Saving…';
 try{const response=await fetch(location.href,{method:'POST',body:data,credentials:'same-origin',headers:{'X-Requested-With':'XMLHttpRequest'}});if(!response.headers.get('content-type')?.includes('application/json'))throw new Error('Your session expired. Reload and sign in again.');const result=await response.json();if(!response.ok||!result.ok)throw new Error(result.error||'Please try again.');list.replaceChildren();for(const task of result.tasks){const li=document.createElement('li'),copy=document.createElement('div'),title=document.createElement('strong');title.textContent=task.title;copy.append(title);if(task.due_date){const date=document.createElement('small');date.textContent='Due '+task.due_date;copy.append(date);}const done=document.createElement('form');done.method='post';for(const [name,value] of Object.entries({csrf:add.querySelector('[name="csrf"]').value,task_action:'complete',task_id:task.id})){const input=document.createElement('input');input.type='hidden';input.name=name;input.value=value;done.append(input);}const button=document.createElement('button');button.className='btn btn-sm btn-outline-primary';button.textContent='Done';button.setAttribute('aria-label','Complete '+task.title);done.append(button);li.append(copy,done);list.append(li);}const empty=area.querySelector('.sc-task-empty');if(empty)empty.hidden=result.tasks.length>0;if(form===add){add.querySelector('[name="title"]').value='';add.querySelector('[name="due_date"]').value='';}status.textContent='Follow-up saved.';}catch(error){status.textContent=error.message||'Could not save. Please try again.';}finally{busy=false;area.querySelectorAll('button').forEach(b=>b.disabled=false);}
 });
})();
