document.addEventListener("DOMContentLoaded", function () {
	const form = document.querySelector('.search')
	
	let hadises = document.querySelectorAll('.hadis__box')
	let hadisCount = hadises.length;
	
	if (hadisCount > 3) {
	    console.log("Привет")
	    for (let i = 3; i < hadisCount; i++) {
	        hadises[i].style.display='none';
	    }
	}

	form.addEventListener('submit', function (evt) {
	    document.querySelectorAll(".hadis__box").forEach(el => el.remove());
		evt.preventDefault();
		
		const input = document.querySelector('#hadisSearch').value;

		if (input !== '') {
			this.submit()
		}
	});
	
});

// function deleteShortWords(str) {
//   let massiv = str.split(' ');

//   for (let i = 0; i < massiv.length; i++) {
//     if (massiv[i].length <= 3) {
//       massiv[i] = "";
//     }
//   }

//   return massiv.join(' ').replace(/\s+/g, ' ').trim();  
// }