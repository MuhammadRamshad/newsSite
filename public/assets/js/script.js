const menuBtn = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

  menuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("open");
  });

const toggle = document.getElementById('searchToggle');
const box = document.getElementById('searchBox');

toggle.addEventListener('click', (e) => {
    e.stopPropagation();
    box.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!box.contains(e.target) && !toggle.contains(e.target)) {
        box.classList.remove('active');
    }
});

box.addEventListener('click', (e) => {
    e.stopPropagation();
});
document.querySelectorAll('.bookmark-btn').forEach(btn => {

    const id = String(btn.dataset.id);

    let saved = JSON.parse(localStorage.getItem('savedNews')) || [];

    if(saved.includes(id)){
        btn.classList.add('saved');
    }

    btn.addEventListener('click', () => {

        let saved = JSON.parse(localStorage.getItem('savedNews')) || [];
        const id = String(btn.dataset.id);

        if(saved.includes(id)){
            saved = saved.filter(i => i !== id);
            btn.classList.remove('saved');
        }else{
            saved.push(id);
            btn.classList.add('saved');
        }

        localStorage.setItem('savedNews', JSON.stringify(saved));
    });

});
