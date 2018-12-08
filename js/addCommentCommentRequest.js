'use strict'

// retrieves the comment form and sets its submit handler  
let replyLinks = document.querySelectorAll('div.story-footer-right a')
replyLinks.forEach((replyLink) => replyLink.addEventListener('click', doneClicked))

// what happens after the 'reply' comment link has been clicked
function doneClicked(event) {

	let footer = event.target.parentNode.parentNode

	if (footer.querySelector('form') == null) {
		footer.insertAdjacentHTML(
			'beforeend',
			'<form action="" class="story-card bg-white">'
			+ '<div class="form-input">'
			+ '<label>Insert comment:</label>'
			+ '<input type="textarea" name="text" placeholder="insert your comment here ..." required>'
			+ '<button class="button primary" type="submit">Add comment</button>'
			+ '</div>' +
			'</form>'
		)

		// retrieve the comment form
		let form = footer.querySelector('form')

		// set its submit handler
		form.addEventListener('submit', formSubmitted)

		/* allow ENTER to submit the comment form - not working
		form.addEventListener('keyup', function (event) {
				event.preventDefault()
				console.log(form)
				if (event.keyCode === 13)
					form.submit()
		})*/
	}
}

function formSubmitted(event) {
	event.preventDefault()

	let footer = event.target.parentNode;
	let link = footer.querySelector('div.story-footer-right a')

	let linkHref = link.getAttribute('href')
	let commentId = linkHref.substr(1, linkHref.length)

	let csrf = link.getAttribute('csrf')

	// setup of the ajax request
	let request = new XMLHttpRequest()

	request.open("post", "../api/api_addCommentComment.php", true)
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

	request.addEventListener("load", function () {
		let response = JSON.parse(this.responseText)

	})

	request.send(
		encodeForAjax(
			{
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