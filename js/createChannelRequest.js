'use strict'

// retrieve 'new channel' button
let newChannel = document.querySelector('div#created-channels header button')
newChannel.addEventListener('click', doneClicked)

// retrieve 'created-channels' container
let channelsDiv = document.getElementById('created-channels')
let createdChannelsContainer = channelsDiv.getElementsByClassName('container')[0]

// what happens after the 'new channel' button has been clicked
function doneClicked() {

  if (createdChannelsContainer.querySelector('div.form-input') == null) {

    createdChannelsContainer.insertAdjacentHTML(
      'beforeend',
      '<form class="story-card bg-white">'
      + '<div class="form-input">'
      + '<label>New channel</label>'
      + '<input type="text" name="title" placeholder="new channel title" required>'
      + '</div>'
      + '<button class="button primary" type="submit">Add channel</button>' +
      '</form>'
    )

    // retrieves the form and sets its submit handler  
    let addChannel = createdChannelsContainer.querySelector('form')
    addChannel.addEventListener('submit', formSubmitted)
  }
}

// what happens after the 'add channel button' has been clicked
function formSubmitted(event) {
  event.preventDefault();

  // required inputs for the channel request
  let formDiv = event.target.parentNode
  let channelTitle = formDiv.querySelector('input[name="title"]').value

  let csrf = channelsDiv.getAttribute('csrf')

  // setup of the ajax request
  let request = new XMLHttpRequest()

  request.open("post", "../api/api_createChannelRequest.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  request.addEventListener("load", function () {

    let response = JSON.parse(this.responseText)
    
    // if channel could not be created
    if (response['error']) {
      let existsMessage = createdChannelsContainer.querySelector('section#messages');

      if (!existsMessage) {
        createdChannelsContainer.querySelector('form').insertAdjacentHTML(
          'beforeend',
          '<section id="messages">'
          + '<article class="error">'
          + '<p>' + response['error'] + '</p>'
          + '</article>'
          + '<?php } clearMessages(); ?>' +
          '</section>'
        )
      }
    } else {
      // remove input div
      let inputDiv = channelsDiv.getElementsByClassName('form-input')[0]
      let form = inputDiv.parentNode;
      form.parentNode.removeChild(form);

      // add new channel
      createdChannelsContainer.insertAdjacentHTML(
        'beforeend',
        '<a href="channel.php?title=' + channelTitle + '">'
        + '<div class="story-card bg-white">' +
        channelTitle + ' - ' + '0 stories'
        + '</div>' +
        '</a>'
      )
    }
  })

  request.send(
    encodeForAjax(
      {
        channelTitle: channelTitle,
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