'use strict'

// retrieve all vote buttons
let voteBtns = document.querySelectorAll('div.story.vote-buttons button')
voteBtns.forEach((voteBtn) => voteBtn.addEventListener('click', doneClicked))

// what happens after a vote button has been clicked
function doneClicked(event) {
  let btn = event.currentTarget

  let username = btn.getAttribute('username')
  let storyId = btn.getAttribute('storyId')
  let vote = btn.getAttribute('vote')
  let csrf = btn.getAttribute('csrf')

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open("post", "../api/api_storyVoteRequest.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  request.addEventListener("load", function () {
    let response = JSON.parse(this.responseText)

    // update likes & dislikes values of story button
    var likesSpan = btn.parentNode.querySelector('span[type="likes"]')
    likesSpan.innerHTML = response['likes']

    // update user points if on profile
    var userPoints = document.querySelector('span[type="points"]');
    if (userPoints != null)
      userPoints.innerHTML = response['userPoints']
  })

  request.send(
    encodeForAjax(
      {
        username: username,
        storyId: storyId,
        vote: vote,
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