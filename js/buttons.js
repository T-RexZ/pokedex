function show_login() {


	document.getElementById('login-form').classList.toggle('visible');
	document.getElementById('register-form').classList.remove('visible')
	document.getElementById('about').classList.remove('visible');


}

function show_register() {


	document.getElementById('register-form').classList.toggle('visible');
	document.getElementById('login-form').classList.remove('visible');
	document.getElementById('about').classList.remove('visible');


}

function show_about() {


	document.getElementById('about').classList.toggle('visible');
	document.getElementById('login-form').classList.remove('visible');
	document.getElementById('register-form').classList.remove('visible');
}