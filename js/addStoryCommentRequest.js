'use strict'

// retrieves the story 'send' comment button
let commentForm = document.querySelector('form')
commentForm.addEventListener('submit', commentSubmitted)

function commentSubmitted(event) {
    event.preventDefault()
    
    let form = event.target.parentNode

    let storyId = form.querySelector('input[name="storyId"]').value
    let commentText = form.querySelector('input[name="text"]').value
    let csrf = form.querySelector('input[name="csrf"]').value

    // setup of the ajax request
    let request = new XMLHttpRequest()

    request.open("post", "../api/api_addStoryComment.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    request.addEventListener("load", function () {
        let response = JSON.parse(this.responseText)
        // TODO: add new comment html
    })

    request.send(
        encodeForAjax(
            {
                storyId : storyId,
                commentText : commentText,
                csrf: csrf
            })
    )
}

// helper function
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}