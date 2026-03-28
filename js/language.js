let content = {};

fetch('languages/en.json')
    .then(response => response.json())
    .then(data => content['en'] = data);

fetch('languages/am.json')
    .then(response => response.json())
    .then(data => content['am'] = data);

function setLanguage(lang) {
    document.querySelectorAll('[data-lang]').forEach(el => {
        let key = el.getAttribute('data-lang');
        el.innerText = content[lang][key];
    });
}