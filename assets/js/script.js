// Menu actif

const links = document.querySelectorAll("nav ul li a");

links.forEach(link => {

link.addEventListener("click", function(){

links.forEach(item=>item.classList.remove("active"));

this.classList.add("active");

});

});

// Animation au scroll

const cards=document.querySelectorAll(".service-card,.product-card,.card");

const observer=new IntersectionObserver(entries=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

entry.target.style.opacity="1";

entry.target.style.transform="translateY(0)";

}

});

});

cards.forEach(card=>{

card.style.opacity="0";

card.style.transform="translateY(40px)";

card.style.transition=".6s";

observer.observe(card);

});

// Scroll Header

window.addEventListener("scroll",()=>{

const header=document.querySelector("header");

if(window.scrollY>80){

header.style.background="#ffffff";

header.style.boxShadow="0 5px 15px rgba(0,0,0,.1)";

}else{

header.style.background="#ffffff";

}

});
