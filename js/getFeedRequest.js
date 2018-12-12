'use strict'

// retrieve all vote buttons
let droplist = document.getElementById('channel')
droplist.addEventListener('change', changedSelected)

// what happens after a vote button has been clicked
function changedSelected(event) {

  let selectedChannel = droplist.options[droplist.selectedIndex].value

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open("get", "../pages/feed.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  
  request.addEventListener("load", function () {
      location.href = '../pages/feed.php?channelTitle=' + selectedChannel;
  })

  request.send(
    encodeForAjax(
    {
        channelTitle : selectedChannel
    })
  )
}

// helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}