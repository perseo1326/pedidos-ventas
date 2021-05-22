// codigo Javascript general que puede ser usado en varias paginas al mismo tiempo

var btnSalir = document.getElementById("cerrarSesion");

// *************************************************
btnSalir.onclick = function () {
	btnSalir.nextElementSibling.classList.toggle("visible");
};

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
	if (!event.target.matches(".dropbtn")) {
		let dropdowns = document.getElementsByClassName("dropdown-content");
		let i;
		for (i = 0; i < dropdowns.length; i++) {
			let openDropdown = dropdowns[i];
			if (openDropdown.classList.contains("visible")) {
				openDropdown.classList.remove("visible");
			}
		}
	}
};
