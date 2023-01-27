const form = document.querySelector('#newCommentForm');
const nameInput = document.getElementById('username');
const commentInput = document.getElementById('comment');

form.addEventListener('submit', function(e) {
    e.preventDefault()
    let submitBtn = this.querySelector('.submit__input');
    submitBtn.disabled = true;
    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();
    let url = form.action;
    xhr.open('POST', url, true);
    xhr.send(formData);
    xhr.onload = function() {
        let data = JSON.parse(xhr.responseText);
        if (xhr.readyState === 4) {
            const errors = document.querySelectorAll('.error-msg');
            errors.forEach(function(elem) {
                elem.parentNode.removeChild(elem);
            });
            if (xhr.status === 400 && data['status'] === 400) {
                submitBtn.disabled = false;
                const keys = data['object'].keys();
                for (const key of keys) {
                    const input = document.querySelector(`#${data['object'][key]}`);
                    const p = document.createElement("p");
                    p.classList.add('error-msg');
                    p.innerHTML = data['message'][key];
                    const textBlock = input.previousSibling.previousSibling;
                    textBlock.querySelector('.error-msg') === null ? textBlock.appendChild(p) :
                        console.log('error');
                }
            }
            if (xhr.status === 400 && data['status'] === 'addFail') {
                submitBtn.disabled = false;
                alert(data['message']);
            }
            if (xhr.status === 200) {
                const successText = document.createElement("p");
                successText.classList.add('success-add');
                successText.innerHTML = data['message'];
                const newCommentHeader = document.querySelector('.new-comment__header');
                newCommentHeader.style.paddingBottom = '0';
                newCommentHeader.appendChild(successText);
                form.reset();
                nameInput.disabled = true;
                commentInput.disabled = true;
                setTimeout(function() { window.location.reload(); }, 3000);
            }
        }
    }
});