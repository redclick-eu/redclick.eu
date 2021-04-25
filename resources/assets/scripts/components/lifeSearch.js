const lang = window.location.href.split('/')[3];

function createListItems(list, data) {
    while (list.firstChild) {
        list.removeChild(list.firstChild);
    }

    if (data.length === 1 && data[0].error) {
        const item = document.createElement('li');
        item.classList.add('m-empty');
        item.innerText = data[0].text;
        list.appendChild(item);
        return;
    }

    const container = document.createDocumentFragment();
    data.forEach((el) => {
        const item = document.createElement('li');
        const link = document.createElement('a');

        link.innerText = el.title;
        link.href = el.href;

        item.appendChild(link);
        container.appendChild(item);
    });
    list.appendChild(container);
}

export default () => {
    document.querySelectorAll('.js-search-form').forEach((form) => {
        const list = form.querySelector('.js-search-list');
        const input = form.querySelector('.js-search');
        const loupe = form.querySelector('.js-search-loupe');
        let abort = new AbortController();

        let timeout;

        input.addEventListener('input', () => {
            input.value = input.value.replace(/^\s+/, '');

            if (input.value.length === 0) {
                clearTimeout(timeout);
                list.classList.remove('m-show', 'm-search');
                return;
            }

            list.innerHTML = '';
            list.classList.add('m-show', 'm-search');

            clearTimeout(timeout);
            timeout = setTimeout(() => {
                abort.abort();
                abort = new AbortController();

                fetch(`/${lang}/wp-json/redclick/v1/search`, {
                    method: 'POST',
                    signal: abort.signal,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        keyword: input.value,
                    }),
                }).then((r) => r.json())
                    .then((response) => {
                        createListItems(list, response);
                        list.classList.remove('m-search');
                    })
                    .catch((reason) => {
                        if (!(reason instanceof DOMException)) {
                            console.warn(reason);
                        }
                    });
            }, 300);
        });

        form.addEventListener('submit', (e) => {
            if (form.querySelector('.js-search').value.length === 0) {
                e.preventDefault();
            }
        });

        form.addEventListener('reset', (e) => {
            e.preventDefault();

            if (!input.value) {
                loupe.dispatchEvent(new Event('click'));
            } else {
                input.value = '';
            }
        });

        window.addEventListener('toggle.opened', (e) => {
            if (e.detail.targets.includes(form)) {
                input.focus();
            }
        });

        window.addEventListener('toggle.closed', () => {
            input.blur();
        });
    });
};
