window.addEventListener('load', function () {
    const nodes = document.querySelectorAll('.js-sticky');

    Array.from(nodes).forEach(function (node) {
        let nodeOffs = node.offsetTop,
            fake = document.createElement('div');

        fake.style.width = '100%';
        fake.style.height = node.offsetHeight + 'px';
        fake.style.marginBottom = getComputedStyle(node).marginBottom;
        fake.style.display = 'none';

        node.parentNode.insertBefore(fake, node);

        window.addEventListener('scroll', function () {
            const scrollPos = (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0) - 1;
            
            if ((scrollPos > nodeOffs)) {
                node.classList.add('stuck');
                document.body.classList.add('stuck');
                fake.style.display = getComputedStyle(node).display;
            } else {
                node.classList.remove('stuck');
                document.body.classList.remove('stuck');
                fake.style.display = 'none';
            }
            if (node.offsetTop !== 0) {
                nodeOffs = node.offsetTop;
            }
        });

        window.addEventListener('resize', function () {
            if (node.offsetTop !== 0) {
                nodeOffs = node.offsetTop;
            }
            fake.style.height = node.offsetHeight + 'px';
        });
    });

    window.dispatchEvent(new Event('scroll'));
});
