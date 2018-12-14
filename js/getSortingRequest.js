'use strict'

// retrieve all droplists
let channelDroplist = document.getElementById('channel')
channelDroplist.addEventListener('change', changedChannel)

let orderDroplist = document.getElementById('order')
orderDroplist.addEventListener('change', changedOrder)

// set current channel and order by parameters on feed
window.addEventListener('load', function () {
  // restore selected channel option
  let channel = localStorage.getItem('selectedChannel')
  channelDroplist.value = channel

  let order = this.localStorage.getItem('orderBy')
  orderDroplist.value = order
})

// what happens after selected channel changes
function changedChannel(event) {

  let index = channelDroplist.selectedIndex;
  let selectedChannel = channelDroplist.options[index].value

  // store selected channel option
  localStorage.setItem('selectedChannel',selectedChannel)
  // restart order by
  localStorage.setItem('orderBy','none')

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open("get", "../pages/feed.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  request.addEventListener('load', function () {
    let index = channelDroplist.selectedIndex;
    let selectedChannel = channelDroplist.options[index].value

    if (selectedChannel != 'none')
      location.href = '../pages/feed.php?channel=' + selectedChannel
    else
      location.href = '../pages/feed.php'
  })

  request.send(
    encodeForAjax(
      {
        channel: selectedChannel
      })
  )
}

// what happens after order parameter changed
function changedOrder(event) {

  let order = orderDroplist.options[orderDroplist.selectedIndex].value
  let sort = '';

  // store selected channel option
  localStorage.setItem('orderBy', order)

  switch (order) {
    case 'published_asc':
      order = 'published'
      sort = 'ASC'
      break;
    case 'published_desc':
      order = 'published'
      sort = 'DESC';
      break;
    case 'title_asc':
      order = 'title'
      sort = 'ASC';
      break;
    case 'title_desc':
      order = 'title'
      sort = 'DESC'
      break;
  }

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open("get", "../pages/feed.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  request.addEventListener("load", function () {
    let index = orderDroplist.selectedIndex;
    let orderBy = orderDroplist.options[index].value

    if (orderBy != 'none')
      location.href = '../pages/feed.php?order=' + order + '&sort=' + sort
    else
      location.href = '../pages/feed.php?channel=' + selectedChannel + '&order=' + order + '&sort=' + sort
  })

  request.send(
    encodeForAjax(
      {
        order: order
      })
  )
}

// helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}