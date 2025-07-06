const form = document.getElementById("login-form");
const errorBox = document.getElementById("loginError");

const API_BASE = "http://localhost/SE_Factory_applications/cinema_project/cinema_server";

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  errorBox.textContent = "";

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;

  try {

    const response = await axios.get(`${API_BASE}/login`, {
      params: { email, password },
    });

    console.log("Server response:", response.data);

    if (response.data.status === 200 && response.data.payload) {
      localStorage.setItem("user", JSON.stringify(response.data.payload));
      window.location.href = "../index.html";
    } else {
      errorBox.textContent =
        response.data.error || "Login failed—check your credentials.";
    }
  } catch (err) {
    console.error("Network or server error:", err);
    errorBox.textContent = "Cannot reach server. Try again later.";
  }
});
