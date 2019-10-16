// Let the document know when the mouse is being used
document.body.addEventListener('mousedown', function() {
    document.body.classList.add('using-mouse');
});
document.body.addEventListener('keydown', function(e) {
    const name = e.target.tagName;
    if(['INPUT','TEXTAREA'].indexOf(name) === -1) {
        document.body.classList.remove('using-mouse');
    }
});