<?php if(!session()->get('isLoggedIn')) {
    header('location:/');
    exit();
} ?>

<div class="container">
    <h1 style="width:50%; margin:auto;">This is the future chat..</h1>

    <div class="chat-container" id="chat-container">

        <ul id="message-list">
        </ul>
    </div>
    <form class="form-group" id="chatForm">
        <input class="form-control" type="text" style="margin: 10px; width: 50%;" name="message"
               placeholder="Your message">
        <input class="btn btn-primary" type="submit" name="submit">
        <input id="sender" type="text" name="sender" style="display: none" value="">
    </form>
    </body>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function (e) {
        grabMessages()
        const refreshInterval = setInterval(function () {
            grabMessages()
        }, 3000)
        const form = document.querySelector("#chatForm")
        form.addEventListener("submit", function (e) {
            e.preventDefault()
            postMessage(e.target)
        })
    })

    function grabMessages() {
        fetch('/restchat', {
            method: "get",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => response.json()
            .then(data => {
                console.log(data.chat);
                renderMessages(data.chat);
                //form.message.value = "";
            }))
    }

    function postMessage(form) {
        fetch("/restchat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                "sender": 5,
                "message": form.message.value
            })
        })
            .then(resp => resp.json())
            .then(function (json) {
                grabMessages()
                form.message.value = ""
            })
    }

    function renderMessages(messages) {
        //const length = messages.length
        //const mostRecent = messages.slice(length - 50)
        const list = document.querySelector("#message-list")
        let newList = ""
        messages.forEach(message => {
            if (!!!document.querySelector(`li[data-id='${message.id}']`)) {
                newList += makeLi(message)
            }
        })
        if (newList != "") {
            list.innerHTML += newList
        }
    }

    function makeLi(message) {
        // Some logic to make your own messages say You instead of your name
        let sender = document.querySelector("#sender").value
        if (message.sender == sender) {
            sender = "You"
        } else {
            sender = message.sender
        }
        //prettier-ignore
        return `
    <li data-id=${message.id}
    <div class="list-container">
        <img src="../images/Persona.png" alt="Avatar">
        <h4>${message.sender}</h4>
        <p>${message.message}</p>
        <span class="time-right">11:00</span>
    </div>
    </li>

    `
    }
</script>