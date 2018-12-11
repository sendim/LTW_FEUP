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

		// retrieve the comment form and set its submit handler
		let form = footer.querySelector('form')
		form.addEventListener('submit', formSubmitted)
	}
}

function formSubmitted(event) {
	event.preventDefault()

	let footer = event.target.parentNode;
	let link = footer.querySelector('div.story-footer-right a')

	// comment needed attributes
	let linkHref = link.getAttribute('href')
	let refCommentId = linkHref.substr(1, linkHref.length)

	let storyId = link.getAttribute('storyId')

	let form = footer.querySelector('form')
	let text = form.querySelector('input[name="text"]').value

	let csrf = link.getAttribute('csrf')

	// setup of the ajax request
	let request = new XMLHttpRequest()

	request.open("post", "../api/api_addCommentComment.php", true)
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

	request.addEventListener("load", function () {
		let response = JSON.parse(this.responseText)
		location.reload()
	})

	request.send(
		encodeForAjax(
			{
				storyId : storyId,
				refCommentId : refCommentId,
				text : text,
				csrf : csrf
			})
	)
}

// helper function
function encodeForAjax(data) {
	return Object.keys(data).map(function (k) {
		return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
	}).join('&')
}