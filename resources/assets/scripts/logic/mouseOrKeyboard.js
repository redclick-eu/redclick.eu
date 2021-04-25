// Let the document know when the mouse is being used
export default () => {
    document.body.addEventListener('mousedown', () => {
        document.body.classList.add('is-using-mouse');
    });

    document.body.addEventListener('keydown', (e) => {
        const name = e.target.tagName;
        if (['INPUT', 'TEXTAREA'].indexOf(name) === -1) {
            document.body.classList.remove('is-using-mouse');
        }
    });
};
