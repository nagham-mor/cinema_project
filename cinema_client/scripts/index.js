document.addEventListener("DOMContentLoaded", () => {
  const nowGrid  = document.getElementById("nowGrid");
  const soonGrid = document.getElementById("soonGrid");
  const today    = new Date("2025-07-05");

  axios
    .get("http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/get_movies.php")
    .then(response => {
      const list = response.data.movies || [];

      list.forEach(movies => {
        const date = new Date(movies.start_date);

        const card = document.createElement("div");
        card.className = "movie-card";
        card.innerHTML = `
          <img src="data:image/jpeg;base64,${movies.poster}" alt="Poster">
          <h3>${movies.title}</h3>
          <p>${movies.start_date}</p>
        `;

       card.style.cursor = 'pointer';      
       card.addEventListener('click', () => {
       window.location.href = `pages/movieDetails.html?id=${movies.id}`;
});


        
        if (date <= today) {
          nowGrid.appendChild(card);
        } else {
          soonGrid.appendChild(card);
        }
      });
    })
    .catch(err => console.error(err));
});
