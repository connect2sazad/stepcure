(() => { document.querySelectorAll('[data-password-toggle]').forEach(button => {
 const form=button.closest('form');const field=form.querySelector(button.dataset.passwordToggle==='confirm'?'input[name="re_pass"]':'input[name="pass"],input[name="password"]');
 if(!field)return;
 field.id=button.dataset.passwordToggle==='confirm'?'sc-confirm-password':'sc-main-password';button.setAttribute('aria-controls',field.id);
 button.addEventListener('click',()=>{const show=field.type==='password';field.type=show?'text':'password';button.setAttribute('aria-pressed',String(show));button.textContent=(show?'Hide':'Show')+(button.dataset.passwordToggle==='confirm'?' confirm password':' password');});
});})();
