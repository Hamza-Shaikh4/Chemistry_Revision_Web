const cards = [
    { 
      question: "What is a Nucleophile?",
      answer: "Electron Pair Donor"
    },
    {
      question: "What is an Isotope?",
      answer: "Atoms with the same number of protons, but different numbers of neutrons."
    },
    {
      question: "What is Electronegativity?",
      answer: "The relative tendency of an atom in a covalent bond in a molecule to attract electrons in a covalent bond to itself."
    }
  ];
  
  const cardContainer = document.querySelector(".card-container");
  const cardQuestion = document.querySelector(".card-question");
  const cardAnswer = document.querySelector(".card-answer");
  const flipButton = document.querySelector(".flip-button");
  const nextButton = document.querySelector(".next-button");
  const backButton = document.querySelector(".back-button");
  
  let currentCard = 0;
  let isFlipped = false;
  
  function showCard() {
    cardQuestion.textContent = cards[currentCard].question;
    cardAnswer.textContent = cards[currentCard].answer;
    cardQuestion.classList.remove("hidden");
    cardAnswer.classList.add("hidden");
    flipButton.textContent = "Flip";
    isFlipped = false;
    
    // Disable the back button if we're on the first card
    backButton.disabled = (currentCard === 0);
  }
  
  showCard();
  
  flipButton.addEventListener("click", function() {
    if (!isFlipped) {
      cardQuestion.classList.add("hidden");
      cardAnswer.classList.remove("hidden");
      flipButton.textContent = "Flip back";
      isFlipped = true;
    } else {
      cardAnswer.classList.add("hidden");
      cardQuestion.classList.remove("hidden");
      flipButton.textContent = "Flip";
      isFlipped = false;
    }
  });
  
  nextButton.addEventListener("click", function() {
    currentCard++;
    if (currentCard >= cards.length) {
      currentCard = 0;
    }
    showCard();
  });
  
  backButton.addEventListener("click", function() {
    currentCard--;
    if (currentCard < 0) {
      currentCard = cards.length - 1;
    }
    showCard();
  });
