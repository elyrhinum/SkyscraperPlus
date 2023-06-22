const cont = document.querySelector('#images-prev');

let filesStore = [];

async function postJSON(route, data, _token) {
    let response = await fetch(route, {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': _token,
        },
        body: data,

    })
    return await response.json()
}

async function dataPostJSON(route, data, _token) {
    let response = await fetch(route, {
        method: 'post',
        headers: {
            'Content-type': 'application/json;charset=utf-8',
        },
        body: JSON.stringify({
            data,
            _token
        }),

    })
    return await response.json()
}

function deleteImg(e) {
    filesStore.splice(e.target.dataset.index, 1);
    cont.textContent = '';
    filesStore.forEach((item, key) => {
        cont.insertAdjacentHTML('beforeend', `
        <div class="images-block">
            <img src="${URL.createObjectURL(item)}" alt="Фотография" >
            <p data-index="${key}" onclick="deleteImg(event)">×</p>
        </div>`);
    })
}
