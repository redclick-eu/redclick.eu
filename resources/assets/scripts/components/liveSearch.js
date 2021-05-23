import { encodeObject } from '../util/helpersForm';
import { parseJsonVars } from '../util/helpers';

function createSearchlistItems(list, data) {
    while (list.firstChild) {
        list.removeChild(list.firstChild);
    }

    if (data.length === 1 && data[0].error) {
        const item = document.createElement('li');
        item.classList.add('is-empty');
        item.innerText = data[0].error;
        list.appendChild(item);
        return;
    }

    const container = document.createDocumentFragment();

    data.forEach((el) => {
        const text = document.createElement('span');
        text.innerText = el.title;

        const link = document.createElement('a');
        link.href = el.link;

        if (el.image) {
            const image = document.createElement('img');
            image.src = el.image;
            image.alt = `Product picture - ${el.title}`;
            link.appendChild(image);
        }

        link.appendChild(text);

        const item = document.createElement('li');
        item.appendChild(link);

        container.appendChild(item);
    });

    list.appendChild(container);
}

export default () => {
    document.querySelectorAll('.js-search-form').forEach((form) => {
        const input = form.querySelector('.js-search-input');
        const loupe = form.querySelector('.js-search-loupe');
        const list = form.querySelector('.js-search-list');

        const settings = parseJsonVars(form.getAttribute('data-settings'), {
            list_size: 4,
        });

        if (!settings.live_search_url) {
            throw new Error('Live search need live_search_variable');
        }

        let abort = new AbortController();
        let timeout;

        input.addEventListener('input', () => {
            const { value } = input;

            list.innerHTML = '';

            if (value.length > 1) {
                list.classList.add('is-showing', 'is-searching');
                clearTimeout(timeout);

                timeout = setTimeout(() => {
                    abort.abort();
                    abort = new AbortController();

                    const data = {
                        keyword: value,
                        size: settings.list_size,
                    };

                    fetch(`${settings.live_search_url}?${encodeObject(data)}`, {
                        method: 'GET',
                        signal: abort.signal,
                    })
                        .then((r) => r.json())
                        .then((response) => {
                            console.log(response);
                            createSearchlistItems(list, response);

                            list.classList.remove('is-searching');
                            list.classList.add('is-showing');
                        })
                        .catch((error) => {
                            console.warn(error);
                        });
                }, 300);
            } else {
                list.classList.remove('is-showing', 'is-searching');
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.js-search')) {
                list.classList.remove('is-showing', 'is-searching');
            }
        });

        input.addEventListener('focus', () => {
            if (list.childNodes.length) {
                list.classList.add('is-showing');
            } else {
                input.dispatchEvent(new Event('input'));
            }
        });

        form.addEventListener('reset', (e) => {
            e.preventDefault();

            if (input.value.length > 0) {
                input.value = '';
                list.innerHTML = '';
                list.classList.remove('is-showing', 'is-searching');
            } else {
                loupe.dispatchEvent(new Event('click'));
            }
        });

        form.addEventListener('submit', (e) => {
            if (input.value.length === 0) {
                e.preventDefault();
            }
        });
    });
};
