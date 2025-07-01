document.addEventListener("DOMContentLoaded", () => {
  const params    = new URLSearchParams(window.location.search);
  const movieId   = params.get("id");
  const container = document.getElementById("movie-details");

  axios.get(`http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/get_movies.php
?id=${movieId}`)
    .then(resp => {
      const movie = resp.data.movies[0];
      if (!movie) {
        container.innerText = "Movie not found.";
        return;
      }

      // Render details + button
      container.innerHTML = `
        <h1>${movie.title}</h1>
        <img
          src="data:image/jpeg;base64,${movie.poster}"
          alt="${movie.title}"
          class="detail-poster"
        />
        <p><strong>Producer:</strong> ${movie.producer}</p>
        <p><strong>Director:</strong> ${movie.director}</p>
        <p><strong>Duration:</strong> ${movie.duration} min</p>
        <p><strong>Country:</strong> ${movie.country}</p>
        <p><strong>Show Dates:</strong> ${movie.start_date} → ${movie.end_date}</p>
        <p class="description">${movie.description}</p>
        <button id="reserve-btn" class="reserve-btn">Reserve Ticket</button>
      `;

      const btn = document.getElementById('reserve-btn');
      btn.addEventListener('click', () => {
        window.location.href = `seats.html?movieId=${movieId}`;
      });
    })
    .catch(err => {
      console.error(err);
      container.innerText = "Error loading movie details.";
    });
});
