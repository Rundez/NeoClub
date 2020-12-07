<?php if (!session()->get('isLoggedIn')) {
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
        <input class="form-control" type="text" style="margin: 10px; width: 50%;" name="message" placeholder="Your message">
        <input class="btn btn-primary" type="submit" name="submit">
        <input id="sender" type="text" name="sender" style="display: none" value="<?= session()->get('id') ?>">
    </form>
    </body>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(e) {
        grabMessages()

        const refreshInterval = setInterval(function() {
            grabMessages()
        }, 3000)
        const form = document.querySelector("#chatForm")
        form.addEventListener("submit", function(e) {
            e.preventDefault()
            postMessage(e.target)
            $("#chat-container").animate({
                scrollTop: $('#chat-container').prop("scrollHeight")
            }, 1000);
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
                    "sender": form.sender.value,
                    "message": form.message.value
                })
            })
            .then(resp => resp.json())
            .then(function(json) {
                grabMessages()
                form.message.value = ""
            })
    }

    function renderMessages(messages) {
        messages.sort(((a, b) => a.id - b.id))


        //const length = messages.length
        const mostRecent = messages.slice(0, -50)
        const list = document.querySelector("#message-list")
        let newList = ""
        messages.forEach(message => {
            if (!!!document.querySelector(`li[data-id='${message.id}']`)) {
                newList += makeLi(message)
            }
        })
        // Append messages to the list
        if (newList != "") {
            list.innerHTML += newList
            let newLength = messages.length;

            // Scroll to bottom after page refresh
            if (newLength > length) {
                $("#chat-container").animate({
                    scrollTop: $('#chat-container').prop("scrollHeight")
                }, 1000);
                length = newLength;
            }
        }
    }

    function makeLi(message) {
        message.senderId = message.sender
        // Some logic to make your own messages say You instead of your name
        //let sender = document.querySelector("#sender").value
        let  style;
        let imgPos;
        let senderPos;
        if (message.sender == <?= session()->get('id') ?>) {
           style = "style='background-color:lightblue'"
          imgPos = "style='float: right'"
          senderPos = "style='float: right; padding-right: 10px;'"
            message.sender = "You"

        } else {
            message.sender = `${message.firstName} ${message.lastName}`
        }
        //prettier-ignore

      return `
    <li data-id=${message.id}
    <div class="list-container" ${style}">
        <img src="../uploads/${message.senderId}" alt="Avatar"  ${imgPos}>
        <h4 ${senderPos}>${message.sender}</h4>
        <p>${message.message}</p>
        <span class="time-right">${message.sent.slice(0, -7)}</span>
    </div>
    </li>

    `
    }
</script>