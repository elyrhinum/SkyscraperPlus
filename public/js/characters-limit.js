const complexDescription = document.querySelectorAll('.header__complex-description'),
    adDescription = document.querySelectorAll('.info__description')

complexDescription.forEach(elem => {
    elem.textContent = limitStr(elem.textContent, 400)
})

adDescription.forEach(elem => {
    elem.textContent = limitStr(elem.textContent, 200)
})

function limitStr(str, n, symb) {
    if (!n && !symb) return str;
    if (str.length < n) return str;
    symb = symb || '...';
    return str.substr(0, n - symb.length) + symb;
}
