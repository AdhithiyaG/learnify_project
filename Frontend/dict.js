const input = document.getElementById('search-input');
const btn = document.getElementById('search-btn');
const dictionaryArea = document.querySelector('.dictionary-app');

async function dictionaryFn(word) {
    const res = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${word}`);
    if (!res.ok) {
        throw new Error('Word not found');
    }
    const data = await res.json();
    return data[0];
}

btn.addEventListener('click', fetchAndCreateCard);

async function fetchAndCreateCard() {
    try {
        const data = await dictionaryFn(input.value);
        console.log(data);

        let partOfSpeechArray = [];
        for (let i = 0; i < data.meanings.length; i++) {
            partOfSpeechArray.push(data.meanings[i].partOfSpeech);
        }

        dictionaryArea.innerHTML = `
            <div class="card">
                <div class="property">
                    <span>Word:</span>
                    <span>${data.word}</span>
                </div>

                <div class="property">
                    <span>Phonetics:</span>
                    <span>${data.phonetic || 'N/A'}</span>
                </div>

                <div class="property">
                    <span>Audio:</span>
                    <span>
                        ${data.phonetics[0] && data.phonetics[0].audio ? `<audio controls src="${data.phonetics[0].audio}"></audio>` : 'N/A'}
                    </span>
                </div>

                <div class="property">
                    <span>Definition:</span>
                    <span>${data.meanings[0].definitions[0].definition}</span>
                </div>

                <div class="property">
                    <span>Example:</span>
                    <span>${data.meanings[0].definitions[0].example || 'N/A'}</span>
                </div>

                <div class="property">
                    <span>Parts of Speech:</span>
                    <span>${partOfSpeechArray.join(', ')}</span>
                </div>
            </div>
        `;
    } catch (error) {
        dictionaryArea.innerHTML = `<p>${error.message}</p>`;
    }
}
