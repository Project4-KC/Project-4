
let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    const slides = document.getElementsByClassName("slide");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}




const highscores = [
    { name: 'Player1', score: 100 },
    { name: 'Player2', score: 90 },
    { name: 'Player3', score: 80 }
];

const highscoreList = document.getElementById('highscores');

highscores.forEach(entry => {
    const listItem = document.createElement('li');
    listItem.textContent = `${entry.name}: ${entry.score}`;
    highscoreList.appendChild(listItem);
});
