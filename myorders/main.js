/***************Order Details******************* */
document.addEventListener("DOMContentLoaded", function () {
    let orderCells = document.querySelectorAll(".order-details");

    orderCells.forEach(cell => {
        cell.addEventListener("click", function () {
            let orderId = this.getAttribute("data-order-id");

            fetch(`get_order_details.php?order_id=${orderId}`)
                .then(response => response.text())
                .then(data => {
                    let detailsRow = document.getElementById("orderDetailsRow");
                    let detailsDiv = document.getElementById("orderDetails");

                    detailsDiv.innerHTML = data;
                    detailsRow.style.display = "table-row";
                })
                .catch(error => console.error("Error fetching details:", error));
        });
    });
});
/************************************************ */
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".filter_data").addEventListener("submit", function (event) {
        event.preventDefault();

        let start_date = document.querySelector("input[name='start_date']").value;
        let end_date = document.querySelector("input[name='end_date']").value;

        fetch(`Filter_data.php?start_date=${start_date}&end_date=${end_date}`)
            .then(response => response.json())
            .then(data => {
                let tableBody = document.querySelector("tbody");
                tableBody.innerHTML = "";
                if (data.error) {
                    tableBody.innerHTML = `<tr><td colspan="6">${data.error}</td></tr>`;
                } else if (data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="6">No orders found.</td></tr>`;
                } else {
                    data.forEach(order => {
                        let row = `<tr>
                            <td class="order-details" data-order-id="${order.order_id}" style="cursor: pointer;">
                                ${order.created_at}
                            </td>
                            <td>${order.status}</td>
                            <td>
                                <form method="POST" action="Amount.php">
                                    <input type="hidden" name="order_id" value="${order.order_id}">
                                    <button type="submit" name="change_amount" value="-1">-</button>
                                    ${parseInt(order.Amount)} 
                                    <button type="submit" name="change_amount" value="1">+</button>
                                </form>
                            </td>
                            <td>${order.unit_price}</td>
                            <td>${order.total_price}</td>
                            <td>
                                ${order.status === "pending" ? `
                                    <form method="POST" action="cancel_order.php">
                                        <input type="hidden" name="order_id" value="${order.order_id}">
                                        <button type="submit">Cancel</button>
                                    </form>` : ""}
                            </td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                }
            })
            .catch(error => console.error("Error fetching data:", error));
    });
});
console.log("sdjfklvguiwsrgtvuhebsrio");