document.addEventListener('DOMContentLoaded', function () {
    const changingText = document.getElementById('changingText');
    const words = ['Toiminnanohjaus..', 'Laitteet & ohjelmistot..', 'Tietoturva..', 'It-tuki pääkaupunkiseudulla!'];
    let currentIndex = 0;

    function changeWord() {
      changingText.textContent = words[currentIndex];
      currentIndex = (currentIndex + 1) % words.length;
    }
console.log('test js')
    setInterval(changeWord, 2000);
  });