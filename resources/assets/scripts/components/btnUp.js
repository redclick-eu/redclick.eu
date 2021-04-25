export default () => {
    const btn = document.querySelector('.btn-scroll-top');

    document.addEventListener('scroll', () => {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            btn.classList.remove('invisible');
        } else {
            btn.classList.add('invisible');
        }
    });

    btn.addEventListener('click', () => {
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth',
        });
    });
};
