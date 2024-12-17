document.addEventListener('DOMContentLoaded', function () {
    const selectedPosition = document.getElementById('position').value;
    const outfieldStats = document.getElementById('outfieldStats');
    const gkStats = document.getElementById('gkStats');

    if (selectedPosition === 'GK') {
        outfieldStats.style.display = 'none';
        gkStats.style.display = 'block';
    } else {
        outfieldStats.style.display = 'block';
        gkStats.style.display = 'none';
    }
});

