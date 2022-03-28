
	//-------------------------------------------------//
	//   Tworzenie responsywnego paska nawigacyjnego   //
	//-------------------------------------------------//
	
function funkcja() {
  var x = document.getElementById("nav");
  if (x.className === "nav") { 			//warunek sprawdzający czy x.className jest taki sam jak nav
    x.className += "responsive"; 		//dodanie do id="nav" classy responsive
  } 
  else 
  {
    x.className = "nav";
  }
};


	//-------------------------------------------------//
	//            SPRAWDZANIE POLOZENIA                //
	//-------------------------------------------------//
	//												   //
	// funkcja sprawdza położenie zmiennej "id=lepki"  //
	//												   //
	//-------------------------------------------------//
	
document.addEventListener('DOMContentLoaded', function() {
  window.addEventListener('scroll', mojScroll);
  var zm = document.getElementById("lepki");
  var sticky = zm.offsetTop;
  	
  function mojScroll() {
    if (window.pageYOffset >= sticky) {
      console.log("sticky");	   		//wypisznie w konsoli przeglądarki kiedy jest nadany atrybut sticky
    } else {
      console.log("Not sticky");   		//wypisznie w konsoli przeglądarki kiedy jest usuwany atrubut sticky
    }
	if (window.pageYOffset >= sticky) {
      nav.classList.add("st");			// Nadanie dla zmiennej "id=lepki" klasy "st" 
    } else {
      nav.classList.remove("st"); 		//Jeżeli "pageYOffset" jest mniejszy to klasa "st" jest usuwana
    }
  }
})