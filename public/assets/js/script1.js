let login = document.getElementById('login');
let register = document.getElementById('register');
let title = document.getElementById('title');
let actionInput = document.getElementById('action');

function getLogin(event) {
    event.preventDefault();
    title.innerText = "Login";
    actionInput.value = "login";
}

function getRegistration(event) {
    event.preventDefault();
    title.innerText = "Registration";
    actionInput.value = "register";
}

document.addEventListener('DOMContentLoaded', (event) => {
    let allWordsBtn = document.getElementById('allWordsBtn');
    let addNewWordBtn = document.getElementById('addNewWordBtn');
    let allWordsForm = document.getElementById('allWordsForm');
    let addNewWordForm = document.getElementById('addNewWordForm');

    allWordsBtn.addEventListener('click', (event) => {
        event.preventDefault();
        allWordsForm.style.display = 'block';
        addNewWordForm.style.display = 'none';
    });

    addNewWordBtn.addEventListener('click', (event) => {
        event.preventDefault();
        addNewWordForm.classList.remove('d-none');
        allWordsForm.style.display = 'none';
        addNewWordForm.style.display = 'block';
    });
});

document.getElementById('filterDropdown').addEventListener('change', function() {
    let filterDropdown = this.value.toLowerCase();
    let rows = document.querySelectorAll('.wordRow');

    rows.forEach(row => {
        let word = row.cells[0].textContent.toLowerCase();
        if (filterDropdown === 'all' || word.startsWith(filterDropdown)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
