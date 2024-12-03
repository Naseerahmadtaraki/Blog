
    let textElement = document.getElementById('text');
let texts = ["Frontend developer", " Backend developer", "Android developer"];
let currentIndex = 0;

function writeText() {
    textElement.textContent = '';
    let text = texts[currentIndex];
    let charIndex = 0;
    let interval = setInterval(() => {
        textElement.textContent += text[charIndex];
        charIndex++;
        if (charIndex >= text.length) {
            clearInterval(interval);
            setTimeout(eraseText, 2000);
        }
    }, 50);
}

function eraseText() {
    let text = textElement.textContent;
    let charIndex = text.length - 1;
    let interval = setInterval(() => {
        textElement.textContent = text.substring(0, charIndex);
        charIndex--;
        if (charIndex < 0) {
            clearInterval(interval);
            currentIndex = (currentIndex + 1) % texts.length;
            setTimeout(writeText, 500);
        }
    }, 50);
}

writeText();