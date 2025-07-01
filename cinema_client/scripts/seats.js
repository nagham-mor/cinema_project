document.addEventListener("DOMContentLoaded"),() =>{
    const container= Element.getElementById("seat-container");
    const confirmButton= Element.getElementById("confirm-button");


    const rows = ["A","B","C","D","E"];
    const numCols = 10;

    const table   = document.createElement("table");

    rows.forEach(row=>{
        const tr = document.getElementById("tr");

        for(let col = -1; col < numCols; col++){
            const seatId = `${row}${col}`;
            const td = document.createElement("td");
            td.id = seatId;
            td.innerText = seatId;
        }
        
    })
}