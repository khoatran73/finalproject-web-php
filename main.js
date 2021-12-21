
// show password
let pwdField = document.querySelectorAll("input[type='password']")

let i1 = document.querySelector("#pass-i")
input_field1 = pwdField[0]

if (i1) {
    i1.onclick = () => {
        if (input_field1.type === "password") {
            input_field1.type = "text"
            i1.classList.add("active")
        } else {
            input_field1.type = "password"
            i1.classList.remove("active")
        }
    }
}


let i2 = document.querySelector("#confirm-pass-i")
if (i2) {
    input_field2 = pwdField[1]
    i2.onclick = () => {
        if (input_field2.type === "password") {
            input_field2.type = "text"
            i2.classList.add("active")
        } else {
            input_field2.type = "password"
            i2.classList.remove("active")
        }
    }
}

let i3 = document.querySelector("#confirm-pass-i2")
if (i3) {
    input_field3 = pwdField[2]
    i3.onclick = () => {
        if (input_field3.type === "password") {
            input_field3.type = "text"
            i3.classList.add("active")
        } else {
            input_field3.type = "password"
            i3.classList.remove("active")
        }
    }
}

// hidden error message
let inputArr = document.querySelectorAll('input');
if (inputArr) {
    inputArr.forEach (input => {
        input.addEventListener("click", () => {
            if (document.querySelector(".error-message")) {
                document.querySelector(".error-message").style.display = "none"
            }
            
        })
    })
}



// jQuery(document).ready(function ($) {
//     $('.owl-carousel').owlCarousel({
//         // loop: true,
//         margin: 10,
//         responsive: {
//             0: {
//                 items: 1
//             },
//             600: {
//                 items: 2
//             },
//             1200: {
//                 items: 4
//             }
//         }
    
//     })
// })


// register successfully

// const login = document.getElementById('login')
// let count = document.getElementById('count')

// let countdown = 10;
// setInterval(function() {
//     count.innerHTML = "" + --countdown
//     if (countdown === 0) {
//     loadLogin();
//     }
// }, 1000)

// function loadLogin() {
//     window.location.assign("login.php")
// }

// login.addEventListener('click', () => {
//     window.location.assign("login.php"  )
// })


// danh gia

// let starsArr = document.querySelectorAll('.stars');

// starsArr.forEach(stars => {
//     let star1 = stars.children[0];
//     let star2 = stars.children[1];
//     let star3 = stars.children[2];
//     let star4 = stars.children[3];
//     let star5 = stars.children[4];

//     star1.onclick = () => {
//         star1.className += " " + "checked";      
//     }
    
//     star2.onclick = () => {
//         star1.className += " " + "checked";
//         star2.className += " " + "checked";
//     }
    
    
//     star3.onclick = () => {
//         star1.className += " " + "checked";
//         star2.className += " " + "checked";
//         star3.className += " " + "checked";
//     }
    
//     star4.onclick = () => {
//         star1.className += " " + "checked";
//         star2.className += " " + "checked";
//         star3.className += " " + "checked";
//         star4.className += " " + "checked";
//     }
    
//     star5.onclick = () => {
//         star1.className += " " + "checked";
//         star2.className += " " + "checked";
//         star3.className += " " + "checked";
//         star4.className += " " + "checked";
//         star5.className += " " + "checked";
//     }
// })

// Hiện alert 

// let pay = document.querySelector('#pay')
// if (pay) {
//     pay.addEventListener("click", () => {
//         document.querySelector('.alert').classList.remove('hidden')
//     });   
// }

// Chuyển hướng đến login.php
const login = document.getElementById('login')
let count = document.getElementById('count')

let countdown = 10;
if (login) {
    setInterval(function() {
        count.innerHTML = "" + --countdown
        if (countdown === 0) {
        loadLogin();
        }
    }, 1000)
    
    function loadLogin() {
        window.location.assign("login.php")
    }
    
    login.addEventListener('click', () => {
        window.location.assign("login.php"  )
    })
}

// Chuyển hướng đến index.php
const index = document.getElementById('index')
// let count = document.getElementById('count')
countdown = 10;

if (index) {
    setInterval(function() {
        count.innerHTML = "" + --countdown
        if (countdown === 0) {
            loadIndex();
        }
    }, 1000)
    
    function loadIndex() {
        window.location.assign("index.php")
    }
    
    login.addEventListener('click', () => {
        window.location.assign("index.php"  )
    })
}


//comment
const form = document.querySelector(".comment-input")
if (form) {
    id_product = form.querySelector(".id_product").value
    inputField = form.querySelector(".input-field")
    sendBtn = form.querySelector(".send")
    commentArea = document.querySelector(".comment-area")

    form.onsubmit = (e)=>{
        e.preventDefault();
    }

    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "insertComment.php?id=" + id_product, true);
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }

    setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "getComment.php?id=" + id_product, true);
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                commentArea.innerHTML = data;
            }
        }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send();
    }, 50);

    function scrollToBottom() {
        commentArea.scrollTop = commentArea.scrollHeight;
    }
}


// search theo the loai 

let select = document.querySelector(".select-search")
if (select) {
    select.addEventListener("change", () => {
        window.location.href = "app-list.php?type=" + select.value      
    })
}

// chuyen den trang pay

let payBtn = document.querySelector("#pay")
let idBox = document.querySelector("#id-product")
if (idBox) {
    id = idBox.innerHTML
}
let priceBox = document.querySelector("#price")
if (priceBox) {
    price = priceBox.innerHTML
}
if (payBtn) {
    payBtn.addEventListener("click", () => {
        if (document.querySelector("#email")) {
            if (confirm("Bạn phải đăng nhập để mua")) {
                window.location.href = "login.php"
            }
        } else {
            if (confirm("Bạn có muốn mua ứng dụng này ?")) {
                window.location.href = "pay.php?id=" + id + "&price=" + price
            }
        }
    })
}
  