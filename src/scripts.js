document.addEventListener('DOMContentLoaded', function () {
document.getElementById('position').addEventListener('change', function () {
    const selectedPosition = this.value;
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

});