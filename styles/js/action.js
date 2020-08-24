let signUp=document.querySelector('.signUp');
let signIn=document.querySelector('.signIn');

document.querySelectorAll('.switch').forEach(e=>e.addEventListener('click',()=>{
    signUp.classList.toggle('show');
    signIn.classList.toggle('show');
}));






