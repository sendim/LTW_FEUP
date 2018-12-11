'use strict'

// retrieve all vote buttons
let commVoteBtns = document.querySelectorAll('div.comment.vote-buttons button')
commVoteBtns.forEach((commVoteBtn) => commVoteBtn.addEventListener('click', doneClicked))

// what happens after a vote button has been clicked
function doneClicked(event) {
  let btn = event.currentTarget

  let username = btn.getAttribute('username')
  let commentId = btn.getAttribute('commentId')
  let vote = btn.getAttribute('vote')
  let csrf = btn.getAttribute('csrf')

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open("post", "../api/api_commentVoteRequest.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  
  request.addEventListener("load", function () {
    let response = JSON.parse(this.responseText)

    // update likes & dislikes values of story button
    var likesSpan = btn.parentNode.querySelector('span[type="likes"]')
    var dislikesSpan = btn.parentNode.querySelector('span[type="dislikes"]')
    likesSpan.innerHTML = response['likes']
    dislikesSpan.innerHTML = response['dislikes']
  })

  request.send(
    encodeForAjax(
    {
      username : username,
      commentId : commentId,
      vote : vote,
      csrf : csrf
    })
  )
}

// helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}