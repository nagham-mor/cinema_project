
document.addEventListener("DOMContentLoaded", () => {
  const nowGrid  = document.getElementById("nowGrid");
  const soonGrid = document.getElementById("soonGrid");
  const today    = new Date("2025-07-05");
  
  const API_BASE = "http://localhost/SE_Factory_applications/cinema_project/cinema_server";

  axios
    .get(`${API_BASE}/get_all_movies`)
    .then(response => {
   
      const movies = response.data.payload || [];

      movies.forEach(movie => {
        const date = new Date(movie.start_date);

        const card = document.createElement("div");
        card.className = "movie-card";
        card.innerHTML = `
          <img src="data:image/jpeg;base64,${movie.poster}" alt="Poster of ${movie.title}">
          <h3>${movie.title}</h3>
          <p>Starts: ${movie.start_date}</p>
        `;
        card.style.cursor = "pointer";
        card.addEventListener("click", () => {
          window.location.href = `pages/movieDetails.html?id=${movie.id}`;
        });

        if (date <= today) {
          nowGrid.appendChild(card);
        } else {
          soonGrid.appendChild(card);
        }
      });
    })
    .catch(err => {
      console.error("Error fetching movies:", err);
      const msg = document.createElement("p");
      msg.textContent = "Unable to load movies. Please try again later.";
      nowGrid.appendChild(msg);
    });
});
