'use strict'

// retrieve all droplists
let orderDroplist = document.getElementById('order')
orderDroplist.addEventListener('change', changedOrder)

// set current channel and order by parameters on feed
window.addEventListener('load', function () { 
  let order = sessionStorage.getItem('orderBy')
  if (order == null)
    orderDroplist.value = 'none'
  else
    orderDroplist.value = order
})

// what happens after order parameter changed
function changedOrder(event) {

  let order = orderDroplist.options[orderDroplist.selectedIndex].value
  let sort = '';

  //alert(user );


  // store selected channel option
  sessionStorage.setItem('orderBy', order)

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
    case 'likes':
      order = 'likes'
      sort = 'ASC';
      break;
    case 'dislikes':
      order = 'dislikes'
      sort = 'DESC'
      break;
  }

  // setup of the ajax request
  let request = new XMLHttpRequest()

  // construct url with csrf security token
  request.open('get', '../pages/feed.php', true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  let user = document.getElementById('profile').getAttribute('value')

  request.addEventListener('load', function () {
    let orderBy = sessionStorage.getItem('orderBy')

    if (orderBy == 'none')
      location.href = '../pages/profile.php?username=' + user
    else
      location.href = '../pages/profile.php?username=' + user + '&order=' + order + '&sort=' + sort
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