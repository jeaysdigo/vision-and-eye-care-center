document.getElementById('search').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#table tr');
    let found = false;

    rows.forEach(row => {
        let cells = row.querySelectorAll('td, th');
        let text = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        if (text.includes(filter)) {
            row.classList.remove('hidden');
            found = true;
        } else {
            row.classList.add('hidden');
        }
    });

    document.getElementById('noRecordsMessage').classList.toggle('hidden', found);
});