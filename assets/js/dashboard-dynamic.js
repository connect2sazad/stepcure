(function () {
  'use strict';
  const data = window.StepCureDashboard || {};
  const primary = (window.config && config.colors.primary) || '#696cff';
  const info = (window.config && config.colors.info) || '#03c3ec';
  const success = (window.config && config.colors.success) || '#71dd37';
  const warning = (window.config && config.colors.warning) || '#ffab00';
  const danger = (window.config && config.colors.danger) || '#ff3e1d';
  const text = '#697a8d';
  const grid = '#eceef1';
  const base = { chart:{fontFamily:'Public Sans, sans-serif',toolbar:{show:false},animations:{enabled:true,speed:550}},dataLabels:{enabled:false},grid:{borderColor:grid},legend:{labels:{colors:text}},tooltip:{theme:'light'},noData:{text:'No records available',align:'center',verticalAlign:'middle'} };
  const mount=(selector,options)=>{const el=document.querySelector(selector);if(el&&window.ApexCharts)new ApexCharts(el,Object.assign({},base,options)).render();};

  mount('#revenueChart',{series:[{name:'Revenue',data:data.revenue?.values||[]}],chart:{type:'area',height:320,toolbar:{show:false}},colors:[primary],stroke:{curve:'smooth',width:3},fill:{type:'gradient',gradient:{opacityFrom:.36,opacityTo:.04}},xaxis:{categories:data.revenue?.labels||[],labels:{style:{colors:text}}},yaxis:{labels:{style:{colors:text},formatter:v=>'₹'+Number(v).toLocaleString('en-IN')}},tooltip:{y:{formatter:v=>'₹'+Number(v).toLocaleString('en-IN',{maximumFractionDigits:2})}}});
  mount('#salesStatusChart',{series:data.salesStatus||[],chart:{type:'donut',height:310},labels:['Finalized','Draft','Archived'],colors:[success,warning,danger],plotOptions:{pie:{donut:{size:'70%',labels:{show:true,total:{show:true,label:'All sales'}}}}},legend:{position:'bottom'}});
  mount('#activityChart',{series:[{name:'Patients',data:data.activity?.patients||[]},{name:'Consultations',data:data.activity?.consultations||[]}],chart:{type:'bar',height:320,toolbar:{show:false}},colors:[primary,info],plotOptions:{bar:{borderRadius:6,columnWidth:'52%'}},xaxis:{categories:data.activity?.labels||[],labels:{rotate:-35,style:{colors:text}}},yaxis:{min:0,forceNiceScale:true,labels:{style:{colors:text},formatter:v=>Math.round(v)}}});
  mount('#stockChart',{series:data.stock?.values||[],chart:{type:'donut',height:310},labels:data.stock?.labels||[],colors:[primary,info,success,warning,'#8592a3','#8b5cf6','#ef6c9e','#2f9e8f'],legend:{position:'bottom'},plotOptions:{pie:{donut:{size:'62%'}}}});
  mount('#siteChart',{series:[{name:'Consultations',data:data.sites?.values||[]}],chart:{type:'bar',height:310,toolbar:{show:false}},colors:[info],plotOptions:{bar:{horizontal:true,borderRadius:5,barHeight:'55%'}},xaxis:{categories:data.sites?.labels||[],labels:{style:{colors:text}}},yaxis:{labels:{style:{colors:text}}}});

  const board=document.getElementById('dashboard-grid');
  const edit=document.getElementById('dashboard-edit');
  const reset=document.getElementById('dashboard-reset');
  if(!board)return;
  const storageKey='stepcure-dashboard-layout:'+board.dataset.layoutUser;
  const saved=JSON.parse(localStorage.getItem(storageKey)||'[]');
  saved.forEach(id=>{const item=board.querySelector('[data-widget="'+CSS.escape(id)+'"]');if(item)board.appendChild(item);});
  let editing=false,dragged=null;
  edit?.addEventListener('click',()=>{editing=!editing;board.classList.toggle('dashboard-editing',editing);board.querySelectorAll('.dashboard-widget').forEach(x=>x.draggable=editing);edit.classList.toggle('btn-primary',editing);edit.classList.toggle('btn-outline-primary',!editing);edit.innerHTML=editing?'<i class="bx bx-check"></i> Finish arranging':'<i class="bx bx-move"></i> Arrange dashboard';});
  board.addEventListener('dragstart',e=>{dragged=e.target.closest('.dashboard-widget');if(!dragged)return;dragged.classList.add('dragging');e.dataTransfer.effectAllowed='move';});
  board.addEventListener('dragover',e=>{if(!dragged)return;e.preventDefault();const target=e.target.closest('.dashboard-widget');board.querySelectorAll('.drag-over').forEach(x=>x.classList.remove('drag-over'));if(target&&target!==dragged){target.classList.add('drag-over');const rect=target.getBoundingClientRect();const after=e.clientY>rect.top+rect.height/2;board.insertBefore(dragged,after?target.nextSibling:target);}});
  board.addEventListener('dragend',()=>{board.querySelectorAll('.dashboard-widget').forEach(x=>x.classList.remove('dragging','drag-over'));dragged=null;localStorage.setItem(storageKey,JSON.stringify([...board.querySelectorAll('.dashboard-widget')].map(x=>x.dataset.widget)));});
  reset?.addEventListener('click',()=>{localStorage.removeItem(storageKey);location.reload();});
})();
